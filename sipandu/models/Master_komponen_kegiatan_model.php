<?php
class Master_komponen_kegiatan_model extends CI_Model {

    public function get_all_records() {
        return $this->db->get('master_komponen_kegiatan')->result();
    }

    public function get_record_by_id($id) {
        return $this->db->get_where('master_komponen_kegiatan', array('id' => $id))->row();
    }

    public function insert_record($data) {
        $this->db->insert('master_komponen_kegiatan', $data);
    }

    public function update_record($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('master_komponen_kegiatan', $data);
    }

    public function delete_record($id) {
        $this->db->where('id', $id);
        $this->db->delete('master_komponen_kegiatan');
    }
}
?>
