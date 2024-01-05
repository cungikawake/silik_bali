<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('migration');
    }

    public function index() { 
        $this->load->library('migration');
        if ($this->migration->current() === FALSE)
        {
            echo $this->migration->error_string();
        }else{
            echo "Table Migrated Successfully.";
        }
    }

}