<?php
class M_login extends CI_Model {

	private $user;

	public function __construct() {
		$table = $this->config->load("database_table", true);
		$this->user = $table['user'];
	}

	//untuk mendapatkan data admin yg login
	public function getUserData($username){
		return $this->db
			->select("id_user, username, password, nama_lengkap, foto, title_user")
			->where('username', "$username")
			->get($this->user, 1);
	}
}