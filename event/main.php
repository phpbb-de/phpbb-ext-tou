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
			'core.page_footer'			=> 'page_footer',
		);
	}

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\config\db_text */
	protected $config_text;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/* @var \phpbb\language\language */
	protected $language;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $root_path;

	/** @var string */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\auth\auth					$auth		Auth object
	 * @param \phpbb\config\config 				$config
	 * @param \phpbb\config\db_text				$config_text
	 * @param \phpbb\request\request 			$request
	 * @param \phpbb\template\template			$template	Template object
	 * @param \phpbb\controller\helper			$helper 	Helper
	 * @param \phpbb\language\language			$language
	 * @param string							$phpbb_root_path		phpBB root path (community/)
	 * @param string							$php_ext				php file extension (php)
	 * @param string							$root_path				php file extension (...phpbb.de/)
	 */
	public function __construct(
		\phpbb\auth\auth $auth,
		\phpbb\config\config $config,
		\phpbb\config\db_text $config_text,
		\phpbb\controller\helper $helper,
		\phpbb\user $user,
		\phpbb\language\language $language,
		\phpbb\request\request $request,
		\phpbb\template\template $template,
		$phpbb_root_path,
		$php_ext)
	{
		$this->auth = $auth;
		$this->config = $config;
		$this->config_text = $config_text;
		$this->phpbb_root_path = $phpbb_root_path;
		$this->helper = $helper;
		$this->php_ext = $php_ext;
		$this->user = $user;
		$this->language =$language;
		$this->template = $template;
		$this->request = $request;
	}

	public function page_header($event)
	{
		// Replace Language Variable for registration:
		// VALUES SET HERE WILL OVERWRITE ALL LOCATIONS WHERE THE VARIABLE IS ACTUALLY USED!
		$this->language->add_lang('ucp');
		// Check for custom Terms of use and display it instead of core variable
		if ($this->config['tou_use_custom_tou'])
		{
			$tou_data = $this->config_text->get_array(array(
				'tou_custom_tou_text',
				'tou_custom_tou_uid',
				'tou_custom_tou_bitfield',
				'tou_custom_tou_flags',
			));

			$tou_custom_tou_text = generate_text_for_display(
				$tou_data['tou_custom_tou_text'],
				$tou_data['tou_custom_tou_uid'],
				$tou_data['tou_custom_tou_bitfield'],
				$tou_data['tou_custom_tou_flags']
			);

			$this->template->assign_var('L_TERMS_OF_USE', $this->language->lang($tou_custom_tou_text, $this->config['sitename'], generate_board_url()));
		}
		else
		{
			$this->template->assign_var('L_TERMS_OF_USE', $this->language->lang('TERMS_OF_USE_CONTENT', $this->config['sitename'], generate_board_url()));
		}
		// Check for custom Privacy Policy and display it instead of core variable
		if ($this->config['tou_use_custom_pp'])
		{
			$pp_data = $this->config_text->get_array(array(
				'tou_custom_pp_text',
				'tou_custom_pp_uid',
				'tou_custom_pp_bitfield',
				'tou_custom_pp_flags',
			));

			$tou_custom_pp_text = generate_text_for_display(
				$pp_data['tou_custom_pp_text'],
				$pp_data['tou_custom_pp_uid'],
				$pp_data['tou_custom_pp_bitfield'],
				$pp_data['tou_custom_pp_flags']
			);

			$this->template->assign_var('L_PRIVACY_POLICY', $this->language->lang($tou_custom_pp_text, $this->config['sitename'], generate_board_url()));
		}
		else
		{
			$this->template->assign_var('L_PRIVACY_POLICY', $this->language->lang('PRIVACY_POLICY', $this->config['sitename'], generate_board_url()));
		}
		// Check for bot, registered user and if the version is higher or equal
		if (($this->user->data['user_tou_version'] >= $this->config['tou_version']) || $this->user->data['is_bot'] || !$this->user->data['is_registered'])
		{
			return;
		}
		// If we are already showing the TOU, obviously we don't need to redirect there
		if (defined('PHPBBDE_TOU_CONTROLLER_IN_TOU'))
		{
			return;
		}
		// Return if we are the board founder
		if ($this->user->data['user_type'] == USER_FOUNDER)
		{
			return;
		}

		// At this point we have a registered user who did not accept the newest TOU.
		redirect($this->helper->route('phpbbde_tou_main_controller', [], false, false, \Symfony\Component\Routing\Generator\UrlGeneratorInterface::ABSOLUTE_URL));
	}

	// Overwrite AGREEMENT_TEXT for ToU or PP
	public function page_footer()
	{
		// Check for phpBB version
		$phpbb_version = $this->config['version'];
		$old_phpbb_version = version_compare($phpbb_version, '3.3.1', '<=');

		$mode = $this->request->variable('mode', '');
		if (($mode == 'terms') && ($this->config['tou_use_custom_tou']))
		{
			$tou_data = $this->config_text->get_array(array(
				'tou_custom_tou_text',
				'tou_custom_tou_uid',
				'tou_custom_tou_bitfield',
				'tou_custom_tou_flags',
			));

			$tou_custom_tou_text = generate_text_for_display(
				$tou_data['tou_custom_tou_text'],
				$tou_data['tou_custom_tou_uid'],
				$tou_data['tou_custom_tou_bitfield'],
				$tou_data['tou_custom_tou_flags']
			);
			$this->template->assign_vars(array(
				'AGREEMENT_TEXT'	=> $old_phpbb_version ? '</p><div style="font-size: 12px">' . $tou_custom_tou_text . '</div><p>' : $tou_custom_tou_text,
			));
		}
		else if (($mode == 'privacy') && ($this->config['tou_use_custom_pp']))
		{
			$pp_data = $this->config_text->get_array(array(
				'tou_custom_pp_text',
				'tou_custom_pp_uid',
				'tou_custom_pp_bitfield',
				'tou_custom_pp_flags',
			));

			$tou_custom_pp_text = generate_text_for_display(
				$pp_data['tou_custom_pp_text'],
				$pp_data['tou_custom_pp_uid'],
				$pp_data['tou_custom_pp_bitfield'],
				$pp_data['tou_custom_pp_flags']
			);
			$this->template->assign_vars(array(
				'AGREEMENT_TEXT'	=> $old_phpbb_version ? '</p><div style="font-size: 12px">' . $tou_custom_pp_text . '</div><p>' : $tou_custom_pp_text,
			));
		}
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
