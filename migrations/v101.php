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

class v101 extends \phpbb\db\migration\migration
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
						'modes'				=> array('settings'),
					),
				)),
		);
		return $data;
	}
}
