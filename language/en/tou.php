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
	'TOU' 					=> 'Terms of Use',
	'CONFIRM_TOU_REDIRECT' 	=> 'The terms of use were successfully acknowledged.',
	'TOU_DENIED' 			=> 'The terms of use were declined. It is not possible to use %s in this case.',
));
