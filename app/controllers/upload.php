<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Upload extends CI_Controller {
		
		function __construct()
		{
			parent::__construct();
			$this->CI =& get_instance();
			
		}
		public function lapor($uc_id_encode)
		{
			$uc_id_decode = $this->encrypt->decode($uc_id_encode);
			$upload_dir = 'files/';
			if (!is_dir($upload_dir)) {
				mkdir($upload_dir);
			}
			chmod($upload_dir, 0777) ;
			$config['upload_path'] = $upload_dir;
			$config['allowed_types'] = '*';
			$config['max_size'] = 0;
			$this->load->library('upload', $config);
			
			if (!$this->upload->do_upload("userfile"))
			{
				$response = $this->upload->display_errors();
			}
			else
			{
				$upload_data = $this->upload->data();
				$data_insert = array (
					'monitor_ukuran_checkpoint_id' 		=> $uc_id_decode,
					'user_id' 			=> $this->session->userdata('user_id'),
					'name' 				=> $upload_data['file_name'],
					'created' 			=> date('Y-m-d h:i:s'),
					'status' 			=> 0
					);
				$this->m_monitor->tmp_file_add($data_insert);
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		}
		
		public function lapor_update($uc_id_encode)
		{
			$uc_id_decode = $this->encrypt->decode($uc_id_encode);
			$upload_dir = 'files/';
			if (!is_dir($upload_dir)) {
				mkdir($upload_dir);
			}
			chmod($upload_dir, 0777) ;
			$config['upload_path'] = $upload_dir;
			$config['allowed_types'] = '*';
			$config['max_size'] = 0;
			$this->load->library('upload', $config);
			
			if (!$this->upload->do_upload("userfile"))
			{
				$response = $this->upload->display_errors();
			}
			else
			{
				$upload_data = $this->upload->data();
				$data_insert = array (
					'monitor_ukuran_checkpoint_id' 		=> $uc_id_decode,
					'user_id' 			=> $this->session->userdata('user_id'),
					'name' 				=> $upload_data['file_name'],
					'created' 			=> date('Y-m-d h:i:s'),
					);
				$this->m_monitor->monitor_lampiran_add($data_insert);
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		}
		
		public function verifikasi($username)
		{
			$upload_dir = 'files/';
			if (!is_dir($upload_dir)) {
				mkdir($upload_dir);
			}
			chmod($upload_dir, 0777) ;
			$config['upload_path'] = $upload_dir;
			$config['allowed_types'] = '*';
			$config['max_size'] = 0;
			$this->load->library('upload', $config);
			
			if (!$this->upload->do_upload("userfile"))
			{
				$response = $this->upload->display_errors();
			}
			else
			{
				$upload_data = $this->upload->data();
				$data_insert = array (
					'username' 		=> $username,
					'name' 			=> $upload_data['file_name']
					);
				//$this->m_admin->tmp_file_add($data_insert);
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		}
	}
	
	/* End of file uploadify.php */
	/* Location: ./application/controllers/uploadify.php */
