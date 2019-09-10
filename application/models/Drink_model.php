<?php 

	class Drink_model extends CI_MODEL{

		private $table_name;
		function __construct(){
			parent::__construct();
			$this->table_name = 'drinks';
		}

		function get_all(){
			return $this->db->select('*')
							->from($this->table_name)
							->order_by('name asc')
							->get()->result();
		}

	}