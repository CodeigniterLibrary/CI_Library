<?php

class MY_Lang extends CI_Lang {
	// --------------------------------------------------------------------

	/**
	 * Load a language file APP LANG
	 *
	 * @access	public
	 * @param	mixed	the name of the language file to be loaded. Can be an array
	 * @param	string	the language (english, etc.)
	 * @param	bool	return loaded array of translations
	 * @param 	bool	add suffix to $langfile
	 * @param 	string	alternative path to look for language file
	 * @return	mixed
	 */
	public static function my_load($langfile = '', $return = TRUE)
	{
		$langfile = str_replace('_lang.', '', str_replace('.php', '', $langfile)).'_lang.php';

		$config =& get_config();
		$idiom = ( ! isset($config['language'])) ? 'english' : $config['language'];

		if ($return)
		{
			return require(APPPATH."language/$idiom/$langfile");
		}
		elseif (in_array($langfile, self::$is_loaded, TRUE))
		{
			return;
		}
		else
		{
			self::$is_loaded[] = $langfile;
			self::$language = array_merge(self::$language, require(APPPATH."language/$idiom/$langfile"));

			log_message('debug', "Language file loaded: language/$idiom/$langfile");
			return TRUE;
		}
	}
}

/* End of file MY_Lang.php */
/* Location: ./application/core/MY_Lang.php */