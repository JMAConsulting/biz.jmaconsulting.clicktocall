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

class CRM_Clicktocall_Form_CallSettings extends CRM_Core_Form {

  function buildQuickForm() {
    $this->add('text', 'twilio_account_sid', ts('Twilio Account SID'), array(), TRUE);
    $this->add('text', 'twilio_auth_token', ts('Twilio Auth Token'), array(), TRUE);
    $this->add('text', 'twilio_number', ts('Twilio Phone Number'), array());
    $this->addYesNo('is_record', ts('Record Call?'), NULL, TRUE);

    $this->addButtons(array(
      array(
        'type' => 'submit',
        'name' => ts("Save"),
        'isDefault' => TRUE,
      ),
      array(
        'type' => 'cancel',
        'name' => ts("Cancel"),
      ),
    ));
    parent::buildQuickForm();
  }

  function setDefaultValues() {
    $defaults = Civi::settings()->get('civicrm_twilio_settings');
    return $defaults;
  }

  function postProcess() {
    $params = $this->controller->exportValues($this->_name);
    unset($params['qfKey']);
    unset($params['entryURL']);
    Civi::settings()->set('civicrm_twilio_settings', $params);
  }
}
