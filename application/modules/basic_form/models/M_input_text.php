<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_input_text extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function data($post, $debug = false)	{
		$order = $post['order'][0];

		$this->db->start_cache();

			$this->db->from("basic_form a");

			// filter
			if (!empty($post['input_text'])) {
				$this->db->like('a.input_text', $post['input_text'], 'both');
			}

			$orderColumn = array(
				2 => "a.input_text",
			);

			// order
			if ($order['column'] == 0) {
				$this->db->order_by('a.id', 'DESC');
			} else {
				$this->db->order_by($orderColumn[$order['column']], $order['dir']);
			}

			// join
			// $this->db->join("ikm_katprod kat", "kat.katprod_id = a.katprod_id", 'left');

		$this->db->stop_cache();

		// get num rows
		$this->db->select('a.id');
		$rowCount = $this->db->get()->num_rows();

		// get result
		$this->db->select('a.*');

		$this->db->limit($post['length'], $post['start']);

		$val = $this->db->get()->result();

		$this->db->flush_cache();

		$output['draw']            = $post['draw'];
		$output['recordsTotal']    = $rowCount;
		$output['recordsFiltered'] = $rowCount;
		$output['data']            = array();

		if ($debug) {
			$output['sql'] = $this->db->last_query();
		}

		$no = 1 + $post['start'];

		$base = base_url();

		foreach ($val as $data) {

			$btnAksi = "";

			$btnAksi .= "
				<li>
					<a href='{$base}basic_form/input_text/form/$data->id' class='btn-edit'>
						<i class='material-icons'>edit</i>
						Edit
					</a>
				</li>
			";

			$btnAksi .= "
				<li>
					<a href='#' class='btn-delete' data-id='$data->id'>
						<i class='material-icons'>delete</i>
						Delete
					</a>
				</li>
			";

			$aksi = "
			<div class='btn-group'>
				<button type='button' class='btn btn-warning waves-effect dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
					<i class='material-icons'>settings</i>
				</button>
				<ul class='dropdown-menu'>
					$btnAksi
				</ul>
			</div>
			";

			$baris = array(
				"no" => $no,
				"aksi" => $aksi,
				"input_text" => $data->input_text,
			);

			array_push($output['data'], $baris);
			$no++;
		}
		return json_encode($output);
	}

}

/* End of file M_input_text.php */
/* Location: ./application/modules/basic_form/models/M_input_text.php */