<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserOrganitation extends CI_Model {

	private $_table = 'users_organizations';

    public function get_all() {
        return $this->db->get($this->_table)->result();
    }

    public function get_all_with_relation() {
         return $this->db->query('SELECT * FROM users_organizations LEFT JOIN users ON users_organizations.user_id = users.id')->result();
    }

    public function find($id) {
        return $this->db
            ->where('id', $id)
            ->get($this->_table)
            ->row();
    }

    public function find_by_user($id) {
        return $this->db
            ->where('user_id', $id)
            ->get($this->_table)
            ->result();
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

/* End of file UserOrganitation.php */
/* Location: ./application/models/UserOrganitation.php */