<?php

	class AutoDirectory {
		
		public $directory = NULL;
		public $contents = array();
		
		public function getDirContents() {
			if($this->directory!==NULL) {
				if(is_dir($this->directory)) {
					$this->contents = scandir($this->directory);
				}
			}
			
			return $this->contents;
		}
		
		
	}