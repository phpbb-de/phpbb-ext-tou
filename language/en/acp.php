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
	'ACP_TOU_SETTINGS_TITLE' 			=> 'Terms of Use - Settings',
	'ACP_TOU_SETTINGS_TITLE_EXPLAIN' 	=> 'This page allows you to change the different settings of the „Term of Use“ extension.',

	'ACP_TOU_SETTINGS_FIELDSET'			=> 'Common settings',
	'ACP_TOU_SETTINGS_FIELDSET_EXPLAIN'	=> 'Define the currently valid version of the terms of use.',

	'ACP_TOU_VERSION' 					=> 'Current version',
	'ACP_TOU_VERSION_EXPLAIN' 			=> 'Every user, who has a lesser value than here defined, needs to agree to the terms of use on his next board visit. You need to input positive integer values.',

	'ACP_TOU_SETTINGS_UPDATED'			=> 'The settings of „Terms of Use“ were updated.',
));
