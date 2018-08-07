<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class Setting extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->general->checkLogin();
			$this->general->checkPerms('monitor');
			$this->load->model('m_setting');
			$this->ci =& get_instance();
			backButtonHandle();
		}
		function users_management(){
			$array_items = array('sess_search_key' => '', 'sess_search_option' => '');
			$this->session->unset_userdata($array_items);
			$data['username']	= $this->tank_auth->get_username();
			$data['active_icon_setting'] = 'class="start active"';
			$data['active_icon_setting_users_management'] = 'class="start active"';
			$config['uri_segment'] = 4;
			$config['per_page'] = $per_page = 15;
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4): 0;
			$users = $this->m_setting->get_users();
			$data['users']	= $this->m_setting->get_users_paging($per_page,$page);
			$total_rows = $users->num_rows();
			$config['total_rows'] = $total_rows;
			$this->load->library('pagination');
			$config['base_url'] = site_url('setting/users-management/page');
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['num_links'] = 3;
			
			$config['first_link'] = '<<';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			
			$config['last_link'] = '>>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			
			$config['next_link'] = '>';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			
			$config['prev_link'] = '<';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			
			$this->pagination->initialize($config); 
			$data['paging'] = $this->pagination->create_links();
			$this->template->set('title', 'Monitoring dan Evaluasi KKP');
			$this->template->load('template_admin', 'app/setting/users_management',$data);
		}
		function users_management_search(){
			$data['username']	= $this->tank_auth->get_username();
			$data['active_icon_setting'] = 'class="start active"';
			$data['active_icon_setting_users_management'] = 'class="start active"';
			$config['uri_segment'] = 4;
			$config['per_page'] = $per_page = 15;
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4): 0;
			if($this->input->post('search')){
                $data['key'] = $this->input->post('key');
                $data['option'] = $this->input->post('option');
                $this->session->set_userdata('sess_search_key', $data['key']);
                $this->session->set_userdata('sess_search_option', $data['option']);
            } else {
                $data['key'] = $this->session->userdata('sess_search_key');
                $data['option'] = $this->session->userdata('sess_search_option');
            }
			$users = $this->m_setting->get_users_search($data['key'],$data['option']);
			$data['users']	= $this->m_setting->get_users_search_paging($data['key'],$data['option'],$per_page,$page);
			$data['search'] = 'active';
			$total_rows = $users->num_rows();
			$config['total_rows'] = $total_rows;
			
			$this->load->library('pagination');
			$config['base_url'] = site_url('setting/users-management-search/page');
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['num_links'] = 3;
			
			$config['first_link'] = '<<';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			
			$config['last_link'] = '>>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			
			$config['next_link'] = '>';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			
			$config['prev_link'] = '<';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			
			$this->pagination->initialize($config); 
			$data['paging'] = $this->pagination->create_links();
			$this->template->set('title', 'Monitoring dan Evaluasi KKP');
			$this->template->load('template_admin', 'app/setting/users_management',$data);
		}
		function roles_management()
		{
			$data['username']	= $this->tank_auth->get_username();
			$data['active_icon_setting'] = 'class="start active"';
			$data['active_icon_setting_roles_management'] = 'class="start active"';
			$data['roles']=$this->m_setting->roles();
			$this->template->set('title', 'Monitoring dan Evaluasi KKP');
			$this->template->load('template_admin', 'app/setting/roles_management',$data);
		}
		function modules_management()
		{
			$data['username'] = $this->tank_auth->get_username();
			$data['active_icon_setting'] = 'class="start active"';
			$data['active_icon_setting_modules_management'] = 'class="start active"';
			$data['permissions']=$this->m_setting->get_permissions();
			$this->template->set('title', 'Monitoring dan Evaluasi KKP');
			$this->template->load('template_admin', 'app/setting/modules_management',$data);
		}
		function user_add(){
			$this->general->checkPerms('setting_user_add');
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			$use_username = $this->config->item('use_username', 'tank_auth');
			$data['use_username'] = $use_username;
			$data['option_roles'] = $this->m_setting->get_roles();
			$this->load->view('app/setting/form/modal_user_add',$data);
		}
		function reset_password($id){
			$this->general->checkPerms('setting_user_reset');
			$this->general->checkDecodeNumber($this->encrypt->decode($id));
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('delete'))
			{
				$id = $this->input->post('id');
				$data_update = array ('password' => '$P$BMUi9465ez2PNwTQPuvE3UX12VNMsM1');
				$this->m_setting->reset_password($id,$data_update);
				echo "success";	
				
			}
			else 
			{
				$data['user_id']=$id;
				$this->load->view('app/setting/form/modal_reset_password',$data);
			}
		}
		function user_edit($id=null)
		{
			$this->general->checkPerms('setting_user_edit');
			$this->general->checkDecodeNumber($this->encrypt->decode($id));
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('ubah'))
			{
				$id = $this->input->post('user_id');
				$this->form_validation->set_rules('role', 'Tingkatan Pengguna', 'required|xss_clean');
				$this->form_validation->set_rules('name', 'Nama', 'required|xss_clean');
				$this->form_validation->set_rules('instansi', 'Instansi', 'required|xss_clean');
				$this->form_validation->set_rules('status', 'Status', 'required|xss_clean');
				if ($this->form_validation->run() == FALSE) 
				{
					$data['option_roles'] = $this->m_setting->get_roles();
					$data['user']=$this->m_setting->get_user_detil($id);
					$this->load->view('app/setting/form/modal_user_edit',$data);
				} 
				else
				{
					$instansi = $this->encrypt->decode($this->input->post('instansi'));
					$data_update = array (
					'role_id' 		=> $this->input->post('role'),
					'name' 			=> $this->input->post('name'),
					'domain_id' 	=> $instansi,
					'banned' 		=> $this->input->post('status'),
					'position' 		=> $this->input->post('jabatan'),
					'phone' 		=> $this->input->post('hp')
					);
					$this->m_setting->user_edit($id,$data_update);
					echo "success";	
				}
			}
			else 
			{
				$data['option_roles'] = $this->m_setting->get_roles();
				$data['user']=$this->m_setting->get_user_detil($id);
				$this->load->view('app/setting/form/modal_user_edit',$data);
			}
		}
		function user_delete($id)
		{
			$this->general->checkPerms('setting_user_delete');
			$this->general->checkDecodeNumber($this->encrypt->decode($id));
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('delete'))
			{
				$id = $this->input->post('id');	
				$this->m_setting->user_delete($id);
				echo "success";	
				
			}
			else 
			{
				$data['user_id']=$id;
				$this->load->view('app/setting/form/modal_user_delete',$data);
			}
		}
		function role_add()
		{
			$this->general->checkPerms('setting_role_add');
			$data['username'] = $this->tank_auth->get_username();
			if($this->input->post('save'))
			{
				$this->form_validation->set_rules('role', 'Role', 'required|xss_clean');
				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('app/setting/form/modal_role_add',$data);
				}
				else
				{
					$data_insert = array (
					'role' 						=> $this->input->post('role')
					);
					$this->m_setting->role_add($data_insert);
					echo "success";	
				}
				
			}
			else 
			{
				$this->load->view('app/setting/form/modal_role_add',$data);
			}
		}
		function role_edit($id=null)
		{
			$this->general->checkPerms('setting_role_edit');
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('ubah'))
			{
				$id = $this->input->post('id');
				$this->form_validation->set_rules('role', 'Tingkatan Pengguna', 'required|xss_clean');
				if ($this->form_validation->run() == FALSE) 
				{
					$data['role']=$this->m_setting->get_role_detil($id);
					$this->load->view('app/setting/form/modal_role_edit',$data);
				} 
				else
				{
					$data_update = array (
					'role' 		=> $this->input->post('role')
					);
					$this->m_setting->role_edit($id,$data_update);
					echo "success";	
				}
			}
			else 
			{
				$data['role']=$this->m_setting->get_role_detil($id);
				$this->load->view('app/setting/form/modal_role_edit',$data);
			}
		}
		function module_add()
		{
			$this->general->checkPerms('setting_module_add');
			$data['username'] = $this->tank_auth->get_username();
			if($this->input->post('save'))
			{
				$this->form_validation->set_rules('key', 'kata kunci', 'required|xss_clean');
				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('app/setting/form/modal_module_add',$data);
				}
				else
				{
					$data_insert = array (
					'key' 			=> $this->input->post('key'),
					'type'			=> $this->input->post('type')
					);
					$this->m_setting->module_add($data_insert);
					echo "success";	
				}
				
			}
			else 
			{
				$this->load->view('app/setting/form/modal_module_add',$data);
			}
		}
		function module_delete($id)
		{
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('delete'))
			{
				$id_decode = $this->encrypt->decode($this->input->post('id'));
				$this->m_setting->module_delete($id_decode);
				echo "success";	
				
			}
			else 
			{
				$data['id']=$id;
				$this->load->view('app/setting/form/modal_module_delete',$data);
			}
		}
		function acl()
		{
			$data['username']	= $this->tank_auth->get_username();
			$data['active_icon_setting'] = 'class="start active"';
			$data['active_icon_setting_rac'] = 'class="start active"';
			$data['roles']=$this->m_setting->roles();
			$this->template->set('title', 'Monitoring dan Evaluasi KKP');
			$this->template->load('template_admin', 'app/setting/acl',$data);
		}
		function acl_detil($id_encode)
		{
			$data['username']	= $this->tank_auth->get_username();
			$data['active_icon_setting'] = 'class="start active"';
			$data['active_icon_setting_rac'] = 'class="start active"';
			$data['acl_detil']=$this->m_setting->get_acl_detil($id_encode);
			$this->template->set('title', 'Monitoring dan Evaluasi KKP');
			$this->template->load('template_admin', 'app/setting/acl_detil',$data);
		}
		function acl_edit($role_id,$id_encode)
		{
			$this->general->checkDecodeNumber($this->encrypt->decode($role_id));
			$this->general->checkDecodeNumber($this->encrypt->decode($id_encode));
			$this->general->checkPerms('setting_acl');
			$role_decode = $this->encrypt->decode($role_id);
			$this->m_setting->acl_edit($id_encode);
			redirect('setting/acl-detil/'.$role_id.'');
			
		}
	}
	
	/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */				