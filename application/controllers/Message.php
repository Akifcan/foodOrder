<?php 

class Message extends MY_CONTROLLER{

	function __construct(){
		parent::__construct();
		$this->load->model('Message_model');
	}

	function send_message(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$user_id = $this->input->post('user_id', true);
			$ticket = $this->input->post('ticket', true);
			$message = $this->input->post('message', true);

			$send_message = $this->Message_model->send_message(
				array(
					'user_id' => $user_id,
					'title'  => $ticket,
					'message' => $message,
					'ip_address' => $_SERVER['REMOTE_ADDR']
				)
			);

			if($send_message){
				echo json_encode(array(true));
			}

		}
	}

	function messages(){
		echo json_encode($this->Message_model->get_all());
	}

}