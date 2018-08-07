<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	//PATCHES 404_override issues with autoloading libraries, see 3 lines below
	
	class MY_Router extends CI_Router {
		
		
		public function set_class($class) 
		{
			parent::set_class($this->_repl($class));
		}
		
		public function set_method($method) 
		{
			parent::set_method($this->_repl($method));
		}
		
		public function _validate_request($segments)
		{
			if (isset($segments[0]))
            $segments[0] = $this->_repl($segments[0]);
			if (isset($segments[1]))
            $segments[1] = $this->_repl($segments[1]);
			if (isset($segments[2]))
            $segments[2] = $this->_repl($segments[2]);	
			
			return parent::_validate_request($segments);
		}
		
		private function _repl($s)
		{
			return str_replace('-', '_', $s);
		}
		
		
	} 	