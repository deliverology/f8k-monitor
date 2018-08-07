<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class Monitor extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->general->checkLogin();
			$this->general->checkPerms('monitor');
			$this->load->model('m_monitor');
			$this->ci =& get_instance();
			backButtonHandle();
		}
		function index()
		{
			if($this->acl->hasRole(1)||$this->acl->hasRole(2)||$this->acl->hasRole(3)||$this->acl->hasRole(4)||$this->acl->hasRole(8))
			{
				$data['username'] = $this->tank_auth->get_username();
				$data['active_icon_monitor'] = 'class="start active"';
				$data['list_monitor'] = $this->m_monitor->get_monitor_verifikator();
				$data['arsip'] = $this->m_monitor->get_monitor_arsip();
				$data['instansi_koordinasi'] = $this->m_monitor->get_monitor_koordinasi();
				$this->template->set('title', 'Monitoring dan Evaluasi KKP');
				$this->template->load('template_admin', 'app/monitor/monitor',$data);
			}
			elseif ($this->tank_auth->has_role(5))
			{
				$user_domain = $this->acl->getUserDomains();
				redirect('monitor/monitor-unit/'.$this->encrypt->encode($user_domain).'');
			}
			elseif ($this->tank_auth->has_role(6))
			{
				
			}
			elseif($this->tank_auth->has_role(7))
			{
				$data['username'] = $this->tank_auth->get_username();
				$data['active_icon_monitor'] = 'class="start active"';
				$data['list_monitor'] = $this->m_monitor->get_monitor_observer();
				$data['arsip'] = $this->m_monitor->get_monitor_arsip_observer();
				$data['instansi_koordinasi'] = $this->m_monitor->get_monitor_koordinasi_observer();
				$this->template->set('title', 'Monitoring dan Evaluasi KKP');
				$this->template->load('template_admin', 'app/monitor/monitor',$data);
			}
			
		}
		function monitor_unit($id_encode)
		{
			$this->general->checkDecodeNumber($this->encrypt->decode($id_encode));
			$data['username'] = $this->tank_auth->get_username();
			$data['active_icon_monitor'] = 'class="start active"';
			$data['domain'] = $this->m_monitor->get_monitor_domain($id_encode);
			$data['list_monitor'] = $this->m_monitor->get_monitor_unit($id_encode);
			$data['arsip'] = $this->m_monitor->get_monitor_arsip_unit($id_encode);
			$this->template->set('title', 'Monitoring dan Evaluasi KKP');
			$this->template->load('template_admin', 'app/monitor/monitor_unit',$data);
		}
		function monitor_add() 
		{
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			$data['monitor_type'] = $this->m_monitor->get_monitor_type();
			if ($this->input->post('tambah'))
			{
				$this->form_validation->set_rules('name', 'Nama Monitor', 'required|xss_clean');
				$this->form_validation->set_rules('name_code', 'Kode Monitor', 'required|xss_clean');
				$this->form_validation->set_rules('monitor_type', 'Jenis Monitor', 'required|xss_clean');
				$this->form_validation->set_rules('verifikator', 'Verifikator', 'required|xss_clean');
				if ($this->form_validation->run() == FALSE) 
				{
					$this->load->view('app/monitor/form/modal_monitor_add',$data);
				} 
				else 
				{
					
					$verifikator = explode(',',$this->input->post('verifikator'));							
					$verifikator_arr = Array();
					foreach($verifikator as $verifikator_row)
					{array_push($verifikator_arr,$this->encrypt->decode($verifikator_row));}
					
					$observer = explode(',',$this->input->post('observer'));							
					$observer_arr = Array();
					foreach($observer as $observer_row)
					{array_push($observer_arr,$this->encrypt->decode($observer_row));}
					
					sort($verifikator_arr);
					sort($observer_arr);
					$data_insert = array (
					'name' 						=> $this->input->post('name'),
					'name_code' 				=> $this->input->post('name_code'),
					'monitor_type_id' 			=> $this->input->post('monitor_type'),
					'verifikator_domains_id' 	=> implode(',',$verifikator_arr),
					'observer_domains_id' 		=> implode(',',$observer_arr)
					);
					
					$this->m_monitor->monitor_add($data_insert);
					echo 'success';
				}
			}
			else $this->load->view('app/monitor/form/modal_monitor_add',$data);
		}
		function monitor_edit($id=null)
		{
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('ubah'))
			{
				$id = $this->input->post('id');
				$this->form_validation->set_rules('name', 'Nama Monitor', 'required|xss_clean');
				$this->form_validation->set_rules('name_code', 'Kode Monitor', 'required|xss_clean');
				$this->form_validation->set_rules('monitor_type', 'Jenis Monitor', 'required|xss_clean');
				$this->form_validation->set_rules('verifikator', 'Verifikator', 'required|xss_clean');
				if ($this->form_validation->run() == FALSE) 
				{
					$data['monitor_type'] = $this->m_monitor->get_monitor_type();
					$data['monitor']=$this->m_monitor->get_monitor_detil($id);
					$this->load->view('app/monitor/form/modal_monitor_edit',$data);
				} 
				else
				{
					$verifikator = explode(',',$this->input->post('verifikator'));							
					$verifikator_arr = Array();
					foreach($verifikator as $verifikator_row)
					{array_push($verifikator_arr,$this->encrypt->decode($verifikator_row));}
					
					$observer = explode(',',$this->input->post('observer'));							
					$observer_arr = Array();
					foreach($observer as $observer_row)
					{array_push($observer_arr,$this->encrypt->decode($observer_row));}
					
					sort($verifikator_arr);
					sort($observer_arr);
					$data_update = array (
					'name' 						=> $this->input->post('name'),
					'name_code' 				=> $this->input->post('name_code'),
					'monitor_type_id' 			=> $this->input->post('monitor_type'),
					'verifikator_domains_id' 	=> implode(',',$verifikator_arr),
					'observer_domains_id' 		=> implode(',',$observer_arr)
					);
					$this->m_monitor->monitor_edit($id,$data_update);
					echo "success";	
				}
			}
			else 
			{
				$data['monitor_type'] = $this->m_monitor->get_monitor_type();
				$data['monitor']=$this->m_monitor->get_monitor_detil($id);
				$this->load->view('app/monitor/form/modal_monitor_edit',$data);
			}
		}
		function monitor_delete($id=null)
		{
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('delete'))
			{
				$id = $this->input->post('id');			
				$data_update = array (
				'is_active'	=> 0
				);
				$this->m_monitor->monitor_delete($id,$data_update);
				echo "success";	
				
			}
			else 
			{
				$data['monitor']=$id;
				$this->load->view('app/monitor/form/modal_monitor_delete',$data);
			}
		}
		function monitor_view($id_encode)
		{
			$this->general->checkDecodeNumber($this->encrypt->decode($id_encode));
			$data['username']	= $this->tank_auth->get_username();
			$data['active_icon_monitor'] = 'class="start active"';
			$data['monitor'] = $this->m_monitor->get_monitor_detil($id_encode);
			$data['monitor_jmlh_anggaran'] = $this->m_monitor->get_monitor_jmlh_anggaran($id_encode);
			$data['jmlh_prioritas'] = $this->m_monitor->get_jmlh_prioritas($id_encode);
			$data['jmlh_program'] = $this->m_monitor->get_jmlh_program($id_encode);
			$data['jmlh_renaksi'] = $this->m_monitor->get_jmlh_renaksi($id_encode);
			$data['jmlh_subrenaksi'] = $this->m_monitor->get_jmlh_subrenaksi($id_encode);
			$data['statistik'] = $this->m_monitor->get_monitor_statistik_all($id_encode);
			$data['instansi_koordinasi'] = $this->m_monitor->get_monitor_instansi_koordinasi($id_encode);
			$this->template->set('title', 'Monitoring dan Evaluasi KKP');
			$this->template->load('template_admin', 'app/monitor/monitor_view',$data);
		}
		function single_monitor_view_unit($id_encode,$penanggung_jawab_encode)
		{
			$this->general->checkDecodeNumber($this->encrypt->decode($id_encode));
			$this->general->checkDecodeNumber($this->encrypt->decode($penanggung_jawab_encode));
			$data['username']	= $this->tank_auth->get_username();
			$data['active_icon_monitor'] = 'class="start active"';
			$data['monitor'] = $this->m_monitor->get_monitor_detil($id_encode);
			$data['domain'] = $this->m_monitor->get_monitor_domain($penanggung_jawab_encode);
			$data['statistik'] = $this->m_monitor->get_single_monitor_statistik($id_encode,$penanggung_jawab_encode);
			$data['renaksi'] = $this->m_monitor->get_renaksi_domain($id_encode,$penanggung_jawab_encode);
			$this->template->set('title', 'Monitoring dan Evaluasi KKP');
			$this->template->load('template_admin', 'app/monitor/single_monitor_view_unit',$data);
		}
		function monitor_view_unit($id_encode,$penanggung_jawab_encode)
		{
			$this->general->checkDecodeNumber($this->encrypt->decode($id_encode));
			$this->general->checkDecodeNumber($this->encrypt->decode($penanggung_jawab_encode));
			$data['username']	= $this->tank_auth->get_username();
			$data['active_icon_monitor'] = 'class="start active"';
			$data['monitor'] = $this->m_monitor->get_monitor_detil($id_encode);
			$data['domain'] = $this->m_monitor->get_monitor_domain($penanggung_jawab_encode);
			$data['statistik'] = $this->m_monitor->get_single_monitor_statistik($id_encode,$penanggung_jawab_encode);
			$data['renaksi'] = $this->m_monitor->get_renaksi_domain($id_encode,$penanggung_jawab_encode);
			$this->template->set('title', 'Monitoring dan Evaluasi KKP');
			$this->template->load('template_admin', 'app/monitor/monitor_view_unit',$data);
		}
		function instansi($renaksi_id=0)
		{
			if(!$renaksi_id == '' && !is_numeric($renaksi_id))
			{
				$data['username']	= $this->tank_auth->get_username();	
				$this->template->set('title', 'Monitoring dan Evaluasi KKP');
				$this->template->load('template_admin', 'app/monitor/instansi',$data);
			}
			else redirect('/monitor');
		}
		function statistics_detil($monitor_id='',$uc_id='')
		{
			$this->general->checkDecodeNumber($this->encrypt->decode($monitor_id));
			$uc_id = $this->encrypt->decode($uc_id);
			$data['username']	= $this->tank_auth->get_username();	
			$data['statistic'] = $this->m_monitor->get_statistic_detil($monitor_id,$uc_id);
			$data['active_icon_monitor'] = 'class="start active"';
			$this->template->set('title', 'Monitoring dan Evaluasi KKP');
			$this->template->load('template_admin', 'app/monitor/statistics_detil',$data);
		}
		function statistics_detil_unit($monitor_id='',$uc_id='',$penanggung_jawab_encode)
		{
			$this->general->checkDecodeNumber($this->encrypt->decode($monitor_id));
			$this->general->checkDecodeNumber($this->encrypt->decode($penanggung_jawab_encode));
			$uc_id = $this->encrypt->decode($uc_id);
			$data['username']	= $this->tank_auth->get_username();	
			$data['statistic'] = $this->m_monitor->get_statistic_detil($monitor_id,$uc_id);
			$data['active_icon_monitor'] = 'class="start active"';
			$data['domain'] = $this->m_monitor->get_monitor_domain($penanggung_jawab_encode);
			$this->template->set('title', 'Monitoring dan Evaluasi KKP');
			$this->template->load('template_admin', 'app/monitor/statistics_detil_unit',$data);
		}
		function browse($monitor_id_encode)
		{
			$this->general->checkDecodeNumber($this->encrypt->decode($monitor_id_encode));
			$data['username']	= $this->tank_auth->get_username();
			$data['active_icon_monitor'] = 'class="start active"';
			$data['monitor'] = $this->m_monitor->get_monitor_detil($monitor_id_encode);
			$data['prioritas'] = $this->m_monitor->get_prioritas_list($monitor_id_encode);
			$this->template->set('title', 'Monitoring dan Evaluasi KKP');
			$this->template->load('template_admin', 'app/monitor/browse',$data);
		}
		function program_browse($prioritas_id_encode)
		{
			$this->general->checkDecodeNumber($this->encrypt->decode($prioritas_id_encode));
			$data['username']	= $this->tank_auth->get_username();
			$data['active_icon_monitor'] = 'class="start active"';
			$data['prioritas_info'] = $this->m_monitor->get_prioritas_info($prioritas_id_encode);
			$data['program'] = $this->m_monitor->get_program_list($prioritas_id_encode);
			$this->template->set('title', 'Monitoring dan Evaluasi KKP');
			$this->template->load('template_admin', 'app/monitor/program_browse',$data);
		}
		function renaksi_browse($program_id_encode)
		{
			$this->general->checkDecodeNumber($this->encrypt->decode($program_id_encode));
			$data['username']	= $this->tank_auth->get_username();
			$data['active_icon_monitor'] = 'class="start active"';
			$data['program_info'] = $this->m_monitor->get_program_info($program_id_encode);
			$data['renaksi'] = $this->m_monitor->get_renaksi_list($program_id_encode);
			$this->template->set('title', 'Monitoring dan Evaluasi KKP');
			$this->template->load('template_admin', 'app/monitor/renaksi_browse',$data);
		}
		function renaksi_view($renaksi_id_encode)
		{
			$this->general->checkDecodeNumber($this->encrypt->decode($renaksi_id_encode));
			$data['username']	= $this->tank_auth->get_username();
			$data['active_icon_monitor'] = 'class="start active"';
			$data['renaksi_info'] = $this->m_monitor->get_renaksi_info($renaksi_id_encode);
			$query_renaksi_info = $this->m_monitor->get_renaksi_info($renaksi_id_encode);
			$renaksi_id = $query_renaksi_info->row();
			$data['kriteria']= $this->m_monitor->get_kriteria_info($renaksi_id->renaksi_id);
			$this->template->set('title', 'Monitoring dan Evaluasi KKP');
			$this->template->load('template_admin', 'app/monitor/renaksi_view',$data);
		}
		function renaksi_view_unit($renaksi_id_encode,$penanggung_jawab_encode)
		{
			$this->general->checkDecodeNumber($this->encrypt->decode($renaksi_id_encode));
			$this->general->checkDecodeNumber($this->encrypt->decode($penanggung_jawab_encode));
			$data['username']	= $this->tank_auth->get_username();
			$data['active_icon_monitor'] = 'class="start active"';
			$data['renaksi_info'] = $this->m_monitor->get_renaksi_info($renaksi_id_encode);
			$query_renaksi_info = $this->m_monitor->get_renaksi_info($renaksi_id_encode);
			$renaksi_id = $query_renaksi_info->row();
			$data['kriteria']= $this->m_monitor->get_kriteria_info($renaksi_id->renaksi_id);
			$this->template->set('title', 'Monitoring dan Evaluasi KKP');
			$this->template->load('template_admin', 'app/monitor/renaksi_view_unit',$data);
		}
		function view_monitor(){
			$data['username'] = $this->tank_auth->get_username();
			$data['active_icon_monitor'] = 'class="start active"';		
			$this->template->set('title', 'Monitoring dan Evaluasi KKP');
			$this->template->load('template_admin', 'app/monitor	/view_monitor',$data);
		}
		function prioritas_add($monitor_encode=null) {
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			$data['monitor'] = $monitor_encode;
			$monitor_decode = $this->encrypt->decode($this->input->post('monitor_id'));
			if ($this->input->post('tambah'))
			{
				$this->form_validation->set_rules('prioritas', 'Prioritas', 'required|xss_clean');
				if ($this->form_validation->run() == FALSE) 
				{
					$this->load->view('app/monitor/form/modal_prioritas_add',$data);
				} 
				else 
				{
					$serial = $this->general->getNextSerial($monitor_decode,'prioritas');
					$data_insert = array (
					'name' 				=> $this->input->post('prioritas'),
					'monitor_id' 		=> $this->encrypt->decode($this->input->post('monitor_id')),
					'serial' 			=> $serial
					);
					
					$this->m_monitor->prioritas_add($data_insert);
					echo 'success';
				}
			}else $this->load->view('app/monitor/form/modal_prioritas_add',$data);
		}
		function prioritas_list($monitor_id_encode)
		{
			$this->general->checkDecodeNumber($this->encrypt->decode($monitor_id_encode));
			$data['username']	= $this->tank_auth->get_username();
			$data['active_icon_monitor'] = 'class="start active"';
			$data['monitor'] = $this->m_monitor->get_monitor_detil($monitor_id_encode);
			$data['prioritas'] = $this->m_monitor->get_prioritas_list($monitor_id_encode);
			$this->template->set('title', 'Monitoring dan Evaluasi KKP');
			$this->template->load('template_admin', 'app/monitor/prioritas_list',$data);
		}
		function prioritas_edit($id=null)
		{
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('ubah'))
			{
				$id = $this->input->post('prioritas_id');
				$this->form_validation->set_rules('prioritas', 'Prioritas', 'required|xss_clean');
				if ($this->form_validation->run() == FALSE) 
				{
					$data['prioritas']=$this->m_monitor->get_prioritas_detil($id);
					$this->load->view('app/monitor/form/modal_prioritas_edit',$data);
				} 
				else
				{
					$data_update = array (
					'name' 						=> $this->input->post('prioritas')
					);
					$this->m_monitor->prioritas_edit($id,$data_update);
					echo "success";	
				}
			}
			else 
			{
				$data['prioritas']=$this->m_monitor->get_prioritas_detil($id);
				$this->load->view('app/monitor/form/modal_prioritas_edit',$data);
			}
		}
		function prioritas_delete($id=null)
		{
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('delete'))
			{
				$id = $this->input->post('id');			
				$data_update = array (
				'is_active'	=> 0
				);
				$this->m_monitor->prioritas_delete($id,$data_update);
				echo "success";	
				
			}
			else 
			{
				$data['prioritas']=$id;
				$this->load->view('app/monitor/form/modal_prioritas_delete',$data);
			}
		}
		function program_add($prioritas_encode=null) {
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			$data['prioritas'] = $prioritas_encode;
			$prioritas_decode = $this->encrypt->decode($prioritas_encode);
			if ($this->input->post('tambah'))
			{
				$this->form_validation->set_rules('program', 'program', 'required|xss_clean');
				if ($this->form_validation->run() == FALSE) 
				{
					$this->load->view('app/monitor/form/modal_program_add',$data);
				} 
				else 
				{
					$prioritas_decode = $this->encrypt->decode($this->input->post('prioritas_id'));
					$serial = $this->general->getNextSerial($prioritas_decode,'program');
					$data_insert = array (
					'name' 				=> $this->input->post('program'),
					'prioritas_id' 		=> $prioritas_decode,
					'serial' 			=> $serial
					);
					
					$this->m_monitor->program_add($data_insert);
					echo 'success';
				}
			}else $this->load->view('app/monitor/form/modal_program_add',$data);
		}
		function program_list($monitor_id_encode)
		{
			$this->general->checkDecodeNumber($this->encrypt->decode($monitor_id_encode));
			$data['username']	= $this->tank_auth->get_username();
			$data['active_icon_monitor'] = 'class="start active"';
			$data['monitor'] = $this->m_monitor->get_monitor_detil($monitor_id_encode);
			$data['program'] = $this->m_monitor->get_program_list_box($monitor_id_encode);
			$this->template->set('title', 'Monitoring dan Evaluasi KKP');
			$this->template->load('template_admin', 'app/monitor/program_list',$data);
		}
		function program_edit($id=null)
		{
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('ubah'))
			{
				$id = $this->input->post('program_id');
				$this->form_validation->set_rules('program', 'program', 'required|xss_clean');
				if ($this->form_validation->run() == FALSE) 
				{
					$data['program']=$this->m_monitor->get_program_detil($id);
					$this->load->view('app/monitor/form/modal_program_edit',$data);
				} 
				else
				{
					$data_update = array (
					'name' 						=> $this->input->post('program')
					);
					$this->m_monitor->program_edit($id,$data_update);
					echo "success";	
				}
			}
			else 
			{
				$data['program']=$this->m_monitor->get_program_detil($id);
				$this->load->view('app/monitor/form/modal_program_edit',$data);
			}
		}
		function program_delete($id=null)
		{
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('delete'))
			{
				$id = $this->input->post('id');			
				$data_update = array (
				'is_active'	=> 0
				);
				$this->m_monitor->program_delete($id,$data_update);
				echo "success";	
				
			}
			else 
			{
				$data['program']=$id;
				$this->load->view('app/monitor/form/modal_program_delete',$data);
			}
		}
		function renaksi_add($program_encode=null) {
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			$data['program'] = $program_encode;
			if ($this->input->post('tambah'))
			{
				$this->form_validation->set_rules('renaksi', 'Renaksi', 'required|xss_clean');
				if ($this->form_validation->run() == FALSE) 
				{
					$this->load->view('app/monitor/form/modal_renaksi_add',$data);
				} 
				else 
				{
					$program_decode = $this->encrypt->decode($this->input->post('program_id'));
					$serial = $this->general->getNextSerial($program_decode,'renaksi');
					$data_insert = array (
					'name' 				=> $this->input->post('renaksi'),
					'program_id' 		=> $program_decode,
					'serial' 			=> $serial
					);
					
					$this->m_monitor->renaksi_add($data_insert);
					echo 'success';
				}
			}else $this->load->view('app/monitor/form/modal_renaksi_add',$data);
		}
		function renaksi_list($monitor_id_encode)
		{
			$this->general->checkDecodeNumber($this->encrypt->decode($monitor_id_encode));
			$data['username']	= $this->tank_auth->get_username();
			$data['active_icon_monitor'] = 'class="start active"';
			$data['monitor'] = $this->m_monitor->get_monitor_detil($monitor_id_encode);
			$data['renaksi'] = $this->m_monitor->get_renaksi_list_box($monitor_id_encode);
			$this->template->set('title', 'Monitoring dan Evaluasi KKP');
			$this->template->load('template_admin', 'app/monitor/renaksi_list',$data);
		}
		function subrenaksi_list($monitor_id_encode)
		{
			$this->general->checkDecodeNumber($this->encrypt->decode($monitor_id_encode));
			$data['username']	= $this->tank_auth->get_username();
			$data['active_icon_monitor'] = 'class="start active"';
			$data['monitor'] = $this->m_monitor->get_monitor_detil($monitor_id_encode);
			$data['renaksi'] = $this->m_monitor->get_subrenaksi_list_box($monitor_id_encode);
			$this->template->set('title', 'Monitoring dan Evaluasi KKP');
			$this->template->load('template_admin', 'app/monitor/subrenaksi_list',$data);
		}
		function renaksi_edit($id=null)
		{
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('ubah'))
			{
				$id = $this->input->post('renaksi_id');
				$this->form_validation->set_rules('renaksi', 'renaksi', 'required|xss_clean');
				if ($this->form_validation->run() == FALSE) 
				{
					$data['renaksi']=$this->m_monitor->get_renaksi_detil($id);
					$this->load->view('app/monitor/form/modal_renaksi_edit',$data);
				} 
				else
				{
					$data_update = array (
					'name' 						=> $this->input->post('renaksi')
					);
					$this->m_monitor->renaksi_edit($id,$data_update);
					echo "success";	
				}
			}
			else 
			{
				$data['renaksi']=$this->m_monitor->get_renaksi_detil($id);
				$this->load->view('app/monitor/form/modal_renaksi_edit',$data);
			}
		}
		function renaksi_delete($id=null)
		{
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('delete'))
			{
				$id = $this->input->post('id');			
				$data_update = array (
				'is_active'	=> 0
				);
				$this->m_monitor->renaksi_delete($id,$data_update);
				echo "success";	
				
			}
			else 
			{
				$data['renaksi']=$id;
				$this->load->view('app/monitor/form/modal_renaksi_delete',$data);
			}
		}
		function kriteria_add($renaksi_encode=null) {
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			$data['renaksi'] = $renaksi_encode;
			if ($this->input->post('tambah'))
			{
				$this->form_validation->set_rules('name', 'Kriteria Keberhasilan', 'required|xss_clean');
				$this->form_validation->set_rules('penanggung_jawab', 'Penanggung Jawab', 'required|xss_clean');
				if ($this->form_validation->run() == FALSE) 
				{
					$data['renaksi'] = $this->input->post('renaksi_id');
					$this->load->view('app/monitor/form/modal_kriteria_add',$data);
				} 
				else 
				{
					$renaksi_decode = $this->encrypt->decode($this->input->post('renaksi_id'));
					
					$instansi_terkait = explode(',',$this->input->post('instansi_terkait'));
					$instansi_terkait_arr = Array();
					foreach($instansi_terkait as $instansi_terkait_row)
					{array_push($instansi_terkait_arr,$this->encrypt->decode($instansi_terkait_row));}
					
					$penanggung_jawab = explode(',',$this->input->post('penanggung_jawab'));
					$penanggung_jawab_arr = Array();
					foreach($penanggung_jawab as $penanggung_jawab_row)
					{array_push($penanggung_jawab_arr,$this->encrypt->decode($penanggung_jawab_row));}
					
					sort($penanggung_jawab_arr);
					sort($instansi_terkait_arr);
					
					$data_insert = array (
					'renaksi_id' 			=> $renaksi_decode,
					'name' 					=> $this->input->post('name'),
					'penanggung_jawab' 		=> implode(',',$penanggung_jawab_arr),
					'instansi_terkait' 		=> implode(',',$instansi_terkait_arr)
					);
					
					$this->m_monitor->kriteria_add($data_insert);
					echo 'success';
				}
			}else $this->load->view('app/monitor/form/modal_kriteria_add',$data);
		}
		function kriteria_edit($id=null)
		{
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('ubah'))
			{
				$id = $this->input->post('kriteria_id');
				$this->form_validation->set_rules('name', 'Kriteria Keberhasilan', 'required|xss_clean');
				$this->form_validation->set_rules('penanggung_jawab', 'Penanggung Jawab', 'required|xss_clean');
				if ($this->form_validation->run() == FALSE) 
				{
					$data['kriteria']=$this->m_monitor->get_kriteria_detil($id);
					$this->load->view('app/monitor/form/modal_kriteria_edit',$data);
				} 
				else
				{
					$instansi_terkait = explode(',',$this->input->post('instansi_terkait'));
					$instansi_terkait_arr = Array();
					foreach($instansi_terkait as $instansi_terkait_row)
					{array_push($instansi_terkait_arr,$this->encrypt->decode($instansi_terkait_row));}
					
					$penanggung_jawab = explode(',',$this->input->post('penanggung_jawab'));
					$penanggung_jawab_arr = Array();
					foreach($penanggung_jawab as $penanggung_jawab_row)
					{array_push($penanggung_jawab_arr,$this->encrypt->decode($penanggung_jawab_row));}
					
					sort($penanggung_jawab_arr);
					sort($instansi_terkait_arr);
					
					$data_update = array (
					'name' 					=> $this->input->post('name'),
					'penanggung_jawab' 		=> implode(',',$penanggung_jawab_arr),
					'instansi_terkait' 		=> implode(',',$instansi_terkait_arr)
					);
					$this->m_monitor->kriteria_edit($id,$data_update);
					echo "success";	
				}
			}
			else 
			{
				$data['kriteria']=$this->m_monitor->get_kriteria_detil($id);
				$this->load->view('app/monitor/form/modal_kriteria_edit',$data);
			}
		}
		function kriteria_delete($id=null)
		{
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('delete'))
			{
				$id = $this->input->post('id');			
				$data_update = array (
				'is_active'	=> 0
				);
				$this->m_monitor->kriteria_delete($id,$data_update);
				echo "success";	
				
			}
			else 
			{
				$data['kriteria']=$id;
				$this->load->view('app/monitor/form/modal_kriteria_delete',$data);
			}
		}
		function ukuran_add($monitor_encode=null,$kriteria_encode=null) {
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			$data['monitor'] = $monitor_encode;
			$data['kriteria'] = $kriteria_encode;
			$data['monitor_checkpoint'] = $this->m_monitor->get_list_checkpoint($monitor_encode);
			if ($this->input->post('tambah'))
			{
				$ii = 0;
				$data['radio'] = $this->input->post('type');
				if($this->input->post('type') == 2) 
				{
					$checkpoint_id = $this->input->post('checkpoint_id');
					$count = count($checkpoint_id);
					$ukuran_capaian = $this->input->post('ukuran_capaian');
					$target_keuangan = $this->input->post('target_keuangan');
					$target_fisik = $this->input->post('target_fisik');
					$target_keuangan_check = 0;	
					$target_fisik_check = 0;
					$validasi_keuangan = 0;
					$validasi_fisik = 0;
					$ii = 0;
					while($ii<$count) {
						if(($ukuran_capaian[$ii]!=" ")&&($ukuran_capaian[$ii]!="")&&($ukuran_capaian[$ii]!="<br>")&&($ukuran_capaian[$ii]!="-")&&($ukuran_capaian[$ii]!="&nbsp;"))
						{
							if($target_keuangan[$ii] >= $target_keuangan_check)
							{
								$target_keuangan_check = $target_keuangan[$ii]; 
							}
							else
							{	
								if($ii == 0)
								{
									$target_keuangan_check = 0;
								}
								else
								{
									$target_keuangan_check = $target_keuangan[$ii-1];
								}
								$validasi_keuangan = 1;
							}
							if($target_fisik[$ii] >= $target_fisik_check)
							{
								$target_fisik_check = $target_fisik[$ii]; 
							}
							else
							{
								if($ii == 0)
								{
									$target_fisik_check = 0;
								}
								else
								{
									$fisik = $target_fisik[$ii-1];
								}
								$validasi_fisik = 1;
							}
						}
					$ii++;
					}
					$this->form_validation->set_rules('jmlh_anggaran', 'Jumlah Anggaran', 'required|xss_clean');
					$this->form_validation->set_rules('ukuran_keberhasilan', 'Ukuran Keberhasilan', 'required|xss_clean');
					if ($this->form_validation->run() == FALSE || $validasi_keuangan == 1 || $validasi_fisik == 1) 
					{
						if($validasi_keuangan == 1) $data['error_validasi_keuangan'] = 'Target keuangan merupakan akumulasi dari bulan sebelumnya<br>';
						if($validasi_fisik == 1) $data['error_validasi_fisik'] = 'Target fisik merupakan akumulasi dari bulan sebelumnya<br>';
						$this->load->view('app/monitor/form/modal_ukuran_add',$data);
					}
					else
					{
						$clear_number_jmlh_anggaran = str_replace('.','',$this->input->post('jmlh_anggaran'));
						$kriteria_id_decode = $this->encrypt->decode($kriteria_encode);
						$data_ukuran_insert = array (
						'kriteria_id' 			=> $kriteria_id_decode,
						'name' 					=> $this->input->post('ukuran_keberhasilan'),
						'anggaran'				=> $clear_number_jmlh_anggaran,
						'type'					=> $this->input->post('type')
						);
						
						$this->m_monitor->ukuran_add($data_ukuran_insert);
						$ukuran_id = $this->db->insert_id();
						$i = 0;
						$last_check = 0;
						while($i<$count) {
							if(($ukuran_capaian[$i]!=" ")&&($ukuran_capaian[$i]!="")&&($ukuran_capaian[$i]!="<br>")&&($ukuran_capaian[$i]!="-")&&($ukuran_capaian[$i]!="&nbsp;")) {
								$data_ukuran_capaian_insert = array (
								'ukuran_id' 			=> $ukuran_id,
								'checkpoint_id' 		=> $this->encrypt->decode($checkpoint_id[$i]),
								'name' 					=> $ukuran_capaian[$i],
								'target_keuangan' 		=> $target_keuangan[$i],
								'target_fisik' 			=> $target_fisik[$i]
								);
								$this->m_monitor->ukuran_capaian_add($data_ukuran_capaian_insert);
								$last_check = $this->db->insert_id();
								} else {
								$data_ukuran_capaian_insert = array (
								'ukuran_id' 			=> $ukuran_id,
								'checkpoint_id' 		=> $this->encrypt->decode($checkpoint_id[$i]),
								'name' 					=> '',
								'target_keuangan' 		=> 0,
								'target_fisik' 			=> 0,
								'status'				=> 0
								);
								$this->m_monitor->ukuran_capaian_add($data_ukuran_capaian_insert);
							}
							$i++;
						}
						$ukuran_capaian_last_checkpoint = array (
						'finish_on' 			=> $last_check
						);
						$this->m_monitor->ukuran_capaian_last_checkpoint($ukuran_id,$ukuran_capaian_last_checkpoint);
						echo 'success';
					}
				}
				else 
				{
					$this->form_validation->set_rules('ukuran_keberhasilan', 'Ukuran Keberhasilan', 'required|xss_clean');
					$kriteria_id_decode = $this->encrypt->decode($kriteria_encode);
					$checkpoint_id = $this->input->post('checkpoint_id');
					$ukuran_capaian = $this->input->post('ukuran_capaian');
					if ($this->form_validation->run() == FALSE) 
					{
						$this->load->view('app/monitor/form/modal_ukuran_add',$data);
					}
					else
					{
						$data_ukuran_insert = array (
						'kriteria_id' 			=> $kriteria_id_decode,
						'name' 					=> $this->input->post('ukuran_keberhasilan')
						);
						
						$this->m_monitor->ukuran_add($data_ukuran_insert);
						$ukuran_id = $this->db->insert_id();
						$i = 0;
						$count = count($checkpoint_id);
						$last_check = 0;
						while($i<$count) {
							if(($ukuran_capaian[$i]!=" ")&&($ukuran_capaian[$i]!="")&&($ukuran_capaian[$i]!="<br>")&&($ukuran_capaian[$i]!="-")&&($ukuran_capaian[$i]!="&nbsp;")) {
								$data_ukuran_capaian_insert = array (
								'ukuran_id' 			=> $ukuran_id,
								'checkpoint_id' 		=> $this->encrypt->decode($checkpoint_id[$i]),
								'name' 					=> $ukuran_capaian[$i]
								);
								$this->m_monitor->ukuran_capaian_add($data_ukuran_capaian_insert);
								$last_check = $this->db->insert_id();
								} else {
								$data_ukuran_capaian_insert = array (
								'ukuran_id' 			=> $ukuran_id,
								'checkpoint_id' 		=> $this->encrypt->decode($checkpoint_id[$i]),
								'name' 					=> $ukuran_capaian[$i],
								'status'				=> 0
								);
								$this->m_monitor->ukuran_capaian_add($data_ukuran_capaian_insert);
							}
							$i++;
						}
						$ukuran_capaian_last_checkpoint = array (
						'finish_on' 			=> $last_check
						);
						$this->m_monitor->ukuran_capaian_last_checkpoint($ukuran_id,$ukuran_capaian_last_checkpoint);
						echo 'success';
					}
				}
			}
			else 
			{
				$data['radio'] = 1;
				$this->load->view('app/monitor/form/modal_ukuran_add',$data);
			}
		}
		function ukuran_edit($id=null)
		{
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('ubah'))
			{
				$ukuran_id = $this->input->post('ukuran_id');
				$ukuran_id_decode = $this->encrypt->decode($ukuran_id);
				$ukuran_keberhasilan = $this->input->post('ukuran_keberhasilan');
				$ukuran_capaian = $this->input->post('ukuran_capaian');
				$target_keuangan = $this->input->post('target_keuangan');
				$target_fisik = $this->input->post('target_fisik');
				$ukuran_capaian_id = $this->input->post('ukuran_capaian_id');
				if($this->input->post('type') == 2) 
				{
					$target_keuangan_check = 0;	
					$target_fisik_check = 0;
					$validasi_keuangan = 0;
					$validasi_fisik = 0;
					$ii = 0;
					$count = count($ukuran_capaian_id);
					while($ii<$count) {
						if(($ukuran_capaian[$ii]!=" ")&&($ukuran_capaian[$ii]!="")&&($ukuran_capaian[$ii]!="<br>")&&($ukuran_capaian[$ii]!="-")&&($ukuran_capaian[$ii]!="&nbsp;"))
						{
							if($target_keuangan[$ii] >= $target_keuangan_check)
							{
								$target_keuangan_check = $target_keuangan[$ii]; 
							}
							else
							{	
								if($ii == 0)
								{
									$target_keuangan_check = 0;
								}
								else
								{
									$target_keuangan_check = $target_keuangan[$ii-1];
								}
								$validasi_keuangan = 1;
							}
							if($target_fisik[$ii] >= $target_fisik_check)
							{
								$target_fisik_check = $target_fisik[$ii]; 
							}
							else
							{
								if($ii == 0)
								{
									$target_fisik_check = 0;
								}
								else
								{
									$fisik = $target_fisik[$ii-1];
								}
								$validasi_fisik = 1;
							}
						}
					$ii++;
					}
					$this->form_validation->set_rules('jmlh_anggaran', 'Jumlah Anggaran', 'required|xss_clean');
					$this->form_validation->set_rules('ukuran_keberhasilan', 'Ukuran Keberhasilan', 'required|xss_clean');
					$clear_number_jmlh_anggaran = str_replace('.','',$this->input->post('jmlh_anggaran'));
					if ($this->form_validation->run() == FALSE || $validasi_keuangan == 1 || $validasi_fisik == 1 || $clear_number_jmlh_anggaran == 0) 
					{
						$data['ukuran']=$this->m_monitor->get_ukuran_detil($this->encrypt->decode($this->input->post('ukuran_id')));
						if($validasi_keuangan == 1) $data['error_validasi_keuangan'] = 'Target keuangan merupakan akumulasi dari bulan sebelumnya<br>';
						if($validasi_fisik == 1) $data['error_validasi_fisik'] = 'Target fisik merupakan akumulasi dari bulan sebelumnya<br>';
						if($clear_number_jmlh_anggaran == 0) $data['error_validasi_jmlh_anggaran'] = 'Jumlah anggaran harus diisi<br>';
						$this->load->view('app/monitor/form/modal_ukuran_edit',$data);
					}
					else
					{
						$data_ukuran_keberhasilan_update = array (
						'name' 					=> $ukuran_keberhasilan,
						'anggaran'				=> $clear_number_jmlh_anggaran,
						'type'					=> $this->input->post('type')
						);
						$this->m_monitor->ukuran_keberhasilan_edit($ukuran_id,$data_ukuran_keberhasilan_update);
						$i = 0;
						$last_check_decode = 0;
						$count = count($ukuran_capaian_id);
						while($i<$count) {
							$check_status_checkpoint = $this->m_monitor->check_status_checkpoint($ukuran_capaian_id[$i]);
							if(($ukuran_capaian[$i]!=" ")&&($ukuran_capaian[$i]!="")&&($ukuran_capaian[$i]!="<br>")&&($ukuran_capaian[$i]!="-")&&($ukuran_capaian[$i]!="&nbsp;")) {
								if($check_status_checkpoint == 2 || $check_status_checkpoint == 3)
								{
									$status_checkpoint = $check_status_checkpoint;
								}
								else $status_checkpoint = 1;
								$data_ukuran_capaian_update = array (
								'name' 					=> $ukuran_capaian[$i],
								'target_keuangan' 		=> $target_keuangan[$i],
								'target_fisik' 			=> $target_fisik[$i],
								'status'				=> $status_checkpoint
								);
								$this->m_monitor->ukuran_capaian_edit($ukuran_capaian_id[$i],$data_ukuran_capaian_update);
								$last_check = $ukuran_capaian_id[$i];
								$last_check_decode = $this->encrypt->decode($last_check);
								} else {
								$data_ukuran_capaian_update = array (
								'name' 					=> '',
								'target_keuangan' 		=> 0,
								'target_fisik' 			=> 0,
								'status'				=> 0
								);
								$this->m_monitor->ukuran_capaian_edit($ukuran_capaian_id[$i],$data_ukuran_capaian_update);
							}
							$i++;
						}
						$ukuran_capaian_last_checkpoint = array (
						'finish_on' 	=> $last_check_decode
						);
						$this->m_monitor->ukuran_capaian_last_checkpoint($ukuran_id_decode,$ukuran_capaian_last_checkpoint);
						echo 'success';
					}	
				}
				else
				{
					$this->form_validation->set_rules('ukuran_keberhasilan', 'Ukuran Keberhasilan', 'required|xss_clean');
					if ($this->form_validation->run() == FALSE) 
					{
						$this->load->view('app/monitor/form/modal_ukuran_edit',$data);
					}
					else
					{
						$data_ukuran_keberhasilan_update = array (
						'name' 			=> $ukuran_keberhasilan,
						'anggaran'		=> 0,
						'type'			=> $this->input->post('type')
						);
						$this->m_monitor->ukuran_keberhasilan_edit($ukuran_id,$data_ukuran_keberhasilan_update);
						$i = 0;
						$last_check_decode = 0;
						$count = count($ukuran_capaian_id);
						while($i<$count) {
							$check_status_checkpoint = $this->m_monitor->check_status_checkpoint($ukuran_capaian_id[$i]);
							if(($ukuran_capaian[$i]!=" ")&&($ukuran_capaian[$i]!="")&&($ukuran_capaian[$i]!="<br>")&&($ukuran_capaian[$i]!="-")&&($ukuran_capaian[$i]!="&nbsp;")) {
								if($check_status_checkpoint == 2 || $check_status_checkpoint == 3)
								{
									$status_checkpoint = $check_status_checkpoint;
								}
								else $status_checkpoint = 1;
								$data_ukuran_capaian_update = array (
								'name' 					=> $ukuran_capaian[$i],
								'target_keuangan' 		=> 0,
								'target_fisik' 			=> 0,
								'status'				=> $status_checkpoint
								);
								$this->m_monitor->ukuran_capaian_edit($ukuran_capaian_id[$i],$data_ukuran_capaian_update);
								$last_check = $ukuran_capaian_id[$i];
								$last_check_decode = $this->encrypt->decode($last_check);
								} else {
								$data_ukuran_capaian_update = array (
								'name' 					=> '',
								'target_keuangan' 		=> 0,
								'target_fisik' 			=> 0,
								'status'				=> 0
								);
								$this->m_monitor->ukuran_capaian_edit($ukuran_capaian_id[$i],$data_ukuran_capaian_update);
							}
							$i++;
						}
						$ukuran_capaian_last_checkpoint = array (
						'finish_on' 	=> $last_check_decode
						);
						$this->m_monitor->ukuran_capaian_last_checkpoint($ukuran_id_decode,$ukuran_capaian_last_checkpoint);
						echo 'success';
					}
				}
			}
			else 
			{
				$data['ukuran']=$this->m_monitor->get_ukuran_detil($id);
				$this->load->view('app/monitor/form/modal_ukuran_edit',$data);
			}
		}
		function ukuran_delete($id=null)
		{
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('delete'))
			{
				$id = $this->input->post('id');			
				$data_delete = array (
				'is_active'	=> 0
				);
				$this->m_monitor->ukuran_delete($id,$data_delete);
				echo "success";	
				
			}
			else 
			{
				$data['ukuran']=$id;
				$this->load->view('app/monitor/form/modal_ukuran_delete',$data);
			}
		}
		function lapor($uc_id_encode=null)
		{
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('lapor'))
			{
				if($this->input->post('ukuran_type') == 1)
				{
					$uc_id_encode = $this->input->post('uc_id_encode');
					$this->form_validation->set_rules('capaian', 'Capaian', 'required|xss_clean|numeric');
					$this->form_validation->set_rules('keterangan', 'Keterangan / Kendala', 'required|xss_clean');
					$check_data_dukung = $this->m_monitor->tmp_check_lapor_data_dukung($uc_id_encode);
					if($check_data_dukung == 0) $data['data_dukung']= 'kosong';
					if ($this->form_validation->run() == FALSE || $check_data_dukung == 0) 
					{
						$data['uc_id_encode'] = $uc_id_encode;
						$data['u_type']=$this->m_monitor->get_ukuran_type($uc_id_encode);
						$data['uc']=$this->m_monitor->get_uc_detil($uc_id_encode);
						$this->load->view('app/monitor/form/modal_lapor',$data);
					} 
					else
					{
						$data_update_capaian = array (
						'capaian' 			=> $this->input->post('capaian'),
						'keterangan' 		=> $this->input->post('keterangan'),
						'status'	 		=> 2
						);
						$this->m_monitor->lapor($uc_id_encode,$data_update_capaian);
						
						$data_insert_logs = array (
						'timestamp' 		=> date('Y-m-d h:i:s'),
						'monitor_ukuran_checkpoint_id'	=> $this->encrypt->decode($uc_id_encode),
						'capaian'	 		=> $this->input->post('capaian'),
						'keterangan'		=> $this->input->post('keterangan'),
						'log_ref_id'	 	=> 1,
						'user_id'	 		=> $this->session->userdata('user_id')
						);
						$this->m_monitor->logs_add($data_insert_logs);
						
						$data_tmp_files_list = $this->m_monitor->tmp_files_list($uc_id_encode);
						if($data_tmp_files_list->num_rows() > 0)
						{
							foreach ($data_tmp_files_list->result() as $row)
							{
								$data_insert_lampiran = array(
								'monitor_ukuran_checkpoint_id'	=> $row->monitor_ukuran_checkpoint_id,
								'user_id'	 		=> $row->user_id,
								'name'				=> $row->name,
								'created'			=> $row->created,
								);
								$this->m_monitor->monitor_lampiran_add($data_insert_lampiran);
								$this->m_monitor->tmp_file_delete($row->id);
							}
						}
						echo "success";	
					}
				}
				else
				{
					$uc_id_encode = $this->input->post('uc_id_encode');
					$this->form_validation->set_rules('capaian', 'Capaian', 'required|xss_clean|numeric');
					$this->form_validation->set_rules('realisasi_keuangan', 'Realisasi Keuangan', 'required|xss_clean');
					$this->form_validation->set_rules('realisasi_fisik', 'Realisasi Fisik', 'required|xss_clean|numeric');
					$this->form_validation->set_rules('keterangan', 'Keterangan / Kendala', 'required|xss_clean');
					$check_data_dukung = $this->m_monitor->tmp_check_lapor_data_dukung($uc_id_encode);
					if($check_data_dukung == 0) $data['data_dukung']= 'kosong';
					if ($this->form_validation->run() == FALSE || $check_data_dukung == 0) 
					{
						$data['uc_id_encode'] = $uc_id_encode;
						$data['u_type']=$this->m_monitor->get_ukuran_type($uc_id_encode);
						$data['uc']=$this->m_monitor->get_uc_detil($uc_id_encode);
						$this->load->view('app/monitor/form/modal_lapor',$data);
					} 
					else
					{
						$clear_number_realisasi_anggaran = str_replace('.','',$this->input->post('realisasi_keuangan'));
						$data_update_capaian = array (
						'capaian' 			=> $this->input->post('capaian'),
						'keterangan' 		=> $this->input->post('keterangan'),
						'realisasi_keuangan'=> $clear_number_realisasi_anggaran,
						'realisasi_fisik'	=> $this->input->post('realisasi_fisik'),
						'status'	 		=> 2
						);
						$this->m_monitor->lapor($uc_id_encode,$data_update_capaian);
						
						$data_insert_logs = array (
						'timestamp' 		=> date('Y-m-d h:i:s'),
						'monitor_ukuran_checkpoint_id'	=> $this->encrypt->decode($uc_id_encode),
						'capaian'	 		=> $this->input->post('capaian'),
						'realisasi_keuangan'=> $clear_number_realisasi_anggaran,
						'realisasi_fisik'	=> $this->input->post('realisasi_fisik'),
						'keterangan'		=> $this->input->post('keterangan'),
						'log_ref_id'	 	=> 1,
						'user_id'	 		=> $this->session->userdata('user_id')
						);
						$this->m_monitor->logs_add($data_insert_logs);
						
						$data_tmp_files_list = $this->m_monitor->tmp_files_list($uc_id_encode);
						if($data_tmp_files_list->num_rows() > 0)
						{
							foreach ($data_tmp_files_list->result() as $row)
							{
								$data_insert_lampiran = array(
								'monitor_ukuran_checkpoint_id'	=> $row->monitor_ukuran_checkpoint_id,
								'user_id'	 		=> $row->user_id,
								'name'				=> $row->name,
								'created'			=> $row->created,
								);
								$this->m_monitor->monitor_lampiran_add($data_insert_lampiran);
								$this->m_monitor->tmp_file_delete($row->id);
							}
						}
						echo "success";	
					}
				}
			}
			else 
			{
				$data['uc_id_encode'] = $uc_id_encode;
				$data['u_type']=$this->m_monitor->get_ukuran_type($uc_id_encode);
				$data['uc']=$this->m_monitor->get_uc_detil($uc_id_encode);
				$this->load->view('app/monitor/form/modal_lapor',$data);
			}
		}
		function lapor_update($uc_id_encode=null)
		{
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('ubah'))
			{
				if($this->input->post('ukuran_type') == 1)
				{
					$uc_id_encode = $this->input->post('uc_id_encode');
					$this->form_validation->set_rules('capaian', 'Capaian', 'required|xss_clean|numeric');
					$this->form_validation->set_rules('keterangan', 'Keterangan / Kendala', 'required|xss_clean');
					$check_data_dukung = $this->m_monitor->check_lapor_data_dukung($uc_id_encode);
					if($check_data_dukung == 0) $data['data_dukung']= 'kosong';
					if ($this->form_validation->run() == FALSE || $check_data_dukung == 0) 
					{
						$data['uc_id_encode'] = $uc_id_encode;
						$data['uc']=$this->m_monitor->get_uc_detil($uc_id_encode);
						$this->load->view('app/monitor/form/modal_lapor_update',$data);
					} 
					else
					{
						$data_update_capaian = array (
						'capaian' 			=> $this->input->post('capaian'),
						'keterangan' 		=> $this->input->post('keterangan'),
						'status'	 		=> 2
						);
						$this->m_monitor->lapor($uc_id_encode,$data_update_capaian);
						
						$data_insert_logs = array (
						'timestamp' 		=> date('Y-m-d h:i:s'),
						'monitor_ukuran_checkpoint_id'	=> $this->encrypt->decode($uc_id_encode),
						'capaian'	 		=> $this->input->post('capaian'),
						'keterangan'		=> $this->input->post('keterangan'),
						'log_ref_id'	 	=> 3,
						'user_id'	 		=> $this->session->userdata('user_id')
						);
						$this->m_monitor->logs_add($data_insert_logs);
						echo "success";	
					}
				}
				else 
				{
					$uc_id_encode = $this->input->post('uc_id_encode');
					$this->form_validation->set_rules('capaian', 'Capaian', 'required|xss_clean|numeric');
					$this->form_validation->set_rules('keterangan', 'Keterangan / Kendala', 'required|xss_clean');
					$check_data_dukung = $this->m_monitor->check_lapor_data_dukung($uc_id_encode);
					if($check_data_dukung == 0) $data['data_dukung']= 'kosong';
					if ($this->form_validation->run() == FALSE || $check_data_dukung == 0) 
					{
						$data['uc_id_encode'] = $uc_id_encode;
						$data['uc']=$this->m_monitor->get_uc_detil($uc_id_encode);
						$this->load->view('app/monitor/form/modal_lapor_update',$data);
					} 
					else
					{
						$clear_number_realisasi_anggaran = str_replace('.','',$this->input->post('realisasi_keuangan'));
						$data_update_capaian = array (
						'capaian' 			=> $this->input->post('capaian'),
						'keterangan' 		=> $this->input->post('keterangan'),
						'realisasi_keuangan'=> $clear_number_realisasi_anggaran,
						'realisasi_fisik'	=> $this->input->post('realisasi_fisik'),
						'status'	 		=> 2
						);
						$this->m_monitor->lapor($uc_id_encode,$data_update_capaian);
						
						$data_insert_logs = array (
						'timestamp' 		=> date('Y-m-d h:i:s'),
						'monitor_ukuran_checkpoint_id'	=> $this->encrypt->decode($uc_id_encode),
						'capaian'	 		=> $this->input->post('capaian'),
						'realisasi_keuangan'=> $clear_number_realisasi_anggaran,
						'realisasi_fisik'	=> $this->input->post('realisasi_fisik'),
						'keterangan'		=> $this->input->post('keterangan'),
						'log_ref_id'	 	=> 3,
						'user_id'	 		=> $this->session->userdata('user_id')
						);
						$this->m_monitor->logs_add($data_insert_logs);
						echo "success";	
					}
				}
			}
			else 
			{
				$data['uc_id_encode'] = $uc_id_encode;
				$data['u_type']=$this->m_monitor->get_ukuran_type($uc_id_encode);
				$data['uc']=$this->m_monitor->get_uc_detil($uc_id_encode);
				$this->load->view('app/monitor/form/modal_lapor_update',$data);
			}
		}
		function logs($uc_id_encode=null)
		{
			if(!$this->input->is_ajax_request()) redirect('auth/login');
			$data['logs']=$this->m_monitor->get_logs($uc_id_encode);
			$this->load->view('app/monitor/form/modal_logs',$data);
		}
		function verifikasi($uc_id_encode=null)
		{
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('verifikasi'))
			{
				if($this->input->post('ukuran_type') == 1)
				{
					$uc_id_encode = $this->input->post('uc_id_encode');
					$this->form_validation->set_rules('capaian_verifikasi', 'Hasil verifikasi', 'required|xss_clean|numeric');
					$this->form_validation->set_rules('keterangan', 'Keterangan / Kendala', 'required|xss_clean');
					$check_data_dukung = $this->m_monitor->check_lapor_data_dukung($uc_id_encode);
					if($check_data_dukung == 0) $data['data_dukung']= 'kosong';
					if ($this->form_validation->run() == FALSE || $check_data_dukung == 0) 
					{
						$data['uc_id_encode'] = $uc_id_encode;
						$data['u_type']=$this->m_monitor->get_ukuran_type($uc_id_encode);
						$data['uc']=$this->m_monitor->get_uc_detil($uc_id_encode);
						$this->load->view('app/monitor/form/modal_verifikasi',$data);
					} 
					else
					{
						$data_update_capaian = array (
						'capaian' 			=> $this->input->post('capaian_verifikasi'),
						'keterangan' 		=> $this->input->post('keterangan'),
						'status'	 		=> 3
						);
						$this->m_monitor->lapor($uc_id_encode,$data_update_capaian);
						
						$data_insert_logs = array (
						'timestamp' 		=> date('Y-m-d h:i:s'),
						'monitor_ukuran_checkpoint_id'	=> $this->encrypt->decode($uc_id_encode),
						'capaian'	 		=> $this->input->post('capaian_verifikasi'),
						'keterangan'		=> $this->input->post('keterangan'),
						'log_ref_id'	 	=> 2,
						'user_id'	 		=> $this->session->userdata('user_id')
						);
						$this->m_monitor->logs_add($data_insert_logs);
						echo "success";	
					}
				}
				else
				{
					$uc_id_encode = $this->input->post('uc_id_encode');
					$this->form_validation->set_rules('capaian_verifikasi', 'Hasil verifikasi', 'required|xss_clean|numeric');
					$this->form_validation->set_rules('keterangan', 'Keterangan / Kendala', 'required|xss_clean');
					$this->form_validation->set_rules('verifikasi_realisasi_keuangan', 'Hasil verifikasi realisasi keuangan', 'required|xss_clean');
					$this->form_validation->set_rules('verifikasi_realisasi_fisik', 'Hasil verifikasi realisasi fisik', 'required|xss_clean|numeric');
					$check_data_dukung = $this->m_monitor->check_lapor_data_dukung($uc_id_encode);
					if($check_data_dukung == 0) $data['data_dukung']= 'kosong';
					if ($this->form_validation->run() == FALSE || $check_data_dukung == 0) 
					{
						$data['uc_id_encode'] = $uc_id_encode;
						$data['u_type']=$this->m_monitor->get_ukuran_type($uc_id_encode);
						$data['uc']=$this->m_monitor->get_uc_detil($uc_id_encode);
						$this->load->view('app/monitor/form/modal_verifikasi',$data);
					} 
					else
					{
						$clear_number_verifikasi_realisasi_anggaran = str_replace('.','',$this->input->post('verifikasi_realisasi_keuangan'));
						$data_update_capaian = array (
						'capaian' 			=> $this->input->post('capaian_verifikasi'),
						'keterangan' 		=> $this->input->post('keterangan'),
						'realisasi_keuangan'=> $clear_number_verifikasi_realisasi_anggaran,
						'realisasi_fisik'	=> $this->input->post('verifikasi_realisasi_fisik'),
						'status'	 		=> 3
						);
						$this->m_monitor->lapor($uc_id_encode,$data_update_capaian);
						
						$data_insert_logs = array (
						'timestamp' 		=> date('Y-m-d h:i:s'),
						'monitor_ukuran_checkpoint_id'	=> $this->encrypt->decode($uc_id_encode),
						'capaian'	 		=> $this->input->post('capaian_verifikasi'),
						'realisasi_keuangan'=> $clear_number_verifikasi_realisasi_anggaran,
						'realisasi_fisik'	=> $this->input->post('verifikasi_realisasi_fisik'),
						'keterangan'		=> $this->input->post('keterangan'),
						'log_ref_id'	 	=> 2,
						'user_id'	 		=> $this->session->userdata('user_id')
						);
						$this->m_monitor->logs_add($data_insert_logs);
						echo "success";	
					}
				}
			}
			else 
			{
				$data['uc_id_encode'] = $uc_id_encode;
				$data['u_type']=$this->m_monitor->get_ukuran_type($uc_id_encode);
				$data['uc']=$this->m_monitor->get_uc_detil($uc_id_encode);
				$this->load->view('app/monitor/form/modal_verifikasi',$data);
			}
		}
		function verifikasi_update($uc_id_encode=null)
		{
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('ubah'))
			{
				if($this->input->post('ukuran_type') == 1)
				{
					$uc_id_encode = $this->input->post('uc_id_encode');
					$this->form_validation->set_rules('capaian_verifikasi', 'Hasil verifikasi', 'required|xss_clean|numeric');
					$this->form_validation->set_rules('keterangan', 'Keterangan / Kendala', 'required|xss_clean');
					$check_data_dukung = $this->m_monitor->check_lapor_data_dukung($uc_id_encode);
					if($check_data_dukung == 0) $data['data_dukung']= 'kosong';
					if ($this->form_validation->run() == FALSE || $check_data_dukung == 0) 
					{
						$data['uc_id_encode'] = $uc_id_encode;
						$data['uc']=$this->m_monitor->get_uc_detil($uc_id_encode);
						$this->load->view('app/monitor/form/modal_verifikasi_update',$data);
					} 
					else
					{
						$data_update_capaian = array (
						'capaian' 			=> $this->input->post('capaian_verifikasi'),
						'keterangan' 		=> $this->input->post('keterangan'),
						'status'	 		=> 3
						);
						$this->m_monitor->lapor($uc_id_encode,$data_update_capaian);
						
						$data_insert_logs = array (
						'timestamp' 		=> date('Y-m-d h:i:s'),
						'monitor_ukuran_checkpoint_id'	=> $this->encrypt->decode($uc_id_encode),
						'capaian'	 		=> $this->input->post('capaian_verifikasi'),
						'keterangan'		=> $this->input->post('keterangan'),
						'log_ref_id'	 	=> 4,
						'user_id'	 		=> $this->session->userdata('user_id')
						);
						$this->m_monitor->logs_add($data_insert_logs);
						echo "success";	
					}
				}
				else
				{
					$uc_id_encode = $this->input->post('uc_id_encode');
					$this->form_validation->set_rules('capaian_verifikasi', 'Hasil verifikasi', 'required|xss_clean|numeric');
					$this->form_validation->set_rules('ubah_verifikasi_realisasi_keuangan', 'Hasil verifikasi realisasi keuangan', 'required|xss_clean');
					$this->form_validation->set_rules('ubah_verifikasi_realisasi_fisik', 'Hasil verifikasi realisasi fisik', 'required|xss_clean|numeric');
					$this->form_validation->set_rules('keterangan', 'Keterangan / Kendala', 'required|xss_clean');
					$check_data_dukung = $this->m_monitor->check_lapor_data_dukung($uc_id_encode);
					if($check_data_dukung == 0) $data['data_dukung']= 'kosong';
					if ($this->form_validation->run() == FALSE || $check_data_dukung == 0) 
					{
						$data['uc_id_encode'] = $uc_id_encode;
						$data['uc']=$this->m_monitor->get_uc_detil($uc_id_encode);
						$this->load->view('app/monitor/form/modal_verifikasi_update',$data);
					} 
					else
					{
						$clear_number_ubah_verifikasi_realisasi_anggaran = str_replace('.','',$this->input->post('ubah_verifikasi_realisasi_keuangan'));
						$data_update_capaian = array (
						'capaian' 			=> $this->input->post('capaian_verifikasi'),
						'keterangan' 		=> $this->input->post('keterangan'),
						'realisasi_keuangan'=> $clear_number_ubah_verifikasi_realisasi_anggaran,
						'realisasi_fisik'	=> $this->input->post('ubah_verifikasi_realisasi_fisik'),
						'status'	 		=> 3
						);
						$this->m_monitor->lapor($uc_id_encode,$data_update_capaian);
						
						$data_insert_logs = array (
						'timestamp' 		=> date('Y-m-d h:i:s'),
						'monitor_ukuran_checkpoint_id'	=> $this->encrypt->decode($uc_id_encode),
						'capaian'	 		=> $this->input->post('capaian_verifikasi'),
						'realisasi_keuangan'=> $clear_number_ubah_verifikasi_realisasi_anggaran,
						'realisasi_fisik'	=> $this->input->post('ubah_verifikasi_realisasi_fisik'),
						'keterangan'		=> $this->input->post('keterangan'),
						'log_ref_id'	 	=> 4,
						'user_id'	 		=> $this->session->userdata('user_id')
						);
						$this->m_monitor->logs_add($data_insert_logs);
						echo "success";	
					}
				}
			}
			else 
			{
				$data['uc_id_encode'] = $uc_id_encode;
				$data['u_type']=$this->m_monitor->get_ukuran_type($uc_id_encode);
				$data['uc']=$this->m_monitor->get_uc_detil($uc_id_encode);
				$this->load->view('app/monitor/form/modal_verifikasi_update',$data);
			}
		}
		function tmp_files_list($uc_id_encode)
		{
			$data['data'] = $this->m_monitor->tmp_files_list($uc_id_encode);
			$this->load->view('app/monitor/tmp_files_list',$data);		
		}
		function tmp_file_delete($id,$name)
		{
			$name_file = $name;
			if(is_file('files/'.$name_file)) unlink('files/'.$name_file);
			$this->m_monitor->tmp_file_delete($id);
			echo "success";
		}
		function files_list($uc_id_encode)
		{
			$data['data'] = $this->m_monitor->files_list($uc_id_encode);
			$this->load->view('app/monitor/files_list',$data);		
		}
		function file_delete($id,$name)
		{
			$name_file = $name;
			if(is_file('files/'.$name_file)) unlink('files/'.$name_file);
			$this->m_monitor->file_delete($id);
			echo "success";
		}
		function reindex($monitor_id_encode)
		{
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			if ($this->input->post('reindex'))
			{
				$prioritas_index = 1;
				$program_index = 1;
				$renaksi_index = 1;
				
				$monitor_id_encode = $this->input->post('monitor_id_encode');		
				$prioritas = $this->m_monitor->get_prioritas_list_reindex($monitor_id_encode);
				if($prioritas->num_rows() > 0)
				{
					foreach($prioritas->result() as $row_prioritas)
					{
						$program_id_encode = $this->encrypt->encode($row_prioritas->prioritas_id);
						$program = $this->m_monitor->get_program_list_reindex($program_id_encode);
						if($program->num_rows() > 0)
						{
							foreach ($program->result() as $row_program)
							{
								$renaksi_id_encode = $this->encrypt->encode($row_program->program_id);
								$renaksi = $this->m_monitor->get_renaksi_list_reindex($renaksi_id_encode);
								if($renaksi->num_rows() > 0)
								{
									foreach($renaksi->result() as $row_renaksi)
									{
										$renaksi_id = $row_renaksi->renaksi_id;
										$data_update_renaksi = array (
										'serial'	=> $renaksi_index
										);
										$this->m_monitor->reindex_renaksi($renaksi_id,$data_update_renaksi);
										$renaksi_index++;
									}
								}
								$program_id = $row_program->program_id;
								$data_update_program = array (
								'serial'	=> $program_index
								);
								$this->m_monitor->reindex_program($program_id,$data_update_program);
								$program_index++;
							}
						}
						$prioritas_id = $row_prioritas->prioritas_id;
						$data_update_prioritas = array (
						'serial'	=> $prioritas_index
						);
						$this->m_monitor->reindex_prioritas($prioritas_id,$data_update_prioritas);
						$prioritas_index++;
					}
				}
				echo "success";	
				
			}
			else 
			{
				$data['monitor_id_encode']=$monitor_id_encode;
				$this->load->view('app/monitor/form/modal_reindex',$data);
			}
		}
		function export($id)
		{
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			$id_decode = $this->encrypt->decode($id);
			$data['option_periode'] = $this->m_monitor->option_periode_export($id_decode);
			$data['option_prioritas'] = $this->m_monitor->option_prioritas_export($id_decode);
			$data['option_penanggungjawab'] = $this->m_monitor->option_penanggungjawab_export($id_decode);
			$data['monitor_id'] = $id;
			$this->load->view('app/monitor/form/modal_export',$data);
		}
		function export_unit($id_encode,$penanggung_jawab_encode)
		{
			if (!$this->input->is_ajax_request()) redirect('auth/login');
			$id_decode = $this->encrypt->decode($id_encode);
			$data['option_periode'] = $this->m_monitor->option_periode_export($id_decode);
			$data['option_prioritas'] = $this->m_monitor->option_prioritas_export($id_decode);
			$data['monitor_id'] = $id_encode;
			$data['penanggung_jawab'] = $penanggung_jawab_encode;
			$this->load->view('app/monitor/form/modal_export_unit',$data);
		}
	}
	
	/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */				