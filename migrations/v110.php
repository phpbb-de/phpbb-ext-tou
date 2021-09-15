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
			// Add permissions
			array('permission.add', array('a_tou_manage', true)),
			// Add config version
			array('config.add', array('tou_ext_version', '1.1.0')),
		);

		// Check if admin role exists and assign permission to admin role
		if ($this->role_exists('ROLE_ADMIN_FULL'))
		{
			$data[] = array('permission.permission_set', array('ROLE_ADMIN_FULL', 'a_tou_manage', 'role', true));
		}
		return $data;
	}

	/**
	 * Checks whether the given role does exist or not.
	 *
	 * @param String $role the name of the role
	 * @return true if the role exists, false otherwise
	 * Source: https://github.com/paul999/mention/
	 */
	private function role_exists($role)
	{
		$sql = 'SELECT role_id
		FROM ' . ACL_ROLES_TABLE . "
		WHERE role_name = '" . $this->db->sql_escape($role) . "'";
		$result = $this->db->sql_query_limit($sql, 1);
		$role_id = $this->db->sql_fetchfield('role_id');
		$this->db->sql_freeresult($result);
		return $role_id;
	}
}
