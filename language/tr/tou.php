<?php
/**
*
* tou
*
* @package language
* @version 0.1.3
* @copyright (c) 2015 phpbb.de
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
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
	'TRANSLATION_INFO'	=> '<br />Tercüme: <a href="https://obelde.com/">O Belde</a> <a href="https://forum.obelde.com/">Forum</a>',
	'TOU' 					=> 'Kullanım Şartları',
	'CONFIRM_TOU_REDIRECT' 	=> 'Kullanım Şartları başarıyla kabul edildi.',
	'TOU_DENIED' 			=> 'Kullanım şartları reddedildi. Bu halde %s kullanmak namümkündür.',
));
