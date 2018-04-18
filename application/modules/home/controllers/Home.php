<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

	private $title = "V-Card 2018";
	private $module = "home";
	private $id_user_vcard = 1;

	public function __construct() {
		parent::__construct();
		$this->output->set_template("public/default");
		// $this->output->set_title($this->title);
		$this->load->model("M_home", "M_app");
	}

	public function index () {
		// custom
		$this->output->script_head('css/home.css');
		$this->output->script_foot('js/home.js');

		$id = $this->id_user_vcard;

		$home = $this->M_app->home($id);
		$experience = $this->M_app->experience($id);
		$portofolio = $this->M_app->portofolio($id);
		$agenda = $this->M_app->agenda($id);
		$pendidikan = $this->M_app->pendidikan($id);
		$blog_post = $this->M_app->blog_post($id);
		$sosial_media = $this->M_app->sosial_media($id);

		if ($home->num_rows() > 0) {
			$val_home = $home->row();
			$val_experience = $experience->result();
			$val_portofolio = $portofolio->result();
			$val_pendidikan = $pendidikan;
			$val_blog_post = $blog_post;
			$val_agenda = $agenda;
			$val_sosial_media = $sosial_media->result();

			$data = array(
				'title' => $val_home->nama_lengkap,
				"home" => $val_home,
				"experience" => $val_experience,
				"portofolio" => $val_portofolio,
				"pendidikan" => $val_pendidikan,
				"agenda" => $val_agenda,
				"blog_post" => $val_blog_post,
				"sosial_media" => $val_sosial_media,
				"videoList" => $this->_youtube(),
			);

			$this->output->set_meta("title", $data['title']);
			$this->output->set_meta("copyright", $data['title']);
	        $this->output->set_meta("keyword", "$val_home->biografi");
			$this->output->set_title($data['title']);
			$this->load->view('home', $data);
		} else {
			show_404();
		}
	}

	public function _youtube() {
		$API_key    = 'AIzaSyCjX4gVB7lHfX2nDCIFIIO6a2tuj16PLMQ';
		$channelID  = 'UCe0bvM51OA3bvY98PuMcTlg';
		$maxResults = 3;

		$ssl_arr = array(
	        'ssl' => array(
	            'verify_peer' => false,
	        ));

		$response = file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$channelID.'&maxResults='.$maxResults.'&key='.$API_key.'', FALSE, stream_context_create($ssl_arr));

		return json_decode($response);
	}

	public function detail ($slug)	{
		$id = $this->id_user_vcard;
		$query = $this->M_app->blog_post_get($slug);

		if ($query->num_rows() > 0) {

			$row = $query->row();

			$data = array(
				'row' => $row,
				'list' => $this->M_app->blog_post($id),
				'title' => $row->nama_lengkap,
				'subtitle' => $row->judul,
			);

			$this->output->set_meta("title", $data['subtitle']);
			$this->output->set_meta("copyright", $data['title']);
	        $this->output->set_meta("keyword", "$row->biografi");
	        $this->output->set_meta("description", "$row->sinopsis");
	        $this->output->set_meta("author", "$row->nama_lengkap");

			$this->output->script_foot('blog_post/js/detail.js');

			$this->output->set_title($data['title']);
			$this->output->append_title($data['subtitle']);

			$this->load->view('blog_post/detail', $data);
		} else {
			redirect('home');
		}
	}

}

/* End of file Home.php */
/* Location: ./application/modules/home/controllers/Home.php */