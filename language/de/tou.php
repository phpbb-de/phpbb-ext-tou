<?php
/**
*
* tou [German]
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
	'TOU' 					=> 'Nutzungsbedingungen',
	'CONFIRM_TOU_REDIRECT' 	=> 'Nutzungsbedingungen erfolgreich bestätigt.',
	'TOU_DENIED' 			=> 'Die Nutzungsbedingungen wurden abgelehnt. Eine Nutzung von %s ist in diesem Fall nicht möglich.',
));
