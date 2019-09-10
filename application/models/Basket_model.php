<?php 

	class Basket_model extends CI_MODEL{

		private $table_name;
		function __construct(){
			parent::__construct();
			$this->table_name = 'basket';
		}

		function add_basket($data=array()){
			return $this->db->insert($this->table_name, $data);
		}

		function get_basket_row($where=array()){
			return $this->db->select('*')
							->from($this->table_name)
							->where($where)
							->get()->row();
		}

		function get_basket($where=array()){
			return $this->db->select('*')
							->from($this->table_name)
							->where($where)
							->join('foods', 'foods.id = basket.food_id')
							->get()->result();
		}

		function get_total_price($where=array()){
			$total_count = $this->db->select_sum('price')
							->from($this->table_name)
							->where($where)
							->get()->row();
			return $total_count;
		}

		function update_basket($where=array(), $data=array()){
			return $this->db->where($where)->update($this->table_name, $data);
		}

		function remove_basket($where=array()){
			return $this->db->where($where)->delete($this->table_name);
		}

	}