<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Contoh_model extends CI_Model
{
	private $_table = 'contoh';	// Nama tabel

	public function _query()
	{
		return "SELECT a.*
            FROM {$this->_table} AS a
            WHERE 1=1
            AND a.is_active = '1'
            AND a.deleted_at IS NULL";
	}

	public function all($where = [])
	{
		$q = $this->_query();
		if (count($where))
			foreach ($where as $k => $v) {
				$q .= " AND a.$k " . ('' === '!=' || false !== strpos($k, '!=') ? '' : '= ') .
					(is_string($v) ? "'$v'"            // Jika string
						: (is_int($v) ? "$v"        // Jika integer
							: (is_null($v) ? "NULL"    // Jika null
								: "'$v'")));
			}

		return $this->db->query($q)->result();
	}

	public function one($where = [])
	{
		$q = $this->_query();
		if (count($where))
			foreach ($where as $k => $v) {
				$q .= " AND a.$k " . ('' === '!=' || false !== strpos($k, '!=') ? '' : '= ') .
					(is_string($v) ? "'$v'"            // Jika string
						: (is_int($v) ? "$v"        // Jika integer
							: (is_null($v) ? "NULL"    // Jika null
								: "'$v'")));
			}

		return $this->db->query($q)->row();
	}

	public function count($where = [])
	{
		$q = $this->_query();
		if (count($where))
			foreach ($where as $k => $v) {
				$q .= " AND a.$k " . ('' === '!=' || false !== strpos($k, '!=') ? '' : '= ') .
					(is_string($v) ? "'$v'"            // Jika string
						: (is_int($v) ? "$v"        // Jika integer
							: (is_null($v) ? "NULL"    // Jika null
								: "'$v'")));
			}

		return $this->db->query($q)->num_rows();
	}

	public function check()
	{
		$id = decrypt(post('id'));
		if (!$id) show_404();

		$data = $this->one(['id' => $id]);
		if (!$data) show_404();

		return $id;
	}
}

/* End of file Contoh_model.php */
