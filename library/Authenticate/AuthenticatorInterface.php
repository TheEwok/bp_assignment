<?php
	/**
	* AuthenticatorInterface.php
	* Interface for authenticator classes
	*
	* @author Barry O'Mahony <the.ewok@gmail.com>
	* @version 1.0
	* @package Beatport Homework
	*/

	/**
	* Interface for authenticator classes
	*
	* @author Barry O'Mahony <the.ewok@gmail.com>
	* @version 1.0
	* @package Beatport Homework
	* @subpackage interfaces
	*/
	interface Authenticate_AuthenticatorInterface {
		
		/**
		* Validate object
		*/
		public function validate();
		
		/**
		* Do Authentication
		*/
		public function authenticate();
		
		/**
		* Set the private variable _identity
		* @param string $identity 
		*/
		public function setIdentity($identity);
		
		/**
		* Set the private variable _credential
		* @param string $credential
		*/
		public function setCredential($credential);
		
		/**
		* Return the persistent user information
		* to store in session
		* @return mixed
		*/
		public function getPersistentUserInfo();

	}