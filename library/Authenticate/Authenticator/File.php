<?php
	/**
	* Authenticate_Authenticator_File
	* Another concrete for authenticator with credentials in a flat file. 
	*
	* @author Barry O'Mahony <the.ewok@gmail.com>
	* @version 1.0
	* @package Beatport Homework
	*/

	/**
	* Authenticate_Authenticator_File
	* Another concrete for authenticator with credentials in a flat file.
	*
	* @author Barry O'Mahony <the.ewok@gmail.com>
	* @version 1.0
	* @package Beatport Homework
	* @subpackage classes
	*/
	
	class Authenticate_Authenticator_File extends Authenticate_AuthenticatorAbstract {

		/**
		* Perform validation on self
		* @return boolean
		* @throws Exception
		*/
		public function validate() {
			if(($this->_identity!==null)&&($this->_credential!==null)) {
				return TRUE;
			} else {
				throw new InvalidArgumentException("Authentication Request Object is not valid - ".__class__, 1);	
			}
		}

		/**
		* Validates credentials against values from the DB
		* @return boolean
		*/
		public function authenticate() {
			$returnValue = FALSE;
			
			$storedCredentials = $this->_getUserCredential();
			
			if($storedCredentials!==FALSE) {
				if($storedCredentials['_credential']==$this->_hashCredential($this->_credential,$storedCredentials['salt'])) {
					$returnValue = TRUE;
				}
			} 
			
			return $returnValue;
		}

		/**
		* Returns JSON encoded array of info to persist through session
		* @return string
		*/
		public function getPersistentUserInfo() {
			return json_encode(array('username'=>$this->_identity));
		}

		/**
		* Retrieves the credentials from the flatfile based on the private _identity
		*
		*/
		private function _getUserCredential() {

			$userPassFile = file_get_contents(USER_PASS_FILE);
			$matches = preg_match_all('/'.$this->_identity.':(.*)?:(.*)?/', $userPassFile, $matchesArray);
			if($matches>0) {
				return array('_credential'=>$matchesArray[1][0],'salt'=>$matchesArray[2][0]);
			} else {
				return FALSE;
			}
		}

		/**
		* Hashes the private _credential
		* @return string
		*/
		private function _hashCredential($password,$salt) {
			return crypt($password,'$2a$07$'.$salt.'$');
		}

	}