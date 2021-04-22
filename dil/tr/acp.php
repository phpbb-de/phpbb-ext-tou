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
	'TRANSLATION_INFO'	=> '<br />Tercüme: <a href="https://obelde.com/">O Belde</a> <a href="https://forum.obelde.com/">Forum</a>',
	'ACP_TOU_SETTINGS_TITLE' 			=> 'Kullanım Şartları - Ayarlar',
	'ACP_TOU_SETTINGS_TITLE_EXPLAIN' 	=> 'Bu sayfa, Kullanım Şartları eklentisinin farklı ayarlarını değiştirmenize olanak tanır.',

	'ACP_TOU_SETTINGS_FIELDSET'			=> 'Genel Ayarlar',
	'ACP_TOU_SETTINGS_FIELDSET_EXPLAIN'	=> 'Kullanım şartlarının şu anda geçerli olan versiyonunu tanımlayın.',

	'ACP_TOU_VERSION' 					=> 'Şimdiki versiyonu',
	'ACP_TOU_VERSION_EXPLAIN' 			=> 'Burada tanımlanandan daha düşük bir değere sahip olan her kullanıcının bir sonraki forum ziyaretinde kullanım şartlarını kabul etmesi gerekir. Pozitif tam sayı değerleri girmeniz gerekir.',

	'ACP_TOU_SETTINGS_UPDATED'			=> '"Kullanım Şartları" ayarları güncellendi.',
	'ACP_TOU_SETTINGS_NOT_UPDATED'		=> 'Mevcut sürümden daha yüksek bir sayı girmeniz gerekiyor.',

	'ACP_TOU_TOU_UPDATED'			=> '"Kullanım Şartları" güncellendi.',
	'ACP_TOU_PP_UPDATED'			=> '"Gizlilik Politikası" güncellendi.',

	// Custom TOU setup
	'ACP_TOU_TOU_UPDATED'					=> '"Kullanım Şartları" güncellendi.',

	'ACP_TOU_TOUSETUP_TITLE'				=> 'Husisi "Kullanım şartları" oluşturun',
	'ACP_TOU_TOUSETUP_TITLE_EXPLAIN'		=> 'PhpBB dahilindeki "Kullanım Şartları", ihtiyaçlarınıza ve forum yapılandırmanıza uyacak şekilde değiştirilmesi gereken genel bir sürümdür.',

	'ACP_TOU_TOUSETUP_FIELDSET'				=> 'Seçenekler',
	'ACP_TOU_TOUSETUP_FIELDSET_EXPLAIN'		=> '"Kullanım Şartları" için birkaç seçeneği değiştirin.',

	'ACP_TOU_INFO_PREVIEW_TOU' 				=> '"Kullanım Şartları" ön izlemesi',

	'ACP_TOU_TOUSETUP_USE_CUSTOM'			=> 'Husisi "Kullanım Şartları" kullanın',
	'ACP_TOU_TOUSETUP_USE_CUSTOM_EXPLAIN'	=> 'Etkinleştirilirse, orijinal phpBB çekirdek sürümü yerine kendi hususi Kullanım Şartlarınız kullanılacaktır.',

	'ACP_TOU_TEXT_INPUT_TOU'				=> '"Kullanım Şartları" metni ekleyin',
	'ACP_TOU_TEXT_INPUT_TOU_EXPLAIN'		=> 'Bu alana hususi "Kullanım Şartlarınızı" girin.',

	 // Custom PP setup
	'ACP_TOU_PP_UPDATED'					=> '"Gizlilik Politikası" güncellendi.',

	'ACP_TOU_PPSETUP_TITLE'					=> 'Hususi "Gizlilik Politikası" oluşturun',
	'ACP_TOU_PPSETUP_TITLE_EXPLAIN'			=> 'PhpBB dahilindeki "Gizlilik Politikası", ihtiyaçlarınıza ve forum yapılandırmanıza uyacak şekilde değiştirilmesi gereken genel bir sürümdür.',

	'ACP_TOU_PPSETUP_FIELDSET'				=> 'Seçenekler',
	'ACP_TOU_PPSETUP_FIELDSET_EXPLAIN'		=> '"Gizlilik politikası" için birkaç seçeneği değiştirin.',

	'ACP_TOU_INFO_PREVIEW_PP' 				=> '"Gizlilik Politikası" ön izlemesi',

	'ACP_TOU_PPSETUP_USE_CUSTOM'			=> 'Hususi "Gizlilik Politikası" kullanın',
	'ACP_TOU_PPSETUP_USE_CUSTOM_EXPLAIN'	=> 'Etkinleştirilirse, orijinal phpBB çekirdek sürümü yerine kendi hususi Gizlilik Politikasınız kullanılacaktır.',

	'ACP_TOU_TEXT_INPUT_PP'					=> '"Gizlilik Politikası" metni ekleyin',
	'ACP_TOU_TEXT_INPUT_PP_EXPLAIN'			=> 'Bu alana hususi Gizlilik Politikanızı girin.',
));
