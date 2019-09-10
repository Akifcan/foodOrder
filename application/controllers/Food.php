<?php 

class Food extends MY_CONTROLLER{

	function __construct(){
		parent::__construct();
		$this->load->model('Food_model');
	}

	function get_all(){
		$foods = $this->Food_model->get_all();
		if($foods){
			echo json_encode(array(true, $foods));
		}
	}

}