<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {

	private $title = "Dashboard 2018";
	private $module = "dashboard";
	private $stat = false;

	public function __construct() {
		parent::__construct();
		$this->output->set_template("admin/default");
		$this->output->set_title($this->title);
		// $this->load->model("M_dashboard", "M_app");
	}

	public function index () {
		// OTHERS CSS & JS
			// Jquery CountTo Plugin Js
			$this->output->js('assets/themes/AdminBSBMaterialDesign/plugins/jquery-countto/jquery.countTo.js');

			// Morris Chart
			$this->output->css('assets/themes/AdminBSBMaterialDesign/plugins/morrisjs/morris.css');
			$this->output->js('assets/themes/AdminBSBMaterialDesign/plugins/raphael/raphael.min.js');
			$this->output->js('assets/themes/AdminBSBMaterialDesign/plugins/morrisjs/morris.js');

			// ChartJs
			$this->output->js('assets/themes/AdminBSBMaterialDesign/plugins/chartjs/Chart.bundle.js');

			// ChartJs
			$this->output->js('assets/themes/AdminBSBMaterialDesign/plugins/chartjs/Chart.bundle.js');

			// Flot Charts Plugin Js
			$this->output->js('assets/themes/AdminBSBMaterialDesign/plugins/flot-charts/jquery.flot.js');
			$this->output->js('assets/themes/AdminBSBMaterialDesign/plugins/flot-charts/jquery.flot.resize.js');
			$this->output->js('assets/themes/AdminBSBMaterialDesign/plugins/flot-charts/jquery.flot.pie.js');
			$this->output->js('assets/themes/AdminBSBMaterialDesign/plugins/flot-charts/jquery.flot.categories.js');
			$this->output->js('assets/themes/AdminBSBMaterialDesign/plugins/flot-charts/jquery.flot.time.js');

			// Sparkline Charts Plugin Js
			$this->output->js('assets/themes/AdminBSBMaterialDesign/plugins/jquery-sparkline/jquery.sparkline.js');
		// CLOSE

		//CUSTOM CS JS
		$this->output->script_foot('js/data.js');

		$data = array(
				"title" => "Dashboard",
			);

		$this->output->append_title(@$data['title']);
		$this->load->view('data', $data);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/modules/dashboard/controllers/Dashboard.php */