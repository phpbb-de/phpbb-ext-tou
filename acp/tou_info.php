<?php
/**
*
* Terms of use extension for the phpBB Forum Software package.
*
* @copyright (c) 2020 Crizzo <https://www.phpbBB.de>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbbde\tou\acp;

class tou_info
{
	function module()
	{
		return array(
			'filename'	=> '\phpbbde\tou\acp\tou_module',
			'title'		=> 'ACP_TOU_TITLE',
			'modes'		=> array(
				'settings'	=> array(
					'title' => 'ACP_TOU_SETTINGS',
					'auth' => 'ext_phpbbde/tou && acl_a_tou_manage',
					'cat' => array('ACP_TOU_TITLE')
					),
				'tousetup'	=> array(
					'title' => 'ACP_TOU_TOUSETUP',
					'auth' => 'ext_phpbbde/tou && acl_a_tou_manage',
					'cat' => array('ACP_TOU_TITLE')
				),
				'ppsetup'	=> array(
					'title' => 'ACP_TOU_PPSETUP',
					'auth' => 'ext_phpbbde/tou && acl_a_tou_manage',
					'cat' => array('ACP_TOU_TITLE')
				),
			),
		);
	}
}
