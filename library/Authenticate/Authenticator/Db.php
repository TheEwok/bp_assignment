<?php
	/**
	* Authenticate_Authenticator_Db
	* Concrete for authenticator with credentials in a DB. 
	*
	* @author Barry O'Mahony <the.ewok@gmail.com>
	* @version 1.0
	* @package Beatport Homework
	*/

	/**
	* Authenticate_Authenticator_DB
	* Concrete for authenticator with credentials in a DB. 
	*
	* @author Barry O'Mahony <the.ewok@gmail.com>
	* @version 1.0
	* @package Beatport Homework
	* @subpackage classes
	*/
	class Authenticate_Authenticator_Db extends Authenticate_AuthenticatorAbstract {
		
		/**
		* Injected DB handle
		* @access public
		* @var object
		*/
		public $dbHandle = NULL;
		
		/**
		* Hashed credential value from the DB
		* @access private
		* @var string
		*/
		private $_storedSecret = NULL;
		
		/**
		* Primary key, application id field from DB
		* @access private
		* @var string
		*
		*/
		private $_apiId = NULL;

		/**
		* Perform validation on self.
		* @return boolean
		* @throws exception 
		*
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
			$this->getStoredCredential();
			if($this->_storedSecret==$this->hashCredential()) {
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
			return json_encode(array('apikey'=>$this->_identity,'apiId'=>$this->_apiId));
		}

		/**
		* Retrieves the credentials from the DB based on the private _identity
		*
		*/
		private function getStoredCredential() {

			if($this->dbHandle!=NULL) {
				$statement = $this->dbHandle->prepare('SELECT id,apikey,apisecret FROM apikeys WHERE apikey=:apikey LIMIT 1');
				$statement->bindParam(':apikey',$this->_identity,PDO::PARAM_STR);
				
				$statement->execute();
				$result = $statement->fetchAll(PDO::FETCH_ASSOC);
				if(count($result)==1) {
					$this->_storedSecret = $result[0]['apisecret'];
					$this->_apiId = $result[0]['id'];
				}
			}

		}
		
		/**
		* Hashes the private _credential
		* @return string
		*/
		private function hashCredential() {
			return md5($this->_credential);
		}

	}