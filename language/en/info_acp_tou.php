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
	'ACP_TOU_SETTINGS' 	=> 'Settings',

	'ACP_TOU_TOUSETUP'	=> 'Add custom Terms of Use',
	'ACP_TOU_PPSETUP'	=> 'Add custom Privacy Policy',

	'TOU_LOG_SETTINGS_UPDATED'	=> 'Terms of Use settings updated',
	'TOU_LOG_TOU_UPDATED'		=> 'Terms of Use updated',
	'TOU_LOG_PP_UPDATED'		=> 'Privacy policy updated',
));
