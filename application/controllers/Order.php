<?php 

class Order extends MY_CONTROLLER{

	function __construct(){
		parent::__construct();
		$this->load->model('Order_model');
	}

	function send_order(){

		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$order = json_decode($this->input->post('order'));
			$user_id = $this->input->post('user_id', true);
			$address = $this->input->post('address', true);
			$drink = $this->input->post('drink', true);
			$send_order;
			foreach($order as $order){
				$send_order = $this->Order_model->create_order(
					array(
						'user_id' => $user_id,
						'address' => $address,
						'drink'   => $drink,
						'food_id' =>$order->food_id,
						'status' => 1,
					)
				);
			}
			if($send_order){
				$this->Order_model->clear_basket($user_id);
				echo json_encode(true);
			}

		}

	}

	function preparing_orders(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$user_id = $this->input->post('user_id', true);
			$preparing_orders = $this->Order_model->get_preparing_order(
				$user_id
			);
			echo json_encode(array(true, $preparing_orders));
		}
	}

	function add_order_log(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$order = json_decode($this->input->post('order'));
			$user_id = $this->input->post('user_id', true);
			$address = $this->input->post('address', true);
			$drink = $this->input->post('drink', true);
			$send_order;
			foreach($order as $order){
				$this->Order_model->add_log_order(
					array(
						'user_id' => $user_id,
						'address' => $address,
						'drink'   => $drink,
						'food_id' =>$order->food_id,
						'status' => 1,
					)
				);
			}

		}
	}

	function order_history(){
		$user_id = $this->input->post('user_id', true);
		$order_history = $this->Order_model->order_history($user_id);
		if($order_history){
			echo json_encode(array(true, $order_history));
		}else{
			echo json_encode(array(false));
		}
	}

	function get_all_orders(){
		echo json_encode($this->Order_model->get_orders());
	}

	function edit_order_preparing_status(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$user_id = $this->input->post('user_id', true);
			$food_id = $this->input->post('food_id', true);
			$drink = $this->input->post('drink', true);
			$status = $this->input->post('status', true);
			$address =  $this->input->post('address', true);

			if($status == 4){
				$this->Order_model->add_log_order(
					array(
						'user_id' => $user_id,
						'status'  => $status,
						'drink'   => $drink,
						'food_id' => $food_id,
						'address' => $address,
 					)
				);
			} 

			$edit_order_preparing_status = $this->Order_model->update_order(
				array(
					'user_id' => $user_id,
					'food_id' => $food_id,
				),
				array(
					'status' => $status
				)
			);

			if($edit_order_preparing_status){
				echo json_encode(array(true, $this->get_all_orders()));
			}

		}
	}

}