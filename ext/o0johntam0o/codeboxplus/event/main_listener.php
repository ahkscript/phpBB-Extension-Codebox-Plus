<?php
/**
*
* Codebox Plus extension for the phpBB Forum Software package
*
* @copyright (c) 2014 o0johntam0o
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace o0johntam0o\codeboxplus\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class main_listener implements EventSubscriberInterface
{
	/** @var \phpbb\controller\helper */
	protected $helper;
	/** @var \phpbb\template\template */
	protected $template;
	/** @var \phpbb\user */
	protected $user;
	/** @var \phpbb\config\config */
	protected $config;
	/** @var string */
	protected $root_path;
	/** @var string */
	protected $php_ext;
	
	protected $syntax_highlighting_enabled;
	protected $download_enabled;
	protected $find;
	protected $find_code;
	protected $find_lang;
	protected $find_file;
	
	public function __construct(\phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\user $user, \phpbb\config\config $config, $root_path, $php_ext)
	{
		$this->helper = $helper;
		$this->template = $template;
		$this->user = $user;
		$this->config = $config;
		$this->root_path = $root_path;
		$this->php_ext = $php_ext;
		
		$this->syntax_highlighting_enabled = isset($this->config['codebox_plus_syntax_highlighting']) ? $this->config['codebox_plus_syntax_highlighting'] : 0;
		$this->download_enabled = isset($this->config['codebox_plus_download']) ? $this->config['codebox_plus_download'] : 0;
	}
	
	static public function getSubscribedEvents()
    {
        return array(
            'core.user_setup'							=> 'load_language_on_setup',
            'core.modify_submit_post_data'				=> 'posting_modify_input',
            'core.posting_modify_template_vars'			=> 'posting_event',
            'core.viewtopic_post_rowset_data'			=> 'viewtopic_event',
			'core.modify_bbcode_init'					=> 'posting_bbcode_init_event',
			'core.bbcode_cache_init_end'				=> 'preview_bbcode_init_event',
        );
    }
	
    public function load_language_on_setup($event)
    {
        $lang_set_ext = $event['lang_set_ext'];
        $lang_set_ext[] = array(
            'ext_name' => 'o0johntam0o/codeboxplus',
            'lang_set' => 'codebox_plus',
        );
        $event['lang_set_ext'] = $lang_set_ext;
		
		if ($this->download_enabled)
		{
			$this->template->assign_vars(array(
				'CODEBOX_PLUS_DOWNLOAD_AVAILABLE'		=> true,
			));
		}
    }
	
	/*
	* Event: core.modify_bbcode_init (message_parser.php)
	* Fix bbcode regex for posting
	*/
	public function posting_bbcode_init_event($event)
	{
		$bbcodes = $event['bbcodes'];
		// Replace the regex and replacement for code tags so that:
		//   '=php' is not processed by the built-in code
		//   ' file=y' doesn't prevent the tag from being recognized
		//   '=x' and ' file=y' are reinserted into the tag
		//   additional chars are allowed in the language name
		$bbcodes['code']['regexp'] = array(
			'#\[code(=[a-z0-9_-]+)?( file=.*?)?\](.+?\[/code\])#uise' => "str_replace(\"[code:\$this->bbcode_uid]\", \"[code\$1\$2:\$this->bbcode_uid]\", \$this->bbcode_code('', '\$3'))",
		);
		$event['bbcodes'] = $bbcodes;
	}
	
	/*
	* Event: core.bbcode_cache_init_end (bbcode.php)
	* Fix bbcode regex for post preview etc.
	*/
	public function preview_bbcode_init_event($event)
	{
		$cache = $event['bbcode_cache'];
		// Replace the regex for code tags for the same reasons as described above.
		// Replacement HTML is generated by calling our codebox_template() method,
		// but since the replacement eval is done by the message parser, we need
		// to get a reference to our extension via the phpbb service container.
		$cache[8] = array(
			'preg' => array(
				'#\[code(?:=([a-z]+))?(?: file=.*?)?:$uid\](.*?)\[/code:$uid\]#ise' => "\$GLOBALS['phpbb_container']->get('o0johntam0o.codeboxplus.listener')->codebox_template('\$2', '\$1')",
			)
		);
		$event['bbcode_cache'] = $cache;
	}
	
	/*
	* Event: core.posting_modify_template_vars (posting.php)
	* Remove extra space before '[/code]'
	*/
	public function posting_event($event)
	{
		if (isset($event['page_data']))
		{
			$page_data = $event['page_data'];
			$message = $page_data['MESSAGE'];
			$message = str_replace(' [/code]', '[/code]', $message);
			
			if (isset($page_data['MESSAGE']))
			{
				$page_data['MESSAGE'] = $message;
				$event['page_data'] = $page_data;
			}
		}
		
		$this->template->assign_vars(array(
			'CODEBOX_PLUS_IN_POSTING'				=> true,
		));
    }
	
	/*
	* Event: core.viewtopic_post_rowset_data (viewtopic.php)
	*/
    public function viewtopic_event($event)
    {
		if (isset($event['rowset_data']))
		{
			$rowset_data = $event['rowset_data'];
			$post_text = isset($rowset_data['post_text']) ? $rowset_data['post_text'] : '';
			$bbcode_uid = isset($rowset_data['bbcode_uid']) ? $rowset_data['bbcode_uid'] : '';
			$post_id = isset($rowset_data['post_id']) ? $rowset_data['post_id'] : 0;
			$part = 0;
			
			while (preg_match("#\[code(?:=[a-z0-9_-]+)?(?: file=.*?)?:" . $bbcode_uid . "\](.*?)\[/code:" . $bbcode_uid . "\]#msi", $post_text))
			{
				$part++;
				$post_text = preg_replace("#\[code(?:=([a-z0-9_-]+))?(?: file=(.*?))?:" . $bbcode_uid . "\](.*?)\[/code:" . $bbcode_uid . "\]#msie", "\$this->codebox_template('\$3', '\$1', '\$2', \$post_id, \$part)", $post_text, 1);
			}
			
			if (isset($rowset_data['post_text']) && $part > 0)
			{
				$rowset_data['post_text'] = $post_text;
				$event['rowset_data'] = $rowset_data;
			}
		}
	}
	
	/*
	* Event: core.modify_submit_post_data (includes/functions_posting.php)
	* Use: $this->codebox_clean_code()
	* Generate text for storage
	*/
	public function posting_modify_input($event)
	{
		if (isset($event['data']))
		{
			// REQUEST
			$data = $event['data'];
			$message = $data['message'];
			$bbcode_uid = $data['bbcode_uid'];
			// MODIFY
			$message = preg_replace("#(\[code(?:=[a-z0-9_-]+)?(?: file=.*?):" . $bbcode_uid . "\])(.*?)(\[/code:" . $bbcode_uid . "\])#msie", "'\$1' . \$this->codebox_clean_code('\$2', \$bbcode_uid) . '\$3'", $message);
			// RETURN
			$data['message'] = $message;
			$event['data'] = $data;
		}
    }
	
	/*
	* Use: $this->codebox_parse_code(), $this->codebox_decode_code()
	* Generate text for display
	*/
	public function codebox_template($code = '', $lang = 'text', $file = '', $id = 0, $part = 0)
	{
		if (strlen($code) == 0)
		{
			return '';
		}
		
		if (strlen($lang) == 0) // [code] tag without language.
		{
			$lang = 'text';
		}
		
		$re = '<div class="codebox codebox_plus"><p>';
		$re .= $this->user->lang['CODE'] . ': ';
		$re .= '<a href="#" onclick="codebox_plus_select(this); return false;">[' . $this->user->lang['SELECT_ALL_CODE'] . ']</a>';
		
		$re .= "&nbsp;<a href=\"#\" onclick=\"codebox_plus_toggle(this, '[" . $this->user->lang['CODEBOX_PLUS_EXPAND'] . "]', '[" . $this->user->lang['CODEBOX_PLUS_COLLAPSE'] . "]'); return false;\">[" . $this->user->lang['CODEBOX_PLUS_EXPAND'] . ']</a>';
		
		if ($this->download_enabled && $lang != 'NULL' && $id != 0)
		{
			$re .= '&nbsp;<a href="' . $this->helper->route('o0johntam0o_codeboxplus_download_controller', array('id' => $id, 'part' => $part)) . '" onclick="window.open(this.href); return false;">';
			$re .= '[' . $this->user->lang['CODEBOX_PLUS_DOWNLOAD'] . ']</a> ' . ($file == '' ? '' : '('. $file . ')');
		}
		
		$re .= '<span class="codebox_plus_about"><a href="http://qbnz.com/highlighter/">GeSHi</a> &copy; <a href="https://www.phpbb.com/customise/db/extension/codeboxplus/">Codebox Plus</a></span>';
		$re .= '</p><code class="collapsed">';
		
		if ($lang != 'NULL')
		{
			$re .= $this->codebox_parse_code($this->codebox_decode_code($code), $lang);
		}
		else
		{
			$re .= $this->user->lang['CODEBOX_PLUS_NO_PREVIEW'];
		}
		
		$re .= '</code></div>';
		
		return $re;
	}
	
	/*
	* Syntax highlighter
	*/
	private function codebox_parse_code($code = '', $lang = 'text')
	{
		if (strlen($code) == 0)
		{
			return '';
		}
		// Remove newline at the beginning
		if (!empty($code) && $code[0] == "\n")
		{
			$code = substr($code, 1);
		}
		
		if ($this->syntax_highlighting_enabled)
		{
			// GeSHi
			if (!class_exists("GeSHi"))
			{
				include($this->root_path . 'ext/o0johntam0o/codeboxplus/includes/geshi/geshi.' . $this->php_ext);
			}
			
			$geshi = new \GeSHi($code, $lang);
			$geshi->set_header_type(GESHI_HEADER_DIV);
			$geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);
			$geshi->enable_keyword_links(false);
			$geshi->set_line_style('margin-left:20px;', false);
			$geshi->set_code_style('border-bottom: dotted 1px #cccccc;', false);
			$geshi->set_line_ending("\n");
			$code = str_replace("\n", "", $geshi->parse_code());
		}
		
		return $code;
	}
	
	/*
	* Decode some special characters
	*/
	private function codebox_decode_code($code = '')
	{
		if (strlen($code) == 0)
		{
			return $code;
		}
		
		$str_from = array('&lt;', '&gt;', '&#91;', '&#93;', '&#40;', '&#41;', '&#46;', '&#58;', '&#058;', '&#39;', '&#039;', '&quot;', '&amp;');
		$str_to = array('<', '>', '[', ']', '(', ')', '.', ':', ':', "'", "'", '"', '&');
		$code = str_replace($str_from, $str_to, $code);
		
		return $code;
	}
	
	/*
	* Remove BBCodes UID & Smilies & Emails
	*/
	private function codebox_clean_code($code = '', $bbcode_uid = '')
	{
		if (strlen($code) == 0 || strlen($bbcode_uid) == 0)
		{
			return $code;
		}
		
		// Email
		$code = preg_replace('#<!-- e --><a href=\\\\"mailto:(?:.*?)\\\\">(.*?)</a><!-- e -->#msi', '$1', $code);
		// Smilies
		$code = preg_replace('#<!-- s(.*?) --><img src=\\\\"{SMILIES_PATH}/(?:.*?)\\\\" /><!-- s(?:.*?) -->#msi', '$1', $code);
		// BBCodes
		$code = str_replace(':o:' . $bbcode_uid, '', $code);
		$code = str_replace(':u:' . $bbcode_uid, '', $code);
		$code = str_replace(':m:' . $bbcode_uid, '', $code);
		$code = str_replace(':' . $bbcode_uid, '', $code);
		// Trouble with BBCode [CODE]
		$code = str_replace('<br />', "\n", $code);
		$code = str_replace('\\"', '&quot;', $code);
		$code = str_replace('&nbsp;', ' ', $code);
		$code = preg_replace('#<(.*?)>#msi', '', $code);
		
		return $code;
	}
}
