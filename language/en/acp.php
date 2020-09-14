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
	'ACP_TOU_SETTINGS_TITLE_EXPLAIN' 	=> 'This page allows you to change the different settings of the “Term of Use” extension.',

	'ACP_TOU_SETTINGS_FIELDSET'			=> 'Common settings',
	'ACP_TOU_SETTINGS_FIELDSET_EXPLAIN'	=> 'Define the currently valid version of the terms of use.',

	'ACP_TOU_VERSION' 					=> 'Current version',
	'ACP_TOU_VERSION_EXPLAIN' 			=> 'Every user, who has a lesser value than here defined, needs to agree to the terms of use on his next board visit. You need to input positive integer values.',

	'ACP_TOU_SETTINGS_UPDATED'			=> 'The settings of “Terms of Use” were updated.',
	'ACP_TOU_SETTINGS_NOT_UPDATED'		=> 'You need to input a higher number than the current version.',

	'ACP_TOU_TOU_UPDATED'			=> 'The “Terms of Use” were updated.',
	'ACP_TOU_PP_UPDATED'			=> 'The “Privacy Policy” was updated.',

	// Custom TOU setup
	'ACP_TOU_TOU_UPDATED'					=> 'The “Terms of Use” were updated.',

	'ACP_TOU_TOUSETUP_TITLE'				=> 'Setup custom “Terms of Use”',
	'ACP_TOU_TOUSETUP_TITLE_EXPLAIN'		=> 'The within phpBB included “Terms of Use” is a generic version, which should be changed to fit your needs and board configuration.',

	'ACP_TOU_TOUSETUP_FIELDSET'				=> 'Options',
	'ACP_TOU_TOUSETUP_FIELDSET_EXPLAIN'		=> 'Change several options for the “Terms of Use”.',

	'ACP_TOU_INFO_PREVIEW_TOU' 				=> '“Terms of Use” preview',

	'ACP_TOU_TOUSETUP_USE_CUSTOM'			=> 'Use custom “Terms of Use”',
	'ACP_TOU_TOUSETUP_USE_CUSTOM_EXPLAIN'	=> 'If activated, your own custom “Terms of Use” will be used instead of the original phpBB core version.',

	'ACP_TOU_TEXT_INPUT_TOU'				=> 'Add “Terms of Use” text',
	'ACP_TOU_TEXT_INPUT_TOU_EXPLAIN'		=> 'Input your custom “Terms of Use” here in that input field.',

	 // Custom PP setup
	'ACP_TOU_PP_UPDATED'					=> 'The “Privacy policy” was updated.',

	'ACP_TOU_PPSETUP_TITLE'					=> 'Setup custom “Privacy policy”',
	'ACP_TOU_PPSETUP_TITLE_EXPLAIN'			=> 'The within phpBB included “Privacy policy” is a generic version, which should be changed to fit your needs and board configuration.',

	'ACP_TOU_PPSETUP_FIELDSET'				=> 'Options',
	'ACP_TOU_PPSETUP_FIELDSET_EXPLAIN'		=> 'Change several options for the “Privacy policy”.',

	'ACP_TOU_INFO_PREVIEW_PP' 				=> '“Privacy policy” preview',

	'ACP_TOU_PPSETUP_USE_CUSTOM'			=> 'Use custom “Privacy policy”',
	'ACP_TOU_PPSETUP_USE_CUSTOM_EXPLAIN'	=> 'If activated, your own custom “Privacy policy” will be used instead of the original phpBB core version.',

	'ACP_TOU_TEXT_INPUT_PP'					=> 'Add “Privacy policy” text',
	'ACP_TOU_TEXT_INPUT_PP_EXPLAIN'			=> 'Input your custom “Privacy policy” here in that input field.',
));
