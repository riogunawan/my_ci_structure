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
		// $this->load->model("M_input_text", "M_app");
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
				"subtitle" => "List Data",
			);

		$this->output->append_title(@$data['subtitle']);
		$this->output->append_title(@$data['title_awal']);
		$this->load->view("$this->module/data", $data);
	}

}

/* End of file Input_text.php */
/* Location: ./application/modules/basic_form/controllers/Input_text.php */