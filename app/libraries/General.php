<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class General {
		
		function __construct()
		{
			$this->ci =& get_instance();
			$this->ci->load->database();
			$this->ci->load->model('m_monitor');
		}
		function checkLogin() {
			if (!$this->ci->tank_auth->is_logged_in()) {
				redirect('/auth/login/');
				} else {
				$this->loadACL();
			}
		}
		function loadACL() {
			$config = array('user_id'=>$this->ci->tank_auth->get_user_id());
			$this->ci->load->library('acl',$config);
		}
		function checkPerms($key) {
			$access = $this->ci->acl->hasPermission($key); 
			if (!$access) {
				redirect('error');
			}
		}
		function checkDecodeNumber($key) { 
			$numeric = is_numeric($key); 
			if (!$numeric) {
				redirect('error');
			}
		}
		function getNextSerial($id_decode,$type) {
			switch($type) {
				case 'prioritas' :
				$query = $this->ci->m_monitor->get_prioritas_serial($id_decode);
				if($query->num_rows()>0) {
					$row = $query->row();
					$serial = $row->serial+1;
					return $serial;
				} else return 1;
				break;
				case 'program' :
				$query_monitor = $this->ci->m_monitor->get_pre_program_serial($id_decode);
				if($query_monitor->num_rows()>0) {
					$row_monitor = $query_monitor->row();
					$monitor_id = $row_monitor->id;
				}
				$query = $this->ci->m_monitor->get_program_serial($monitor_id);
				if($query->num_rows()>0) {
					$row = $query->row();
					$serial = $row->serial+1;
					return $serial;
				} else return 1;
				break;
				case 'renaksi' :
				$query_monitor = $this->ci->m_monitor->get_pre_renaksi_serial($id_decode);
				if($query_monitor->num_rows()>0) {
					$row_monitor = $query_monitor->row();
					$monitor_id = $row_monitor->id;
				}
				$query = $this->ci->m_monitor->get_renaksi_serial($monitor_id);
				if($query->num_rows()>0) {
					$row = $query->row();
					$serial = $row->serial+1;
					return $serial;
				} else return 1;
				break;
			}
		}
		function convert_date_id($date)
		{
			
			$format = array(
			'Sun' => 'Minggu',
			'Mon' => 'Senin',
			'Tue' => 'Selasa',
			'Wed' => 'Rabu',
			'Thu' => 'Kamis',
			'Fri' => 'Jumat',
			'Sat' => 'Sabtu',
			'Jan' => 'Januari',
			'Feb' => 'Februari',
			'Mar' => 'Maret',
			'Apr' => 'April',
			'May' => 'Mei',
			'Jun' => 'Juni',
			'Jul' => 'Juli',
			'Aug' => 'Agustus',
			'Sep' => 'September',
			'Oct' => 'Oktober',
			'Nov' => 'November',
			'Dec' => 'Desember'
			);
			
			return strtr($date, $format);
		}
	}
