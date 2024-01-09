<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  Migration_add_field_komponen_kegiatan extends CI_Migration {

   public function up() { 
       
      // Tambah Filed Kegiatan
      $fields = array(
         "options" => array(
            "type" => "text",
            "after" => "zoom_code_kegiatan"
         )
      );
      $this->dbforge->add_column("kegiatan", $fields);
   }

   public function down() {
      $this->dbforge->drop_column('kegiatan', 'options');
   }
}
