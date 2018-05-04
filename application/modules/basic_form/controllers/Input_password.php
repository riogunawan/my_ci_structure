<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Input_password extends MX_Controller {

	private $title_awal = "Basic Form";
	private $title = "Input Password";
	private $module = "basic_form/input_password";
	private $stat = false;

	public function __construct() {
		parent::__construct();
		$this->output->set_template("admin/default");
		$this->output->set_title($this->title);
		$this->load->model("M_input_password", "M_app");
	}

	public function index () {
		// OTHERS CSS & JS
			// JQuery DataTable Css
			$this->output->css('assets/themes/AdminBSBMaterialDesign/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css');
			$this->output->js('assets/themes/AdminBSBMaterialDesign/plugins/jquery-datatable/jquery.dataTables.js');
			$this->output->js('assets/themes/AdminBSBMaterialDesign/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js');
		// CLOSE

		//CUSTOM CS JS
		$this->output->script_foot("$this->module/js/data.js");

		$data = array(
				"title" => $this->title,
				"title_awal" => $this->title_awal,
				"subtitle" => "Tabel Data",
				"link_add" => site_url("$this->module/form"),
				"filter" => array(
					"input_password" => form_input(array(
						'name' => "input_password",
						"class" => "form-control input_password",
						"type" => "password",
						 )),
					),
			);

		$this->output->append_title(@$data['subtitle']);
		$this->output->append_title(@$data['title_awal']);
		$this->load->view("$this->module/data", $data);
	}

	public function data () {
		$this->output->unset_template();
		header("Content-type: application/json");
		if (
			isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
			!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
			strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
		) {
			echo $this->M_app->data($this->input->post());
		}
		return;
	}

	public function form ($id = 0) {
		$this->_formAssets();

		// custom
		$this->output->script_foot("$this->module/js/form.js");

		if ($id > 0) {
			$this->edit($id);
		} else {
			$this->add();
		}
	}

	private function _formAssets () {
	}

	private function add () {
		$data = $this->_formInputData(array(
			'subtitle' => 'Tambah Data',
			"aksi" => base_url("$this->module/add_proses"),
		));

		$this->load->view("$this->module/form", $data);
	}

	private function edit ($id) {
		$sql = $this->M_app->cekid($id);

		if ($sql->num_rows() > 0) {
			$val = $sql->row();

			$data = $this->_formInputData(array(
				"subtitle" => "Edit Data ".$val->input_password,
				"aksi" => base_url("$this->module/edit_proses"),
				"id" => $id,
				"input_password" => $val->input_password,
			));
			
			$this->load->view("$this->module/form", $data);
		} else {
			show_404();
		}
	}

	public function add_proses () {
		$this->output->unset_template();
		$this->_rules();
		$back = "$this->module/form";
		$submsg = "Gagal di proses";

		if ($this->input->post()) {
			if (!$this->form_validation->run()) {
				$submsg = $this->_formPostProsesError();
			} else {
				$data = $this->_formPostInputData();
				$add = $this->M_app->add($data);
				if ($add) {
					$this->stat = true;
					$back = "$this->module";
					$submsg = "Proses Berhasil";
				}
			}
			$this->_notif($back, $submsg);
		} else {
			show_404();
		}
	}

	public function edit_proses () {
		$this->output->unset_template();
		$id = $this->input->post("id");

		$sql = $this->M_app->cekId($id);

		if (
			$this->input->post() AND
			$sql->num_rows() > 0
		) {
			$this->_rules();
			$back = "$this->module/form/$id";
			$submsg = "Gagal di proses";

			if (!$this->form_validation->run()) {
				$submsg = $this->_formPostProsesError();
			} else {
				$data = $this->_formPostInputData();
				$edit = $this->M_app->edit($id, $data);
				if ($edit) {
					$this->stat = true;
					$back = "$this->module";
					$submsg = "Proses Berhasil";
				}
			}
			$this->_notif($back, $submsg);
		} else {
			show_404();
		}
	}

	public function delete_proses () {
		$this->output->unset_template();

		$id = $this->input->post('id');
		$sql = $this->M_app->cekId($id);

		if ($sql->num_rows()) {

			$del = $this->M_app->delete($id);

			if ($del) {
				$this->stat = true;
			}

			echo json_encode(array(
				"stat" => $this->stat
			));
		} else {
			show_404();
		}
	}

	private function _formInputData ($data = array()) {
		$this->output->append_title($data['subtitle']);
		$this->output->append_title($this->title_awal);
		
		return array(
			"title" => $this->title,
			"title_awal" => $this->title_awal,
			"subtitle" => @$data['subtitle'],
			"link_back" => site_url($this->module),
			"form_action" => $data['aksi'],

			"input" => array(
				"hide" => array(
					"id" => form_input(array(
						"type" => "hidden",
						"name" => "id",
						"class" => "id",
						"value" => @$data['id'],
					))
				),

				"input_password" => form_input(array(
					"name" => "input_password",
					"value" => @$data['input_password'],
					"class" => "form-control input_password",
					"type" => "password",
					"required" => "",
				)),
				"pass_confirm" => form_input(array(
					"name" => "pass_confirm",
					"value" => @$data['pass_confirm'],
					"class" => "form-control pass_confirm",
					"type" => "password",
				)),
			)
		);
	}

	private function _formPostInputData () {
		$data = array(
			"input_password" => password_hash($this->input->post("input_password"), PASSWORD_BCRYPT, array('cost' => 12)),
		);

		return $data;
	}

	private function _formPostProsesError () {
		$err = "";

		if(form_error("input_password")) {
			$err .= form_error("input_password");
		}
		if(form_error("pass_confirm")) {
			$err .= form_error("pass_confirm");
		}

		return $err;
	}

	private function _rules () {
		$this->load->helper('security');
		$this->load->library('form_validation');

		$config = array(
			array(
				"field" => "input_password",
				"label" => "Input Password",
				"rules" => "required",
				"errors" => array(
					"required" => "%s tidak boleh kosong"
				)
			),
			array(
				"field" => "pass_confirm",
				"label" => "Konfirmasi Password",
				"rules" => "matches[input_password]",
				"errors" => array(
					"matches" => "%s tidak sama dengan Password"
				)
			),
		);

		$this->form_validation->set_error_delimiters("<div class='alert alert-danger'><strong>Oh snap!</strong>&nbsp; ", "</div>");
		$this->form_validation->set_rules($config);
	}

	private function _notif ($back, $submsg = "") {
		if ($this->stat) {
			$this->session->set_flashdata( "msg", quirkNotif(true, "Sukses", $submsg) );
		} else {
			$this->session->set_flashdata( "msg", quirkNotif(false, "Gagal", $submsg) );
		}

		redirect($back);
	}

}

/* End of file Input_password.php */
/* Location: ./application/modules/basic_form/controllers/Input_password.php */