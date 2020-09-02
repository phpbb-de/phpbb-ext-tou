<?php

/**
 *
 * @package phpBB.de tou
 * @copyright (c) 2015 phpBB.de, gn#36
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace phpbbde\tou\controller;

class main
{

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/* @var \phpbb\language\language */
	protected $language;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var string */
	protected $root_path;

	/** @var string */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config $config
	 * @param \phpbb\db\driver\driver_interface $db
	 * @param \phpbb\request\request $request
	 * @param \phpbb\template\template $template
	 * @param \phpbb\user $user
	 * @param \phpbb\language\language	$language
	 * @param \phpbb\controller\helper $helper
	 * @param string $root_path
	 * @param string $php_ext
	 */
	public function __construct(
					\phpbb\config\config $config,
					\phpbb\db\driver\driver_interface $db,
					\phpbb\request\request $request,
					\phpbb\template\template $template,
					\phpbb\user $user,
					\phpbb\language\language $language,
					\phpbb\controller\helper $helper,
					$root_path,
					$php_ext)
	{
		$this->config = $config;
		$this->request = $request;
		$this->db = $db;
		$this->template = $template;
		$this->user = $user;
		$this->language = $language;
		$this->helper = $helper;
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
	}

	/**
	 * Handle all calls
	 * @param string $name
	 */
	public function handle($name = '')
	{
		define('PHPBBDE\TOU\CONTROLLER\IN_TOU', true);
		$this->language->add_lang('ucp');
		$this->language->add_lang('tou', 'phpbbde/tou');

		// Adding links to the breadcrumbs
		$this->template->assign_block_vars('navlinks', array(
			'FORUM_NAME'	=> $this->language->lang('TOU'),
			'U_VIEW_FORUM'	=> $this->helper->route('phpbbde_tou_main_controller'),
		));

		// Checking amount of available languages
		$sql = 'SELECT lang_id
				FROM ' . LANG_TABLE;
		$result = $this->db->sql_query($sql);

		$lang_row = array();
		while ($row = $this->db->sql_fetchrow($result))
		{
			$lang_row[] = $row;
		}
		$this->db->sql_freeresult($result);

		// Check for user language
		$user_lang		= $this->request->variable('lang', $this->user->lang_name);
		$change_lang	= $this->request->variable('tou_lang_change', '');
		$s_hidden_fields = array();

		if ($change_lang || $user_lang != $this->config['default_lang'])
		{
			$use_lang = ($change_lang) ? basename($change_lang) : basename($user_lang);

			if (!function_exists('validate_language_iso_name'))
			{
				require($this->root_path . 'includes/functions_user.' . $this->php_ext);
			}

			if (!validate_language_iso_name($use_lang))
			{
				$user_lang = $use_lang;
			}
			else
			{
				$change_lang = '';
				$user_lang = $this->user->lang_name;
			}
		}
		// If we change the language, we want to pass the language parameter.
		if ($change_lang)
		{
			$s_hidden_fields = array_merge($s_hidden_fields, array(
				'lang'				=> $this->user->lang_name,
			));
		}

		$this->template->assign_vars(array(
			'L_TERMS_OF_USE' => $this->language->lang('TERMS_OF_USE_CONTENT', $this->config['sitename'], generate_board_url()),
			'L_PRIVACY_POLICY' => $this->language->lang('PRIVACY_POLICY', $this->config['sitename'], generate_board_url()),

			'S_UCP_ACTION' => $this->helper->route('phpbbde_tou_main_controller'),

			'S_LANG_OPTIONS'	=> (count($lang_row) > 1) ? language_select($user_lang) : '',
			'S_HIDDEN_FIELDS'	=> build_hidden_fields($s_hidden_fields),
			'COOKIE_NAME'		=> $this->config['cookie_name'],
			'COOKIE_PATH'		=> $this->config['cookie_path'],
		));

		if ($this->request->is_set_post('agreed'))
		{
			if ( check_form_key('agreement'))
			{
				$sql = 'UPDATE ' . USERS_TABLE . '
				SET user_tou_version = ' . (int) $this->config['tou_version'] . ',
						user_tou_confirmdate = ' . (int) time() . ',
						user_tou_confirmip = \'' . $this->user->ip . '\'
				WHERE user_id = ' . (int) $this->user->data['user_id'];
				$this->db->sql_query($sql);

				$redirect = "{$this->root_path}index.{$this->php_ext}";

				$message = $this->language->lang('CONFIRM_TOU_REDIRECT');

				$l_redirect = $this->language->lang('RETURN_INDEX');

				// append/replace SID (may change during the session for AOL users)
				$redirect = reapply_sid($redirect);

				meta_refresh(3, $redirect);
				trigger_error($message . '<br /><br />' . sprintf($l_redirect, '<a href="' . $redirect . '">', '</a>'));
			}
			trigger_error('INVALID_FORM');
		}
		else if ($this->request->is_set_post('not_agreed'))
		{
			trigger_error($this->language->lang('TOU_DENIED', $this->config['sitename']));
		}

		add_form_key('agreement');

		return $this->helper->render('tou_body.html', $this->language->lang('TOU'));
	}

}
