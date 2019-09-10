<?php 

class Auth extends MY_CONTROLLER{

	function __construct(){
		parent::__construct();
		$this->load->library('Validations');
		$this->load->model('Auth_model');
	}

	function sign_up(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			if($this->validations->rules_for_sign_up() == FALSE){
				echo json_encode(array(false, message('danger', validation_errors())));
			}else{
				$create_user = $this->Auth_model->create_user(
					array(
						'username' => $this->input->post('username', true),
						'email' => $this->input->post('email', true),
						'password' => do_hash($this->input->post('password', true), 'md5'),
						'is_active' => 1,
					)
				);
				if($create_user){
					echo json_encode(array(true, message('success', 'Kayıt işleminiz başarılı')));
				}
			}
		}else{
			echo json_encode(array(false, message('danger', 'Bir hata oluştu lütfen tekrar deneyin')));
		}
	}

	function auto_sign_in(){
		if($_SERVER['REQUEST_METHOD']){
			$get_user = $this->Auth_model->get_user(
				array(
					'id' => $this->input->post('user_id', true),
					'is_active' => 1,
				)
			);
			if($get_user){
				$this->session->set_userdata('user', $get_user);
				echo json_encode(array(true, $get_user));
			}
		}
	}

	function sign_in(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			if($this->validations->rules_for_sign_in() == FALSE){
				echo json_encode(array(false, message('danger', validation_errors())));
			}else{
				$user_exists = $this->Auth_model->get_user(
					array(
						'email' => $this->input->post('email', true),
						'password' => do_hash($this->input->post('password', true) ,'md5'),
						'is_active' => 1,
					)
				);
				if($user_exists){
					echo json_encode(array(true, $user_exists->id, $user_exists));
				}else{
					echo json_encode(array(false, message('danger', 'Böyle bir kullanıcı Bulunamadı')));
				}
			}
		}
	}


	function update_user(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			if($this->validations->rules_for_update_account_settings() == FALSE){
				echo json_encode(array(false, message('danger', validation_errors())));
			}else{
				$update  = $this->Auth_model->update(
					array(
						'id' => $this->input->post('user_id', true)
					),
					array(
						'username' => $this->input->post('username', true),
						'email' => $this->input->post('email',  true),
					)
				);			
				if($update){
					$user = $this->Auth_model->get_user(
						array('id' => $this->input->post('user_id'))
					);
					echo json_encode(array(true, message('success','Bilgileriniz Başarıyla Güncellenmiştir'), $user));
				}
			}
		}
	}





}