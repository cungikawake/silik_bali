<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	
	function __construct() {
		parent::__construct();		
		$this->load->model("biodata_model");
		$this->load->model("laporan_model");
	}
	
	public function index () {
		$this->auth->login();
		
		redirect(base_url("/admin/laporan/penugasan"));
	}
	
	public function penugasan () {
		$data = array();
		
		$pegawai = $this->biodata_model->getBiodataByPegawaiBalai(1);
		
		if (!empty($pegawai)) {
			$lookupPegawai = array();
			$ktp = array();
			
			foreach ($pegawai as $peg) {
				$ktp[] = $peg["ktp"];
				$lookupPegawai[$peg["ktp"]] = $peg;
			}
			
			$laporan = $this->laporan_model->getLaporanPenugasan($ktp);
			
			if (!empty($laporan)) {
				$laporanPenugasan = array();
				
				foreach ($laporan as $lap) {
					$laporanPenugasan[$lap["ktp"]] = $lap;
					$laporanPenugasan[$lap["ktp"]]["nama"] = $lookupPegawai[$lap["ktp"]]["nama"];
				}
				
				$data["laporan"] = $laporanPenugasan;
			}
		}
		
		$this->load->view('backend/laporan/penugasan_list',$data);
	}
}
