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
));
