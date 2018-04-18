<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function data ($post, $debug = false) {
		
		$order = $post['order'][0];

		$this->db->start_cache();
		
			$this->db->from("user u");

			// filter
			
			$orderColumn = array(
				2 => "nama_lengkap",
				3 => "username",
			);
			
			// order
			if ($order['column'] == 0) {
				$this->db->order_by('id_user', 'DESC');
			} else {
				$this->db->order_by($orderColumn[$order['column']], $order['dir']);
			}

			// join

		$this->db->stop_cache();

			// get num rows
			$this->db->select('id_user');
			$rowCount = $this->db->get()->num_rows();

			// get result
			$this->db->select('u.*');

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
				<a href='{$base}user/form/$data->id_user' id='btn-edit'>
					<i class='fa fa-edit'></i>&nbsp Edit
				</a>
			</li>
			";

			// DELETE
			$btnAksi .= "
			<li>
				<a href='#' data-id='$data->id_user' id='btn-delete'>
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

			$baris = array(
				"no" => $no,
				"aksi" => $aksi,
				"nama_lengkap" => $data->nama_lengkap,
				"username" => $data->username,
			);

			array_push($output['data'], $baris);

			$no++;
		}

		return json_encode($output);
	}

	public function cekid ($id) {
		return $this->db
			->where("id_user", $id)
			->get("user", 1);
	}

	public function add ($data) {
		$this->db->insert("user", $data);
		return $this->db->insert_id();
	}

	public function edit ($id, $data) {
		$this->db
			->where("id_user", $id)
			->update("user", $data);
		return $this->db->affected_rows();
	}

	public function delete ($id) {
		$this->db
			->where("id_user", $id)	
			->delete("user");

		return $this->db->affected_rows();
	}

	function check_username($username, $id_user) {
        $this->db->select('username');
        $this->db->from('user');
        $this->db->where(array("username" => $username));
        if ($id_user > 0) {
            $this->db->where("id_user !=", $id_user);
        }
        $query = $this->db->get();

        if ($query->num_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

}

/* End of file M_user.php */
/* Location: ./application/modules/user/models/M_user.php */