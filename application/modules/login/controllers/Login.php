<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller{

	private $msg = "Process Failed";
	private $stat = false;

	public function __construct () {
		parent::__construct ();
		$this->output->set_title("Markas Admin");
		$this->load->model("M_login");
	}

	public function index () {
		if ($this->session->userdata('login') == true) {
			$notif = quirkNotif(true, "Logged in", "Welcome " . $this->session->userdata('nama_lengkap'));
			$this->session->set_flashdata('msg', $notif);
			redirect('profile','refresh');
		}

		$data = array(
			"username" => array(
				"type" => "text",
				"class" => "form-control username",
				"name" => "username",
				"required" => "true",
				"placeholder" => "Username...",
			),
			"password" => array(
				"type" => "password",
				"class" => "form-control password",
				"name" => "password",
				"required" => "true",
				"placeholder" => "Password...",
			),
			"title" => "PT. Qapuas Media Technologi",
		);

		$this->load->view("form", $data);
	}

	public function login_proses () {

		if ($this->input->post()) {
			$this->load->library('form_validation');
			$this->load->helper('security');
			$_backto = "login";

			//validasi form
			$config = array(
				array(
					"field" => "username",
					"label" => "Username",
					"rules" => "required|xss_clean",
					"errors" => array(
						// "required" => "%s tidak boleh kosong"
					)
				),
				array(
					"field" => "password",
					"label" => "Password",
					"rules" => "required|xss_clean|trim",
					"errors" => array(
						// "required" => "%s tidak boleh kosong"
					)
				),
			);

			$this->form_validation->set_error_delimiters("<div class='text-danger'>", "</div>");
			$this->form_validation->set_rules($config);

			//jika validasi sukses
			if($this->form_validation->run() == TRUE) {
				$username = $this->input->post('username');
				$password = $this->input->post('password');

				$admin = $this->M_login->getUserData($username);

				if ($admin->num_rows() > 0) {
					$admin = $admin->row();
					$proses = true;

					if ($proses) {
						if (password_verify($password, $admin->password)) {
							$image = ( empty($admin->foto) || !file_exists(FCPATH . "assets/upload/foto/thumb/$admin->foto") ) ? base_url("assets/themes/e-disi-admin/images/thumb-user-photo.png") : base_url("assets/upload/foto/thumb/$admin->foto");
							$data = array(
								"id_user" => $admin->id_user,
								"username" => $admin->username,
								"password" => $admin->password,
								"nama_lengkap" => $admin->nama_lengkap,
								"title_user" => $admin->title_user,
								"foto" => $image,
								"login" => true,
								// "upload_image_file_manager" => true,
							);

							$this->session->set_userdata($data);

							$this->stat = true;
							$_backto = "profile";
						} else {
							$this->msg = "Sorry, your Username or Password is wrong";
						}
					}
				}

			}

			if ($this->stat) {
				$notif = quirkNotif(true, "Login Succeeded", "Welcome " . $this->session->userdata('nama_lengkap'));
				$this->session->set_flashdata('msg', $notif);
			} else {
				$notif = quirkNotif(false, "Login Failed", $this->msg);
				$this->session->set_flashdata('msg', $notif);
			}

			redirect($_backto);
		} else {
			show_404();
		}
	}

	public function cek_login ($level = "") {
		$status_login = $this->session->userdata('login');
		$password = $this->session->userdata('password');
		$username = $this->session->userdata('username');
		$sql = $this->db
			->select("id_user")
			->where("username", $username)
			->where("password", $password)
			->get("user", 1);

		if (!isset($status_login) || $status_login != TRUE || $sql->num_rows() == 0) {
			// $this->session->sess_destroy();
			$notif = quirkNotif(false, "Not Logged in", "log in first, then just go inside");
			$this->session->set_flashdata('msg', $notif);
			$data = array(
				"login" => false,
			);
			$this->session->set_userdata($data);

			redirect('login');
		} else {
			// redirect('dashboard');
			return true;
		}
	}

	public function logout () {
		$this->session->sess_destroy();
		redirect('login');
	}
}