<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class Domains extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			backButtonHandle();
			$this->general->checkLogin();
			$this->general->checkPerms('monitor');
			$this->load->model('m_monitor');
			$this->load->model('m_domains');
			if (!$this->tank_auth->is_logged_in()) redirect('/auth/login/');
		}
		
		function json_domains()
		{
			$search = $this->input->get('q');	
			$domains = $this->m_monitor->get_domains($search);
			print json_encode($domains);
		}
		function json_domains_prepopulate($domains)
		{
			$domains_prepopulate = $this->m_monitor->get_domains_prepopulate($domains);
			print json_encode($domains_prepopulate);
		}
		function domains_management()
		{
			$array_items = array('sess_search_key' => '', 'sess_search_option' => '');
			$this->session->unset_userdata($array_items);
			$data['username']	= $this->tank_auth->get_username();
			$data['active_icon_unit'] = 'class="start active"';
			$config['uri_segment'] = 4;
			$config['per_page'] = $per_page = 15;
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4): 0;
			$domains = $this->m_domains->get_domains();
			$data['domains'] = $this->m_domains->get_domains_paging($per_page,$page);
			$total_rows = $domains->num_rows();
			$config['total_rows'] = $total_rows;
			$this->load->library('pagination');
			$config['base_url'] = site_url('domains/domains-management/page');
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
			$this->template->load('template_admin', 'app/domains/domains_management',$data);
		}
		function domains_management_search()
		{
			$data['username']	= $this->tank_auth->get_username();
			$data['active_icon_unit'] = 'class="start active"';
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
			$data['search'] = 'active';
			$domains = $this->m_domains->get_domains_search($data['key'],$data['option']);
			$data['domains'] = $this->m_domains->get_domains_search_paging($data['key'],$data['option'],$per_page,$page);
			$total_rows = $domains->num_rows();
			$config['total_rows'] = $total_rows;
			$this->load->library('pagination');
			$config['base_url'] = site_url('domains/domains-management-search/page');
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
			$this->template->load('template_admin', 'app/domains/domains_management',$data);
		}
		function domain_delete($domain_id_encode=null)
		{
			//$this->general->checkDecodeNumber($this->encrypt->decode($domain_id_encode));
			$this->general->checkPerms('domains_delete');
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('delete'))
			{
				$domain_id_encode = $this->input->post('domain_id_encode');			
				$data_update = array (
				'is_active'	=> 0
				);
				$this->m_domains->domain_delete($domain_id_encode,$data_update);
				echo "success";	
				
			}
			else 
			{
				$data['domain_id_encode']=$domain_id_encode;
				$this->load->view('app/domains/form/modal_domains_delete',$data);
			}
		}
		function domain_view($domain_id_encode = 0)
		{
			$data['domain'] = $this->m_domains->get_domain_detil($domain_id_encode);
			$this->load->view('app/domains/form/modal_domains_view',$data);
		}
		function domain_edit($domain_id_encode=null)
		{
			
			$this->general->checkDecodeNumber($this->encrypt->decode($domain_id_encode));
			$this->general->checkPerms('domains_edit');
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('ubah'))
			{
				$domain_id_encode = $domain_id_encode;
				$this->form_validation->set_rules('name', 'Instansi / Unit Kerja', 'required|xss_clean');
				$this->form_validation->set_rules('instansi_induk', 'Instansi / Unit Kerja Induk', 'required|xss_clean');
				$this->form_validation->set_rules('type', 'Tingkatan', 'required|xss_clean');
				$this->form_validation->set_rules('status', 'Status Instansi / Unit Kerja', 'required|xss_clean');
				if ($this->form_validation->run() == FALSE) 
				{
					$data['option_type'] = $this->m_domains->option_domain_type();
					$data['domain']=$this->m_domains->get_domain_detil($domain_id_encode);
					$this->load->view('app/domains/form/modal_domains_edit',$data);
				} 
				else
				{
					$parent_id = $this->encrypt->decode($this->input->post('instansi_induk'));
					$data_update = array (
					'parent_id' 		=> $parent_id,
					'name' 				=> $this->input->post('name'),
					'domains_type_id' 	=> $this->input->post('type'),
					'name_alias' 		=> $this->input->post('alias'),
					'verified' 			=> $this->input->post('status')
					);
					$this->m_domains->domain_edit($domain_id_encode,$data_update);
					echo "success";	
				}
			}
			else 
			{
				$data['option_type'] = $this->m_domains->option_domain_type();
				$data['domain']=$this->m_domains->get_domain_detil($domain_id_encode);
				$this->load->view('app/domains/form/modal_domains_edit',$data);
			}
		}
		function domain_add() {
			$this->general->checkPerms('domains_add');
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('tambah'))
			{
				$this->form_validation->set_rules('name', 'Instansi / Unit Kerja', 'required|xss_clean');
				$this->form_validation->set_rules('parent_id', 'Instansi / Unit Kerja Induk', 'required|xss_clean');
				$this->form_validation->set_rules('type', 'Tingkatan', 'required|xss_clean');
				$this->form_validation->set_rules('status', 'Status', 'required|xss_clean');
				if ($this->form_validation->run() == FALSE) 
				{
					$data['option_type'] = $this->m_domains->option_domain_type();
					$this->load->view('app/domains/form/modal_domains_add',$data);
				} 
				else 
				{
					$parent_id_decode = $this->encrypt->decode($this->input->post('parent_id'));
					
					$data_insert = array (
					'parent_id' 		=> $parent_id_decode,
					'name' 				=> $this->input->post('name'),
					'name_alias' 		=> $this->input->post('name_alias'),
					'domains_type_id'	=> $this->input->post('type'),
					'verified' 			=> $this->input->post('status')
					);
					
					$this->m_domains->domain_add($data_insert);
					echo 'success';
				}
			}
			else 
			{
				$data['option_type'] = $this->m_domains->option_domain_type();
				$this->load->view('app/domains/form/modal_domains_add',$data);
			}
		}
	}
	
	/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */			