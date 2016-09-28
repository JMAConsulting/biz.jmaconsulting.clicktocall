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

class CRM_Clicktocall_Page_Outbound extends CRM_Core_Page {

  function run() {
    $toNumber = CRM_Utils_Request::retrieve('toNumber', 'String');
    $toName = CRM_Utils_Request::retrieve('toContactName', 'String');
    $fromName = CRM_Utils_Request::retrieve('fromContactName', 'String');
    $sayMessage = "Hi {$fromName}!";

    $response = new Twilio\Twiml();
    $response->say($sayMessage);
    $dialParams = array(
      array(
        'action' => CRM_Utils_System::url('civicrm/call/dial', 'toNumber={$toNumber}', TRUE, NULL, FALSE, TRUE, FALSE),
        'method' => 'GET',
        'say' => "Press 1 to confirm call to {$toName}. Press 2 to quit the call.",
      ),
      'say' => 'Thank you. Goodbye.'
    );
    $response->gather($dialParams);
    print $response->__toString();
    exit;
  }
}
