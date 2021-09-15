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

class v113 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array(
			'\phpbbde\tou\migrations\v112',
		);
	}

	public function update_data()
	{
		$data = array(
			// Update version
			array('config.update', array('tou_ext_version', '1.1.3')),
		);
		return $data;
	}
}
