<?php 


class Admin extends MY_CONTROLLER{

	function __construct(){
		parent::__construct();
		$this->load->model('Admin_model');
		$this->load->library('Validations');
	}

	function sign_in(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			if($this->validations->rules_for_admin_sign_in() == FALSE){
				echo json_encode(array(false, message('danger', validation_errors())));
			}else{
				$password = do_hash($this->input->post('password'), 'md5');
				$user_is_exists = $this->Admin_model->sign_in_admin($password);
				if($user_is_exists){
					echo json_encode(array(true, $user_is_exists->id, $user_is_exists));
				}else{
					echo json_encode(array(false, message('danger', 'Hatalı giriş')));
				}
			}
		}
	}

	function add_menu(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			if($this->validations->rules_for_add_menu() == FALSE){
				echo json_encode(array(false, message('danger', validation_errors())));
			}else{
				$food_name = $this->input->post('food_name', true);
				$price     = $this->input->post('price', true);
				$description = $this->input->post('description', true);
				$image_name = slug($food_name.time('Y-M-D'));

				$config['upload_path'] = FCPATH.'/images/menu';
				$config['allowed_types'] = 'jpeg|jpg|png';
				$config['max_size']  = '5000';
				$config['file_name'] =  $image_name;
				$this->load->library('upload', $config);

				
				if (!$this->upload->do_upload('file')){
					$add_menu = $this->Admin_model->add_menu(
						array(
							'food_name' => $food_name,
							'price' => $price,
							'description' => $description,
							'image' => 'images/menu/no-image.png'
						)
					);
					if($add_menu){
						echo json_encode(array(true, message('success', 'Menü Eklenmiştir')));
					}

				}
				else{
					$data = array('upload_data' => $this->upload->data());
					$add_menu = $this->Admin_model->add_menu(
						array(
							'food_name' => $food_name,
							'price' => $price,
							'description' => $description,
							'image' => 'images/menu/'.$data['upload_data']['file_name']
						)
					);
					if($add_menu){
						echo json_encode(array(true, message('success', 'Menü Eklenmiştir')));
					}
				}
			}
		}
	}

	function get_customers(){
		echo json_encode($this->Admin_model->get_customers());
	}

	function get_address(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$user_id = $this->input->post('user_id', true);
			echo json_encode($this->Admin_model->get_customer_address(array('user_id' => $user_id)));
		}
	}

}