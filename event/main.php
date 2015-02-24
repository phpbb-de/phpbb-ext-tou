<?php
/**
 *
 * @package phpBB.de pastebin
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
			'core.page_header'	=> 'page_header',
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
	public function __construct(\phpbb\auth\auth $auth, \phpbb\config\config $config, \phpbb\controller\helper $helper, \phpbb\user $user, $phpbb_root_path, $php_ext)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->helper = $helper;
		$this->php_ext = $php_ext;
		$this->user = $user;
	}

	public function page_header($event)
	{
		if(version_compare($this->user->data['user_tou_version'], $this->config['tou_version'], 'eq') || $this->user->data['is_bot'] || !$this->user->data['is_registered'])
		{
			return;
		}

		// If we are already showing the TOU, obviously we don't need to redirect there
		if(defined('IN_TOU'))
		{
			return;
		}

		// At this point we have a registered user who did not accept the newest TOU.
		redirect($this->helper->route('phpbbde_tou_main_controller'));
	}
}
