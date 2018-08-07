<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class M_Setting extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
			
			$ci =& get_instance();
		}
		function get_users(){
			$query = $this->db->query("
			SELECT u.id as user_id,u.username as username,u.email as email,banned,r.role,d.`name` as domain_name FROM users u INNER JOIN user_profiles up 
			ON up.user_id = u.id INNER JOIN domains d
			ON up.domain_id = d.id INNER JOIN roles r
			ON u.role_id = r.id
			ORDER BY u.username
			");
			return $query;
		}
		function get_users_paging($per_page,$page){
			$query = $this->db->query("
			SELECT u.id as user_id,u.username as username,u.email as email,banned,r.role,d.`name` as domain_name FROM users u INNER JOIN user_profiles up 
			ON up.user_id = u.id INNER JOIN domains d
			ON up.domain_id = d.id INNER JOIN roles r
			ON u.role_id = r.id
			ORDER BY u.username
			LIMIT $page,$per_page
			");
			return $query;
		}
		function get_users_search($key,$option){
			$this->db->select('users.id as user_id,users.username as username,users.email as email,users.banned,roles.role,domains.`name` as domain_name');
			$this->db->from('users');
			$this->db->join('user_profiles','user_profiles.user_id = users.id','inner');
			$this->db->join('domains','user_profiles.domain_id = domains.id','inner');
			$this->db->join('roles','users.role_id = roles.id','inner');
			if($option == 1){
			$this->db->like('users.username',$key);	
			}elseif($option == 2){
			$this->db->like('users.email',$key);	
			}else{
			$this->db->like('domains.name',$key);	
			}
			$query = $this->db->get();
			return $query;
		}
		function get_users_search_paging($key,$option,$per_page,$page){
			$this->db->select('users.id as user_id,users.username as username,users.email as email,users.banned,roles.role,domains.`name` as domain_name');
			$this->db->from('users');
			$this->db->join('user_profiles','user_profiles.user_id = users.id','inner');
			$this->db->join('domains','user_profiles.domain_id = domains.id','inner');
			$this->db->join('roles','users.role_id = roles.id','inner');
			if($option == 1){
			$this->db->like('users.username',$key);	
			}elseif($option == 2){
			$this->db->like('users.email',$key);	
			}else{
			$this->db->like('domains.name',$key);	
			}
			$this->db->limit($per_page,$page);
			$query = $this->db->get();
			return $query;
		}
		function get_roles(){
			$query = $this->db->get('roles');
			if ($query->num_rows() > 0)
			{
				foreach ($query->result() as $row)
				{
					$result[0]= '- Pilih Tingkatan Penggunan -';
					$result[$row->id]= $row->role;
				}
				return $result;
			}
		}
		function roles()
		{
			$query = $this->db->get('roles');
			return $query;
		}
		function get_user_detil($id){
			$id_decode = $this->encrypt->decode($id);
			$query = $this->db->query("
			SELECT u.id,u.email,u.username,u.banned,d.id as domain_id,u.role_id,up.`name`,up.position,up.phone FROM user_profiles up INNER JOIN users u
			ON up.user_id = u.id INNER JOIN domains d
			ON up.domain_id = d.id
			WHERE u.id = ?
			",array($id_decode));
			return $query;
		}
		function get_role_detil($id){
			$id_decode = $this->encrypt->decode($id);
			$this->db->where('id',$id_decode);
			$query = $this->db->get('roles');
			return $query;
		}
		function get_permissions()
		{
			$this->db->order_by('key asc');
			$query = $this->db->get('acl_perm');
			return $query;
		}
		function get_acl_detil($id_encode)
		{
			$id_decode = $this->encrypt->decode($id_encode);
			$query = $this->db->query("
			SELECT acl.id acl_id,acl.`value` as acl_value, perm.`type` as `type`,perm.key, r.role as role,r.id as role_id FROM acl_role_perms acl INNER JOIN acl_perm perm
			ON acl.perm_id = perm.id INNER JOIN roles r
			ON acl.role_id = r.id
			WHERE acl.role_id = ?
			ORDER BY perm.key ASC
			",array($id_decode));
			return $query;
		}
		function reset_password($id,$data_update)
		{
			$id_decode = $this->encrypt->decode($id);
			$this->db->where('id', $id_decode);
			$this->db->update('users', $data_update); 
		}
		function user_edit($id,$data_update)
		{
			$id_decode = $this->encrypt->decode($id);
			$this->db->where('users.id', $id_decode);
			$this->db->update('users inner join user_profiles on user_profiles.user_id = users.id', $data_update); 
		}
		function user_delete($id)
		{
			$id_decode = $this->encrypt->decode($id);
			$this->db->where('id', $id_decode);
			$this->db->delete('users');
			$this->user_delete_profile($id_decode);
		}
		function user_delete_profile($id_decode)
		{
			$this->db->where('user_id', $id_decode);
			$this->db->delete('user_profiles');
		}
		function role_add($data_insert)
		{
			$this->db->insert('roles', $data_insert);
			$id_insert = $this->db->insert_id();
			$query = $this->db->query(
			"
			SELECT id,`key` FROM acl_perm WHERE NOT EXISTS
			(SELECT * FROM acl_role_perms 
			WHERE acl_perm.id = acl_role_perms.perm_id
			AND acl_role_perms.role_id = ? )
			ORDER BY id
			",array($id_insert));
			if($query->num_rows() > 0)
			{
				foreach($query->result() as $row)
				{
					$data_insert = array (
					'role_id' 				=> $id_insert,
					'perm_id' 				=> $row->id,
					'value' 				=> 0,
					'addDate' 				=> date('Y-m-d h:i:s')
					);
					$this->db->insert('acl_role_perms', $data_insert);
				}	
			}
			
		}
		function role_edit($id,$data_update)
		{
			$id_decode = $this->encrypt->decode($id);
			$this->db->where('id', $id_decode);
			$this->db->update('roles', $data_update); 
		}
		function module_add($data_insert)
		{
			$this->db->insert('acl_perm', $data_insert);
			$id_insert = $this->db->insert_id();
			$query = $this->db->query(
			"
			SELECT id,role FROM roles WHERE NOT EXISTS
			(SELECT * FROM acl_role_perms 
			WHERE roles.id = acl_role_perms.role_id
			AND acl_role_perms.perm_id = ? )
			ORDER BY id
			",array($id_insert));
			if($query->num_rows() > 0)
			{
				foreach($query->result() as $row)
				{
					$data_insert = array (
					'role_id' 				=> $row->id,
					'perm_id' 				=> $id_insert,
					'value' 				=> 0,
					'addDate' 				=> date('Y-m-d h:i:s')
					);
					$this->db->insert('acl_role_perms', $data_insert);
				}	
			}
		}
		function module_delete($id_decode)
		{
			$this->db->where('id', $id_decode);
			$this->db->delete('acl_perm');
			$this->acl_delete_by_key($id_decode);
		}
		function acl_delete_by_key($id_decode)
		{
			$this->db->where('perm_id', $id_decode);
			$this->db->delete('acl_role_perms');
		}
		function acl_edit($id_encode)
		{
			$id_decode = $this->encrypt->decode($id_encode);
			$query = $this->db->query("SELECT * FROM acl_role_perms WHERE id = ?",array($id_decode));
			$status = $query->row();
			if ($status->value == 1) $value = 0;
			else $value = 1;
			$data_update = array (
			'value'				=> $value
			);
			
			$this->db->where('id', $id_decode);
			$this->db->update('acl_role_perms', $data_update);
			
		}
	}																														