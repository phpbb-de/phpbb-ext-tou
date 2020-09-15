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

class v111 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array(
			'\phpbbde\tou\migrations\v110',
		);
	}

	public function update_data()
	{
		$data = array(
			// Update to version 1.1.1
			array('config.update', array('tou_ext_version', '1.1.1')),
		);
		return $data;
	}
}
