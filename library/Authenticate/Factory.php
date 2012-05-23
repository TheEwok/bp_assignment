<?php
	/**
	* Authenticate_Factory
	* 
	* Beatport homework assignment
	* per user story presented
	* @author Barry O'Mahony <the.ewok@gmail.com>
	* @version 1.0
	* @package Beatport Homework
	*/

	/**
	* Factory for generation of authenticator objects
	* 
	* @author Barry O'Mahony <the.ewok@gmail.com>
	* @version 1.0
	* @package Beatport Homework
	* @subpackage classes
	*/
	
	class Authenticate_Factory {

		/**
		* Static factory method
		* @param string $authType
		* @return object;
		*/
		public static function factory($authType) {

			$className = 'Authenticate_Authenticator_'.$authType;
			return new $className;

		}

	}