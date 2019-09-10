<?php 

class Basket extends MY_CONTROLLER{

	function __construct(){
		parent::__construct();
		$this->load->model('Basket_model');
		$this->load->library('Validations');
	}

	function get_basket_info($user_id){
		return $this->Basket_model->get_basket(
			array('user_id' => $user_id)
		);
	}

	function total_price($user_id){
		$total_price = $this->Basket_model->get_total_price(
			array('user_id' => $user_id)
		);
		return $total_price->price;
	}

	function add_basket(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			if($this->validations->rules_for_add_basket() == FALSE){
				echo validation_errors();
			}else{
				$user_id = $this->input->post('user_id', true);
				$food_id = $this->input->post('food_id', true);
				$quantity = null;
				$basket_is_exists = $this->Basket_model->get_basket_row(
					array(
						'user_id' => $user_id,
						'food_id' => $food_id,
					)
				);
				if($basket_is_exists){
					$qunatity = $basket_is_exists->qunatity;
					$price    = $basket_is_exists->price;
					$update_basket = $this->Basket_model->update_basket(
						array(
							'user_id' => $user_id,
							'food_id' => $food_id,
						),
						array(
							'qunatity' => $qunatity+=1,
							'price'    => $qunatity*$price,
						)
					);

					if($update_basket){
						echo json_encode(array(true, $this->total_price($user_id), $this->get_basket_info($user_id)));
					}
				}else{
					$add_basket = $this->Basket_model->add_basket(
						array(
							'user_id' => $user_id,
							'food_id' => $this->input->post('food_id', true),
							'price' => $this->input->post('price', true),
							'qunatity' => 1,
						)
					);

					if($add_basket){
						echo json_encode(array(true, $this->total_price($user_id), $this->get_basket_info($user_id)));
					}
				}
			}
		}
	}

	function get_basket(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$user_id = $this->input->post('user_id', true);
			$total_price = $this->Basket_model->get_total_price(
				array('user_id' => $user_id)
			);
			$get_basket = $this->Basket_model->get_basket(
				array('user_id' => $user_id)
			);
			if($get_basket){
				echo json_encode(array(true, $get_basket, $total_price->price));
			}else{
				echo json_encode(array(false));
			}
		}
	}

	function increase_basket(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$food_id = $this->input->post('food_id', true);
			$user_id = $this->input->post('user_id', true);

			$basket = $this->Basket_model->get_basket_row(
				array('user_id' => $user_id, 'food_id' => $food_id)
			);

			$basket_quantity = $basket->qunatity+1;
			$basket_price = $basket->price*$basket_quantity;

			if($basket_quantity > 1){
				$update_basket = $this->Basket_model->update_basket(
					array('user_id' => $user_id, 'food_id' => $food_id),
					array(
						'qunatity' => $basket_quantity,
						'price' => $basket_price
					)
				);

				if($update_basket){
					echo json_encode(array(true, $this->total_price($user_id), $this->get_basket_info($user_id)));
				}
			}


		}	
	}

	function decrease_basket(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$food_id = $this->input->post('food_id', true);
			$user_id = $this->input->post('user_id', true);

			$basket = $this->Basket_model->get_basket_row(
				array('user_id' => $user_id, 'food_id' => $food_id)
			);

			$basket_quantity = $basket->qunatity-1;
			$basket_price = $basket->price*$basket_quantity;



			$update_basket = $this->Basket_model->update_basket(
				array('user_id' => $user_id, 'food_id' => $food_id),
				array(
					'qunatity' => $basket_quantity,
					'price' => $basket_price
				)
			);

			if($update_basket){
				echo json_encode(array(true, $this->total_price($user_id), $this->get_basket_info($user_id)));
			}


		}	
	}

	function remove_basket(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$food_id = $this->input->post('food_id', true);
			$user_id = $this->input->post('user_id', true);

			$remove_basket = $this->Basket_model->remove_basket(
				array('user_id' => $user_id, 'food_id' => $food_id)
			);

			if($remove_basket){
				echo json_encode(array(true, $this->total_price($user_id), $this->get_basket_info($user_id)));
			}


		}	
	}

}