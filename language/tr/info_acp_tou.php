<?php
/**
*
* Terms of Use extension for the phpBB Forum Software package.
*
* @copyright (c) 2020 Crizzo <https://www.phpBB.de>
* @license GNU General Public License, version 2 (GPL-2.0)
*
* Translated into Turkish: O Belde (forum.obelde.com) - HE
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
	'ACP_TOU_TITLE' 	=> 'Kullanım Şartları',
	'ACP_TOU_SETTINGS' 	=> 'Ayarlar',

	'ACP_TOU_TOUSETUP'	=> 'Hususi Kullanım Şartları ekleyin',
	'ACP_TOU_PPSETUP'	=> 'Hususi Gizlilik Politikası ekleyin',

	'TOU_LOG_SETTINGS_UPDATED'	=> 'Kullanım Şartları ayarları güncellendi',
	'TOU_LOG_TOU_UPDATED'		=> 'Kullanım Şartları güncellendi',
	'TOU_LOG_PP_UPDATED'		=> 'Gizlilik Politikası güncellendi',
));
