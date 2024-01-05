<?php
class Master_komponen_kegiatan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Master_komponen_kegiatan_model', 'komponen_model');
    }

    public function index() {
        $data['records'] = $this->komponen_model->get_all_records();
        $this->load->view('master_komponen_kegiatan/index', $data);
    }

    public function create() {
        // Your create form logic goes here
    }

    public function edit($id) {
        $data['record'] = $this->komponen_model->get_record_by_id($id);
        // Your edit form logic goes here
    }

    public function store() {
        $data = $this->input->post(); // Assuming form data is sent using POST
        $this->komponen_model->insert_record($data);
        redirect('master_komponen_kegiatan');
    }

    public function update($id) {
        $data = $this->input->post();
        $this->komponen_model->update_record($id, $data);
        redirect('master_komponen_kegiatan');
    }

    public function delete($id) {
        $this->komponen_model->delete_record($id);
        redirect('master_komponen_kegiatan');
    }
}
?>
