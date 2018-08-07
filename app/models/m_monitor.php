<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
	class M_monitor extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
			
			$ci =& get_instance();
		}
		function get_monitor_verifikator()
		{
			$user_domain = $this->acl->getUserDomains();
			if($this->acl->hasRole(1)){
				
			}
			elseif ($this->acl->hasRole(2)){
				$this->db->like('verifikator_domains_id', $user_domain);
			}
			elseif($this->acl->hasRole(3)){
				$this->db->where('monitor_type_id', 1);
				$this->db->like('verifikator_domains_id', $user_domain);
			}
			elseif($this->acl->hasRole(4)){
				$this->db->where('monitor_type_id', 2);
				$this->db->like('verifikator_domains_id', $user_domain);
			}
			$this->db->where('is_active', 1);	
			$this->db->where('status <', 3);
			$this->db->order_by('name asc'); 
			$query = $this->db->get('monitor');
			return $query;
		}
		function get_monitor_observer()
		{
			$user_domain = $this->acl->getUserDomains();
			$this->db->like('observer_domains_id', $user_domain);
			$this->db->where('is_active', 1);	
			$this->db->where('status =', 2);
			$this->db->order_by('name asc'); 
			$query = $this->db->get('monitor');
			return $query;
		}
		function get_monitor_arsip()
		{
			$user_domain = $this->acl->getUserDomains();
			if($this->acl->hasRole(1)){
				
			}
			elseif ($this->acl->hasRole(2)){
				$this->db->like('verifikator_domains_id', $user_domain);
			}
			elseif($this->acl->hasRole(3)){
				$this->db->where('monitor_type_id', 1);
				$this->db->like('verifikator_domains_id', $user_domain);
			}
			elseif($this->acl->hasRole(4)){
				$this->db->where('monitor_type_id', 2);
				$this->db->like('verifikator_domains_id', $user_domain);
			}
			$this->db->where('is_active', 1);	
			$this->db->where('status =', 3);
			$this->db->order_by('name asc'); 
			$query = $this->db->get('monitor');
			return $query;
		}
		function get_monitor_arsip_observer()
		{
			$user_domain = $this->acl->getUserDomains();
			$this->db->like('observer_domains_id', $user_domain);
			$this->db->where('is_active', 1);	
			$this->db->where('status =', 3);
			$this->db->order_by('name asc'); 
			$query = $this->db->get('monitor');
			return $query;
		}
		function get_monitor_koordinasi_observer()
		{
			$user_domain = $this->acl->getUserDomains();
			$this->db->select('v_monitor_f8k.*,domains.name as domain_name');
			$this->db->from('v_monitor_f8k');
			$this->db->join('domains','v_monitor_f8k.kriteria_penanggung_jawab = domains.id','inner');
			$this->db->like('monitor_observer', $user_domain);
			$this->db->group_by('v_monitor_f8k.kriteria_penanggung_jawab');
			$this->db->order_by('domains.name asc'); 
			$query = $this->db->get();
			return $query;
		}
		function get_monitor_koordinasi()
		{
			$user_domain = $this->acl->getUserDomains();
			$this->db->select('v_monitor_f8k.*,domains.name as domain_name');
			$this->db->from('v_monitor_f8k');
			$this->db->join('domains','v_monitor_f8k.kriteria_penanggung_jawab = domains.id','inner');
			if($this->acl->hasRole(1)){
				
			}
			elseif ($this->acl->hasRole(2)){
				$this->db->like('monitor_verifikator', $user_domain);
			}
			elseif($this->acl->hasRole(3)){
				$this->db->where('monitor_type', 1);
				$this->db->like('monitor_verifikator', $user_domain);
			}
			elseif($this->acl->hasRole(4)){
				$this->db->where('monitor_type', 2);
				$this->db->like('monitor_verifikator', $user_domain);
			}
			$this->db->group_by('v_monitor_f8k.kriteria_penanggung_jawab');
			$this->db->order_by('domains.name asc'); 
			$query = $this->db->get();
			return $query;
		}
		function get_monitor_unit($id_encode)
		{
			$id_decode = $this->encrypt->decode($id_encode);
			$this->db->select('v_monitor_f8k.*,domains.name as domain_name');
			$this->db->from('v_monitor_f8k');
			$this->db->join('domains','v_monitor_f8k.kriteria_penanggung_jawab = domains.id','inner');
			$this->db->where('v_monitor_f8k.kriteria_penanggung_jawab',$id_decode);
			$this->db->where('v_monitor_f8k.monitor_status =', 2);
			$this->db->group_by('v_monitor_f8k.monitor_id');
			$this->db->order_by('monitor_name asc'); 
			$query = $this->db->get();
			return $query;
		}
		function get_monitor_arsip_unit($id_encode)
		{
			$id_decode = $this->encrypt->decode($id_encode);
			$this->db->select('v_monitor_f8k.*,domains.name as domain_name');
			$this->db->from('v_monitor_f8k');
			$this->db->join('domains','v_monitor_f8k.kriteria_penanggung_jawab = domains.id','inner');
			$this->db->where('v_monitor_f8k.kriteria_penanggung_jawab',$id_decode);
			$this->db->where('v_monitor_f8k.monitor_status =', 3);
			$this->db->group_by('v_monitor_f8k.monitor_id');
			$this->db->order_by('domain_name asc'); 
			$query = $this->db->get();
			return $query;
		}
		function get_monitor_claimant()
		{
			if($this->acl->hasRole(5)){
				$where1 = "";
				$where2 = "";
			}
			elseif ($this->acl->hasRole(6)){
				$where1 = "$this->db->like('verifikator_domains_id', '".$this->acl->getUserDomains()."'); ";
				$where2 = "";
			}
			echo $where1;
			echo $where2;
			$this->db->where('is_active', 1);	
			$this->db->where('status <', 3); 
			$query = $this->db->get('monitor');
			return $query;
		}
		function get_monitor_type()
		{
			$this->db->where('is_active', 1);
			$query = $this->db->get('monitor_type');
			if ($query->num_rows() > 0)
			{
				foreach ($query->result_array() as $row)
				{
					$type[$row['id']]=$row['name'];
				}
				return $type;
			}
			return null;
		}
		function get_monitor_detil($id=0)
		{
			$id_decode =  $this->encrypt->decode($id);
			$this->db->where('id', $id_decode);
			$this->db->where('is_active', 1);
			$query = $this->db->get('monitor');
			return $query;
		}
		function get_monitor_jmlh_anggaran($id=0)
		{
			$id_decode =  $this->encrypt->decode($id);
			$this->db->select('m.name as monitor_name, sum(u.anggaran) as jml_anggaran, u.type');
			$this->db->from('monitor_ukuran as u');
			$this->db->join('monitor_kriteria as k','u.kriteria_id = k.id','inner');
			$this->db->join('monitor_renaksi as r','k.renaksi_id = r.id','inner');
			$this->db->join('monitor_program as pro','r.program_id = pro.id','inner');
			$this->db->join('monitor_prioritas as pri','pro.prioritas_id = pri.id','inner');
			$this->db->join('monitor as m','pri.monitor_id = m.id','inner');
			$this->db->where('u.is_active',1);
			$this->db->where('k.is_active',1);
			$this->db->where('r.is_active',1);
			$this->db->where('pro.is_active',1);
			$this->db->where('pri.is_active',1);
			$this->db->where('m.is_active',1);
			$this->db->where('m.id',$id_decode);
			$this->db->group_by('m.id');
			$query = $this->db->get();
			return $query;
		}
		function get_single_monitor_detil($id=0)
		{
			$id_decode =  $this->encrypt->decode($id);
			$this->db->where('id', $id_decode);
			$this->db->where('is_active', 1);
			$query = $this->db->get('monitor');
			return $query;
		}
		function get_prioritas_list($monitor_id_encode)
		{
			$monitor_id_decode = $this->encrypt->decode($monitor_id_encode);
			$query = $this->db->query("
			select pri.id as prioritas_id,pri.`name` as prioritas_name, pri.serial as prioritas_serial, m.id as monitor_id,m.name as monitor_name,m.name_code as monitor_code
			from monitor_prioritas pri INNER JOIN monitor m
			on pri.monitor_id = m.id
			WHERE m.is_active = 1 AND pri.is_active = 1 AND m.id = ?
			ORDER BY prioritas_serial
			",array($monitor_id_decode));
			return $query;
		}
		function get_prioritas_list_reindex($monitor_id_encode)
		{
			$monitor_id_decode = $this->encrypt->decode($monitor_id_encode);
			$query = $this->db->query("
			select pri.id as prioritas_id,pri.`name` as prioritas_name, pri.serial as prioritas_serial
			from monitor_prioritas pri INNER JOIN monitor m
			on pri.monitor_id = m.id
			WHERE m.is_active = 1 AND pri.is_active = 1 AND m.id = ?
			ORDER BY pri.id ASC
			",array($monitor_id_decode));
			return $query;
		}
		function get_prioritas_info($id=0)
		{
			$id_decode =  $this->encrypt->decode($id);
			$query = $this->db->query("
			select m.id as monitor_id, m.`name` as monitor_name, m.name_code as monitor_code,m.status as monitor_status,pri.id as prioritas_id, pri.`name` as prioritas_name, pri.serial as prioritas_serial
			FROM monitor_prioritas pri INNER JOIN monitor m
			on pri.monitor_id=m.id
			WHERE pri.is_active=1 
			AND m.is_active=1
			AND pri.id= ?
			",array($id_decode));
			return $query;
		}
		function get_prioritas_detil($id=0)
		{
			$id_decode =  $this->encrypt->decode($id);
			$this->db->where('id', $id_decode);
			$this->db->where('is_active', 1);
			$query = $this->db->get('monitor_prioritas');
			return $query;
		}
		function get_program_list($prioritas_id_encode)
		{
			$prioritas_id_decode = $this->encrypt->decode($prioritas_id_encode);
			$query = $this->db->query("
			select pro.id as program_id, pro.`name` as program_name,pro.serial as program_serial	,pri.id as prioritas_id,pri.`name` as prioritas_name, pri.serial as prioritas_serial,m.id as monitor_id,m.name as monitor_name,m.name_code as monitor_code
			from monitor_program pro INNER JOIN monitor_prioritas pri
			on pro.prioritas_id = pri.id INNER JOIN monitor m
			on pri.monitor_id = m.id
			WHERE m.is_active = 1 AND pri.is_active = 1 AND pro.is_active = 1 AND pri.id = ?
			ORDER BY pro.serial
			",array($prioritas_id_decode));
			return $query;
			
		}
		function get_program_list_box($monitor_id_encode)
		{
			$monitor_id_decode = $this->encrypt->decode($monitor_id_encode);
			$query = $this->db->query("
			SELECT m.id as monitor_id,m.name_code as monitor_code, m.`status` as monitor_status,pri.serial as prioritas_serial,
			pro.id as program_id, pro.`name` as program_name, pro.serial as program_serial
			FROM monitor_program pro INNER JOIN monitor_prioritas pri 
			on pro.prioritas_id = pri.id INNER JOIN monitor m
			ON pri.monitor_id  = m.id
			WHERE pro.is_active = 1
			AND pri.is_active = 1
			AND m.is_active = 1
			AND m.id = ?
			GROUP BY pro.id
			",array($monitor_id_decode));
			return $query;
			
		}
		function get_program_list_reindex($prioritas_id_encode)
		{
			$prioritas_id_decode = $this->encrypt->decode($prioritas_id_encode);
			$query = $this->db->query("
			select pro.id as program_id, pro.`name` as program_name,pro.serial as program_serial	,pri.id as prioritas_id,pri.`name` as prioritas_name, pri.serial as prioritas_serial,m.id as monitor_id,m.name as monitor_name,m.name_code as monitor_code
			from monitor_program pro INNER JOIN monitor_prioritas pri
			on pro.prioritas_id = pri.id INNER JOIN monitor m
			on pri.monitor_id = m.id
			WHERE m.is_active = 1 AND pri.is_active = 1 AND pro.is_active = 1 AND pri.id = ?
			ORDER BY pro.id
			",array($prioritas_id_decode));
			return $query;
			
		}
		function get_program_info($id=0)
		{
			$id_decode =  $this->encrypt->decode($id);
			$query = $this->db->query("
			SELECT
			m.id as monitor_id, m.`name` as monitor_name, m.name_code as monitor_code,m.status as monitor_status,pri.id as prioritas_id, pri.`name` as prioritas_name, pri.serial as prioritas_serial,
			pro.id as program_id, pro.`name` as program_name, pro.serial as program_serial
			FROM monitor_program pro 
			INNER JOIN monitor_prioritas pri on pro.prioritas_id = pri.id
			INNER JOIN monitor m on pri.monitor_id = m.id
			WHERE m.is_active = 1 AND pri.is_active = 1
			AND pro.is_active = 1 AND pro.id = ?
			",array($id_decode));
			return $query;
		}
		function get_program_detil($id=0)
		{
			$id_decode =  $this->encrypt->decode($id);
			$this->db->where('id', $id_decode);
			$this->db->where('is_active', 1);
			$query = $this->db->get('monitor_program');
			return $query;
		}
		function get_renaksi_list($program_id_encode)
		{
			$program_id_decode = $this->encrypt->decode($program_id_encode);
			$query = $this->db->query("
			SELECT r.id as renaksi_id,r.name as renaksi_name,r.serial as renaksi_serial,
			m.id as monitor_id, m.`name` as monitor_name, m.name_code as monitor_code,
			pri.id as prioritas_id, pri.`name` as prioritas_name, pri.serial as prioritas_serial,
			pro.id as program_id, pro.`name` as program_name, pro.serial as program_serial
			FROM monitor_renaksi r
			INNER JOIN monitor_program pro on r.program_id = pro.id
			INNER JOIN monitor_prioritas pri on pro.prioritas_id = pri.id
			INNER JOIN monitor m on pri.monitor_id = m.id
			WHERE m.is_active = 1 AND pri.is_active = 1
			AND pro.is_active = 1 AND r.is_active = 1
			AND pro.id = ?
			",array($program_id_decode));
			return $query;
		}
		function get_renaksi_list_box($monitor_id_encode)
		{
			$monitor_id_decode = $this->encrypt->decode($monitor_id_encode);
			$query = $this->db->query("
			SELECT r.id as renaksi_id, r.`name` as renaksi_name, r.serial as renaksi_serial,m.id as monitor_id,m.name_code as monitor_code, m.`status` as monitor_status,pri.serial as prioritas_serial,
			pro.id as program_id, pro.`name` as program_name, pro.serial as program_serial
			FROM monitor_renaksi r INNER JOIN monitor_program pro 
			ON r. program_id = pro.id INNER JOIN monitor_prioritas pri 
			on pro.prioritas_id = pri.id INNER JOIN monitor m
			ON pri.monitor_id  = m.id
			WHERE r.is_active = 1 
			AND pro.is_active = 1
			AND pri.is_active = 1
			AND m.is_active = 1
			AND m.id = ?
			GROUP BY r.id
			",array($monitor_id_decode));
			return $query;
		}
		function get_subrenaksi_list_box($monitor_id_encode)
		{
			$monitor_id_decode = $this->encrypt->decode($monitor_id_encode);
			$count = $this->get_renaksi_count_checkpoint($monitor_id_decode);
			$query = $this->db->query("
			SELECT monitor_id,monitor_name,monitor_code,monitor_status,
			prioritas_id, prioritas_name, prioritas_serial,
			program_id, program_name, program_serial,
			renaksi_id,renaksi_name, renaksi_serial, count(ukuran_finish_on)/? as sub_renaksi
			from v_monitor_f8k
			WHERE monitor_id = ?
			GROUP BY renaksi_id
			",array($count,$monitor_id_decode));
			return $query;
		}
		function get_renaksi_count_checkpoint($monitor_id_decode)
		{
			$query = $this->db->query("
			SELECT count(monitor_id) as count_checkpoint FROM monitor_checkpoint
			WHERE monitor_id = ?
			",array($monitor_id_decode));
			if ($query->num_rows() > 0)
			{
				$count = $query->row();
				return $count->count_checkpoint;
			}
			else return 0;
		}
		function get_renaksi_list_reindex($program_id_encode)
		{
			$program_id_decode = $this->encrypt->decode($program_id_encode);
			$query = $this->db->query("
			SELECT r.id as renaksi_id,r.name as renaksi_name,r.serial as renaksi_serial,
			m.id as monitor_id, m.`name` as monitor_name, m.name_code as monitor_code,
			pri.id as prioritas_id, pri.`name` as prioritas_name, pri.serial as prioritas_serial,
			pro.id as program_id, pro.`name` as program_name, pro.serial as program_serial
			FROM monitor_renaksi r
			INNER JOIN monitor_program pro on r.program_id = pro.id
			INNER JOIN monitor_prioritas pri on pro.prioritas_id = pri.id
			INNER JOIN monitor m on pri.monitor_id = m.id
			WHERE m.is_active = 1 AND pri.is_active = 1
			AND pro.is_active = 1 AND r.is_active = 1
			AND pro.id = ?
			ORDER BY r.id
			",array($program_id_decode));
			return $query;
		}
		function get_renaksi_detil($id=0)
		{
			$id_decode =  $this->encrypt->decode($id);
			$this->db->where('id', $id_decode);
			$this->db->where('is_active', 1);
			$query = $this->db->get('monitor_renaksi');
			return $query;
		}
		function get_kriteria_detil($id=0)
		{
			$id_decode =  $this->encrypt->decode($id);
			$this->db->where('id', $id_decode);
			$this->db->where('is_active', 1);
			$query = $this->db->get('monitor_kriteria');
			return $query;
		}
		function get_renaksi_info($id=0)
		{
			$id_decode =  $this->encrypt->decode($id);
			$query = $this->db->query("
			SELECT m.id as monitor_id,m.`name` as monitor_name, m.name_code as monitor_code,m.status as monitor_status,
			pri.id as prioritas_id, pri.`name` as prioritas_name, pri.serial as prioritas_serial,
			pro.id as program_id, pro.`name` as program_name, pro.serial as program_serial,
			r.id as renaksi_id, r.`name` as renaksi_name, r.serial as renaksi_serial
			FROM monitor_renaksi r INNER JOIN monitor_program pro 
			ON r.program_id = pro.id INNER JOIN monitor_prioritas pri 
			ON pro.prioritas_id = pri.id INNER JOIN monitor m
			ON pri.monitor_id = m.id
			WHERE r.is_active = 1 AND pro.is_active = 1
			AND pri.is_active = 1 AND m.is_active = 1
			AND r.id = ?
			",array($id_decode));
			return $query;
		}
		function get_kriteria_info($renaksi_id=0){
			$this->db->select('monitor_kriteria.*,domains.name as domain_name');
			$this->db->from('monitor_kriteria');
			$this->db->join('monitor_renaksi', 'monitor_kriteria.renaksi_id = monitor_renaksi.id','inner');
			$this->db->join('domains', 'monitor_kriteria.penanggung_jawab = domains.id','inner');
			$this->db->where('monitor_kriteria.is_active', 1);
			$this->db->where('monitor_renaksi.is_active', 1);
			$this->db->where('domains.is_active', 1);
			if($this->acl->hasRole(5)){
				
			}
			$this->db->where('monitor_kriteria.renaksi_id', $renaksi_id);
			$this->db->order_by("monitor_kriteria.id"); 
			$query = $this->db->get();
			return $query;
		}
		function get_ukuran_info($kriteria_id=0){
			$this->db->select('monitor_ukuran.*');
			$this->db->from('monitor_ukuran');
			$this->db->join('monitor_kriteria','monitor_ukuran.kriteria_id = monitor_kriteria.id','inner');
			$this->db->where('monitor_ukuran.is_active',1);
			$this->db->where('monitor_kriteria.is_active',1);
			$this->db->where('monitor_ukuran.kriteria_id',$kriteria_id);
			$query = $this->db->get();
			return $query;
		}
		function get_ukuran_checkpoint_info($ukuran_id=0){
			$this->db->select('monitor_ukuran_checkpoint.*,monitor_checkpoint.id as mc_id,monitor_checkpoint.year,monitor_checkpoint.month, monitor_checkpoint.week, monitor_checkpoint.date_open,monitor_checkpoint.date_close,monitor_checkpoint.status as mc_status');
			$this->db->from('monitor_ukuran_checkpoint');
			$this->db->join('monitor_ukuran','monitor_ukuran_checkpoint.ukuran_id = monitor_ukuran.id','inner');
			$this->db->join('monitor_checkpoint','monitor_ukuran_checkpoint.checkpoint_id = monitor_checkpoint.id','inner');
			$this->db->where('monitor_ukuran.is_active',1);
			$this->db->where('monitor_checkpoint.status >',0);
			$this->db->where('monitor_ukuran_checkpoint.status >',0);
			$this->db->where('monitor_ukuran_checkpoint.ukuran_id',$ukuran_id);
			$query = $this->db->get();
			return $query;
		}
		function get_ukuran_detil($id=0)
		{
			$id_decode =  $this->encrypt->decode($id);
			$this->db->where('id', $id_decode);
			$this->db->where('is_active', 1);
			$query = $this->db->get('monitor_ukuran');
			return $query;
		}
		function get_ukuran_capaian_detil($id=0)
		{
			$this->db->select('
			monitor_ukuran_checkpoint.id as uc_id,monitor_ukuran_checkpoint.name as uc_name, monitor_ukuran_checkpoint.capaian as uc_capaian, monitor_ukuran_checkpoint.keterangan as uc_keterangan,monitor_checkpoint.id as mc_id, monitor_checkpoint.year as mc_year, monitor_checkpoint.month as mc_month, monitor_checkpoint.week as mc_week, monitor_checkpoint.status as mc_status,
			monitor_ukuran_checkpoint.target_keuangan as uc_target_keuangan,monitor_ukuran_checkpoint.target_fisik as uc_target_fisik');
			$this->db->from('monitor_ukuran_checkpoint');
			$this->db->join('monitor_checkpoint','monitor_ukuran_checkpoint.checkpoint_id = monitor_checkpoint.id','inner');
			$this->db->where('monitor_checkpoint.is_active', 1);
			$this->db->where('monitor_ukuran_checkpoint.ukuran_id', $id);
			$query = $this->db->get();
			return $query;
		}
		function get_domains_verifikator($id=0)
		{
			$id_decode =  explode(',',$this->encrypt->decode($id));
			$this->db->select('id,name');
			$this->db->where_in('id', $id_decode);
			$this->db->where('is_active', 1);
			$this->db->where('verified', 1);
			$query = $this->db->get('domains');
			return $query;
		}
		function get_monitor_domain($id_encode)
		{
			$id_decode =  $this->encrypt->decode($id_encode);
			$this->db->where('id', $id_decode);
			$this->db->where('is_active', 1);
			$this->db->where('verified', 1);
			$query = $this->db->get('domains');
			return $query;
		}
		function get_domains($search)
		{
			$this->db->where('is_active', 1);
			$this->db->where('verified', 1);
			$this->db->like('name', $search);
			$this->db->or_like('name_alias', $search); 
			$query = $this->db->get('domains');
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
		function get_domains_prepopulate($domains=0)
		{
			$domains_in =  explode(',',$domains);
			$this->db->select('id,name');
			$this->db->where_in('id', $domains_in);
			$this->db->where('is_active', 1);
			$this->db->where('verified', 1);
			$query = $this->db->get('domains');
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
		function get_prioritas_serial($id)
		{
			$this->db->where('monitor_id', $id);
			$this->db->order_by('serial desc'); 
			$query = $this->db->get('monitor_prioritas');
			return $query;
		}
		function get_pre_program_serial($id)
		{
			$query = $this->db->query("
			SELECT m.*
			FROM monitor_prioritas pri INNER JOIN monitor m
			ON pri.monitor_id = m.id
			WHERE pri.is_active = 1 AND m.is_active = 1
			AND pri.id = ?", array($id));
			return $query;
		}
		function get_pre_renaksi_serial($id)
		{
			$query = $this->db->query("
			SELECT m.*
			FROM monitor_program pro INNER JOIN monitor_prioritas pri 
			on pro.prioritas_id = pri.id INNER JOIN monitor m 
			ON pri.monitor_id = m.id
			WHERE pri.is_active = 1 AND m.is_active = 1
			AND pro.is_active = 1 AND pro.id = ?
			", array($id));
			return $query;
		}
		function get_program_serial($id)
		{
			$query = $this->db->query("
			SELECT pro.*
			FROM monitor_program pro INNER JOIN monitor_prioritas pri
			ON pro.prioritas_id = pri.id INNER JOIN monitor m
			on pri.monitor_id = m.id
			WHERE m.is_active = 1 AND m.id = ?
			ORDER BY pro.serial DESC",array($id));
			return $query;
		}
		function get_renaksi_serial($id)
		{
			$query = $this->db->query("
			SELECT r.*
			FROM monitor_renaksi r INNER JOIN monitor_program pro 
			ON r.program_id = pro.id INNER JOIN monitor_prioritas pri
			ON pro.prioritas_id = pri.id INNER JOIN monitor m
			ON pri.monitor_id = m.id
			WHERE m.is_active = 1 AND pri.is_active = 1 
			AND pro.is_active = 1 AND m.id = ?
			ORDER BY r.serial DESC",array($id));
			return $query;
		}
		function get_instansi_koordinasi($id)
		{
			$domains = explode(',',$id);
			$this->db->where('is_active', 1);
			$this->db->where_in('id',$domains);
			$this->db->order_by('name'); 
			$query = $this->db->get('domains');
			if($query->num_rows() > 0)
			{
				foreach ($query->result() as $row)
				{
					$domain_name[] = $row->name;
				}
				return $domain_name;
			}
		}
		function get_list_checkpoint($monitor_encode)
		{
			$monitor_id = $this->encrypt->decode($monitor_encode);
			$query = $this->db->query("
			SELECT mc.id as mc_id, mc.`year` as mc_year, mc.`month` as mc_month, mc.`week` as mc_week,
			mc.`status` as mc_status
			FROM monitor_checkpoint mc INNER JOIN monitor m
			ON mc.monitor_id = m.id
			WHERE m.is_active = 1 AND mc.is_active =1 
			AND mc.monitor_id = ?",array($monitor_id));
			return $query;
		}
		function get_jmlh_prioritas($id)
		{
			$id_decode = $this->encrypt->decode($id);
			$this->db->where('monitor_id',$id_decode);
			$this->db->where('is_active',1);
			$query = $this->db->get('monitor_prioritas');
			return $query;
		}
		function get_jmlh_program($id)
		{
			$id_decode = $this->encrypt->decode($id);
			$this->db->select('monitor_program.id');
			$this->db->from('monitor_program');
			$this->db->join('monitor_prioritas','monitor_program.prioritas_id = monitor_prioritas.id','inner');
			$this->db->join('monitor','monitor_prioritas.monitor_id = monitor.id','inner');
			$this->db->where('monitor_program.is_active',1);
			$this->db->where('monitor_prioritas.is_active',1);
			$this->db->where('monitor.is_active',1);
			$this->db->where('monitor.id',$id_decode);
			$this->db->group_by('monitor_program.id');
			$query = $this->db->get();
			return $query;
		}
		function get_jmlh_renaksi($id)
		{
			$id_decode = $this->encrypt->decode($id);
			$query = $this->db->query('
			SELECT r.id FROM monitor_renaksi r INNER JOIN monitor_program pro 
			ON r.program_id = pro.id INNER JOIN monitor_prioritas pri 
			ON pro.prioritas_id = pri.id INNER JOIN monitor m
			ON pri.monitor_id = m.id
			WHERE r.is_active = 1
			AND pro.is_active = 1
			AND pri.is_active = 1
			AND m.is_active = 1
			AND pri.monitor_id = ?
			GROUP BY r.id
			',array($id_decode));
			return $query;
		}
		function get_jmlh_subrenaksi($id)
		{
			$id_decode = $this->encrypt->decode($id);
			$query = $this->db->query('
			SELECT uc.id, uc.`name` FROM monitor_ukuran_checkpoint uc INNER JOIN monitor_ukuran u 
			ON uc.ukuran_id = u.id INNER JOIN monitor_kriteria k
			ON u.kriteria_id = k.id INNER JOIN monitor_renaksi r
			ON k.renaksi_id = r.id INNER JOIN monitor_program pro 
			ON r.program_id = pro.id INNER JOIN monitor_prioritas pri 
			ON pro.prioritas_id = pri.id INNER JOIN monitor m
			ON pri.monitor_id = m.id
			WHERE u.is_active = 1
			AND k.is_active = 1
			AND r.is_active = 1
			AND pro.is_active = 1
			AND pri.is_active = 1
			AND m.is_active = 1
			AND m.id = ?
			GROUP BY u.id
			',array($id_decode));
			return $query;
		}
		function get_monitor_statistik_all($id)
		{
			$id_decode = $this->encrypt->decode($id);
			$query = $this->db->query('
			SELECT mc.*
			FROM monitor_checkpoint mc INNER JOIN monitor m
			ON mc.monitor_id = m.id
			WHERE mc.is_active = 1
			AND m.is_active = 1
			AND m.id = ?
			ORDER BY mc.id
			',array($id_decode));
			$result = array();
			if($query->num_rows() > 0)
			{
				$i=0;
				foreach ($query->result() as $row){
					$query_uc = $this->db->query('
					SELECT uc.id as uc_id, uc.checkpoint_id as uc_mc_id,uc.`name` as uc_name, uc.capaian as uc_capaian, uc.keterangan as uc_keterangan, uc.`status` as uc_status,
					u.id as u_id, u.kriteria_id as u_kriteria_id, u.`name` as u_name,u.finish as u_finish, u.finish_on as u_finish_on
					FROM monitor_ukuran_checkpoint uc INNER JOIN monitor_ukuran u 
					ON uc.ukuran_id = u.id INNER JOIN monitor_kriteria k
					ON u.kriteria_id = k.id INNER JOIN monitor_renaksi r
					ON k.renaksi_id = r.id INNER JOIN monitor_program pro 
					ON r.program_id = pro.id INNER JOIN monitor_prioritas pri 
					ON pro.prioritas_id = pri.id INNER JOIN monitor m
					ON pri.monitor_id = m.id
					WHERE u.is_active = 1
					AND k.is_active = 1
					AND r.is_active = 1
					AND pro.is_active = 1
					AND pri.is_active = 1
					AND m.is_active = 1
					AND m.id = ?
					AND uc.checkpoint_id = ?
					',array($id_decode,$row->id));
					if($query_uc->num_rows() > 0)
					{
						$ii=0;
						foreach ($query_uc->result() as $row_uc){
							$result[$i]['year']=$row->year;
							$result[$i]['month']=$row->month;
							$result[$i]['week']=$row->week;
							if($row_uc->uc_status == 0){
								$result[$i]['tidak_ada_target'][] = $row_uc->uc_id;
							}
							elseif ($row_uc->uc_status == 1)
							{
								if($row_uc->u_finish_on == $row_uc->uc_id){
									$result[$i]['target_akhir_tidak_tercapai'][] = $row_uc->uc_id;
								}
								elseif ($row_uc->u_finish_on > $row_uc->uc_id){
									$result[$i]['tidak_lapor'][] = $row_uc->uc_id;
								}
							}
							elseif($row_uc->uc_status == 2)
							{
								if($row_uc->u_finish_on == $row_uc->uc_id){
									$result[$i]['verifikasi'][] = $row_uc->uc_id;
								}
								elseif ($row_uc->u_finish_on > $row_uc->uc_id){
									$result[$i]['verifikasi'][] = $row_uc->uc_id;
								}
							}
							elseif($row_uc->uc_status == 3)
							{
								if($row_uc->u_finish_on == $row_uc->uc_id)
								{
									if($row_uc->uc_capaian < 100)
									{
										$result[$i]['target_akhir_tidak_tercapai'][] = $row_uc->uc_id;
									}
									elseif ($row_uc->uc_capaian >= 100)
									{
										$result[$i]['target_akhir_tercapai'][] = $row_uc->uc_id;
									}
								}
								elseif ($row_uc->u_finish_on > $row_uc->uc_id)
								{
									if($row_uc->uc_capaian <= 50)
									{
										$result[$i]['target_antara_tidak_tercapai'][] = $row_uc->uc_id;
									}
									elseif ($row_uc->uc_capaian > 50 && $row_uc->uc_capaian <= 75)
									{
										$result[$i]['target_antara_tidak_sempurna'][] = $row_uc->uc_id;
									}
									elseif ($row_uc->uc_capaian > 75 && $row_uc->uc_capaian <= 100)
									{
										$result[$i]['target_antara_tercapai'][] = $row_uc->uc_id;
									}
									elseif($row_uc->uc_capaian > 100)
									{
										$result[$i]['melampaui_target_antara'][] = $row_uc->uc_id;
									}
								}
							}
						}
					}
					$i++;
				}
			}
			return $result;
		}
		function get_single_monitor_statistik($id,$penanggung_jawab)
		{
			$penanggung_jawab_decode = $this->encrypt->decode($penanggung_jawab);
			$id_decode = $this->encrypt->decode($id);
			$query = $this->db->query('
			SELECT mc.*
			FROM monitor_checkpoint mc INNER JOIN monitor m
			ON mc.monitor_id = m.id
			WHERE mc.is_active = 1
			AND m.is_active = 1
			AND m.id = ?
			ORDER BY mc.id
			',array($id_decode));
			$result = array();
			if($query->num_rows() > 0)
			{
				$i=0;
				foreach ($query->result() as $row){
					$query_uc = $this->db->query('
					SELECT uc.id as uc_id, uc.checkpoint_id as uc_mc_id,uc.`name` as uc_name, uc.capaian as uc_capaian, uc.keterangan as uc_keterangan, uc.`status` as uc_status,
					u.id as u_id, u.kriteria_id as u_kriteria_id, u.`name` as u_name,u.finish as u_finish, u.finish_on as u_finish_on
					FROM monitor_ukuran_checkpoint uc INNER JOIN monitor_ukuran u 
					ON uc.ukuran_id = u.id INNER JOIN monitor_kriteria k
					ON u.kriteria_id = k.id INNER JOIN monitor_renaksi r
					ON k.renaksi_id = r.id INNER JOIN monitor_program pro 
					ON r.program_id = pro.id INNER JOIN monitor_prioritas pri 
					ON pro.prioritas_id = pri.id INNER JOIN monitor m
					ON pri.monitor_id = m.id
					WHERE u.is_active = 1
					AND k.is_active = 1
					AND r.is_active = 1
					AND pro.is_active = 1
					AND pri.is_active = 1
					AND m.is_active = 1
					AND m.id = ?
					AND uc.checkpoint_id = ?
					AND k.penanggung_jawab = ?
					',array($id_decode,$row->id,$penanggung_jawab_decode));
					if($query_uc->num_rows() > 0)
					{
						$ii=0;
						foreach ($query_uc->result() as $row_uc){
							$result[$i]['year']=$row->year;
							$result[$i]['month']=$row->month;
							$result[$i]['week']=$row->week;
							if($row_uc->uc_status == 0){
								$result[$i]['tidak_ada_target'][] = $row_uc->uc_id;
							}
							elseif ($row_uc->uc_status == 1)
							{
								if($row_uc->u_finish_on == $row_uc->uc_id){
									$result[$i]['target_akhir_tidak_tercapai'][] = $row_uc->uc_id;
								}
								elseif ($row_uc->u_finish_on > $row_uc->uc_id){
									$result[$i]['tidak_lapor'][] = $row_uc->uc_id;
								}
							}
							elseif($row_uc->uc_status == 2)
							{
								if($row_uc->u_finish_on == $row_uc->uc_id){
									$result[$i]['verifikasi'][] = $row_uc->uc_id;
								}
								elseif ($row_uc->u_finish_on > $row_uc->uc_id){
									$result[$i]['verifikasi'][] = $row_uc->uc_id;
								}
							}
							elseif($row_uc->uc_status == 3)
							{
								if($row_uc->u_finish_on == $row_uc->uc_id)
								{
									if($row_uc->uc_capaian < 100)
									{
										$result[$i]['target_akhir_tidak_tercapai'][] = $row_uc->uc_id;
									}
									elseif ($row_uc->uc_capaian >= 100)
									{
										$result[$i]['target_akhir_tercapai'][] = $row_uc->uc_id;
									}
								}
								elseif ($row_uc->u_finish_on > $row_uc->uc_id)
								{
									if($row_uc->uc_capaian <= 50)
									{
										$result[$i]['target_antara_tidak_tercapai'][] = $row_uc->uc_id;
									}
									elseif ($row_uc->uc_capaian > 50 && $row_uc->uc_capaian <= 75)
									{
										$result[$i]['target_antara_tidak_sempurna'][] = $row_uc->uc_id;
									}
									elseif ($row_uc->uc_capaian > 75 && $row_uc->uc_capaian <= 100)
									{
										$result[$i]['target_antara_tercapai'][] = $row_uc->uc_id;
									}
									elseif($row_uc->uc_capaian > 100)
									{
										$result[$i]['melampaui_target_antara'][] = $row_uc->uc_id;
									}
								}
							}
						}
					}
					$i++;
				}
			}
			return $result;
		}
		function get_monitor_instansi_koordinasi($id)
		{
			$id_decode = $this->encrypt->decode($id);
			$query = $this->db->query('
			SELECT m.id as monitor_id,k.penanggung_jawab as penanggung_jawab, d.`name` as domain_name, k.id as kriteria_id, r.id as renaksi_id, COUNT(u.id) as ukuran_id FROM monitor_ukuran u INNER JOIN monitor_kriteria k 
			ON u.kriteria_id = k.id INNER JOIN monitor_renaksi r
			ON k.renaksi_id = r.id INNER JOIN monitor_program pro 
			ON r.program_id = pro.id INNER JOIN monitor_prioritas pri 
			ON pro.prioritas_id = pri.id INNER JOIN monitor m
			ON pri.monitor_id = m.id INNER JOIN domains d
			ON k.penanggung_jawab = d.id
			WHERE u.is_active = 1
			AND k.is_active = 1
			AND r.is_active = 1
			AND pro.is_active = 1
			AND pri.is_active = 1
			AND m.is_active = 1
			AND d.is_active = 1
			AND m.id = ?
			GROUP BY k.penanggung_jawab
			ORDER BY d.name asc
			', array($id_decode));
			return $query;
		}
		function get_statistic_detil($monitor_id,$uc_id)
		{
			$monitor_id_decode = $this->encrypt->decode($monitor_id);
			$uc_id_split = str_replace("_",",",$uc_id);
			$query = $this->db->query('
			SELECT monitor_id,monitor_name,monitor_code,prioritas_serial,program_serial,renaksi_id,renaksi_name,renaksi_serial, COUNT(uc_id) as jmlh_sub_renaksi
			FROM v_monitor_f8k
			WHERE monitor_id = ?
			AND uc_id IN ('.$uc_id_split.')
			GROUP BY renaksi_id
			',array($monitor_id_decode));
			return $query;
		}
		function get_renaksi_domain($id_encode,$penanggung_jawab_encode)
		{
			$id_decode = $this->encrypt->decode($id_encode);
			$penanggung_jawab_decode = $this->encrypt->decode($penanggung_jawab_encode);
			$query = $this->db->query("
			SELECT monitor_code,prioritas_serial,program_serial,renaksi_serial,renaksi_id,renaksi_name,count(DISTINCT ukuran_id)as sub_renaksi FROM v_monitor_f8k
			WHERE monitor_id = ?
			AND kriteria_penanggung_jawab = ?
			GROUP BY renaksi_name
			ORDER BY prioritas_serial asc,program_serial asc, renaksi_serial asc
			",array($id_decode,$penanggung_jawab_decode));
			return $query;
		}
		function get_ukuran_type($uc_id_encode)
		{
			$uc_id_decode = $this->encrypt->decode($uc_id_encode);
			$query = $this->db->query("
			SELECT u.type FROM monitor_ukuran_checkpoint uc INNER JOIN monitor_ukuran u
			ON uc.ukuran_id = u.id
			WHERE uc.id = ?
			",array($uc_id_decode));
			return $query;
		}
		function get_uc_detil($uc_id_encode)
		{
			$uc_id_decode = $this->encrypt->decode($uc_id_encode);
			$this->db->where('id',$uc_id_decode);
			$query = $this->db->get('monitor_ukuran_checkpoint');
			return $query;
		}
		function get_files($uc_id)
		{
			$this->db->where('monitor_ukuran_checkpoint_id',$uc_id);
			$this->db->where('is_active',1);
			$query  = $this->db->get('monitor_lampiran');
			return $query;
		}
		function get_logs($uc_id_encode)
		{
			$uc_id_decode = $this->encrypt->decode($uc_id_encode);
			$query  = $this->db->query("
			SELECT `logs`.`timestamp`,log_ref.`name`,`logs`.capaian,u.username FROM `logs` INNER JOIN log_ref
			ON `logs`.log_ref_id = log_ref.id INNER JOIN users u
			ON `logs`.user_id = u.id
			WHERE `logs`.monitor_ukuran_checkpoint_id = ?
			ORDER BY `logs`.`timestamp`
			",array($uc_id_decode));
			return $query;
		}
		function tmp_check_lapor_data_dukung($uc_id_encode)
		{
			$uc_id_decode = $this->encrypt->decode($uc_id_encode);
			$this->db->where('monitor_ukuran_checkpoint_id',$uc_id_decode);
			$query = $this->db->get('tmp_monitor_lampiran');
			if($query->num_rows() > 0 ) return 1;			
			else return 0;
		}
		function check_lapor_data_dukung($uc_id_encode)
		{
			$uc_id_decode = $this->encrypt->decode($uc_id_encode);
			$this->db->where('monitor_ukuran_checkpoint_id',$uc_id_decode);
			$query = $this->db->get('monitor_lampiran');
			if($query->num_rows() > 0 ) return 1;			
			else return 0;
		}
		function tmp_files_list($uc_id_encode)
		{
			$uc_id_decode = $this->encrypt->decode($uc_id_encode);
			$this->db->where('monitor_ukuran_checkpoint_id',$uc_id_decode);
			$query = $this->db->get('tmp_monitor_lampiran');
			return $query;
		}
		function files_list($uc_id_encode)
		{
			$uc_id_decode = $this->encrypt->decode($uc_id_encode);
			$this->db->where('monitor_ukuran_checkpoint_id',$uc_id_decode);
			$this->db->where('is_active',1);
			$query = $this->db->get('monitor_lampiran');
			return $query;
		}
		function tmp_file_add($data_insert)
		{
			$this->db->insert('tmp_monitor_lampiran', $data_insert);
		}
		function file_delete($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('monitor_lampiran');
		}
		function tmp_file_delete($id)
		{
			$this->db->where('id', $id);
			$this->db->delete('tmp_monitor_lampiran');
		}
		function monitor_add($data_insert)
		{
			$this->db->insert('monitor', $data_insert);
		}
		function monitor_edit($id,$data_update)
		{
			$id_decode = $this->encrypt->decode($id);
			$this->db->where('id', $id_decode);
			$this->db->update('monitor', $data_update); 
		}
		function monitor_delete($id,$data_update)
		{
			$id_decode = $this->encrypt->decode($id);
			$this->db->where('id', $id_decode);
			$this->db->update('monitor', $data_update);
		}
		function prioritas_add($data_insert)
		{
			$this->db->insert('monitor_prioritas', $data_insert);
		}
		function prioritas_edit($id,$data_update)
		{
			$id_decode = $this->encrypt->decode($id);
			$this->db->where('id', $id_decode);
			$this->db->update('monitor_prioritas', $data_update); 
		}
		function prioritas_delete($id,$data_update)
		{
			$id_decode = $this->encrypt->decode($id);
			$this->db->where('id', $id_decode);
			$this->db->update('monitor_prioritas', $data_update);
		}
		function program_add($data_insert)
		{
			$this->db->insert('monitor_program', $data_insert);
		}
		function program_edit($id,$data_update)
		{
			$id_decode = $this->encrypt->decode($id);
			$this->db->where('id', $id_decode);
			$this->db->update('monitor_program', $data_update); 
		}
		
		function program_delete($id,$data_update)
		{
			$id_decode = $this->encrypt->decode($id);
			$this->db->where('id', $id_decode);
			$this->db->update('monitor_program', $data_update);
		}
		function renaksi_add($data_insert)
		{
			$this->db->insert('monitor_renaksi', $data_insert);
		}
		function renaksi_edit($id,$data_update)
		{
			$id_decode = $this->encrypt->decode($id);
			$this->db->where('id', $id_decode);
			$this->db->update('monitor_renaksi', $data_update); 
		}
		function renaksi_delete($id,$data_update)
		{
			$id_decode = $this->encrypt->decode($id);
			$this->db->where('id', $id_decode);
			$this->db->update('monitor_renaksi', $data_update);
		}
		function kriteria_add($data_insert)
		{
			$this->db->insert('monitor_kriteria', $data_insert);
		}
		function kriteria_edit($id,$data_update)
		{
			$id_decode = $this->encrypt->decode($id);
			$this->db->where('id', $id_decode);
			$this->db->update('monitor_kriteria', $data_update); 
		}
		function kriteria_delete($id,$data_update)
		{
			$id_decode = $this->encrypt->decode($id);
			$this->db->where('id', $id_decode);
			$this->db->update('monitor_kriteria', $data_update);
		}
		function ukuran_add($data_insert)
		{
			$this->db->insert('monitor_ukuran', $data_insert);
		}
		function ukuran_keberhasilan_edit($id,$data_update)
		{
			$id_decode = $this->encrypt->decode($id);
			$this->db->where('id', $id_decode);
			$this->db->update('monitor_ukuran', $data_update); 
		}
		function check_status_checkpoint($ukuran_capaian_id)
		{
			$ukuran_capaian_id_decode = $this->encrypt->decode($ukuran_capaian_id);
			$this->db->select('status');
			$this->db->from('monitor_ukuran_checkpoint');
			$this->db->where('id',$ukuran_capaian_id_decode);
			$query = $this->db->get();
			if($query->num_rows() > 0)
			{
				$query_value = $query->row();
				return $query_value->status;
			}
			else return 0;
			echo $this->db->last_query();
		}
		function ukuran_capaian_edit($id,$data_update)
		{
			$id_decode = $this->encrypt->decode($id);
			$this->db->where('id', $id_decode);
			$this->db->update('monitor_ukuran_checkpoint', $data_update); 
		}
		function ukuran_delete($id,$data_update)
		{
			$id_decode = $this->encrypt->decode($id);
			$this->db->where('id', $id_decode);
			$this->db->update('monitor_ukuran', $data_update);
		}
		function ukuran_capaian_add($data_insert)
		{
			$this->db->insert('monitor_ukuran_checkpoint', $data_insert);
		}
		function ukuran_capaian_last_checkpoint($ukuran_id,$last_check)
		{
			$this->db->where('id', $ukuran_id);
			$this->db->update('monitor_ukuran', $last_check); 
		}
		function lapor($uc_id_encode,$data_update)
		{
			$uc_id_decode = $this->encrypt->decode($uc_id_encode);
			$this->db->where('id',$uc_id_decode);
			$this->db->update('monitor_ukuran_checkpoint',$data_update);
		}
		function logs_add($data_insert_logs)
		{
			$this->db->insert('logs', $data_insert_logs);
		}
		function monitor_lampiran_add($data_insert_lampiran)
		{
			$this->db->insert('monitor_lampiran', $data_insert_lampiran);
		}
		function reindex_renaksi($id,$data_update)
		{
			$this->db->where('id', $id);
			$this->db->update('monitor_renaksi', $data_update); 
		}
		function reindex_program($id,$data_update)
		{
			$this->db->where('id', $id);
			$this->db->update('monitor_program', $data_update); 
		}
		function reindex_prioritas($id,$data_update)
		{
			$this->db->where('id', $id);
			$this->db->update('monitor_prioritas', $data_update); 
		}
		function option_periode_export($id)
		{
			$query = $this->db->query("
			SELECT mc.* FROM monitor_checkpoint mc INNER JOIN monitor m
			ON mc.monitor_id = m.id
			WHERE m.`is_active` = 1 
			AND mc.is_active = 1
			AND m.id = ?
			",array($id));
			if ($query->num_rows() > 0)
			{
				$periode[0] = "Semua";
				foreach ($query->result_array() as $row)
				{
					if(isset($row['weeke'])) $week = "-M".sprintf('%02d',$row['week']);
					else $week = "";
					$periode[$row['id']] = "T".$row['year']."-B".sprintf('%02d',$row['month']).$week;
				}
				return $periode;
			}
			return null;
		}
		function option_prioritas_export($id)
		{
			$query = $this->db->query("
			SELECT pri.* FROM monitor_prioritas pri INNER JOIN monitor m
			ON pri.monitor_id = m.id
			WHERE pri.is_active = 1
			AND m.is_active
			AND m.id = ?
			",array($id));
			if ($query->num_rows() > 0)
			{
				$prioritas[0] = "Semua";
				foreach ($query->result_array() as $row)
				{
					$prioritas[$row['id']] = $row['name'];
				}
				return $prioritas;
			}
			return null;
		}
		function option_penanggungjawab_export($id)
		{
			$query = $this->db->query("
			SELECT v_f8k.kriteria_penanggung_jawab,d.`name` FROM v_monitor_f8k v_f8k INNER JOIN domains d
			ON `v_f8k`.kriteria_penanggung_jawab = d.id
			WHERE v_f8k.monitor_id = ?
			GROUP BY v_f8k.kriteria_penanggung_jawab
			",array($id));
			if ($query->num_rows() > 0)
			{
				$penanggungjawab[$this->encrypt->encode(0)] = "Semua";
				foreach ($query->result_array() as $row)
				{
					$penanggungjawab[$this->encrypt->encode($row['kriteria_penanggung_jawab'])] = $row['name'];
				}
				return $penanggungjawab;
			}
			return null;
		}
		function export_data_monitor($monitor_id)
		{
			$this->db->where('id',$monitor_id);
			$query = $this->db->get('monitor');
			return $query;
		}
		function export_data_prioritas($monitor_id,$periode,$prioritas,$penanggung_jawab)
		{
			$penanggung_jawab_decode = $this->encrypt->decode($penanggung_jawab);
			$this->db->select('prioritas_id,prioritas_name,monitor_code,prioritas_serial');
			if($periode != 0)
			{
				$this->db->where('mc_id',$periode);
			}
			if($prioritas != 0)
			{
				$this->db->where('prioritas_id',$prioritas);
			}
			if($penanggung_jawab_decode != 0)
			{
				$this->db->where('kriteria_penanggung_jawab',$penanggung_jawab_decode);
			}
			$this->db->where('monitor_id',$monitor_id);
			$this->db->group_by('prioritas_id');
			$this->db->order_by('prioritas_id','asc');
			$query = $this->db->get('v_monitor_f8k');
			return $query;
		}
		function export_data_program($periode,$prioritas_id,$penanggung_jawab)
		{
			$penanggung_jawab_decode = $this->encrypt->decode($penanggung_jawab);
			$this->db->select('prioritas_id,prioritas_name,monitor_code,kriteria_penanggung_jawab,prioritas_serial,program_id,program_name,program_serial');
			if($periode != 0)
			{
				$this->db->where('mc_id',$periode);
			}
			if($penanggung_jawab_decode != 0)
			{
				$this->db->where('kriteria_penanggung_jawab',$penanggung_jawab_decode);
			}
			$this->db->where('prioritas_id',$prioritas_id);
			$this->db->group_by('program_id');
			$this->db->order_by('program_id','asc');
			$query = $this->db->get('v_monitor_f8k');
			return $query;
		}
		function export_data_renaksi($program_id,$penanggung_jawab)
		{
			$penanggung_jawab_decode = $this->encrypt->decode($penanggung_jawab);
			$this->db->select('v_monitor_f8k.*,domains.name');
			if($penanggung_jawab_decode != 0)
			{
				$this->db->where('v_monitor_f8k.kriteria_penanggung_jawab',$penanggung_jawab_decode);
			}
			$this->db->join('domains','v_monitor_f8k.kriteria_penanggung_jawab = domains.id','inner');
			$this->db->where('v_monitor_f8k.uc_status !=',0);
			$this->db->where('v_monitor_f8k.program_id',$program_id);
			$this->db->order_by('v_monitor_f8k.renaksi_id,domains.name','asc');
			$query = $this->db->get('v_monitor_f8k');
			return $query;
		}
		function export_data_instansi_terkait($kriteria_instansi_terkait)
		{
			$domains =  explode(',',$kriteria_instansi_terkait);
			$this->db->where_in('id',$domains);
			$query = $this->db->get('domains');
			if($query->num_rows() > 0)
			{
				$domains = array();
				$i = 0;
				foreach($query->result() as $row_domains)
				{
					$domains[$i] = $row_domains->name;
					$i++;
				}
				sort($domains);
				return implode(', ',$domains);
			}
			return null;
		}
		function export_data_renaksi_xls($monitor_id_decode,$periode,$prioritas,$penanggung_jawab)
		{
			$penanggung_jawab_decode = $this->encrypt->decode($penanggung_jawab);
			$this->db->select('f8k.*,d1.name,d2.name as instansi_induk');
			$this->db->from('v_monitor_f8k as f8k');
			if($periode != 0)
			{
				$this->db->where('f8k.mc_id',$periode);
			}
			if($penanggung_jawab_decode != 0)
			{
				$this->db->where('f8k.kriteria_penanggung_jawab',$penanggung_jawab_decode);
			}
			if($prioritas != 0)
			{
				$this->db->where('f8k.prioritas_id',$prioritas);
			}
			$this->db->join('domains as d1','f8k.kriteria_penanggung_jawab = d1.id','inner');
			$this->db->join('domains as d2','d1.parent_id = d2.id','inner');
			$this->db->where('f8k.monitor_id',$monitor_id_decode);
			$this->db->order_by('f8k.renaksi_id,d1.name','asc');
			$query = $this->db->get();
			return $query;
		}
	}																														