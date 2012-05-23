<?php
	/**
	* Authenticate_Authenticator_User
	* Another concrete for authenticator with credentials in a DB. 
	* Used in alternative solution to Beatport homework
	*
	* @author Barry O'Mahony <the.ewok@gmail.com>
	* @version 1.0
	* @package Beatport Homework
	*/

	/**
	* Authenticate_Authenticator_User
	* Another concrete for authenticator with credentials in a DB. 
	* Used in alternative solution to Beatport homework
	*
	* @author Barry O'Mahony <the.ewok@gmail.com>
	* @version 1.0
	* @package Beatport Homework
	* @subpackage classes
	*/
	
	class Authenticate_Authenticator_User extends Authenticate_AuthenticatorAbstract {

		/**
		* Injected DB handle
		* @access public
		* @var object
		*/
		public $dbHandle = NULL;
		
		/**
		* Hashed credential from the DB
		* @access private
		* @var string
		*/
		private $_storedSecret = NULL;
		
		/**
		* Primary key from DB, user ID
		* @access private
		* @var integer
		*/
		private $_userId = NULL;
		
		/**
		* Salt for hashing credential
		* @access private
		* @var string
		*/
		private $_salt = NULL;

		/**
		* Perform validation on self
		* @return boolean
		* @throws Exception
		*/
		public function validate() {
			if(($this->_identity!==null)&&($this->_credential!==null)) {
				return TRUE;
			} else {
				throw new Exception("Authentication Request Object is not valid - ".__class__, 1);	
			}
		}

		/**
		* Validates credentials against values from the DB
		* @return boolean
		*/
		public function authenticate() {
			$this->getStoredCredential();;
			if($this->_storedSecret==$this->_hashCredential()) {
				return TRUE;
			} else {
				return FALSE;
			}
		}

		/**
		* Returns JSON encoded array of info to persist through session
		* @return string
		*/
		public function getPersistentUserInfo() {
			return json_encode(array('userId'=>$this->_userId,'email'=>$this->_identity));
		}

		/**
		* Retrieves the credentials from the DB based on the private _identity
		*
		*/
		private function getStoredCredential() {

			if($this->dbHandle!=NULL) {
				$statement = $this->dbHandle->prepare('SELECT id,email,password,salt FROM users WHERE email=:identity LIMIT 1');
				$statement->bindParam(':identity',$this->_identity,PDO::PARAM_STR);
				
				$statement->execute();
				$result = $statement->fetchAll(PDO::FETCH_ASSOC);
				if(count($result)==1) {
					$this->_storedSecret = $result[0]['password'];
					$this->_userId = $result[0]['id'];
					$this->_salt = $result[0]['salt'];
				}
			}

		}

		/**
		* Hashes the private _credential
		* @return string
		*/
		private function _hashCredential() {
			return crypt($this->_credential,'$2a$07$'.$this->_salt.'$');
		}

	}