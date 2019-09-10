<?php 

	class Address_model extends CI_MODEL{

		private $table_name;
		function __construct(){
			parent::__construct();
			$this->table_name = 'user_address';
		}

		function create_address($data=array()){
			return $this->db->insert($this->table_name, $data);
		}

		function get_address($where=array()){
			return $this->db->select('*')
							->from($this->table_name)
							->where($where)
							->get()->result();
		}

	}