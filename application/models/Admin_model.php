<?php 

	class Admin_model extends CI_MODEL{

		private $table_name;
		private $menu_table = 'foods';
		private $user_table = 'users';
		function __construct(){
			parent::__construct();
			$this->table_name = 'admin';
		}

		function add_menu($data=array()){
			return $this->db->insert($this->menu_table, $data);
		}

		function sign_in_admin($password){
			return $this->db->select('*')
							->from($this->table_name)
							->where('password', $password)
							->get()->row();
		}

		function get_customers(){
			return $this->db->select('*')
							->from($this->user_table)
							->get()->result();
		}

		function get_customer_address($where=array()){
			return $this->db->select('*')
							->from('user_address')
							->where($where)
							->get()->result();
		}

	}