<?php
/**
*
* Codebox Plus extension for the phpBB Forum Software package
*
* @copyright (c) 2014 o0johntam0o
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace o0johntam0o\codeboxplus\migrations;

class v200 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['codebox_plus_version']) && version_compare($this->config['codebox_plus_version'], '2.0.0', '>=');
	}
	
	// INSTALL ==============================================================
	public function update_data()
	{
		return array(
			array('config.add', array('codebox_plus_version', '2.0.0')),
			
			array('config.add', array('codebox_plus_syntax_highlighting', 1)),
			array('config.add', array('codebox_plus_download', 1)),
			array('config.add', array('codebox_plus_login_required', 0)),
			array('config.add', array('codebox_plus_prevent_bots', 1)),
			array('config.add', array('codebox_plus_captcha', 1)),
			array('config.add', array('codebox_plus_max_attempt', 3)),
			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'CODEBOX_PLUS_TITLE'
			)),
			array('module.add', array(
				'acp',
				'CODEBOX_PLUS_TITLE',
				array(
					'module_basename'   => '\o0johntam0o\codeboxplus\acp\main_module',
					'modes'             => array('config_codebox_plus'),
				),
			)),
		);
	}
}
