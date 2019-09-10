<?php 

class Order_model extends CI_MODEL{

	private $order_log;
	private $table_name;
	private $basket_table;
	function __construct(){
		parent::__construct();
		$this->table_name = 'orders';
		$this->basket_table = 'basket';
		$this->order_log = 'order_log';
	}

	function create_order($data=array()){
		return $this->db->insert($this->table_name, $data);
	}

	function add_log_order($data=array()){
		return $this->db->insert($this->order_log, $data);
	}

	function order_history($user_id){
		return $this->db->select('*')
						->from($this->order_log)
						->where('user_id', $user_id)
						->where('status', 4)
						->join('foods', "foods.id=$this->order_log.food_id")
						->get()->result();
	}

	function clear_basket($user_id){
		return $this->db->where('user_id', $user_id)->delete($this->basket_table);
	}

	function get_preparing_order($user_id){
		return $this->db->select('*')
		->from($this->table_name)
		->where('user_id', $user_id)
		->where('status', 1)
		->or_where('status', 2)
		->or_where('status', 3)
		->join('foods', "foods.id = $this->table_name.food_id")
		->get()->result();
	}

	function get_orders(){
		return $this->db->select('*')
						->from($this->table_name)
						->where('status', 1)
						->or_where('status', 2)
						->or_where('status', 3)
						->join('foods', "foods.id = orders.food_id")
						->get()->result();
	}

	function update_order($where=array(), $data=array()){
		return $this->db->where($where)
						->update($this->table_name, $data);
	}

}