<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserVolunteer extends CI_Model {

	private $_table = 'users_volunteers';

    public function get_all() {
        return $this->db->get($this->_table)->result();
    }

    public function get_all_with_relation() {
         return $this->db->query('SELECT 
            users_volunteers.id as user_volunteers_id,
            users_volunteers.name_of_volunteer as name_of_volunteer,
            users_volunteers.role as user_volunteers_role,
            users_volunteers.start_year as user_volunteers_start_year,
            users_volunteers.end_year as user_volunteers_end_year,
            users_volunteers.start_month as user_volunteers_start_month,
            users_volunteers.end_month as user_volunteers_end_month,
            users_volunteers.description as user_volunteers_description,
            volunteer_types.name as volunteer_type_name

            FROM users_volunteers LEFT JOIN users ON users_volunteers.user_id = users.id
            LEFT JOIN volunteer_types ON users_volunteers.volunteer_type_id = volunteer_types.id')->result();
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

/* End of file UserVolunteer.php */
/* Location: ./application/models/UserVolunteer.php */