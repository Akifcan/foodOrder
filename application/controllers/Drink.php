<?php 

	class Drink extends MY_CONTROLLER{

		function __construct(){
			parent::__construct();
			$this->load->model('Drink_model');
		}

		function get_all_drinks(){
			echo json_encode($this->Drink_model->get_all());
		}

	}