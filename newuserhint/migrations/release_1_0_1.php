<?php

/**
*
* @package phpBB Extension - New User Hint
* @copyright (c) 2014 OXPUS - www.oxpus.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace oxpus\newuserhint\migrations;

class release_1_0_1 extends \phpbb\db\migration\migration
{
	var $ext_version = '1.0.1';

	public function effectively_installed()
	{
		return isset($this->config['newuserhint_version']) && version_compare($this->config['newuserhint_version'], $this->ext_version, '>=');
	}

	static public function depends_on()
	{
		return array('\oxpus\newuserhint\migrations\release_1_0_0');
	}

	public function update_data()
	{
		return array(
			// Set the current version
			array('config.add', array('newuserhint_version', $this->ext_version)),
		);
	}
}
