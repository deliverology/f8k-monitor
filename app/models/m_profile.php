<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class M_Profile extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
			
			$ci =& get_instance();
		}
		function get_profile(){
			$user_id = $this->tank_auth->get_user_id();
			$query = $this->db->query("
			SELECT u.id,u.username,u.email,r.role,up.`name`,up.position,up.phone FROM user_profiles up INNER JOIN users u
			ON up.user_id = u.id INNER JOIN roles r
			ON u.role_id = r.id
			WHERE u.id = ?
			",array($user_id));
			return $query;
		}
		function change_email($user_id,$data_update)
		{
			$this->db->where('id', $user_id);
			$this->db->update('users', $data_update);
		}
		function edit_data($user_id,$data_update)
		{
			$this->db->where('user_id', $user_id);
			$this->db->update('user_profiles', $data_update);
		}
	}																														