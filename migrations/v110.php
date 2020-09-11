<?php
/**
*
* Terms of use extension for the phpBB Forum Software package.
*
* @copyright (c) 2020 Crizzo <https://www.phpBB.de>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbbde\tou\migrations;

class v110 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array(
			'\phpbbde\tou\migrations\v_1_0_0',
		);
	}

	public function update_data()
	{
		$data = array(
			// Add ACP module for TOU
			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_TOU_TITLE'
			)),
			// Add ACP module TOU settings
				array('module.add', array(
					'acp',
					'ACP_TOU_TITLE',
					array(
						'module_basename'	=> '\phpbbde\tou\acp\tou_module',
						'modes'				=> array('settings', 'tousetup', 'ppsetup'),
					),
				)),
			// Add new config values
			array('config.add', array('tou_use_custom_tou', 0)),
			array('config.add', array('tou_use_custom_pp', 0)),

			// Add new config text values
			array('config_text.add', array('tou_custom_tou_text', '')),
			array('config_text.add', array('tou_custom_tou_uid', '')),
			array('config_text.add', array('tou_custom_tou_bitfield', '')),
			array('config_text.add', array('tou_custom_tou_flags', OPTION_FLAG_BBCODE + OPTION_FLAG_SMILIES + OPTION_FLAG_LINKS)),

			array('config_text.add', array('tou_custom_pp_text', '')),
			array('config_text.add', array('tou_custom_pp_uid', '')),
			array('config_text.add', array('tou_custom_pp_bitfield', '')),
			array('config_text.add', array('tou_custom_pp_flags', OPTION_FLAG_BBCODE + OPTION_FLAG_SMILIES + OPTION_FLAG_LINKS)),

			array('config.add', array('tou_ext_version', '1.1.0')),
		);
		return $data;
	}
}
