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

  public static function create($cid, $number, $twilio, $host) {

    $client = new Twilio\Rest\Client(
      $twilio['twilio_account_sid'],
      $twilio['twilio_auth_token']
    );

    try {
      $call = $client->account->calls->create(
        $number,
        $twilio['twilio_number'],
        array(
          "url" => $host,
          "sendName" => CRM_Contact_BAO_Contact::displayName($cid),
          "method" => "GET",
        )
      );
    }
    catch (Exception $e) {
      // Failed calls will throw
      return $e;
    }
    
    // return a JSON response
    return array('message' => 'Call incoming!');
    
  }
}
