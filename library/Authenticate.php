<?php
	/**
	* Authenticate.php
	* 
	* Beatport homework assignment
	* per user story presented
	* @author Barry O'Mahony <the.ewok@gmail.com>
	* @version 1.0
	* @package Beatport Homework
	*/
	
	/**
	* Class responsible for managing authentication
	* 
 	* @author Barry O'Mahony <the.ewok@gmail.com>
 	* @version 1.0
	* @package Beatport Homework
	* @subpackage classes
	*/
	class Authenticate {
		
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
		* Is this currently authenticated
		* @access private
		* @var boolean
		*/
		private $authenticated = FALSE;

		/**
		* Validate and authenticate the injected authenticator
		* @return boolean
		*/
		public function doAuthenticate() {
			if($this->session->get('authenticated')==TRUE) {
				$this->authenticated = TRUE;
			} else {
				if($this->authenticator->validate()) {
					if($this->authenticator->authenticate()) {	
						$this->session->save(array('authenticated'=>TRUE,'userinfo'=>$this->authenticator->getPersistentUserInfo()));
						$this->authenticated = TRUE;
						return $this->authenticated;	
					}
				}
			}
			return $this->authenticated;
		}
		
		/**
		* Remove authentication
		* @return boolean
		*/
		public function deauthenticate() {
			$this->authenticated = FALSE;
			$this->session->dump('authenticated');
			$this->session->dump('userinfo');
			return TRUE;
		}
		
		/**
		* Check if currently authenticated
		* @return boolean
		*
		*/
		public function isAuthenticated() {
			return $this->authenticated;
		}
	}