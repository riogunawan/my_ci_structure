<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_input_password extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function data($post, $debug = false)	{
		$order = $post['order'][0];

		$this->db->start_cache();

			$this->db->from("basic_form a");

			// filter
			if (!empty($post['input_password'])) {
				$this->db->like('a.input_password', $post['input_password'], 'both');
			}

			$orderColumn = array(
				2 => "a.input_password",
			);

			// order
			if ($order['column'] == 0) {
				$this->db->order_by('a.id', 'DESC');
			} else {
				$this->db->order_by($orderColumn[$order['column']], $order['dir']);
			}

			// join

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
					<a href='{$base}basic_form/input_password/form/$data->id' class='btn-edit'>
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
				"input_password" => $data->input_password,
			);

			array_push($output['data'], $baris);
			$no++;
		}
		return json_encode($output);
	}

	public function add ($data) {
		$this->db->insert('basic_form', $data);
		return $this->db->insert_id();
	}

	public function edit ($id, $data) {
		$this->db
			->where("id", $id)
			->update("basic_form", $data);
		return $this->db->affected_rows();
	}

	public function delete ($id) {
		return $this->db
			->where("id", $id)
			->delete("basic_form");
	}

	public function cekid ($id) {
		$this->db->where("id", $id);
		return $this->db->get('basic_form');
	}

}

/* End of file M_input_password.php */
/* Location: ./application/modules/basic_form/models/M_input_password.php */