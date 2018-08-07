<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class Monitor_anggaran extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			backButtonHandle();
			if (!$this->tank_auth->is_logged_in()) redirect('/auth/login/');
		}
		
		function index()
		{
			$data['username'] = $this->tank_auth->get_username();
			$data['active_icon_monitor'] = 'class="start active"';
			$this->template->set('title', 'Monitor | Monev KKP');
			$this->template->load('template_admin', 'app/adm_panel/monitor',$data);
		}
		function add_monitor()
		{
			$this->load->model('adm_panel/m_monitor');
			$data['js'] = 'FormValidation.init();';
			$data['username'] = $this->tank_auth->get_username();
			$data['active_icon_monitor'] = 'class="start active"';
			$data['monitor_type'] = $this->m_monitor->get_monitor_type();
			$this->template->set('title', 'Monitor | Monev KKP');
			$this->template->load('template_admin', 'app/adm_panel/add_monitor',$data);
		}
		function view_monitor(){
			$data['username'] = $this->tank_auth->get_username();
			$data['active_icon_monitor'] = 'class="start active"';		
			$this->template->set('title', 'Monitor | Monev KKP');
			$this->template->load('template_admin', 'app/adm_panel/view_monitor',$data);
		}
	}
	
	/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */			