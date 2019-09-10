<?php 


class Address extends MY_CONTROLLER{

	function __construct(){
		parent::__construct();
		$this->load->model('Address_model');
		$this->load->library('Validations');
	}

	function create_address(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			if($this->validations->rules_for_create_address() == FALSE){
				echo json_encode(array(false, message('danger', validation_errors())));
			}else{
				$create_address = $this->Address_model->create_address(
					array(
						'user_id' => $this->input->post('user_id', true),
						'address_type' => $this->input->post('address_type', true),
						'address' => $this->input->post('address')
					)
				);
				if($create_address){
					echo json_encode(array(true, message('success', 'Adresiniz oluşturulmuştur')));
				}else{
					echo json_encode(array(false, message('danger', 'Bir hata oluştu lütfen tekrar deneyin')));
				}
			}
		}
	}

	function get_address(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$address = $this->Address_model->get_address(
				array('user_id' => $this->input->post('user_id', true))
			);
			if($address){
				echo json_encode($address);
			}
		}
	}
}