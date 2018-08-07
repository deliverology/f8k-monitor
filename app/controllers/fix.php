<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class Fix extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->model('m_monitor');
			$this->ci =& get_instance();
			backButtonHandle();
		}
		function statistik($id){
			$data = $this->m_monitor->get_monitor_statistik_all($this->encrypt->encode($id));
			var_dump($data);
			}
			
		function statistik_warna($id){
			$data = $this->m_monitor->get_monitor_statistik_all($this->encrypt->encode($id));
			foreach($data as $row){
			$merah = count($row['merah']);
			$gray = count($row['gray']);
			echo "<br>merah : ".$merah;
			echo "<br>gray : ".$gray;
			}
		}
	}
	
	/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */			