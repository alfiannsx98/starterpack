<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_dashboard extends CI_Model
{
	public function select_by_user()
	{
		$sql = "SELECT * FROM user WHERE role_id=2 AND is_active=1";

		$data = $this->db->query($sql);

		return $data->num_rows();
	}

	public function select_by_role()
	{
		$sql = "SELECT * FROM user WHERE role_id=2 AND is_active=1";

		$data = $this->db->query($sql);

		return $data->result_array();
	}

	public function total_dosen()
	{
		$data = $this->db->get('dosbing');

		return $data->num_rows();
	}

	public function total_perusahaan()
	{
		$data = $this->db->get('perusahaan');

		return $data->num_rows();
	}

	public function total_admin()
	{
		$data = $this->db->get('admin_prodi');

		return $data->num_rows();
	}
}

/* End of file M_posisi.php */
/* Location: ./application/models/M_posisi.php */
