<?php
	/**
	* Session
	* Basic session class
	*
	* @author Barry O'Mahony <the.ewok@gmail.com>
	* @version 1.0
	* @package Beatport Homework
	*/

	/**
	* Session
	* Basic session class
	*
	* @author Barry O'Mahony <the.ewok@gmail.com>
	* @version 1.0
	* @package Beatport Homework
	* @subpackage classes
	*/

	class Session {
		/**
		* Saves an array of variables to the session
		* @param array $sessionVar
		*/
		public function save($sessionVar) {
			if(is_array($sessionVar)) {
				foreach($sessionVar as $var=>$val) {
					$_SESSION[$var] = $val;
				}
			}
		}
		
		/**
		* Retrieves a session variable if it exists
		* @param array $sessionVar
		* @return mixed
		*/		
		public function get($sessionVar) {
			if(isset($_SESSION[$sessionVar])) {
				return $_SESSION[$sessionVar];
			} else {
				return null;
			}
		}
		
		/**
		* Unsets a session variable if it exists
		* @param array $sessionVar
		*/
		public function dump($sessionVar) {
			if(isset($_SESSION[$sessionVar])) {
				unset($_SESSION[$sessionVar]);
			}
		}
		
	}