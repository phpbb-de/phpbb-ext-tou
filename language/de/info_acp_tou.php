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
	'ACP_TOU_TITLE' 	=> 'Terms of Use',
	'ACP_TOU_SETTINGS' 	=> 'Einstellungen',

	'ACP_TOU_TOUSETUP'	=> 'Eigene Terms of Use ergänzen',
	'ACP_TOU_PPSETUP'	=> 'Eigene Privacy Policy ergänzen',

	'TOU_LOG_SETTINGS_UPDATED'	=> 'Terms of Use Einstellungen aktualisiert',
	'TOU_LOG_TOU_UPDATED'		=> 'Nutzungsbedingungen aktualisiert',
	'TOU_LOG_PP_UPDATED'		=> 'Datenschutzerklärung aktualisiert',
));
