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

class CRM_Clicktocall_Page_Call extends CRM_Core_Page {

  function run() {
    $twilio = Civi::settings()->get('civicrm_twilio_settings');
    if (empty($twilio['twilio_account_sid']) || empty($twilio['twilio_auth_token'])) {
      echo "Twilio credentials required to create call. Please navigate to Administer > Communications > Twilio Settings.";
      CRM_Utils_System::civiExit();
    }
    $toNumber = CRM_Utils_Request::retrieve('phoneNumber', 'String');
    $toContact = CRM_Utils_Request::retrieve('cid', 'String');
    $cid = CRM_Core_Session::singleton()->get('userID');
    $toName = rawurlencode(CRM_Contact_BAO_Contact::displayName($toContact));
    $fromName = rawurlencode(CRM_Contact_BAO_Contact::displayName($cid));
    $phone = CRM_Utils_Array::value('twilio_number', $twilio);

    if (empty($phone)) {
      try {
        $result = civicrm_api3('Phone', 'get', array("contact_id" => $cid, "is_primary" => 1));
        if ($result['count'] > 0 && isset($result['id'])) {
          $phone = $result['values'][$result['id']]['phone'];
        }
      }
      catch (CiviCRM_API3_Exception $e) {
        // Handle error here.
        $errorMessage = $e->getMessage();
        $errorCode = $e->getErrorCode();
        $errorData = $e->getExtraParams();
        return array(
          'error' => $errorMessage,
          'error_code' => $errorCode,
          'error_data' => $errorData,
        );
      }
    }
    $host = CRM_Utils_System::url('civicrm/call/outbound', "toNumber=$toNumber&toContactName=$toName&fromContactName=$fromName", TRUE, NULL, FALSE, TRUE, FALSE);
    $call = CRM_Clicktocall_BAO_Twilio_Call::create($cid, $phone, $twilio, $host);
    if ($call) {
      echo 1;
      CRM_Utils_System::civiExit();
    }
  }
}
