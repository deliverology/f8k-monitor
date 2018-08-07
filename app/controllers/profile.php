<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class Profile extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->general->checkLogin();
			$this->general->checkPerms('monitor');
			$this->load->model('m_profile');
			$this->ci =& get_instance();
			backButtonHandle();
		}
		function index(){
			$data['username'] = $this->tank_auth->get_username();
			$data['active_icon_profile'] = 'class="last active"';
			$data['profile'] = $this->m_profile->get_profile();
			$this->template->set('title', 'Monitoring dan Evaluasi KKP');
			$this->template->load('template_admin', 'app/profile/profile',$data);
		}
		function change_email()
		{
			$this->general->checkPerms('profile_change_email');
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('ubah'))
			{
				$this->form_validation->set_rules('email', 'Alamat Email', 'required|xss_clean');
				if ($this->form_validation->run() == FALSE || ($this->tank_auth->check_email($this->input->post('email')) != 1)) 
				{
					$data['error'] = "error";
					$this->load->view('app/profile/form/modal_change_email',$data);
				} 
				else
				{
					$user_id = $this->tank_auth->get_user_id();
					$data_update = array (
					'email' 	=> $this->input->post('email')
					);
					$this->m_profile->change_email($user_id,$data_update);
					echo "success";	
				}
			}
			else 
			{
				$this->load->view('app/profile/form/modal_change_email');
			}
		}
		function edit()
		{
			$this->general->checkPerms('profile_change_data');
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			$data['profile'] = $this->m_profile->get_profile();
			if ($this->input->post('ubah'))
			{
				$this->form_validation->set_rules('name', 'Nama', 'required|xss_clean');
				if ($this->form_validation->run() == FALSE || ($this->tank_auth->check_email($this->input->post('email')) != 1)) 
				{
					$data['error'] = "error";
					$this->load->view('app/profile/form/modal_edit_data',$data);
				} 
				else
				{
					$user_id = $this->tank_auth->get_user_id();
					$data_update = array (
					'name' 		=> $this->input->post('name'),
					'position' 	=> $this->input->post('position'),
					'phone' 	=> $this->input->post('phone')
					);
					$this->m_profile->edit_data($user_id,$data_update);
					echo "success";	
				}
			}
			else 
			{
				$this->load->view('app/profile/form/modal_edit_data',$data);
			}
		}
	}
	
	/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */				