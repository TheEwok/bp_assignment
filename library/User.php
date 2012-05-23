<?php
	/**
	* User.php
	* 
	* This file demonstrates an alternate approach
 	* to the beatport homework design
 	* @author Barry O'Mahony <the.ewok@gmail.com>
 	* @version 1.0
	* @package Beatport Homework
	*/
	
	/**
	* Class User
	*
	* Handles some actions that a User is responsible for
	* @package Beatport Homework
	* @subpackage classes
	*/
	class User {
		
		/**
		* Injected authenticator object
		* @access public
		* @var object
		*/
		public $authenticator;
		
		/**
		* Injected session object
		* @access public
		* @var object
		*/
		public $session;
		
		/**
		* Is this user authenticated?
		* @access private
		* @var boolean
		*/
		private $authenticated = FALSE;
		
		/**
		* Perform login for user with given credentials
		* @param string $identity The email address for the user
		* @param string $credential The plain text password for the user
		* @return boolean
		*/
		public function login($identity,$credential) {
			$this->authenticator->setIdentity($identity);
			$this->authenticator->setCredential($credential);
		
			if($this->authenticator->authenticate()) {
				$this->session->save(array('authenticated'=>TRUE,'userinfo'=>$this->authenticator->getPersistentUserInfo()));
				$this->authenticated = TRUE;
			}
			
			return $this->authenticated;
		}
		
		/**
		* Perform logout for a user
		* @return boolean
		*/
		public function logout() {
			$this->session->dump('authenticated');
			$this->session->dump('userinfo');
			$this->authenticated = FALSE;
			return TRUE;
		}
		
		/**
		* Check if user is authenticated
		* @return boolean
		*/
		public function isAuthenticated() {
			return $this->authenticated;
		}
		
		
	}
?>