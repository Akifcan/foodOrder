<?php 

class My_Controller extends CI_CONTROLLER{

	function __construct(){
		parent::__construct();
		$this->output->set_content_type('application/json');
		$this->output->set_header('Access-Control-Allow-Origin: *');
		$this->output->set_header('Access-Control-Allow-Methods: GET, OPTIONS');
		$this->output->set_header('Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding');

	}

}