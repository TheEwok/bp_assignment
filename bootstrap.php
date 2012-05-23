<?php
	/**
	* Bootstrap
	* Simple bootstrap include. Defines path to the flat file used
	* and sets up the autoloader.
	*
	* @author Barry O'Mahony <the.ewok@gmail.com>
	* @version 1.0
	* @package Beatport Homework
	*/

	//Start the session handler
	session_start();
	
	/**
	* Defines path to user credentials flat file
	*/
	define('USER_PASS_FILE', __DIR__.DIRECTORY_SEPARATOR.'bpusercred.txt');
	
	/**
	* Autloader
	* replaces _ with / and includes file if found.
	* @throws Exception
	*/
	function __autoload($classname) {
		$path = __DIR__.DIRECTORY_SEPARATOR.'library'.DIRECTORY_SEPARATOR.str_replace('_', DIRECTORY_SEPARATOR, $classname).'.php';

		if(file_exists($path)) {
			include($path);
		} else {
			throw new Exception("Include file does not exist - $path", 1);
		}
	}
	
	