<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validasi extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model("validasi_ttd_model");
	}
	
	function ttd ($kode = "") {
		if (!empty($kode)) {
			$ttd = $this->validasi_ttd_model->getByKode($kode);
			
			if (!empty($ttd)) {
				$this->load->view('frontend/validasi/ttd', $ttd);
			}
			else {
				$this->load->view('frontend/errors/ttd');
			}
		}
		else {
			$this->load->view('frontend/errors/logo');
		}
	}
}