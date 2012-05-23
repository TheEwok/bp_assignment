<?php
		/**
	* Session
	* Basic session class for testing
	*
	* @author Barry O'Mahony <the.ewok@gmail.com>
	* @version 1.0
	* @package Beatport Homework
	*/

	/**
	* Session
	* Basic session class for testing
	*
	* @author Barry O'Mahony <the.ewok@gmail.com>
	* @version 1.0
	* @package Beatport Homework
	* @subpackage classes
	*/

	class Test_Session {

		private $_session = array();

		/**
		* Saves an array of variables to the session
		* @param array $sessionVar
		*/
		public function save($sessionVar) {
			if(is_array($sessionVar)) {
				foreach($sessionVar as $var=>$val) {
					$this->_session[$var] = $val;
				}
			}
		}
		
		/**
		* Retrieves a session variable if it exists
		* @param array $sessionVar
		* @return mixed
		*/		
		public function get($sessionVar) {
			if(isset($this->_session[$sessionVar])) {
				return $this->_session[$sessionVar];
			} else {
				return null;
			}
		}
		
		/**
		* Unsets a session variable if it exists
		* @param array $sessionVar
		*/
		public function dump($sessionVar) {
			if(isset($this->_session[$sessionVar])) {
				unset($this->_session[$sessionVar]);
			}
		}
		
	}