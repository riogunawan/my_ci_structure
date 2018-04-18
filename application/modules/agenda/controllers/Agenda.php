<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends MX_Controller {

	private $title = "Agenda";
	private $module = "agenda";
	private $upload_path = "./assets/upload/agenda";
	private $stat = false;

	public function __construct() {
		parent::__construct();
		Modules::run("login/cek_login");
		$this->output->set_template("admin/default");
		$this->output->set_title($this->title);
		$this->load->model("M_agenda", "M_app");
	}

	public function index () {
		// datatables
		$this->output->js('assets/themes/e-disi-admin/vendors/datatables/jquery.dataTables.js');
		$this->output->js('assets/themes/e-disi-admin/vendors/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js');
		$this->output->css('assets/themes/e-disi-admin/vendors/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css');

		// custom
		$this->output->script_foot('js/data.js');

		$data = array(
			'title' => $this->title,
			'subtitle' => "List Data",
			"link_add" => site_url("$this->module/form"),
		);
		$this->output->append_title($data['subtitle']);
		$this->load->view('data', $data);
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

	private function _formAssets () {
		// ckeditor
		$this->output->js('assets/themes/e-disi-admin/vendors/ckeditor/ckeditor.js');
		$this->output->js('assets/themes/e-disi-admin/vendors/ckeditor/adapters/jquery.js');

		// DATETIMEPICKER
		$this->output->css('assets/themes/e-disi-admin/vendors/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css');
		$this->output->js('assets/themes/e-disi-admin/vendors/moment/js/moment.min.js');
		$this->output->js('assets/themes/e-disi-admin/vendors/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js');

		// file input
		$this->output->css('assets/themes/e-disi-admin/vendors/file-input/css/fileinput.css');
		$this->output->css('assets/themes/e-disi-admin/vendors/file-input/css/custom-file-input.css');
		$this->output->js('assets/themes/e-disi-admin/vendors/file-input/js/fileinput.js');
		$this->output->js('assets/themes/e-disi-admin/vendors/file-input/themes/fa/theme.js');

		// validate
		$this->output->js('assets/themes/e-disi-admin/vendors/jquery-validate/jquery.validate.js');
	}

	public function form ($id = 0) {
		$this->_formAssets();

		// custom
		$this->output->script_foot('js/fileinput.js');
		$this->output->script_foot('js/form.js');

		if ($id > 0) {
			$this->edit($id);
		} else {
			$this->add();
		}
	}

	private function add () {
		$data = $this->_formInputData(array(
			'subtitle' => 'Add Data',
			"aksi" => base_url("$this->module/add_proses"),
		));

		$this->load->view("form", $data);
	}

	private function edit ($id) {
		$sql = $this->M_app->cekid($id);

		if ($sql->num_rows() > 0) {
			$val = $sql->row();

			$cover = (file_exists(FCPATH . "$this->upload_path/$val->cover")) ? $val->cover : "";

			$data = $this->_formInputData(array(
				"subtitle" => "Edit Data ".$val->title,
				"aksi" => base_url("$this->module/edit_proses"),
				"id_agenda" => $id,
				"title" => $val->title,
				"date_agenda" => $val->date_agenda,
				"city" => $val->city,
				"deskripsi" => $val->deskripsi,
				"cover" => $cover,
				"publish" => $val->publish,
			));
			
			$this->load->view("form", $data);
		} else {
			show_404();
		}
	}

	public function add_proses () {
		$this->output->unset_template();
		$this->_rules();
		$back = "$this->module/form";
		$submsg = "Process Failed";

		if ($this->input->post()) {
			if (!$this->form_validation->run()) {
				$submsg = $this->_formPostProsesError();
			} else {
				$cover = "";
				if ( !empty($_FILES['cover']['name']) && isset($_FILES['cover']['name']) ) {
					$file_element_name = 'cover';
					$user_upload_path = $this->upload_path.'/';

					$upload = $this->_upload($file_element_name, $user_upload_path);
					$cover = ($upload == "") ? $cover : $upload;
				}

				$data = $this->_formPostInputData($cover, true);
				$add = $this->M_app->add($data);
				if ($add) {
					$this->stat = true;
					$back = "$this->module";
					$submsg = "Process Succeeded";
				}
			}
			$this->_notif($back, $submsg);
		} else {
			show_404();
		}
	}

	public function edit_proses () {
		$this->output->unset_template();
		$id = $this->input->post("id_agenda");

		$sql = $this->M_app->cekId($id);

		if (
			$this->input->post() AND
			$sql->num_rows() > 0
		) {
			$this->_rules();
			$back = "$this->module/form/$id";
			$submsg = "Process Failed";

			if (!$this->form_validation->run()) {
				$submsg = $this->_formPostProsesError();
			} else {
				$sql = $this->M_app->cekImage($id, "cover");
				$val = $sql->row();

				$cover = $val->cover;

				if ( !empty($_FILES['cover']['name']) && isset($_FILES['cover']['name']) ) {
					$file_element_name = 'cover';
					$user_upload_path = $this->upload_path.'/';

					$upload = $this->_upload($file_element_name, $user_upload_path, $cover);
					$cover = ($upload == "") ? $cover : $upload;
				}

				$data = $this->_formPostInputData($cover, false);
				$edit = $this->M_app->edit($id, $data);
				if ($edit) {
					$this->stat = true;
					$back = "$this->module";
					$submsg = "Process Succeeded";
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
			$val = $sql->row();

			if ($val->cover != "") {
				unlink("{$this->upload_path}/$val->cover");
				unlink("{$this->upload_path}/thumb/$val->cover");
			}

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

	public function _upload($file_element_name = "", $user_upload_path = "", $image = "") {
		$config['upload_path'] = $user_upload_path;
		$config['allowed_types'] = 'jpg|jpeg|gif|png|bmp';
		$config['max_size']  = 1024 * 3;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload');
		$this->upload->initialize($config);

		$file_name = "";

		if ($this->upload->do_upload($file_element_name)){
			$data_upload = $this->upload->data();
			$file_name = $data_upload["file_name"];

			if ($file_element_name == 'cover') {
				$config_resize['image_library'] = 'gd2';
				$config_resize['maintain_ratio'] = TRUE;
				$config_resize['master_dim'] = 'height';
				$config_resize['quality'] = "100%";
				$config_resize['source_image'] = $user_upload_path . $file_name;
				$config_resize['new_image'] = $user_upload_path . 'thumb/';
				$config_resize['width'] = 500;
				$config_resize['height'] = 500;

				$this->load->library('image_lib', $config_resize);

				if ( !$this->image_lib->resize() ) {
					$back = "$this->module";
					$submsg = "Resize File Failed";
					$this->stat = false;
					$this->_notif($back, $submsg);
				}
				
				if ($image != "") {
					unlink("{$user_upload_path}/thumb/$image");
				}
			}
			
			if ($image != "") {
				unlink("{$user_upload_path}/$image");
			}
		} else {
			$back = "$this->module";
			$submsg = "Upload File Failed";
			$this->stat = false;
			$this->_notif($back, $submsg);
		}

		return $file_name;
	}

	private function _formInputData ($data = array()) {
		$this->output->append_title($data['subtitle']);
		
		return array(
			"title" => $this->title,
			"subtitle" => @$data['subtitle'],
			"link_back" => base_url($this->router->fetch_class()),
			"form_action" => $data['aksi'],

			"cover" => @$data['cover'],

			"input" => array(
				"hide" => array(
					"id" => form_input(array(
						"type" => "hidden",
						"name" => "id_agenda",
						"class" => "id_agenda",
						"value" => @$data['id_agenda'],
					))
				),

				"title" => form_input(array(
					"name" => "title",
					"value" => @$data['title'],
					"class" => "form-control title",
					"type" => "text",
					"placeholder" => "input Title...",
				)),
				"date_agenda" => form_input(array(
                    "name" => "date_agenda",
                    "class" => "form-control date_agenda date",
                    "type" => "text",
                    "value" => @$data['date_agenda'],
					"placeholder" => "input Date Publish...",
                )),
                "city" => form_input(array(
                    "name" => "city",
                    "class" => "form-control city",
                    "type" => "text",
                    "value" => @$data['city'],
					"placeholder" => "input City...",
                )),
				"deskripsi" => form_textarea(array(
					"name" => "deskripsi",
					"class" => "form-control deskripsi",
					"value" => @$data['deskripsi']
				)),
				"publish" => array(
					"ya" => form_radio(array(
						"name" => "publish",
						"value" => "ya",
						"class" => "publish_ya",
						"checked" => ( empty($data['publish']) ) ? false : ( ( $data['publish'] == 'ya' ) ? true : false )
					)),
					"tidak" => form_radio(array(
						"name" => "publish",
						"value" => "tidak",
						"class" => "publish_tidak",
						"checked" => ( empty($data['publish']) ) ? true : ( ( $data['publish'] == 'tidak' ) ? true : false )
					))
				),

			)
		);
	}

	private function _formPostInputData ($cover, $slug = true) {
		$data = array(
			"title" => $this->input->post("title"),
			"date_agenda" => $this->input->post("date_agenda"),
			"city" => $this->input->post("city"),
			"cover" => $cover,
			"deskripsi" => $this->input->post("deskripsi"),
			"publish" => $this->input->post("publish"),
			"id_user" => $this->session->userdata('id_user'),
		);

		if ($slug) {
			$this->load->library('slug');
			$slug = $this->slug->createSlugDB($data['title'], "agenda", "slug");
			$data += array(
				'slug' => $slug,
			);
		}

		return $data;
	}

	private function _formPostProsesError () {
		$err = "";

		if(form_error("title")) {
			$err .= form_error("title");
		}
		if(form_error("date_agenda")) {
			$err .= form_error("date_agenda");
		}
		if(form_error("city")) {
			$err .= form_error("city");
		}
		if(form_error("deskripsi")) {
			$err .= form_error("deskripsi");
		}
		if(form_error("publish")) {
			$err .= form_error("publish");
		}

		return $err;
	}

	private function _rules () {
		$this->load->helper('security');
		$this->load->library('form_validation');

		$config = array(
			array(
				"field" => "title",
				"label" => "Title",
				"rules" => "required",
				"errors" => array(
					// "required" => "%s tidak boleh kosong"
				)
			),
			array(
				"field" => "city",
				"label" => "Synopsis",
				"rules" => "required",
				"errors" => array(
					// "required" => "%s tidak boleh kosong"
				)
			),
			array(
				"field" => "deskripsi",
				"label" => "Description",
				"rules" => "required",
				"errors" => array(
					// "required" => "%s tidak boleh kosong"
				)
			),
			array(
				"field" => "date_agenda",
				"label" => "Date Agenda",
				"rules" => "required",
				"errors" => array(
					// "required" => "%s tidak boleh kosong"
				)
			),
			array(
				"field" => "publish",
				"label" => "Publish",
				"rules" => "required",
				"errors" => array(
					// "required" => "%s tidak boleh kosong"
				)
			),
		);

		$this->form_validation->set_error_delimiters("<div class=''>", "</div>");
		$this->form_validation->set_rules($config);
	}

	private function _notif ($back, $submsg = "") {
		if ($this->stat) {
			$this->session->set_flashdata( "msg", quirkNotif(true, "Success", $submsg) );
		} else {
			$this->session->set_flashdata( "msg", quirkNotif(false, "Failed", $submsg) );
		}

		redirect($back);
	}

}

/* End of file Agenda.php */
/* Location: ./application/modules/agenda/controllers/Agenda.php */