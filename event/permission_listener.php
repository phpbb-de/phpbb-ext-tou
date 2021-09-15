<?php
/**
 *
 * @package phpBB.de Terms of use
 * @copyright (c) 2020 https://www.phpBB.de, Crizzo
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
class permission_listener implements EventSubscriberInterface
{
	/** @var \phpbb\auth\auth */
	protected $auth;

	/**
	 * Constructor
	 *
	 * @param \phpbb\template\template $template Template object
	 */
	public function __construct(\phpbb\auth\auth $auth)
	{
		$this->auth = $auth;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.permissions' => 'permissions',
		);
	}

	/**
	 * Add permissions
	 *
	 * @param	object	$event	The event object
	 * @return	null
	 * @access	public
	 */
	public function permissions($event)
	{
		$permissions = $event['permissions'];
		$permissions['a_tou_manage'] = array('lang' => 'ACL_A_TOU_MANAGE', 'cat' => 'misc');
		$event['permissions'] = $permissions;
	}
}
