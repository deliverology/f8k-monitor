<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class Checkpoint extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			backButtonHandle();
			$this->general->checkLogin();
			$this->general->checkPerms('monitor');
			$this->load->model('m_checkpoint');
			if (!$this->tank_auth->is_logged_in()) redirect('/auth/login/');
		}
		
		function checkpoint_management()
		{
			$array_items = array('sess_search_key' => '', 'sess_search_option' => '');
			$this->session->unset_userdata($array_items);
			$data['username']	= $this->tank_auth->get_username();
			$data['active_icon_mc'] = 'class="start active"';
			$config['uri_segment'] = 4;
			$config['per_page'] = $per_page = 15;
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4): 0;
			$monitor = $this->m_checkpoint->get_monitor_checkpoint();
			$data['monitor'] = $this->m_checkpoint->get_monitor_checkpoint_paging($per_page,$page);
			$total_rows = $monitor->num_rows();
			$config['total_rows'] = $total_rows;
			$this->load->library('pagination');
			$config['base_url'] = site_url('checkpoint/checkpoint-management/page');
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
			$this->template->load('template_admin', 'app/checkpoint/checkpoint_management',$data);
		}
		function checkpoint_management_search()
		{
			$data['username']	= $this->tank_auth->get_username();
			$data['active_icon_mc'] = 'class="start active"';
			$config['uri_segment'] = 4;
			$config['per_page'] = $per_page = 1;
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
			$monitor = $this->m_checkpoint->get_monitor_checkpoint_search($data['key'],$data['option']);
			$data['monitor'] = $this->m_checkpoint->get_monitor_checkpoint_search_paging($data['key'],$data['option'],$per_page,$page);
			$total_rows = $monitor->num_rows();
			$config['total_rows'] = $total_rows;
			$this->load->library('pagination');
			$config['base_url'] = site_url('checkpoint/checkpoint-management-search/page');
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
			$this->template->load('template_admin', 'app/checkpoint/checkpoint_management',$data);
		}
		function monitor_status($monitor_id_encode = 0)
		{
			$this->general->checkPerms('mc_monitor_status');
			$this->general->checkDecodeNumber($this->encrypt->decode($monitor_id_encode));
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('ubah'))
			{
				$monitor_id_encode = $monitor_id_encode;
				$this->form_validation->set_rules('status', 'Status', 'required|xss_clean');
				if ($this->form_validation->run() == FALSE) 
				{
					$data['monitor_id_encode'] = $monitor_id_encode;
					$data['status'] = $this->m_checkpoint->get_monitor_status($monitor_id_encode);
					$this->load->view('app/checkpoint/form/modal_monitor_status',$data);
				} 
				else
				{
					$data_update = array (
					'status' 		=> $this->input->post('status')
					);
					$this->m_checkpoint->monitor_status_edit($monitor_id_encode,$data_update);
					echo "success";	
				}
			}
			else 
			{
				$data['monitor_id_encode'] = $monitor_id_encode;
				$data['status'] = $this->m_checkpoint->get_monitor_status($monitor_id_encode);
				$this->load->view('app/checkpoint/form/modal_monitor_status',$data);
			}
		}
		function checkpoint_status($checkpoint_id_encode = 0)
		{
			$this->general->checkPerms('mc_checkpoint_status');
			$this->general->checkDecodeNumber($this->encrypt->decode($checkpoint_id_encode));
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('ubah'))
			{
				$checkpoint_id_encode = $checkpoint_id_encode;
				$this->form_validation->set_rules('status', 'Status', 'required|xss_clean');
				if ($this->form_validation->run() == FALSE) 
				{
					$data['checkpoint_id_encode'] = $checkpoint_id_encode;
					$data['status'] = $this->m_checkpoint->get_checkpoint_status($checkpoint_id_encode);
					$this->load->view('app/checkpoint/form/modal_checkpoint_status',$data);
				} 
				else
				{
					$data_update = array (
					'status' 		=> $this->input->post('status')
					);
					$this->m_checkpoint->checkpoint_status_edit($checkpoint_id_encode,$data_update);
					echo "success";	
				}
			}
			else 
			{
				$data['checkpoint_id_encode'] = $checkpoint_id_encode;
				$data['status'] = $this->m_checkpoint->get_checkpoint_status($checkpoint_id_encode);
				$this->load->view('app/checkpoint/form/modal_checkpoint_status',$data);
			}
		}
		function checkpoint_list($monitor_id_encode)
		{
			$data['username']	= $this->tank_auth->get_username();
			$data['active_icon_mc'] = 'class="start active"';
			$data['monitor_id_encode'] = $monitor_id_encode;
			$data['monitor_name'] = $this->m_checkpoint->get_monitor_name($monitor_id_encode);
			$data['checkpoint_list'] = $this->m_checkpoint->get_checkpoint_list($monitor_id_encode);
			$this->template->set('title', 'Monitoring dan Evaluasi KKP');
			$this->template->load('template_admin', 'app/checkpoint/checkpoint_list',$data);
		}
		function checkpoint_delete($checkpoint_id_encode)
		{
			$this->general->checkPerms('mc_checkpoint_delete');
			$this->general->checkDecodeNumber($this->encrypt->decode($checkpoint_id_encode));
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('delete'))
			{
				$checkpoint_id_encode = $checkpoint_id_encode;	
				$data_update = array (
					'is_active' 		=> $this->input->post('status')
				);
				$this->m_checkpoint->checkpoint_delete($checkpoint_id_encode,$data_update);
				echo "success";	
				
			}
			else 
			{
				$data['checkpoint_id_encode']=$checkpoint_id_encode;
				$this->load->view('app/checkpoint/form/modal_checkpoint_delete',$data);
			}
		}
		function checkpoint_add($monitor_id_encode = 0) {
			$this->general->checkPerms('mc_checkpoint_add');
			$this->general->checkDecodeNumber($this->encrypt->decode($monitor_id_encode));
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('tambah'))
			{
				$monitor_id_encode = $monitor_id_encode;
				$this->form_validation->set_rules('year', 'Tahun', 'required|xss_clean|numeric');
				$this->form_validation->set_rules('month', 'Bulan', 'required|xss_clean');
				$this->form_validation->set_rules('date_open', 'Pembukaan Periode Pelaporan', 'required|xss_clean');
				$this->form_validation->set_rules('date_close', 'Penutupan Periode Pelaporan', 'required|xss_clean');
				if ($this->form_validation->run() == FALSE) 
				{
					$data['monitor_id_encode'] = $monitor_id_encode;
					$this->load->view('app/checkpoint/form/modal_checkpoint_add',$data);
				} 
				else 
				{
					if($this->input->post('week') == 0) $week = null;
					else $week = $this->input->post('week');
					$monitor_id_decode = $this->encrypt->decode($monitor_id_encode);
					$data_insert = array (
					'monitor_id' 	=> $monitor_id_decode,
					'year' 			=> date('y',strtotime('01-01-'.$this->input->post('year'))),
					'month' 		=> $this->input->post('month'),
					'week'			=> $week,
					'date_open' 	=> date('Y-m-d',strtotime($this->input->post('date_open'))),
					'date_close' 	=> date('Y-m-d',strtotime($this->input->post('date_close'))),
					'status'	 	=> 1
					);
					$this->m_checkpoint->checkpoint_add($data_insert);
					echo 'success';
				}
			}
			else 
			{
				$data['monitor_id_encode'] = $monitor_id_encode;
				$this->load->view('app/checkpoint/form/modal_checkpoint_add',$data);
			}
		}
		function checkpoint_edit($checkpoint_id_encode = 0)
		{
			$this->general->checkPerms('mc_checkpoint_edit');
			$this->general->checkDecodeNumber($this->encrypt->decode($checkpoint_id_encode));
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('ubah'))
			{
				$checkpoint_id_encode = $checkpoint_id_encode;
				$this->form_validation->set_rules('year', 'Tahun', 'required|xss_clean|numeric');
				$this->form_validation->set_rules('month', 'Bulan', 'required|xss_clean');
				$this->form_validation->set_rules('date_open', 'Pembukaan Periode Pelaporan', 'required|xss_clean');
				$this->form_validation->set_rules('date_close', 'Penutupan Periode Pelaporan', 'required|xss_clean');
				if ($this->form_validation->run() == FALSE) 
				{
					$data['checkpoint_id_encode'] = $checkpoint_id_encode;
					$data['checkpoint'] = $this->m_checkpoint->get_checkpoint_detil($checkpoint_id_encode);
					$this->load->view('app/checkpoint/form/modal_checkpoint_edit',$data);
				} 
				else
				{
					if($this->input->post('week') == 0) $week = null;
					else $week = $this->input->post('week');
					$data_update = array (
					'year' 			=> date('y',strtotime('01-01-'.$this->input->post('year'))),
					'month' 		=> $this->input->post('month'),
					'week'			=> $week,
					'date_open' 	=> date('Y-m-d',strtotime($this->input->post('date_open'))),
					'date_close' 	=> date('Y-m-d',strtotime($this->input->post('date_close'))),
					'status'	 	=> 1
					);
					$this->m_checkpoint->checkpoint_edit($checkpoint_id_encode,$data_update);
					echo "success";	
				}
			}
			else 
			{
				$data['checkpoint_id_encode'] = $checkpoint_id_encode;
				$data['checkpoint'] = $this->m_checkpoint->get_checkpoint_detil($checkpoint_id_encode);
				$this->load->view('app/checkpoint/form/modal_checkpoint_edit',$data);
			}
		}
		function json_monitor()
		{
			$search = $this->input->get('q');	
			$monitor = $this->m_checkpoint->get_monitor($search);
			print json_encode($monitor);
		}
		function json_monitor_prepopulate($monitor)
		{
			$domains_prepopulate = $this->m_checkpoint->get_domains_prepopulate($monitor);
			print json_encode($domains_prepopulate);
		}
	}
	
	/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */			