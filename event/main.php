<?php
/**
 *
 * @package phpBB.de tou
 * @copyright (c) 2015 phpBB.de, gn#36
 * @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 *
 */

namespace phpbbde\tou\event;

/**
 * @ignore
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener
 */
class main implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			'core.page_header'			=> 'page_header',
			'core.user_add_modify_data' => 'user_add_modify',
		);
	}

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth			$auth		Auth object
	 * @param \phpbb\template\template	$template	Template object
	 * @param \phpbb\controller\helper	$helper 	Helper
	 * @param string			$phpbb_root_path		phpBB root path (community/)
	 * @param string			$php_ext				php file extension (php)
	 * @param string			$root_path				php file extension (...phpbb.de/)
	 */
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\controller\helper $helper, \phpbb\user $user, \phpbb\template\template $template, $phpbb_root_path, $php_ext)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->helper = $helper;
		$this->php_ext = $php_ext;
		$this->user = $user;
		$this->template = $template;
	}

	public function page_header($event)
	{
		// Replace Language Variable for registration:
		// TODO: Maybe make this controllable via ACP.
		// VALUES SET HERE WILL OVERWRITE ALL LOCATIONS WHERE THE VARIABLE IS ACTUALLY USED!
		$this->user->add_lang('ucp');
		$this->template->assign_var('L_PRIVACY_POLICY_TEXT', sprintf($this->user->lang['PRIVACY_POLICY'], $this->config['sitename'], generate_board_url()));
		$this->template->assign_var('L_TERMS_OF_USE', sprintf($this->user->lang['TERMS_OF_USE_CONTENT'], $this->config['sitename'], generate_board_url()));
		//$this->template->assign_var('L_TERMS_OF_USE', 'TEST');

		if (version_compare($this->user->data['user_tou_version'], $this->config['tou_version'], 'eq') || $this->user->data['is_bot'] || !$this->user->data['is_registered'])
		{
			return;
		}

		// If we are already showing the TOU, obviously we don't need to redirect there
		if (defined('PHPBBDE\TOU\CONTROLLER\IN_TOU'))
		{
			return;
		}

		// At this point we have a registered user who did not accept the newest TOU.
		redirect($this->helper->route('phpbbde_tou_main_controller', [], false, false, \Symfony\Component\Routing\Generator\UrlGeneratorInterface::ABSOLUTE_URL));
	}

	public function user_add_modify($event)
	{
		$sql_ary = $event['sql_ary'];
		$sql_ary['user_tou_version'] 		= $this->config['tou_version'];
		$sql_ary['user_tou_confirmdate'] 	= time();
		$sql_ary['user_tou_confirmip'] 		= empty($sql_ary['user_ip']) ? $this->user->ip : $sql_ary['user_ip'];
		$event['sql_ary'] = $sql_ary;
	}
}
