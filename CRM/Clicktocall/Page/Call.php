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
    $number = CRM_Utils_Request::retrieve('phoneNumber', 'String');
    $host = CRM_Utils_System::url('civicrm/clicktocall/outbound', NULL, TRUE, NULL, TRUE, TRUE, FALSE);
    $host = "http://attentive.ly.jmaconsulting.biz/civicrm/attentively/authcallback";
    $twilio = CRM_Core_OptionGroup::values('twilio_auth', TRUE, FALSE, FALSE, NULL, 'name', FALSE);

    $client = new Twilio\Rest\Client(
      $twilio['twilio_account_sid'],
      $twilio['twilio_auth_token']
    );

    try {
      $client->calls->create(
        $number, // The visitor's phone number
        $twilio['twilio_number'], // A Twilio number in your account
        array(
          "url" => $host,
        )
      );
    } catch (Exception $e) {
      // Failed calls will throw
      return $e;
    }
    
    // return a JSON response
    return array('message' => 'Call incoming!');
  }
}
