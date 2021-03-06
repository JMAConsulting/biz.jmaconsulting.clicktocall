<?php

/*
 +--------------------------------------------------------------------+
 | CiviCRM version 4.7                                                |
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC (c) 2004-2016                                |
 +--------------------------------------------------------------------+
 | This file is a part of CiviCRM.                                    |
 |                                                                    |
 | CiviCRM is free software; you can copy, modify, and distribute it  |
 | under the terms of the GNU Affero General Public License           |
 | Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
 |                                                                    |
 | CiviCRM is distributed in the hope that it will be useful, but     |
 | WITHOUT ANY WARRANTY; without even the implied warranty of         |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
 | See the GNU Affero General Public License for more details.        |
 |                                                                    |
 | You should have received a copy of the GNU Affero General Public   |
 | License and the CiviCRM Licensing Exception along                  |
 | with this program; if not, contact CiviCRM LLC                     |
 | at info[AT]civicrm[DOT]org. If you have questions about the        |
 | GNU Affero General Public License or the licensing of CiviCRM,     |
 | see the CiviCRM license FAQ at http://civicrm.org/licensing        |
 +--------------------------------------------------------------------+
 */

/**
 *
 * @package CRM
 * @copyright CiviCRM LLC (c) 2004-2016
 * $Id$
 *
 */
class CRM_Clicktocall_BAO_Twilio_Call implements CRM_Clicktocall_ClickToCallAPI {

  public static function create($cid, $fromNumber, $twilio, $host) {

    $client = new Twilio\Rest\Client(
      $twilio['twilio_account_sid'],
      $twilio['twilio_auth_token']
    );
    $isRecord = FALSE;
    if ($twilio['is_record']) {
      $isRecord = TRUE;
    }

    try {
      $client->account->calls->create(
        $fromNumber,
        $twilio['twilio_number'],
        array(
          "url" => $host,
          "method" => "GET",
          "record" => $isRecord,
          "statusCallbackMethod" => "POST",
          "statusCallback" => CRM_Utils_System::url('civicrm/call/callstatus', NULL, TRUE, NULL, TRUE, TRUE, FALSE),
          "statusCallbackEvent" => array(
            "completed",
          ),
        )
      );
    }
    catch (Exception $e) {
      // Failed calls will throw
      return $e;
    }
    
    // return success
    return TRUE;
  }

  public static function createActivity($call, $data) {
    $activityTypes = CRM_Core_PseudoConstant::activityType(TRUE, FALSE, FALSE, 'name');
    $activityStatus = CRM_Core_PseudoConstant::activityStatus('name');

    // Get contacts
    $toPhone = civicrm_api3('Phone', 'get', array(
      'sequential' => 1,
      'return' => array("contact_id"),
      'phone' => $call->to,
    ));
    foreach ($toPhone['values'] as $values) {
      $toCid = $values['contact_id'];
      break;
    }

    $fromPhone = civicrm_api3('Phone', 'get', array(
      'sequential' => 1,
      'return' => array("contact_id"),
      'phone' => $call->from,
    ));
    foreach ($fromPhone['values'] as $values) {
      $fromCid = $values['contact_id'];
      break;
    }

    // Twilio Details
    $message = "<h1>Twilio Information</h1>";
    $message .= "<br/>";
    $message .= "<p><b>Call SID:</b> {$call->sid}";

    $activityParams = array(
      'activity_type_id' => array_search('Phone Call', $activityTypes),
      'subject' => 'Twilio - Phone call',
      'status_id' => array_search('Completed', $activityStatus),
      'activity_date_time' => $call->startTime->format('YmdHis'),
      'duration' => round($call->duration/60, 2),
      'source_contact_id' => $fromCid,
      'target_contact_id' => $toCid,
      'assignee_contact_id' => $toCid,
      'details' => $message,
      'version' => 3,
    );
    // Add recording as attachment.
    if (CRM_Utils_Array::value('RecordingUrl', $data)) {
      $path = CRM_Core_Config::singleton()->customFileUploadDir;
      $name = basename($data['RecordingSid']) . '.wav';
      $path = $path . $name;
      file_put_contents($path, fopen($data['RecordingUrl'], 'rb'));
      $recording = array(
        'api.Attachment.create' =>  array(
          'sequential' => 1,
          'name' => $name,
          'mime_type' => 'audio/wav',
          'entity_table' => "civicrm_activity",
          'path' => $path,
          'options' => array('move-file' => $path),
        ),
      );
      $activityParams = $activityParams + $recording;
    }
    // create the activity
    civicrm_api( 'Activity', 'create', $activityParams);
  }

  public static function formatPhone($number) {
    // Weird case when passing numbers between XMLs cause + to disappear.
    if (strpos($number, '+') === FALSE) {
      return '+' . trim($number);
    }
    return trim($number);
  }
}
