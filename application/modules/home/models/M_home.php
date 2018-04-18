<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_home extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function home ($id) {
		return $this->db
			->where("id_user", $id)
			->get("user", 1);
	}

	public function experience ($id) {
		return $this->db
			->where("id_user", $id)
			->where("publish", "ya")
			->order_by('tahun_awal', 'desc')
			->order_by('tahun_akhir', 'desc')
			->order_by('present', 'desc')
			->get("pengalaman");
	}

	public function portofolio ($id) {
		return $this->db
			// ->join('portofolio_kategori p_k', 'p_k.id_portofolio_kategori = p.id_portofolio_kategori', 'left')
			->where("id_user", $id)
			->where("publish", "ya")
			->order_by('tahun_awal', 'desc')
			->order_by('tahun_akhir', 'desc')
			->get("portofolio p");
	}

	public function agenda ($id) {
		return $this->db
			->where("id_user", $id)
			->where("publish", "ya")
			->order_by('date_agenda', 'desc')
			->where('DATE(`date_agenda`) >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)')
			->get("agenda", 5);
	}

	public function pendidikan ($id) {
		return $this->db
			->where("id_user", $id)
			->where("publish", "ya")
			->order_by('tahun_awal', 'asc')
			->order_by('tahun_akhir', 'asc')
			->get("pendidikan");
	}

	public function blog_post ($id) {
		return $this->db
			->where("id_user", $id)
			->where("publish", "ya")
			->order_by('date_publish', 'desc')
			->get("blog_post", 3);
	}

	public function blog_post_get ($slug) {
		return $this->db
			->select("b_p.*, k.kategori, u.nama_lengkap, u.biografi")
			->join("blog_post_kategori k", "k.id_kategori = b_p.id_kategori", "left")
			->join("user u", "u.id_user = b_p.id_user", "left")
			->where("slug", $slug)
			->where("publish", "ya")
			->get("blog_post b_p");
	}

	public function sosial_media ($id) {
		return $this->db
			->select('s_m.*, s_m_k.*')
			->join('sosial_media_kategori s_m_k', 's_m_k.id_sosial_media_kategori = s_m.id_sosial_media_kategori', 'left')
			->where("id_user", $id)
			->where("publish", "ya")
			->get("sosial_media s_m");
	}

}

/* End of file M_home.php */
/* Location: ./application/modules/home/models/M_home.php */