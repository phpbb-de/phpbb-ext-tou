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
	 * @param \phpbb\controller\helper $helper
	 * @param unknown $root_path
	 * @param unknown $php_ext
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \phpbb\request\request $request, \phpbb\template\template $template, \phpbb\user $user, \phpbb\controller\helper $helper, $root_path, $php_ext)
	{
		$this->config = $config;
		$this->request = $request;
		$this->db = $db;
		$this->template = $template;
		$this->user = $user;
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
		define('phpbbde\tou\controller\IN_TOU', true);
		$this->user->add_lang('ucp');
		$this->user->add_lang_ext('phpbbde/tou', 'tou');

		// Adding links to the breadcrumbs
		$this->template->assign_block_vars('navlinks', array(
			'FORUM_NAME'	=> $this->user->lang['TOU'],
			'U_VIEW_FORUM'	=> $this->helper->route('phpbbde_tou_main_controller'),
		));

		$this->template->assign_vars(array(
			'L_TERMS_OF_USE' => sprintf($this->user->lang['TERMS_OF_USE_CONTENT'], $this->config['sitename'], generate_board_url()),
			'L_REGISTRATION' => $this->user->lang['TOU'],
			'S_REGISTRATION' => true,
			'S_UCP_ACTION' => $this->helper->route('phpbbde_tou_main_controller'),
		));


		if(isset($_POST['agreed']))
		{
			if(check_form_key('agreement'))
			{
				$sql = 'UPDATE ' . USERS_TABLE . '
				SET user_tou_version = ' . (int) $this->config['tou_version'] . ',
						user_tou_confirmdate = ' . (int) time() . ',
						user_tou_confirmip = \'' . $this->user->ip . '\'
				WHERE user_id = ' . (int) $this->user->data['user_id'];
				$this->db->sql_query($sql);
				$redirect = "{$this->root_path}index.{$this->php_ext}";
				$message = $this->user->lang['CONFIRM_TOU_REDIRECT'];
				$l_redirect = $this->user->lang['RETURN_INDEX'];

				// append/replace SID (may change during the session for AOL users)
				$redirect = reapply_sid($redirect);

				meta_refresh(3, $redirect);
				trigger_error($message . '<br /><br />' . sprintf($l_redirect, '<a href="' . $redirect . '">', '</a>'));
			}
			trigger_error('INVALID_FORM');
		}
		elseif(isset($_POST['not_agreed']))
		{
			//check_form_key('agreement');
			trigger_error(sprintf($this->user->lang['TOU_DENIED'], $this->config['sitename']));
		}

		add_form_key('agreement');

		//return $this->helper->render('tou_body.html', $this->user->lang['TOU']);
		return $this->helper->render('ucp_agreement.html', $this->user->lang['TOU']);
	}

}
