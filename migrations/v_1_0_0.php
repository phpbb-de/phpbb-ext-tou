<?php

/**
 *
 * @package phpBB.de tou
 * @copyright (c) 2014 phpBB.de, gn#36
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace phpbbde\tou\migrations;

class v_1_0_0 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array(
			'\phpbb\db\migration\data\v31x\v311',
		);
	}

	public function effectively_installed()
	{
		return !empty($this->config['tou_version']) && version_compare($this->config['tou_version'], '1', '>=');
	}

	public function update_schema()
	{
		return array(
			'add_columns' => array(
				USERS_TABLE => array(
					'user_tou_version'	=> array('INT:3', 0),
					'user_tou_confirmdate' => array('INT:11', 0),
					'user_tou_confirmip' => array('VCHAR:40', ''),
				)
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_columns' => array(
				USERS_TABLE => array(
					'user_tou_version',
					'user_tou_confirmdate',
					'user_tou_confirmip',
				),
			),
		);
	}

	public function update_data()
	{
		return array(
				array('config.add', array('tou_version', '1')),
		);
	}

	private function table($name)
	{
		return $this->table_prefix . $name;
	}
}
