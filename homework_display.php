<?php

	function db_auth() {
		
		ob_start();
		
		$authenticator = Authenticate_Factory::factory('Db');
		$authenticator->setIdentity('72b302bf297a228a75730123efef7c41');
		$authenticator->setCredential('blue');
	
		//inject DB handle to DB authenticator
		$authenticator->dbHandle = new PDO("mysql:host=localhost;dbname=beatport", 'root', '');
	
		$authObj = new Authenticate();
		//Inject Authenticator
		$authObj->authenticator = $authenticator;
		//Inject Session
		$authObj->session = new Session();
	
		echo "Authenticating <br />";
		var_dump($authObj->doAuthenticate());
		echo "Checking session vars <br />";
		var_dump($authObj->session->get('userinfo'));
		var_dump($authObj->session->get('authenticated'));
		echo "Checking authObject for authentication <br />";
		var_dump($authObj->isAuthenticated());
		echo "Logging out <br />";
		var_dump($authObj->deauthenticate());
		echo "Checking authObject for authentication <br />";
		var_dump($authObj->isAuthenticated());
		echo "Checking session vars <br />";
		var_dump($authObj->session->get('userinfo'));
		var_dump($authObj->session->get('authenticated'));
		
		return ob_get_clean();
	}
	
	function file_auth() {
		
		ob_start();
		$authObj = new Authenticate();
		
		$authenticator = Authenticate_Factory::factory('File');
		$authenticator->setIdentity('ewok');
		$authenticator->setCredential('password');
		
		//Inject authenticator
		$authObj->authenticator = $authenticator;
		//Inject Session
		$authObj->session = new Session();
		
		echo "Authenticating <br />";
		var_dump($authObj->doAuthenticate());
		echo "Checking session vars <br />";
		var_dump($authObj->session->get('userinfo'));
		var_dump($authObj->session->get('authenticated'));
		echo "Checking authObject for authentication <br />";
		var_dump($authObj->isAuthenticated());
		echo "Logging out <br />";
		var_dump($authObj->deauthenticate());
		echo "Checking authObject for authentication <br />";
		var_dump($authObj->isAuthenticated());
		echo "Checking session vars <br />";
		var_dump($authObj->session->get('userinfo'));
		var_dump($authObj->session->get('authenticated'));
		
		return ob_get_clean();
		
		
	}
	
	function directory_contents() {
		ob_start();
		
		$dirScanner = new AutoDirectory();
		$dirScanner->directory = '/Users/baz/webdev/dev/bp/';
		var_dump($dirScanner->getDirContents());
		
		return ob_get_clean();
	}