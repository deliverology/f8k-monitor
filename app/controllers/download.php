<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class Download extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			backButtonHandle();	
			if (!$this->tank_auth->is_logged_in()) redirect('/auth/login/');
		}
		function files($file){
			$file_path = 'files/'.$file;
			header('Content-Type: application/octet-stream');
			header("Content-Disposition: attachment; filename=$file");
			ob_clean();
			flush();
			readfile($file_path);
		}
	}
	
	/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */				