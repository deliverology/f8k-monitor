<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class M_Checkpoint extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
			
			$ci =& get_instance();
		}
		function get_monitor_checkpoint()
		{
			$this->db->where('is_active',1);
			$this->db->order_by('id asc');
			$query = $this->db->get('monitor');
			return $query;
		}
		function get_monitor_checkpoint_paging($per_page,$page)
		{
			$this->db->select('monitor.*,monitor_type.name as type');
			$this->db->from('monitor');
			$this->db->join('monitor_type','monitor.monitor_type_id = monitor_type.id','inner');
			$this->db->where('monitor.is_active',1);
			$this->db->where('monitor_type.is_active',1);
			$this->db->order_by('monitor.name'); 
			$this->db->limit($per_page,$page);
			$query = $this->db->get();
			return $query;
		}
		function get_monitor_checkpoint_search($key,$option)
		{
			$this->db->select('monitor.*,monitor_type.name as type');
			$this->db->from('monitor');
			$this->db->join('monitor_type','monitor.monitor_type_id = monitor_type.id','inner');
			if($option == 1){
			$this->db->like('monitor.name',$key);	
			}else{
			$this->db->like('monitor_type.name',$key);	
			}
			$this->db->where('monitor.is_active',1);
			$this->db->where('monitor_type.is_active',1);
			$this->db->order_by('monitor.name'); 
			$query = $this->db->get();
			return $query;
		}
		function get_monitor_checkpoint_search_paging($key,$option,$per_page,$page)
		{
			$this->db->select('monitor.*,monitor_type.name as type');
			$this->db->from('monitor');
			$this->db->join('monitor_type','monitor.monitor_type_id = monitor_type.id','inner');
			if($option == 1){
			$this->db->like('monitor.name',$key);	
			}else{
			$this->db->like('monitor_type.name',$key);	
			}
			$this->db->where('monitor.is_active',1);
			$this->db->where('monitor_type.is_active',1);
			$this->db->order_by('monitor.name'); 
			$this->db->limit($per_page,$page);
			$query = $this->db->get();
			return $query;
		}
		function get_monitor_status($monitor_id_encode)
		{
			$monitor_id_decode = $this->encrypt->decode($monitor_id_encode);
			$this->db->where('id',$monitor_id_decode);
			$this->db->where('is_active',1);
			$query = $this->db->get('monitor');
			return $query;
		}
		function monitor_status_edit($monitor_id_encode,$data_update)
		{
			$monitor_id_decode = $this->encrypt->decode($monitor_id_encode);
			$this->db->where('id',$monitor_id_decode);
			$this->db->update('monitor',$data_update);
		}
		function checkpoint_status_edit($checkpoint_id_encode,$data_update)
		{
			$checkpoint_id_decode = $this->encrypt->decode($checkpoint_id_encode);
			$this->db->where('id',$checkpoint_id_decode);
			$this->db->update('monitor_checkpoint',$data_update);
		}
		function get_checkpoint_list($monitor_id_encode)
		{
			$monitor_id_decode = $this->encrypt->decode($monitor_id_encode);
			$this->db->select('monitor_checkpoint.*,monitor.name as monitor_name');
			$this->db->from('monitor_checkpoint');
			$this->db->join('monitor','monitor_checkpoint.monitor_id = monitor.id','inner');
			$this->db->where('monitor_checkpoint.monitor_id',$monitor_id_decode);
			$this->db->where('monitor_checkpoint.is_active',1);
			$this->db->where('monitor.is_active',1);
			$query = $this->db->get();
			return $query;
		}
		function get_monitor_name($monitor_id_encode)
		{
			$monitor_id_decode = $this->encrypt->decode($monitor_id_encode);
			$this->db->where('id',$monitor_id_decode);
			$query = $this->db->get('monitor');
			return $query;
		}
		function get_checkpoint_status($checkpoint_id_encode)
		{
			$checkpoint_id_decode = $this->encrypt->decode($checkpoint_id_encode);
			$this->db->select('monitor_checkpoint.*,monitor.name as monitor_name');
			$this->db->from('monitor_checkpoint');
			$this->db->join('monitor','monitor_checkpoint.monitor_id = monitor.id','inner');
			$this->db->where('monitor_checkpoint.id',$checkpoint_id_decode);
			$this->db->where('monitor_checkpoint.is_active',1);
			$this->db->where('monitor.is_active',1);
			$query = $this->db->get();
			return $query;
		}
		function checkpoint_delete($checkpoint_id_encode,$data_update)
		{
			$checkpoint_id_decode = $this->encrypt->decode($checkpoint_id_encode);
			$this->db->where('id',$checkpoint_id_decode);
			$this->db->update('monitor_checkpoint',$data_update);
		}
		function get_monitor($search)
		{
			$this->db->where('is_active', 1);
			$this->db->like('name', $search);
			$this->db->or_like('name_code', $search); 
			$query = $this->db->get('monitor');
			$arr = array();
			if ($query->num_rows() > 0)
			{
				foreach ($query->result_array() as $row)
				{
					$temp['id'] =$this->encrypt->encode($row['id']);
					$temp['name']=$row['name'];
					array_push($arr,$temp);
				}
				return $arr;
			}
		}
		function get_monitor_prepopulate($monitor=0)
		{
			$monitor_in =  explode(',',$monitor);
			$this->db->select('id,name');
			$this->db->where_in('id', $monitor_in);
			$this->db->where('is_active', 1);
			$query = $this->db->get('monitor');
			$domains_prepopulate = array();
			$arr = array();
			if ($query->num_rows() > 0)
			{
				foreach ($query->result_array() as $row)
				{
					$temp['id'] =$this->encrypt->encode($row['id']);
					$temp['name']=$row['name'];
					array_push($arr,$temp);
				}
				return $arr;
			}	
		}
		function get_checkpoint_detil($checkpoint_id_encode)
		{
			$checkpoint_id_decode = $this->encrypt->decode($checkpoint_id_encode);
			$this->db->where('id',$checkpoint_id_decode);
			$this->db->where('is_active',1);
			$query = $this->db->get('monitor_checkpoint');
			return $query;
		}
		function checkpoint_add($data_insert)
		{
			$this->db->insert('monitor_checkpoint',$data_insert);
		}
		function checkpoint_edit($checkpoint_id_encode,$data_update)
		{
			$checkpoint_id_decode = $this->encrypt->decode($checkpoint_id_encode);
			$this->db->where('id',$checkpoint_id_decode);
			$this->db->update('monitor_checkpoint',$data_update);
		}
		
	}																														