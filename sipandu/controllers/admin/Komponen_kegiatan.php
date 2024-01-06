<?php
class Komponen_kegiatan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Master_komponen_kegiatan_model', 'komponen_model');
    }

    public function index() {
        $this->auth->login();
		$this->load->view('/backend/komponen_kegiatan/lists'); 
    }
 
    public function save () {
		$out = array();
		$out["error"] = false;
		$out["msg"] = "Berhasil menyimpan komponen kagiatan!";
		$out["close_modal"] = true;
		$out["reload_table"] = true;
		
		if (isset($_POST) && !empty($_POST)) { 
			$data = $_POST;
			
			$id = (isset($data["id"]) ? $data["id"] : "");

			unset($data["id"]);
			
			if (isset($data["name"]) && !empty($data["name"])) {
				$data["code"] = $this->generate_slug($data["name"]);
                $data['table_name'] = 'kegiatan_'.$data["code"]; 
			}
             
			$result = $this->komponen_model->save($data, $id);
			 
			if (!$result) {
				$out["error"] = true;
				$out["msg"] = "Gagal menyimpan komponen kegiatan. Silahkan coba lagi!";
			}
		}
		
		print json_encode($out);
		exit();
	} 

    public function generate_slug($str) { 
        $str = strtolower($str); 
        $str = str_replace(' ', '_', $str); 
        $str = preg_replace('/[^a-z0-9_]/', '', $str); 

        return $str;
    }
}
?>
