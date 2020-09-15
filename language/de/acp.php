<?php
/**
*
* Terms of Use extension for the phpBB Forum Software package.
*
* @copyright (c) 2020 Crizzo <https://www.phpBB.de>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'ACP_TOU_SETTINGS_TITLE' 			=> 'Terms of Use - Einstellungen',
	'ACP_TOU_SETTINGS_TITLE_EXPLAIN' 	=> 'Diese Seite ermöglicht es die verschiedenen Einstellungen der „Term of Use“-Erweiterung zu ändern.',

	'ACP_TOU_SETTINGS_FIELDSET'			=> 'Grundsätzliche Einstellungen',
	'ACP_TOU_SETTINGS_FIELDSET_EXPLAIN'	=> 'Definiere die aktuell gültige „Nutzungsbedingungen“-Version.',

	'ACP_TOU_VERSION' 					=> 'Aktuelle Version',
	'ACP_TOU_VERSION_EXPLAIN' 			=> 'Jeder Benutzer, der einen geringeren Wert, als hier definiert, hat, muss die Nutzungsbedingungen beim nächsten Besuch des Forums bestätigen. Es müssen ganzzahlige, positive Werte eingegeben werden',

	'ACP_TOU_SETTINGS_UPDATED'			=> 'Die Einstellung von „Terms of Use“ wurden aktualisiert.',
	'ACP_TOU_SETTINGS_NOT_UPDATED'		=> 'Du musst eine höhere Zahl als die aktuelle Version eintragen.',

	'ACP_TOU_TOU_UPDATED'			=> 'Die „Nutzungsbedingungen“ wurden aktualisiert.',
	'ACP_TOU_PP_UPDATED'			=> 'Die „Datenschutzerklärung“ wurde aktualisiert.',

	// Custom TOU setup
	'ACP_TOU_TOU_UPDATED'					=> 'Die „Nutzungsbedingungen“ wurden aktualisiert.',

	'ACP_TOU_TOUSETUP_TITLE'				=> 'Eigene „Nutzungsbedingungen“ einrichten',
	'ACP_TOU_TOUSETUP_TITLE_EXPLAIN'		=> 'Die mit phpBB mitgelieferten „Nutzungsbedingungen“ sind allgemein gehalten und sollten von dir für deine Bedürfnisse und Board-Konfiguration angepasst werden.',

	'ACP_TOU_TOUSETUP_FIELDSET'				=> 'Einstellungen',
	'ACP_TOU_TOUSETUP_FIELDSET_EXPLAIN'		=> 'Ändere verschiedene Einstellungen für die „Nutzungsbedingungen“.',

	'ACP_TOU_INFO_PREVIEW_TOU' 				=> '„Nutzungsbedingungen“-Vorschau',

	'ACP_TOU_TOUSETUP_USE_CUSTOM'			=> 'Eigene „Nutzungsbedingungen“ verwenden',
	'ACP_TOU_TOUSETUP_USE_CUSTOM_EXPLAIN'	=> 'Sofern aktiviert, werden deine eigenen „Nutzungsbedingungen“ anstelle der original phpBB-Version verwendet.',

	'ACP_TOU_TEXT_INPUT_TOU'				=> '„Nutzungsbedingungen“-Text ergänzen',
	'ACP_TOU_TEXT_INPUT_TOU_EXPLAIN'		=> 'Trage deine eigenen „Nutzungsbedingungen“ hier in das Textfeld ein.',

	// Custom PP setup
	'ACP_TOU_PP_UPDATED'					=> 'Die „Datenschutzerklärung“ wurde aktualisiert.',

	'ACP_TOU_PPSETUP_TITLE'					=> 'Eigene „Datenschutzerklärung“ einrichten',
	'ACP_TOU_PPSETUP_TITLE_EXPLAIN'			=> 'Die mit phpBB mitgelieferte „Datenschutzerklärung“ ist allgemein gehalten und sollte von dir für deine Bedürfnisse und Board-Konfiguration angepasst werden.',

	'ACP_TOU_PPSETUP_FIELDSET'				=> 'Einstellungen',
	'ACP_TOU_PPSETUP_FIELDSET_EXPLAIN'		=> 'Ändere verschiedene Einstellungen für die „Datenschutzerklärung“.',

	'ACP_TOU_INFO_PREVIEW_PP' 				=> '„Datenschutzerklärung“-Vorschau',

	'ACP_TOU_PPSETUP_USE_CUSTOM'			=> 'Eigene „Datenschutzerklärung“ verwenden',
	'ACP_TOU_PPSETUP_USE_CUSTOM_EXPLAIN'	=> 'Sofern aktiviert, wird deine eigene „Datenschutzerklärung“ anstelle der original phpBB-Version verwendet.',

	'ACP_TOU_TEXT_INPUT_PP'					=> '„Datenschutzerklärung“-Text ergänzen',
	'ACP_TOU_TEXT_INPUT_PP_EXPLAIN'			=> 'Trage deine eigene „Datenschutzerklärung“ hier in das Textfeld ein.',
));
