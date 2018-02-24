<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class General_model extends CI_Model {
	
	public function respuestaId($id) {
		$this->db->where('p_planes_id',$id);
		return $this->db->get('cat_planes')->row();
	}
}