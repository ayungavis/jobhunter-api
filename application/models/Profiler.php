<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profiler extends CI_Model {

	private $_table = 'profiles';

    public function get_all() {
        return $this->db->get($this->_table)->result();
    }

    public function get_by_username($username) {
        return $this->db
            ->where('username', $username)
            ->get($this->_table)
            ->row();
    }

    public function find($id) {
        return $this->db
            ->where('id', $id)
            ->get($this->_table)
            ->row();
    }

    public function insert($attributes) {
        $this->db->insert($this->_table, $attributes);
        return $this->db->insert_id();
    }

    public function update($id, $attributes) {
        return $this->db
            ->where('id', $id)
            ->update($this->_table, $attributes);
    }

    public function delete($id) {
        return $this->db
            ->where('id', $id)
            ->delete($this->_table);
    }
	

}

/* End of file Profiler.php */
/* Location: ./application/models/Profiler.php */