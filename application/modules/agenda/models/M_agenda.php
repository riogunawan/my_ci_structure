<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_agenda extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function data ($post, $debug = false) {
		
		$order = $post['order'][0];

		$this->db->start_cache();
		
			$this->db->from("agenda a");

			// filter
			
			$orderColumn = array(
				2 => "title",
				3 => "date_agenda",
				4 => "cover",
				5 => "city",
				6 => "publish",
			);
			
			// order
			if ($order['column'] == 0) {
				$this->db->order_by('id_agenda', 'DESC');
			} else {
				$this->db->order_by($orderColumn[$order['column']], $order['dir']);
			}

			// join
			$this->db->where('id_user', $this->session->userdata('id_user'));

		$this->db->stop_cache();

			// get num rows
			$this->db->select('id_agenda');
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

			// EDIT
			$btnAksi .= "
			<li>
				<a href='{$base}agenda/form/$data->id_agenda' id='btn-edit'>
					<i class='fa fa-edit'></i>&nbsp Edit
				</a>
			</li>
			";

			// DELETE
			$btnAksi .= "
			<li>
				<a href='#' data-id='$data->id_agenda' id='btn-delete'>
					<i class='fa fa-trash'></i>&nbsp Delete
				</a>
			</li>
			";

			$aksi = "
			<div class='btn-group'>
				<button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
					<i class='fa fa-gear'></i>
				</button>
				<ul class='dropdown-menu'>
					$btnAksi
				</ul>
			</div>
			";

			$cover = ( empty($data->cover) || !file_exists(FCPATH . "assets/upload/agenda/thumb/".$data->cover) ) ? '<img src="#" class="img-responsive" alt="No Image">' : '<img src="'.base_url("assets/upload/agenda/thumb/".$data->cover).'" class="img-responsive" alt="No Image">';
			
			$date_agenda = date_create($data->date_agenda);

			$baris = array(
				"no" => $no,
				"aksi" => $aksi,
				"title" => $data->title,
				"city" => $data->city,
				"cover" => $cover,
				"date_agenda" => date_format($date_agenda, "l, jS F Y"),
				"publish" => ($data->publish == "ya") ? "Yes" : "No",
			);

			array_push($output['data'], $baris);

			$no++;
		}

		return json_encode($output);
	}

	public function cekid ($id) {
		return $this->db
			->where("id_agenda", $id)
			->where("id_user", $this->session->userdata('id_user'))
			->get("agenda", 1);
	}

	public function add ($data) {
		$this->db->insert("agenda", $data);
		return $this->db->insert_id();
	}

	public function edit ($id, $data) {
		$this->db
			->where("id_agenda", $id)
			->where("id_user", $this->session->userdata('id_user'))
			->update("agenda", $data);
		return $this->db->affected_rows();
	}

	public function delete ($id) {
		$this->db
			->where("id_agenda", $id)
			->where("id_user", $this->session->userdata('id_user'))
			->delete("agenda");

		return $this->db->affected_rows();
	}

	public function cekImage ($id, $select = "") {
        $id = $this->db->escape_str($id);

        return $this->db
                ->select("$select")
                ->where('id_agenda', $id)
                ->get('agenda');
    }

}

/* End of file M_agenda.php */
/* Location: ./application/modules/agenda/models/M_agenda.php */