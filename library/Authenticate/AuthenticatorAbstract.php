<?php
	/**
	* AuthenticatorAbstract
	* Abstract for authenticator classes. 
	* This is extended in concrete classes.
	*
	* @author Barry O'Mahony <the.ewok@gmail.com>
	* @version 1.0
	* @package Beatport Homework
	*/
	
	/**
	* AuthenticatorAbstract
	* Abstract for authenticator classes
	* Implements AuthenticatorInterface
	*
	* @author Barry O'Mahony <the.ewok@gmail.com>
	* @version 1.0
	* @package Beatport Homework
	* @subpackage classes
	*/
	abstract class Authenticate_AuthenticatorAbstract implements Authenticate_AuthenticatorInterface {

		/**
		* Identity for validation
		* @access protected
		* @var string
		*/
		protected $_identity;
		
		/**
		* Credential for validation
		* @access protected
		* @var string
		*/
		protected $_credential;

		/**
		* Perform validation on authenticator
		* Overridden in concrete classes
		* @return boolean
		*/
		public function validate() {}

		/**
		* Perform authentication
		* Overridden in concrete classes
		* @return boolean
		*/
		public function authenticate() {}
			
		/**
		* Return persistent info to Validation class for session storage
		* Overridden in concrete classes
		* @return mixed
		*/
		public function getPersistentUserInfo() {}
		
		/**
		* Set the private variable _identity
		* @param string $identity
		*/
		public function setIdentity($identity) {
			$this->_identity = $identity;
		}
		
		/**
		* Set the private variable _credential
		* @param string $credential
		*/
		public function setCredential($credential) {
			$this->_credential = $credential;
		}

	}