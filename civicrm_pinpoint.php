<?php

require_once 'civicrm_pinpoint.civix.php';
use CRM_CivicrmPinpoint_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/ 
 */
function civicrm_pinpoint_civicrm_config(&$config) {
  _civicrm_pinpoint_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function civicrm_pinpoint_civicrm_xmlMenu(&$files) {
  _civicrm_pinpoint_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function civicrm_pinpoint_civicrm_install()
{
  $groupID = CRM_Core_DAO::getFieldValue('CRM_Core_DAO_OptionGroup', 'sms_provider_name', 'id', 'name');
  $params  = [
    'option_group_id' => $groupID,
    'label' => 'AWS Pinpoint',
    'value' => 'aws.pinpoint',
    'name'  => 'awspinpoint',
    'is_default' => 1,
    'is_active'  => 1,
  ];
  civicrm_api3('option_value', 'create', $params);
  _civicrm_pinpoint_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function civicrm_pinpoint_civicrm_postInstall() {
  _civicrm_pinpoint_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function civicrm_pinpoint_civicrm_uninstall()
{
  $optionID = CRM_Core_DAO::getFieldValue('CRM_Core_DAO_OptionValue', 'dummysms', 'id', 'name');
  if ($optionID)
    CRM_Core_BAO_OptionValue::del($optionID);
  $filter    =  array('name'  => 'io.3sd.dummysms');
  $Providers =  CRM_SMS_BAO_Provider::getProviders(False, $filter, False);
  if ($Providers) {
    foreach ($Providers as $key => $value) {
      CRM_SMS_BAO_Provider::del($value['id']);
    }
  }
  _civicrm_pinpoint_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function civicrm_pinpoint_civicrm_enable() {
  _civicrm_pinpoint_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function civicrm_pinpoint_civicrm_disable() {
  _civicrm_pinpoint_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function civicrm_pinpoint_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _civicrm_pinpoint_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function civicrm_pinpoint_civicrm_managed(&$entities) {
  _civicrm_pinpoint_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function civicrm_pinpoint_civicrm_caseTypes(&$caseTypes) {
  _civicrm_pinpoint_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function civicrm_pinpoint_civicrm_angularModules(&$angularModules) {
  _civicrm_pinpoint_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function civicrm_pinpoint_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _civicrm_pinpoint_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function civicrm_pinpoint_civicrm_entityTypes(&$entityTypes) {
  _civicrm_pinpoint_civix_civicrm_entityTypes($entityTypes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 *
function civicrm_pinpoint_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 *
function civicrm_pinpoint_civicrm_navigationMenu(&$menu) {
  _civicrm_pinpoint_civix_insert_navigation_menu($menu, 'Mailings', array(
    'label' => E::ts('New subliminal message'),
    'name' => 'mailing_subliminal_message',
    'url' => 'civicrm/mailing/subliminal',
    'permission' => 'access CiviMail',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _civicrm_pinpoint_civix_navigationMenu($menu);
} // */
