<?php
	/**
	* Defines path to user credentials flat file
	*/
	define('USER_PASS_FILE', '../bpusercred.txt');
	spl_autoload_register('__autoload');
	
	/**
	* Autloader
	* replaces _ with / and includes file if found.
	* @throws Exception
	*/
	function __autoload($classname) {
		$path = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'library'.DIRECTORY_SEPARATOR.str_replace('_', DIRECTORY_SEPARATOR, $classname).'.php';
		if(file_exists($path)) {
			include($path);
		} else {
			throw new Exception("Include file does not exist - $path", 1);
		}
	}

