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
 * This interface defines the set of functions a class needs to implement
 * to use the CRM/Clicktocall object.
 *
 * Using this interface allows us to standardize on multiple things including
 * calling a contact
 *
 *
 * @package CRM
 * @copyright CiviCRM LLC (c) 2005-2016
 * $Id$
 *
 */
interface CRM_Clicktocall_ClickToCallAPI {


  /**
   * creates a call
   *
   * @param 
   * $to string containing the number of the person intended for receiving the call.
   * $twilio array containing the settings.
   * $host array containing url of the outbound call.
   *
   * @return array the response from the API
   *
   */
  public static function create($to, $settings, $host);

}

