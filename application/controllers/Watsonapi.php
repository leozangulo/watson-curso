<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Watsonapi extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library("Watson");
		$this->load->library('session');
	}

	public function index() {
		$this->load->view('dialogo');
	}

	public function conversation() {
		$query = $this->input->post('query');
		$watson = new Watson();
		$watson->set_credentials('fc83b4f1-ba12-484a-8bda-01527a0eebf2','N3ZtcLISvcqJ');
		$wid = "5b493b32-678b-4fb7-a252-cec9f4bc1d7b";
		$data_array = $watson->send_watson_conv_request($query,$wid);
		$this->session->set_userdata('context', json_encode($data_array['context']));
		$watson->set_context($this->session->userdata('context'));
		$this->output->set_output(json_encode($data_array));
	}
}