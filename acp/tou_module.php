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
	protected $language;
	protected $request;
	protected $template;
	protected $user;

	public function main($id, $mode)
	{

		global $config, $template, $request, $phpbb_container, $user;

		/** @var \phpbb\language\language $language */
		$language = $phpbb_container->get('language');

		$this->config = $config;
		$this->language = $language;
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;

		// Mode switch start
		switch ($mode)
		{
			// Settings
			case 'settings':
				// Add the TOU ACP lang file
				$this->language->add_lang('acp', 'phpbbde/tou');

				$this->tpl_name = 'acp_tou_settings';
				$this->page_title = ('ACP_TOU_SETTINGS');

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
						$this->config->set('tou_version', $this->request->variable('phpbbde_tou_version', 0));

						trigger_error($this->language->lang('ACP_TOU_SETTINGS_UPDATED') . adm_back_link($this->u_action));
					}
				}

				$this->template->assign_vars(array(
					'ERRORS'								=> $error,
					'U_ACTION'								=> $this->u_action,

					'ACP_TOU_VERSION_VALUE'				=> $this->config['tou_version'],
				));
			break;

		}
	}
}
