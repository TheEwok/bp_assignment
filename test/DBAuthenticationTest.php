<?php

	class DBAuthenticationTest extends PHPUnit_Framework_TestCase {

		protected $_authenticate;

		public function setUp() {
			$this->_authenticate = new Authenticate();
			$this->_authenticate->session = new Test_Session();

			$authenticator = Authenticate_Factory::factory('Db');
			$authenticator->dbHandle = new PDO("mysql:host=localhost;dbname=beatport", 'root', '');

			$this->_authenticate->authenticator = $authenticator;

		}

		public function tearDown() {
			unset($this->_authenticate);
		}

		/**
		* @expectedException InvalidArgumentException
		*/
		public function testShouldThrowInvalidAuthenticatorException() {
			$this->_authenticate->doAuthenticate();
		}

		public function testShouldReturnFalseForInvalidIdentity() {
			$this->_authenticate->authenticator->setIdentity('nonexistantIdentity');
			$this->_authenticate->authenticator->setCredential('blue');

			$this->assertFalse($this->_authenticate->doAuthenticate());
		}

		public function testShouldReturnFalseForInvalidCredential() {
			$this->_authenticate->authenticator->setIdentity('72b302bf297a228a75730123efef7c41');
			$this->_authenticate->authenticator->setCredential('incorrectPassword');

			$this->assertFalse($this->_authenticate->doAuthenticate());
		}

		public function testShouldReturnTrueForValidIdentityAndCredential() {
			$this->_authenticate->authenticator->setIdentity('72b302bf297a228a75730123efef7c41');
			$this->_authenticate->authenticator->setCredential('blue');

			$this->assertTrue($this->_authenticate->doAuthenticate());
		}

		public function testShouldReturnTrueForLoggedInUser() {
			$this->_authenticate->authenticator->setIdentity('72b302bf297a228a75730123efef7c41');
			$this->_authenticate->authenticator->setCredential('blue');

			$authResult = $this->_authenticate->doAuthenticate();

			$this->assertTrue($this->_authenticate->isAuthenticated());
		}

		public function testShouldReturnArrayFromSession() {
			$this->_authenticate->authenticator->setIdentity('72b302bf297a228a75730123efef7c41');
			$this->_authenticate->authenticator->setCredential('blue');

			$authResult = $this->_authenticate->doAuthenticate();

			$this->assertTrue(is_string($this->_authenticate->session->get('userinfo')));
		}

		public function testShouldReturnTrueFromSession() {
			$this->_authenticate->authenticator->setIdentity('72b302bf297a228a75730123efef7c41');
			$this->_authenticate->authenticator->setCredential('blue');

			$authResult = $this->_authenticate->doAuthenticate();

			$this->assertTrue($this->_authenticate->session->get('authenticated'));
		}

		public function testShouldReturnTrueOnLogout() {
			$this->_authenticate->authenticator->setIdentity('72b302bf297a228a75730123efef7c41');
			$this->_authenticate->authenticator->setCredential('blue');

			$authResult = $this->_authenticate->doAuthenticate();

			$this->assertTrue($this->_authenticate->deauthenticate());
		}

		public function testShouldReturnNullUserInfoFromSessionAfterLogout()  {
			$this->_authenticate->authenticator->setIdentity('72b302bf297a228a75730123efef7c41');
			$this->_authenticate->authenticator->setCredential('blue');

			$authResult = $this->_authenticate->doAuthenticate();
			$deauthResult = $this->_authenticate->deauthenticate();

			$this->assertNull($this->_authenticate->session->get('userinfo'));
		}

		public function testShouldReturnNullAuthenticatedFromSessionAfterLogout()  {
			$this->_authenticate->authenticator->setIdentity('72b302bf297a228a75730123efef7c41');
			$this->_authenticate->authenticator->setCredential('blue');

			$authResult = $this->_authenticate->doAuthenticate();
			$deauthResult = $this->_authenticate->deauthenticate();

			$this->assertNull($this->_authenticate->session->get('authenticated'));
		}
	}