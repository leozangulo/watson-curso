<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Watsonapi extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library("Watson");
		$this->load->library("ToneAnalyzer");
		$this->load->library("LanguajeTranslator");
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

	public function tone() {
		$toneAnalyzer = new ToneAnalyzer();
		$toneAnalyzer->set_credentials('004be85a-8866-41aa-a80d-62e6118a53fb','YufUIKBXWNMa');
		$tone = $toneAnalyzer->tone('i like artifitial inttelligence');
		var_dump($tone);
	}

	public function translate() {
		$languajeTranslator = new LanguajeTranslator();
		$languajeTranslator->set_credentials('5c190533-a77e-4e5f-b207-5d2a2b3ed12a','NGcLTemQXo86');
		$translate = $languajeTranslator->translate('Odio tener que estar traduciendo todo a ingles antes de enviarlo');
		var_dump($translate);
	}
}