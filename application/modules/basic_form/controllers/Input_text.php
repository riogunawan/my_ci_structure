<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Input_text extends MX_Controller {

	private $title_awal = "Basic Form";
	private $title = "Input Text";
	private $module = "basic_form/input_text";
	private $stat = false;

	public function __construct() {
		parent::__construct();
		$this->output->set_template("admin/default");
		$this->output->set_title($this->title);
		$this->load->model("M_input_text", "M_app");
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
					"input_text" => form_input(array(
						'name' => "input_text",
						"class" => "form-control input_text",
						"type" => "text",
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
		// validate
		// $this->output->js('assets/themes/e-disi-admin/vendors/jquery-validate/jquery.validate.js');
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
				"subtitle" => "Edit Data ".$val->input_text,
				"aksi" => base_url("$this->module/edit_proses"),
				"id" => $id,
				"input_text" => $val->input_text,
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

				"input_text" => form_input(array(
					"name" => "input_text",
					"value" => @$data['input_text'],
					"class" => "form-control input_text",
					"type" => "text",
					"required" => "",
				)),
			)
		);
	}

	private function _formPostInputData () {
		$data = array(
			"input_text" => $this->input->post("input_text"),
		);

		return $data;
	}

	private function _formPostProsesError () {
		$err = "";

		if(form_error("input_text")) {
			$err .= form_error("input_text");
		}

		return $err;
	}

	private function _rules () {
		$this->load->helper('security');
		$this->load->library('form_validation');

		$config = array(
			array(
				"field" => "input_text",
				"label" => "Input Text",
				"rules" => "required",
				"errors" => array(
					"required" => "%s tidak boleh kosong"
				)
			),
		);

		$this->form_validation->set_error_delimiters("<div class='alert alert-danger'><strong>Oh snap!</strong>", "</div>");
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

/* End of file Input_text.php */
/* Location: ./application/modules/basic_form/controllers/Input_text.php */