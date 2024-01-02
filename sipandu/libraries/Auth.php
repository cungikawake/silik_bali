<?php
	if (! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Auth {
		protected $CI;
		
		public function __construct() {
			$this->CI =& get_instance();
		}
		
		public function login () {
			if (!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
				redirect(base_url('/admin/login/'));
			}
		}
		
		public function guest () {
			if (!isset($_SESSION["guest"]) || empty($_SESSION["guest"])) {
				redirect(base_url('/user/login/'));
			}
		}
	}
?>