<?php
	/**
	* AutoDirectory
	* Autoloaded Directory Listing
	*
	* @author Barry O'Mahony <the.ewok@gmail.com>
	* @version 1.0
	* @package Beatport Homework
	*/

	/**
	* AutoDirectory
	* Autoloaded Directory Listing
	*
	* @author Barry O'Mahony <the.ewok@gmail.com>
	* @version 1.0
	* @package Beatport Homework
	* @subpackage classes
	*/
	class AutoDirectory {
	
		/**
		* Directory to scan
		* @access public
		* @var string
		*/
		public $directory = NULL;
		
		/**
		* Scan results
		* @access public
		* @var array
		*/
		public $contents = array();
		
		/**
		* Get the directory contents
		* @access public
		* @return array
		*/
		public function getDirContents() {
			if($this->directory!==NULL) {
				if(is_dir($this->directory)) {
					$this->contents = scandir($this->directory);
				}
			}
			
			return $this->contents;
		}
		
		
	}