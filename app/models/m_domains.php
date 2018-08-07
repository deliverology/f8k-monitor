<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class M_Domains extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
			
			$ci =& get_instance();
		}
		function get_domains()
		{
			$query = $this->db->query(
			"
			SELECT d1.*,d2.`name` as parent_name, type.`name` as type FROM domains d1 INNER JOIN domains d2
			ON d1.parent_id = d2.id INNER JOIN domains_type type
			ON d1.domains_type_id = type.id
			WHERE d1.is_active = 1
			AND d2.is_active = 1
			AND type.is_active = 1
			ORDER BY type.id,d1.name
			"
			);
			return $query;
		}
		function get_domains_paging($per_page,$page)
		{
			$query = $this->db->query(
			"
			SELECT d1.*,d2.`name` as parent_name, type.`name` as type FROM domains d1 INNER JOIN domains d2
			ON d1.parent_id = d2.id INNER JOIN domains_type type
			ON d1.domains_type_id = type.id
			WHERE d1.is_active = 1
			AND d2.is_active = 1
			AND type.is_active = 1
			ORDER BY type.id,d1.name
			LIMIT $page,$per_page
			"
			);
			return $query;
		}
		function get_domains_search($key,$option)
		{
			$this->db->select('d1.*, d2.name as parent_name,type.name as type');
			$this->db->from('domains as d1');
			$this->db->join('domains as d2','d1.parent_id = d2.id','inner');
			$this->db->join('domains_type as type','d1.domains_type_id = type.id','inner');
			if($option == 1){
			$this->db->like('d1.name',$key);	
			}elseif($option == 2){
			$this->db->like('d2.name',$key);	
			}else{
			$this->db->like('type.name',$key);	
			}
			$this->db->where('d1.is_active',1);
			$this->db->where('d2.is_active',1);
			$this->db->where('type.is_active',1);
			$query = $this->db->get();
			return $query;
		}
		function get_domains_search_paging($key,$option,$per_page,$page)
		{
			$this->db->select('d1.*, d2.name as parent_name,type.name as type');
			$this->db->from('domains as d1');
			$this->db->join('domains as d2','d1.parent_id = d2.id','inner');
			$this->db->join('domains_type as type','d1.domains_type_id = type.id','inner');
			if($option == 1){
			$this->db->like('d1.name',$key);	
			}elseif($option == 2){
			$this->db->like('d2.name',$key);	
			}else{
			$this->db->like('type.name',$key);	
			}
			$this->db->where('d1.is_active',1);
			$this->db->where('d2.is_active',1);
			$this->db->where('type.is_active',1);
			$this->db->limit($per_page,$page);
			$query = $this->db->get();
			return $query;
		}
		function domain_delete($domain_id_encode,$data_update)
		{
			$domain_id_decode = $this->encrypt->decode($domain_id_encode);
			$this->db->where('id', $domain_id_decode);
			$this->db->update('domains', $data_update); 
		}
		function get_domain_detil($domain_id_encode)
		{
			$domain_id_decode = $this->encrypt->decode($domain_id_encode);
			$this->db->select('d1.*, d2.name as parent_name,type.name as type');
			$this->db->from('domains as d1');
			$this->db->join('domains as d2','d1.parent_id = d2.id','inner');
			$this->db->join('domains_type as type','d1.domains_type_id = type.id','inner');
			$this->db->where('d1.is_active',1);
			$this->db->where('d2.is_active',1);
			$this->db->where('type.is_active',1);
			$this->db->where('d1.id',$domain_id_decode);
			$query = $this->db->get();
			return $query;
		}
		function option_domain_type()
		{
			$this->db->where('is_active',1);
			$query = $this->db->get('domains_type');
			if ($query->num_rows() > 0)
			{
				foreach ($query->result_array() as $row)
				{
					$domains_type[$row['id']] = $row['name'];
				}
				return $domains_type;
			}
			return null;
		}
		function domain_edit($domain_id_encode,$data_update)
		{
			$domain_id_decode = $this->encrypt->decode($domain_id_encode);
			$this->db->where('id', $domain_id_decode);
			$this->db->update('domains', $data_update); 
		}
		function domain_add($data_insert)
		{
			$this->db->insert('domains',$data_insert);
		}
	}																														