<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MX_Controller {

	private $title = "Users";
	private $upload_path = "./assets/upload/";
	private $stat = false;

	public function __construct() {
		parent::__construct();
		Modules::run("login/cek_login");
		$this->output->set_template("admin/default");
		$this->output->set_title($this->title);
		$this->load->model("M_user", "M_app");
	}

	public function index () {
		// datatables
		$this->output->js('assets/themes/e-disi-admin/vendors/datatables/jquery.dataTables.js');
		$this->output->js('assets/themes/e-disi-admin/vendors/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.js');
		$this->output->css('assets/themes/e-disi-admin/vendors/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css');

		// validate
		$this->output->js('assets/themes/e-disi-admin/vendors/jquery-validate/jquery.validate.js');

		// custom
		$this->output->script_foot('js/data.js');

		$data = array(
			'title' => $this->title,
			'subtitle' => "List Data",
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
		// validate
		$this->output->js('assets/themes/e-disi-admin/vendors/jquery-validate/jquery.validate.js');
	}

	public function form ($id = 0) {
		$this->_formAssets();

		// custom
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
			"aksi" => base_url("user/add_proses"),
		));

		$this->load->view("form", $data);
	}

	private function edit ($id) {
		$sql = $this->M_app->cekid($id);

		if ($sql->num_rows() > 0) {
			$val = $sql->row();

			$data = $this->_formInputData(array(
				"subtitle" => "Edit Data ".$val->nama_lengkap,
				"aksi" => base_url("user/edit_proses"),
				"id_user" => $id,
				"username" => $val->username,
				"nama_lengkap" => $val->nama_lengkap,
			));
			
			$this->load->view("form", $data);
		} else {
			show_404();
		}
	}

	public function add_proses () {
		$this->output->unset_template();
		$this->_rules();
		$back = "user/form";
		$submsg = "Process Failed";

		if ($this->input->post()) {
			if (!$this->form_validation->run()) {
				$submsg = $this->_formPostProsesError();
			} else {
				$data = $this->_formPostInputData();
				$add = $this->M_app->add($data);
				if ($add) {
					$this->stat = true;
					$back = "user";
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
		$id = $this->input->post("id_user");

		$sql = $this->M_app->cekId($id);

		if (
			$this->input->post() AND
			$sql->num_rows() > 0
		) {
			$this->_rules();
			$back = "user/form/$id";
			$submsg = "Process Failed";
			$val = $sql->row();

			if (!$this->form_validation->run()) {
				$submsg = $this->_formPostProsesError();
			} else {
				$data = $this->_formPostInputData();
				$edit = $this->M_app->edit($id, $data);
				if ($edit) {
					$this->stat = true;
					$back = "user";
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

			$del = $this->M_app->delete($id);

			if ($val->foto != "") {
				unlink("{$this->upload_path}/foto/$val->foto");
				unlink("{$this->upload_path}/foto/thumb/$val->foto");
			}
			if ($val->banner != "") {
				unlink("{$this->upload_path}/banner/$val->banner");
			}

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
		
		return array(
			"title" => $this->title,
			"subtitle" => @$data['subtitle'],
			"link_back" => base_url($this->router->fetch_class()),
			"form_action" => $data['aksi'],

			"input" => array(
				"hide" => array(
					"id" => form_input(array(
						"type" => "hidden",
						"name" => "id_user",
						"class" => "id_user",
						"value" => @$data['id_user'],
					))
				),

				"nama_lengkap" => form_input(array(
					"name" => "nama_lengkap",
					"value" => @$data['nama_lengkap'],
					"class" => "form-control nama_lengkap",
					"type" => "text",
					"placeholder" => "input full name...",
				)),
				"username" => form_input(array(
                    "name" => "username",
                    "class" => "form-control username",
                    "type" => "text",
                    "value" => @$data['username'],
					"placeholder" => "input username...",
                )),
                "password" => form_input(array(
                    "name" => "password",
                    "class" => "form-control password",
                    "type" => "password",
					"placeholder" => "input password...",
                )),
                "password_confirm" => form_input(array(
                    "name" => "password_confirm",
                    "class" => "form-control password_confirm",
                    "type" => "password",
					"placeholder" => "input confirm password...",
                )),
			)
		);
	}

	private function _formPostInputData () {
		$username = $this->input->post('username', TRUE);
		$data = array(
			"username" => $username,
			"nama_lengkap" => $this->input->post("nama_lengkap", TRUE),
		);

		if (!empty($this->input->post('password'))) {
			$data += array(
					"password" => password_hash($this->input->post('password'), PASSWORD_BCRYPT, array('cost' => 12)),
				);
		}

		return $data;
	}

	private function _formPostProsesError () {
		$err = "";

		if(form_error("nama_lengkap")) {
			$err .= form_error("nama_lengkap");
		}

		if ($this->input->post('username')) {
			if(form_error("username")) {
				$err .= form_error("username");
			}
			if(form_error("password")) {
				$err .= form_error("password");
			}
			if(form_error("password_confirm")) {
				$err .= form_error("password_confirm");
			}
		}

		return $err;
	}

	private function _rules () {
		$this->load->helper('security');
		$this->load->library('form_validation');

		$config = array(
			array(
				"field" => "nama_lengkap",
				"label" => "Full Name",
				"rules" => "required",
				"errors" => array(
					// "required" => "%s tidak boleh kosong"
				)
			),
		);

		if ($this->input->post('username')) {
			$config += array(
				array(
					"field" => "username",
					"label" => "Username",
					"rules" => "required",
					"errors" => array(
						// "required" => "%s tidak boleh kosong"
					)
				),
				array(
					"field" => "password",
					"label" => "Password",
					"rules" => "required",
					"errors" => array(
						// "required" => "%s tidak boleh kosong"
					)
				),
				array(
					"field" => "password_confirm",
					"label" => "Confirm Password",
					"rules" => "matches[password]",
					"errors" => array(
						// "matches" => "%s tidak Sama Dengan Password"
					)
				),
			);
		}

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

	public function check() {
        $this->output->unset_template();
        if($this->input->is_ajax_request()){
            if($this->input->post()){
                $username = $this->input->post('username');
                $id_user = $this->input->post('id_user');
                if ($username) {
                    $check = $this->M_app->check_username($username, $id_user);
                    if($check){
                        echo "false";
                    }else{
                        echo "true";
                    }
                }
            }
        }
    }

}

/* End of file User.php */
/* Location: ./application/modules/user/controllers/User.php */