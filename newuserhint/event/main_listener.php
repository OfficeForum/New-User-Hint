<?php

/**
*
* @package phpBB Extension - New User Hint
* @copyright (c) 2014 OXPUS - www.oxpus.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace oxpus\newuserhint\event;

/**
* @ignore
*/
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class main_listener implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'						=> 'load_language_on_setup',
			'core.page_header'						=> 'add_page_header_links',
		);
	}

	/* @var \phpbb\db\driver\driver_interface */
	protected $db;

	/* @var \phpbb\template\template */
	protected $template;
	
	/* @var \phpbb\user */
	protected $user;

	/**
	* Constructor
	*
	* @param \phpbb\db\driver\driver_interfacer		$db
	* @param \phpbb\template\template				$template
	* @param \phpbb\user							$user
	*/
	public function __construct(\phpbb\db\driver\driver_interface $db, \phpbb\template\template $template, \phpbb\user $user)
	{
		$this->db 						= $db;
		$this->template 				= $template;
		$this->user 					= $user;
	}

	public function load_language_on_setup($event)
	{	
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'oxpus/newuserhint',
			'lang_set' => 'common',
		);

		$event['lang_set_ext'] = $lang_set_ext;

	}

	public function add_page_header_links($event)
	{
		if ($this->user->data['user_type'] == USER_FOUNDER)
		{
			$sql = "SELECT COUNT(user_id) AS total FROM " . USERS_TABLE . "
				WHERE user_type = " . USER_INACTIVE . "
					AND user_id <> " . ANONYMOUS;
			$result = $this->db->sql_query($sql);
			$row = $this->db->sql_fetchrow($result);
			$this->db->sql_freeresult($result);

			if ($row['total'] != 0)
			{
				$this->template->assign_vars(array(
					'INACTIVE_USERS' => sprintf($this->user->lang['NEW_USER_HINT'], $row['total'])
				));
			}
		}
	}
}
