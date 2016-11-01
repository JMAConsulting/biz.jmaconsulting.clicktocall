<?php

require_once 'clicktocall.civix.php';

/**
 * Implementation of hook_civicrm_config
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function clicktocall_civicrm_config(&$config) {
  _clicktocall_civix_civicrm_config($config);
}

/**
 * Implementation of hook_civicrm_xmlMenu
 *
 * @param $files array(string)
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function clicktocall_civicrm_xmlMenu(&$files) {
  _clicktocall_civix_civicrm_xmlMenu($files);
}

/**
 * Implementation of hook_civicrm_install
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function clicktocall_civicrm_install() {
  _clicktocall_civix_civicrm_install();
}

/**
 * Implementation of hook_civicrm_uninstall
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function clicktocall_civicrm_uninstall() {
  _clicktocall_civix_civicrm_uninstall();
}

/**
 * Implementation of hook_civicrm_enable
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function clicktocall_civicrm_enable() {
  _clicktocall_civix_civicrm_enable();
}

/**
 * Implementation of hook_civicrm_disable
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function clicktocall_civicrm_disable() {
  _clicktocall_civix_civicrm_disable();
}

/**
 * Implementation of hook_civicrm_upgrade
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed  based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function clicktocall_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _clicktocall_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implementation of hook_civicrm_managed
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function clicktocall_civicrm_managed(&$entities) {
  $entities[] = array(
    'module' => 'biz.jmaconsulting.clicktocall',
    'name' => 'clicktocall',
    'update' => 'never',
    'entity' => 'OptionValue',
    'params' => array(
      'label' => 'wav',
      'is_active' => 1,
      'version' => 3,
      'option_group_id' => 'safe_file_extension',
    ),
  );
  $entities[] = array(
    'module' => 'biz.jmaconsulting.clicktocall',
    'name' => 'navigation',
    'update' => 'never',
    'entity' => 'Navigation',
    'params' => array(
      'label' => "Twilio Settings",
      'name' => "twilio_settings",
      'url' => "civicrm/callsettings?reset=1",
      'parent_id' => "Communications",
      'permission' => "administer CiviCRM",
      'has_separator' => 1,
      'is_active' => 1,
      'version' => 3,
    ),
  );
  _clicktocall_civix_civicrm_managed($entities);
}

/**
 * Implementation of hook_civicrm_caseTypes
 *
 * Generate a list of case-types
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function clicktocall_civicrm_caseTypes(&$caseTypes) {
  _clicktocall_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implementation of hook_civicrm_alterSettingsFolders
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function clicktocall_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _clicktocall_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_pageRun().
 */
function clicktocall_civicrm_pageRun(&$page) {
  if ($page->getVar('_name') == "CRM_Contact_Page_View_Summary") {
    CRM_Core_Region::instance('page-body')->add(array(
      'template' => 'CRM/Clicktocall/Call.tpl',
    ));
  }
}