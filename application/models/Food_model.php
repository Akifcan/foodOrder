<?php 

	class Food_model extends CI_MODEL{

		private $table_name;
		function __construct(){
			parent::__construct();
			$this->table_name = 'foods';
		}

		function get_all(){
			return $this->db->select('*')
							->from($this->table_name)
							->where('is_active', 1)
							->get()->result();
		}

	}