<?php 

	class Message_model extends CI_MODEL{

		private $table_name;
		function __construct(){
			parent::__construct();
			$this->table_name = 'message';
		}

		function send_message($data=array()){
			return $this->db->insert($this->table_name, $data);
		}

		function get_all(){
			return $this->db->select('*')
							->from($this->table_name)
							->join('users', "users.id = $this->table_name.user_id")
							->get()->result();
		}

	}