<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Contoh_model extends CI_Model
{
	private $_table = 'contoh';	// Nama tabel
	private $_column_order = [null, 'kolom_1', 'kolom_2', 'kolom_3', null];
	private $_column_search = ['kolom_1', 'kolom_2', 'kolom_3'];
	private $_default_order = ['a.created_at ' => 'DESC'];

	public function _query()
	{
		return "SELECT a.*
            FROM {$this->_table} AS a
            WHERE 1=1
            AND a.is_active = '1'
            AND a.deleted_at IS NULL";
	}

	public function datatables()
	{
		// Query
		$q = $this->_query();

		// Records Total
		$return['recordsTotal'] = $this->db->query($q)->num_rows();
		// ========================================================================

		$q .= " HAVING 1=1 AND (1=0";
		$search_val = false;
		foreach ($this->_column_search as $k => $v) {
			if ($v && post("columns[$k][search][value]")) {
				$search_val = true;
				$q .= " OR {$v} LIKE '%" . post("columns[$k][search][value]") . "%'";
			} elseif ($v && post('search[value]')) {
				$search_val = true;
				$q .= " OR {$v} LIKE '%" . post('search[value]') . "%'";
			}
		}

		if ($search_val) $q .= " )";
		else $q .= " OR 1=1)";

		// Records Filtered
		$return['recordsFiltered'] = $this->db->query($q)->num_rows();
		// ========================================================================

		if (!post('order')) $q .= " ORDER BY " . key($this->_default_order) .
			"{$this->_default_order[key($this->_default_order)]}";
		else {
			$q .= " ORDER BY ";
			foreach (post('order') as $k => $v) {
				if ($this->_column_order[$v['column']]) $q .= " {$this->_column_order[$v['column']]} {$v['dir']}";
				else $q .= key($this->_default_order) .
					"{$this->_default_order[key($this->_default_order)]}";
				if ($k !== count(post('order')) - 1) $q .= ', ';
			}
		}

		$q .= " LIMIT " . (post('start') ?? '0') . ", " . (post('length') ?? '10');
		// ========================================================================

		// Data
		$return['data'] = [];
		$no = post('start');
		$data = $this->db->query($q)->result();

		foreach ($data as $field) {
			$no++;

			$field->no = $no;
			$field->id = encrypt($field->id);

			$return['data'][] = $field;
		}
		// ========================================================================

		// Query
		$return['query'] = $this->db->last_query();
		// ========================================================================

		return [
			"draw" => post("draw"),
			"recordsTotal" => $return["recordsTotal"],
			"recordsFiltered" => $return["recordsFiltered"],
			"data" => $return["data"],
			// "query" => $return['query']
		];
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
