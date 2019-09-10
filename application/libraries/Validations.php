<?php 

class Validations{

	private $ci;
	function __construct(){
		$this->ci = & get_instance();
	}

	function rules_for_sign_up(){
		$this->ci->form_validation->set_rules('username', 
			'Kullanıcı Adı', 
			'required|max_length[50]|xss_clean');

		$this->ci->form_validation->set_rules('email', 
			'E-Posta Adresi', 
			'required|max_length[50]|valid_email|is_unique[users.email]xss_clean');

		$this->ci->form_validation->set_rules('password', 
			'Şifre', 
			'required|max_length[50]|xss_clean');

		$this->ci->form_validation->set_message('required',
			'%s alanı doldurulmalıdır');

		$this->ci->form_validation->set_message('valid_email',
			'%snizi hatalı girdiniz');

		$this->ci->form_validation->set_message('max_length',
			'%s alanı en fazla 50 karakter olabilir');

		$this->ci->form_validation->set_message('is_unique',
			'Bu %s kayıt edilmiş');

		if($this->ci->form_validation->run() == FALSE){
			return false;
		}else{
			return true;
		}
	}

	function rules_for_sign_in(){
		$this->ci->form_validation->set_rules('email', 'E-Posta Adres',
			'required|valid_email|xss_clean');

		$this->ci->form_validation->set_rules('password', 'Şifre',
			'required|xss_clean');

		$this->ci->form_validation->set_message('requied', '%s alanı doldurulmalıdır');
		$this->ci->form_validation->set_message('valid_email', 'E-posta adresinizi yanlış girdiniz');


		if($this->ci->form_validation->run() == FALSE){
			return false;
		}else{
			return true;
		}
	}

	function rules_for_update_account_settings(){
		$this->ci->form_validation->set_rules('username', 'Kullanıcı Adı', 'required|max_length[50]|xss_clean');

		$this->ci->form_validation->set_rules('email', 'E-Posta Adresi', 'required|max_length[50]|xss_clean');


		$this->ci->form_validation->set_rules('user_id', 'id', 'required|xss_clean|numeric');

		$this->ci->form_validation->set_message('required', '%s alanı doldurulmalıdır');
		$this->ci->form_validation->set_message('max_length', '%s alanı en fazla 50 karakter olabilir');

		if($this->ci->form_validation->run() == FALSE){
			return false;
		}else{
			return true;
		}

	}

	function rules_for_create_address(){
		$this->ci->form_validation->set_rules('user_id', 'user'
			, 'required|xss_clean');
		$this->ci->form_validation->set_rules('address_type', 'Adres Başlığı', 'required|max_length[50]|xss_clean');
		$this->ci->form_validation->set_rules('address', 'Adres', 'required|max_length[255]|min_length[10]|xss_clean|is_unique[user_address.address]');

		$this->ci->form_validation->set_message('required', 
			'%s alanı zorunludur');

		$this->ci->form_validation->set_message('max_length', 
			'%s alanı için çok fazla karakter girdiniz');

		$this->ci->form_validation->set_message('min_length', 
			'%s alanı en az 10 karakter olmalı');

		$this->ci->form_validation->set_message('is_unique', 'Bu adresi daha önceden kayıt etmişsiniz');


		if($this->ci->form_validation->run() == FALSE){
			return false;
		}else{
			return true;
		}

	}

	function rules_for_add_basket(){
		$this->ci->form_validation->set_rules('user_id', 'userid', 'required|xss_clean');
		$this->ci->form_validation->set_rules('food_id', 'foodid', 'required|xss_clean');
		$this->ci->form_validation->set_rules('price', 'price', 'required|xss_clean');

		if($this->ci->form_validation->run() == FALSE){
			return false;
		}else{
			return true;
		}

	}

	function rules_for_admin_sign_in(){
		$this->ci->form_validation->set_rules('password', 'Şifre', 'required|max_length[50]|xss_clean');
		$this->ci->form_validation->set_message('required', '%s alanı doldurulmalıdır');
		$this->ci->form_validation->set_message('max_length', '%s alanı en fazla 50 karakter olabilir');

		if($this->ci->form_validation->run() == FALSE){
			return false;
		}else{
			return true;
		}
	}

	function rules_for_add_menu(){
		$this->ci->form_validation->set_rules('food_name', 'Yemek Adı', 'required|max_length[50]|xss_clean');
		$this->ci->form_validation->set_rules('price', 'Fiyat', 'required|max_length[50]|xss_clean');
		$this->ci->form_validation->set_rules('description', 'Açıklama', 'required|xss_clean');

		$this->ci->form_validation->set_message('required', '%s alanı doldurulmalıdır');
		$this->ci->form_validation->set_message('max_length', '%s alanı en fazla 50 karakter olmalı');

		
		if($this->ci->form_validation->run() == FALSE){
			return false;
		}else{
			return true;
		}

	}

}