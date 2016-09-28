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

class CRM_Clicktocall_Page_Status extends CRM_Core_Page {

  function run() {
    if ($data = $_POST) {
      CRM_Core_Error::debug('new', $_POST);
      $twilio = CRM_Core_OptionGroup::values('twilio_auth', TRUE, FALSE, FALSE, NULL, 'name', FALSE);

      $username = $twilio['twilio_account_sid'];
      $password = $twilio['twilio_auth_token'];
      $url = "https://api.twilio.com/2010-04-01/Accounts/" . $twilio['twilio_account_sid'] . "/Calls.json?ParentCallSid=" . $data['CallSid'];
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$url);
      curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
      curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
      curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
      $result = curl_exec($ch);
      curl_close ($ch);

      if ($result) {
        CRM_Clicktocall_BAO_Twilio_Call::createActivity($result);
      }
    }
  }

}

