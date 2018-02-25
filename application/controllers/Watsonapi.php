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

	public function emociones() {
		$this->load->view('emociones');
	}

	public function voz() {
		$this->load->view('voz');
	}

	public function conversation() {
		$query = $this->input->post('query');
		$watson = new Watson();
		$watson->set_credentials('4fcf6baa-09f8-4088-b195-fa04ed58b1ab','MvBPIBdizPzS');
		$wid = "65b82fd3-47ea-4391-ad98-3ad5bfd1cf61";
		$data_array = $watson->send_watson_conv_request($query,$wid);
		$this->session->set_userdata('context', json_encode($data_array['context']));
		$watson->set_context($this->session->userdata('context'));
		if (isset($data_array['output']['p_planes_id'])) {
			//$this->output->set_output(json_encode($data_array));	
			switch ($data_array['output']['p_planes_id']) {
				case 1:
					$db = $this->general_model->respuestaId($data_array['output']['p_planes_id']);
					$data_array['db_response'] = json_encode($db);
					$this->output->set_output(json_encode($data_array));
					break;
				
				default:
					$this->output->set_output(json_encode($data_array));
					break;
			}
		}
		else {
			$this->output->set_output(json_encode($data_array));
		}
	}


	public function conversationRico() {
		$query = $this->input->post('query');
		$watson = new Watson();
		$watson->set_credentials('4fcf6baa-09f8-4088-b195-fa04ed58b1ab','MvBPIBdizPzS');
		$wid = "65b82fd3-47ea-4391-ad98-3ad5bfd1cf61";
		$data_array = $watson->send_watson_conv_request($query,$wid);
		$this->session->set_userdata('context', json_encode($data_array['context']));
		$watson->set_context($this->session->userdata('context'));
		$text = $this->translate($query);
		$emotional = $this->tone($text['translations'][0]['translation']);
		$data = array('conversation' => $data_array,'toneanalyzer'=>$emotional);
		$this->output->set_output(json_encode($data));
	}

	public function tone($query) {
		$toneAnalyzer = new ToneAnalyzer();
		$toneAnalyzer->set_credentials('004be85a-8866-41aa-a80d-62e6118a53fb','YufUIKBXWNMa');
		return $tone = $toneAnalyzer->tone($query);
	}

	public function translate($query) {
		$languajeTranslator = new LanguajeTranslator();
		$languajeTranslator->set_credentials('5c190533-a77e-4e5f-b207-5d2a2b3ed12a','NGcLTemQXo86');
		return $translate = $languajeTranslator->translate($query);
	}
}