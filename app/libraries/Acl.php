<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class Acl
	{
		var $perms = array();       //Array : Stores the permissions for the user
		var $user_id;            //Integer : Stores the ID of the current user
		var $userRoles = array();   //Array : Stores the roles of the current user
		var $ci;
		function __construct($config=array()) {
			$this->ci = &get_instance();
			$this->user_id = floatval($config['user_id']);
			$this->userRoles = $this->getUserRoles();
			$this->user_domains = $this->getUserDomains();
			$this->user_domain_parents = $this->getUserDomainParents();
			$this->user_domain_childs = $this->getUserDomainChilds();
			$this->buildACL();
		}
		
		function buildACL() {
			//first, get the rules for the user's role
			if (count($this->userRoles) > 0)
			{
				$this->perms = array_merge($this->perms,$this->getRolePerms($this->userRoles));
			}
			//then, get the individual user permissions
			$this->perms = array_merge($this->perms,$this->getUserPerms($this->user_id));
		}
		
		function getPermKeyFromID($permID) {
			//$strSQL = "SELECT `permKey` FROM `".DB_PREFIX."permissions` WHERE `ID` = " . floatval($permID) . " LIMIT 1";
			$this->ci->db->select('key');
			$this->ci->db->where('id',floatval($permID));
			$sql = $this->ci->db->get('acl_perm',1);
			$data = $sql->result();
			return $data[0]->key;
		}
		
		function getPermNameFromID($permID) {
			//$strSQL = "SELECT `permName` FROM `".DB_PREFIX."permissions` WHERE `ID` = " . floatval($permID) . " LIMIT 1";
			$this->ci->db->select('name');
			$this->ci->db->where('id',floatval($permID));
			$sql = $this->ci->db->get('acl_perm',1);
			$data = $sql->result();
			return $data[0]->name;
		}
		
		function getRoleNameFromID($roleID) {
			//$strSQL = "SELECT `roleName` FROM `".DB_PREFIX."roles` WHERE `ID` = " . floatval($roleID) . " LIMIT 1";
			$this->ci->db->select('role');
			$this->ci->db->where('id',floatval($roleID),1);
			$sql = $this->ci->db->get('roles');
			$data = $sql->result();
			return $data[0]->role;
		}
		
		function getUserRoles() {
			//$strSQL = "SELECT * FROM `".DB_PREFIX."user_roles` WHERE `user_id` = " . floatval($this->user_id) . " ORDER BY `addDate` ASC";
			
			$this->ci->db->where(array('id'=>floatval($this->user_id)));
			$this->ci->db->order_by('created','asc');
			$sql = $this->ci->db->get('users');
			$data = $sql->result();
			
			$resp = array();
			foreach( $data as $row )
			{
				$resp[] = $row->role_id;
			}
			return $resp;
		}
		
		function getAllRoles($format='ids') {
			$format = strtolower($format);
			//$strSQL = "SELECT * FROM `".DB_PREFIX."roles` ORDER BY `roleName` ASC";
			$this->ci->db->order_by('role','asc');
			$sql = $this->ci->db->get('roles');
			$data = $sql->result();
			
			$resp = array();
			foreach( $data as $row )
			{
				if ($format == 'full')
				{
					$resp[] = array("id" => $row->id,"name" => $row->role);
					} else {
					$resp[] = $row->id;
				}
			}
			return $resp;
		}
		
		function getAllPerms($format='ids') {
			$format = strtolower($format);
			//$strSQL = "SELECT * FROM `".DB_PREFIX."permissions` ORDER BY `permKey` ASC";
			
			$this->ci->db->order_by('key','asc');
			$sql = $this->ci->db->get('acl_perm');
			$data = $sql->result();
			
			$resp = array();
			foreach( $data as $row )
			{
				if ($format == 'full')
				{
					$resp[$row->permKey] = array('id' => $row->id, 'name' => $row->name, 'key' => $row->key);
					} else {
					$resp[] = $row->id;
				}
			}
			return $resp;
		}
		
		function getRolePerms($role) {
			if (is_array($role))
			{
				//$roleSQL = "SELECT * FROM `".DB_PREFIX."role_perms` WHERE `roleID` IN (" . implode(",",$role) . ") ORDER BY `ID` ASC";
				$this->ci->db->where_in('role_id',$role);
				} else {
				//$roleSQL = "SELECT * FROM `".DB_PREFIX."role_perms` WHERE `roleID` = " . floatval($role) . " ORDER BY `ID` ASC";
				$this->ci->db->where(array('role_id'=>floatval($role)));
			}
			
			$this->ci->db->order_by('id','asc');
			$sql = $this->ci->db->get('acl_role_perms'); //$this->db->select($roleSQL);
			$data = $sql->result();
			$perms = array();
			foreach( $data as $row )
			{
				$pK = strtolower($this->getPermKeyFromID($row->perm_id));
				if ($pK == '') { continue; }
				if ($row->value === '1') {
					$hP = true;
					} else {
					$hP = false;
				}
				$perms[$pK] = array('perm' => $pK,'inheritted' => true,'value' => $hP,'name' => $this->getPermNameFromID($row->perm_id),'id' => $row->perm_id);
			}
			return $perms;
		}
		
        function getUserPerms($user_id) {
			//$strSQL = "SELECT * FROM `".DB_PREFIX."user_perms` WHERE `user_id` = " . floatval($user_id) . " ORDER BY `addDate` ASC";
			
			$this->ci->db->where('user_id',floatval($user_id));
			$this->ci->db->order_by('addDate','asc');
			$sql = $this->ci->db->get('acl_user_perms');
			$data = $sql->result();
			
			$perms = array();
			foreach( $data as $row )
			{
				$pK = strtolower($this->getPermKeyFromID($row->perm_id));
				if ($pK == '') { continue; }
				if ($row->value == '1') {
					$hP = true;
					} else {
					$hP = false;
				}
				$perms[$pK] = array('perm' => $pK,'inheritted' => false,'value' => $hP,'name' => $this->getPermNameFromID($row->perm_id),'id' => $row->perm_id);
			}
			return $perms;
		}
		
		function hasRole($roleID) {
			foreach($this->userRoles as $k => $v)
			{
				if (floatval($v) === floatval($roleID))
				{
					return true;
				}
			}
			return false;
		}
		
		function hasPermission($permKey) {
			$permKey = strtolower($permKey);
			if (array_key_exists($permKey,$this->perms))
			{
				if ($this->perms[$permKey]['value'] === '1' || $this->perms[$permKey]['value'] === true)
				{
					return true;
					} else {
					return false;
				}
				} else {
				return false;
			}
		}
		function getUserDomains() {
			
			$this->ci->db->where(array('user_id'=>floatval($this->user_id)));
			$sql = $this->ci->db->get('user_profiles');
			$data = $sql->row();
			$resp = $data->domain_id;
			return $resp;
		}
		function getUserDomainParents() {
			$sql = $this->ci->db->query("SELECT domains.id,domains.parent_id FROM user_profiles AS up,domains WHERE up.domain_id = domains.id AND user_id='".$this->user_id."'");
			$data = $sql->result();
			
			$resp = array();
			
			
			$i = 0;
			
			foreach( $data as $row )
			{
				
				$resp[$i] = $row->parent_id;
				
				$row_parent = $this->getDomainParents($resp[$i]);
				if($row_parent) {
					$i++;
					$resp[$i] = $row_parent->parent_id;
					$row_parent = $this->getDomainParents($resp[$i]);
				}
				
				$i++;
			}
			
			
			return $resp;
		}
		
		function getUserDomainChilds() {
			$sql = $this->ci->db->query("SELECT domains.id,domains.parent_id FROM user_profiles AS up,domains WHERE (up.domain_id = domains.id OR up.domain_id = domains.parent_id) AND user_id='".$this->user_id."'");
			$data = $sql->result();
			
			$resp = array();
			
			
			$i = 0;
			
			foreach( $data as $row )
			{
				
				$resp[$i] = $row->id;
				$row_child = $this->getDomainChilds($resp[$i]);
				if($row_child) {
					$i++;
					$resp[$i] = $row_child->id;
					$row_child = $this->getDomainChilds($resp[$i]);
				}
				
				$i++;
			}
			
			
			return $resp;
		}
		
		function getDomainParents($domain) {
			$this->ci->db->where(array('id'=>floatval($domain)));
			$sql = $this->ci->db->get('domains');
			return $sql->row();
		}
		function getDomainChilds($domain) {
			$this->ci->db->where(array('parent_id'=>floatval($domain)));
			$sql = $this->ci->db->get('domains');
			return $sql->row();
		}
	}		