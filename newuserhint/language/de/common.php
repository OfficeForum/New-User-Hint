<?php

/**
*
* @package phpBB Extension - New User Hint
* @copyright (c) 2014 OXPUS - www.oxpus.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/*
* [ german ] language file
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
   	'NEW_USER_HINT' => 'Es sind %s inaktive Benutzeraccounts vorhanden. Bitte prüfen!',

));
