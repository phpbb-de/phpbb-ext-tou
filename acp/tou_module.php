<?php
/**
*
* Terms of Use extension for the phpBB Forum Software package.
*
* @copyright (c) 2020 Crizzo <https://www.phpBB.de>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace phpbbde\tou\acp;

/**
* @ignore
*/


/**
* @package acp
*/
class tou_module
{
	public $u_action;
	public $tpl_name;
	public $page_title;

	protected $config;
	protected $config_text;
	protected $language;
	protected $request;
	protected $template;
	protected $user;
	protected $phpbb_root_path;
	protected $php_ext;
	protected $phpbb_log;

	public function main($id, $mode)
	{

		global $config, $template, $request, $phpbb_container, $user, $phpbb_root_path, $phpEx;
		global $phpbb_log;

		/** @var \phpbb\language\language $language */
		$language = $phpbb_container->get('language');

		$this->config_text = $phpbb_container->get('config_text');

		$this->config = $config;
		$this->language = $language;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->php_ext = $phpEx;
		$this->phpbb_log = $phpbb_log;

		// Add the TOU ACP lang file
		$this->language->add_lang('acp', 'phpbbde/tou');

		// Mode switch start
		switch ($mode)
		{
			// Settings
			case 'settings':

				$this->tpl_name = 'acp_tou_settings';
				$this->page_title = 'ACP_TOU_SETTINGS';

				$form_name = 'ACP_TOU_SETTINGS';
				add_form_key($form_name);
				$error = '';

				if ($this->request->is_set_post('submit'))
				{
					if (!check_form_key($form_name))
					{
						$error = $this->language->lang('FORM_INVALID');
					}

					if (empty($error) && $this->request->is_set_post('submit'))
					{
						if ($this->config['tou_version'] <= $this->request->variable('phpbbde_tou_version', 0))
						{
							$this->config->set('tou_version', $this->request->variable('phpbbde_tou_version', 0));
							$this->config->set('tou_use_custom_tou', $this->request->variable('tou_use_custom_tou', false));
							$this->config->set('tou_use_custom_pp', $this->request->variable('tou_use_custom_pp', false));

							// Add log entry
							$this->phpbb_log->add('admin', $this->user->data['user_id'], $this->user->ip, 'TOU_LOG_SETTINGS_UPDATED');

							trigger_error($this->language->lang('ACP_TOU_SETTINGS_UPDATED') . adm_back_link($this->u_action));
						}
						else
						{
							trigger_error($this->language->lang('ACP_TOU_SETTINGS_NOT_UPDATED') . adm_back_link($this->u_action), E_USER_WARNING);
						}
					}
				}

				$this->template->assign_vars(array(
					'ERRORS'								=> $error,
					'U_ACTION'								=> $this->u_action,

					'ACP_TOU_VERSION_VALUE'					=> $this->config['tou_version'],
					'ACP_TOU_USE_CUSTOM_TOU_ENABLED'		=> $this->config['tou_use_custom_tou'],
					'ACP_TOU_USE_CUSTOM_PP_ENABLED'			=> $this->config['tou_use_custom_pp'],
				));
			break;

			// Setup own custom terms of use
			case 'tousetup':

				$this->tpl_name = 'acp_tou_tousetup';
				$this->page_title = 'ACP_TOU_TOUSETUP';

				$language->add_lang(array('acp/board', 'posting'));

				$form_name = 'ACP_TOU_TOUSETUP';
				add_form_key($form_name);
				$error = '';

				// Check for possible missing functions
				if (!function_exists('display_custom_bbcodes'))
				{
					include $this->phpbb_root_path . 'includes/functions_display.' . $this->php_ext;
				}

				if (!class_exists('parse_message'))
				{
					include $this->phpbb_root_path . 'includes/message_parser.' . $this->php_ext;
				}

				// Get all tou data from the config_text table in the database
				$tou_data = $this->config_text->get_array(array(
					'tou_custom_tou_text',
					'tou_custom_tou_uid',
					'tou_custom_tou_bitfield',
					'tou_custom_tou_flags',
				));

				$tou_custom_tou_text		= $tou_data['tou_custom_tou_text'];
				$tou_custom_tou_uid			= $tou_data['tou_custom_tou_uid'];
				$tou_custom_tou_bitfield	= $tou_data['tou_custom_tou_bitfield'];
				$tou_custom_tou_flags		= $tou_data['tou_custom_tou_flags'];

				if ($this->request->is_set_post('submit') || $request->is_set_post('preview'))
				{
					if (!check_form_key($form_name))
					{
						$error = $this->language->lang('FORM_INVALID');
					}

					$tou_custom_tou_text = $request->variable('tou_custom_tou_text', '', true);

					generate_text_for_storage(
						$tou_custom_tou_text,
						$tou_custom_tou_uid,
						$tou_custom_tou_bitfield,
						$tou_custom_tou_flags,
						!$request->variable('disable_bbcode', false),
						!$request->variable('disable_magic_url', false),
						!$request->variable('disable_smilies', false)
					);

					if (empty($error) && $this->request->is_set_post('submit'))
					{
						$this->config->set('tou_use_custom_tou', $this->request->variable('tou_use_custom_tou', false));

						// Store the data to the config_table in the database
						$this->config_text->set_array(array(
							'tou_custom_tou_text'			=> $tou_custom_tou_text,
							'tou_custom_tou_uid'			=> $tou_custom_tou_uid,
							'tou_custom_tou_bitfield'		=> $tou_custom_tou_bitfield,
							'tou_custom_tou_flags'			=> $tou_custom_tou_flags,
						));

						$this->phpbb_log->add('admin', $this->user->data['user_id'], $this->user->ip, 'TOU_LOG_TOU_UPDATED');

						trigger_error($this->language->lang('ACP_TOU_TOU_UPDATED') . adm_back_link($this->u_action));
					}
				}

				$tou_preview_tou = '';

				if ($request->is_set_post('preview'))
				{
					$tou_preview_tou = generate_text_for_display($tou_custom_tou_text, $tou_custom_tou_uid, $tou_custom_tou_bitfield, $tou_custom_tou_flags);
				}
				$tou_edit_tou = generate_text_for_edit($tou_custom_tou_text, $tou_custom_tou_uid, $tou_custom_tou_flags);

				$this->template->assign_vars(array(
					'ERRORS'								=> $error,
					'U_ACTION'								=> $this->u_action,

					'ACP_TOU_USE_CUSTOM_TOU_ENABLED'		=> $this->config['tou_use_custom_tou'],

					'ACP_TOU_CUSTOM_TOU_TEXT' 				=> $tou_edit_tou['text'],
					'ACP_TOU_PREVIEW_TOU'					=> $tou_preview_tou,

					'S_BBCODE_DISABLE_CHECKED'		=> !$tou_edit_tou['allow_bbcode'],
					'S_MAGIC_URL_DISABLE_CHECKED'	=> !$tou_edit_tou['allow_urls'],
					'S_SMILIES_DISABLE_CHECKED'		=> !$tou_edit_tou['allow_smilies'],

					'BBCODE_STATUS'					=> $language->lang('BBCODE_IS_ON', '<a href="' . $phpbb_container->get('controller.helper')->route('phpbb_help_bbcode_controller') . '">', '</a>'),
					'FLASH_STATUS'					=> $language->lang('FLASH_IS_ON'),
					'IMG_STATUS'					=> $language->lang('IMAGES_ARE_ON'),
					'SMILIES_STATUS'				=> $language->lang('SMILIES_ARE_ON'),
					'URL_STATUS'					=> $language->lang('URL_IS_ON'),

					'S_BBCODE_ALLOWED'				=> true,
					'S_BBCODE_FLASH'				=> true,
					'S_BBCODE_IMG'					=> true,
					'S_LINKS_ALLOWED'				=> true,
					'S_SMILIES_ALLOWED'				=> true,
				));
				// Assigning custom bbcodes
				display_custom_bbcodes();
			break;

			// Setup own custom terms of use
			case 'ppsetup':

				$this->tpl_name = 'acp_tou_ppsetup';
				$this->page_title = 'ACP_TOU_PPSETUP';

				$language->add_lang(array('acp/board', 'posting'));

				$form_name = 'ACP_TOU_PPSETUP';
				add_form_key($form_name);
				$error = '';

				// Check for possible missing functions
				if (!function_exists('display_custom_bbcodes'))
				{
					include $this->phpbb_root_path . 'includes/functions_display.' . $this->php_ext;
				}

				if (!class_exists('parse_message'))
				{
					include $this->phpbb_root_path . 'includes/message_parser.' . $this->php_ext;
				}

				// Get all tou data from the config_text table in the database
				$pp_data = $this->config_text->get_array(array(
					'tou_custom_pp_text',
					'tou_custom_pp_uid',
					'tou_custom_pp_bitfield',
					'tou_custom_pp_flags',
				));

				$tou_custom_pp_text			= $pp_data['tou_custom_pp_text'];
				$tou_custom_pp_uid			= $pp_data['tou_custom_pp_uid'];
				$tou_custom_pp_bitfield		= $pp_data['tou_custom_pp_bitfield'];
				$tou_custom_pp_flags		= $pp_data['tou_custom_pp_flags'];

				if ($this->request->is_set_post('submit') || $request->is_set_post('preview'))
				{
					if (!check_form_key($form_name))
					{
						$error = $this->language->lang('FORM_INVALID');
					}

					$tou_custom_pp_text = $request->variable('tou_custom_pp_text', '', true);

					generate_text_for_storage(
						$tou_custom_pp_text,
						$tou_custom_pp_uid,
						$tou_custom_pp_bitfield,
						$tou_custom_pp_flags,
						!$request->variable('disable_bbcode', false),
						!$request->variable('disable_magic_url', false),
						!$request->variable('disable_smilies', false)
					);

					if (empty($error) && $this->request->is_set_post('submit'))
					{
						$this->config->set('tou_use_custom_pp', $this->request->variable('tou_use_custom_pp', false));

						// Store the data to the config_table in the database
						$this->config_text->set_array(array(
							'tou_custom_pp_text'			=> $tou_custom_pp_text,
							'tou_custom_pp_uid'				=> $tou_custom_pp_uid,
							'tou_custom_pp_bitfield'		=> $tou_custom_pp_bitfield,
							'tou_custom_pp_flags'			=> $tou_custom_pp_flags,
						));

						$this->phpbb_log->add('admin', $this->user->data['user_id'], $this->user->ip, 'TOU_LOG_PP_UPDATED');

						trigger_error($this->language->lang('ACP_TOU_PP_UPDATED') . adm_back_link($this->u_action));
					}
				}

				$tou_preview_pp = '';

				if ($request->is_set_post('preview'))
				{
					$tou_preview_pp = generate_text_for_display($tou_custom_pp_text, $tou_custom_pp_uid, $tou_custom_pp_bitfield, $tou_custom_pp_flags);
				}
				$tou_edit_pp = generate_text_for_edit($tou_custom_pp_text, $tou_custom_pp_uid, $tou_custom_pp_flags);

				$this->template->assign_vars(array(
					'ERRORS'								=> $error,
					'U_ACTION'								=> $this->u_action,

					'ACP_TOU_USE_CUSTOM_PP_ENABLED'			=> $this->config['tou_use_custom_pp'],

					'ACP_TOU_CUSTOM_PP_TEXT' 				=> $tou_edit_pp['text'],
					'ACP_TOU_PREVIEW_PP'					=> $tou_preview_pp,

					'S_BBCODE_DISABLE_CHECKED'		=> !$tou_edit_pp['allow_bbcode'],
					'S_MAGIC_URL_DISABLE_CHECKED'	=> !$tou_edit_pp['allow_urls'],
					'S_SMILIES_DISABLE_CHECKED'		=> !$tou_edit_pp['allow_smilies'],

					'BBCODE_STATUS'					=> $language->lang('BBCODE_IS_ON', '<a href="' . $phpbb_container->get('controller.helper')->route('phpbb_help_bbcode_controller') . '">', '</a>'),
					'FLASH_STATUS'					=> $language->lang('FLASH_IS_ON'),
					'IMG_STATUS'					=> $language->lang('IMAGES_ARE_ON'),
					'SMILIES_STATUS'				=> $language->lang('SMILIES_ARE_ON'),
					'URL_STATUS'					=> $language->lang('URL_IS_ON'),

					'S_BBCODE_ALLOWED'				=> true,
					'S_BBCODE_FLASH'				=> true,
					'S_BBCODE_IMG'					=> true,
					'S_LINKS_ALLOWED'				=> true,
					'S_SMILIES_ALLOWED'				=> true,
				));
				// Assigning custom bbcodes
				display_custom_bbcodes();
			break;

		}
	}
}
