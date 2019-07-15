<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserSkill extends CI_Model {

	private $_table = 'users_skills';

    public function get_all() {
        return $this->db->get($this->_table)->result();
    }

    public function get_all_with_relation() {
         return $this->db->query('SELECT 
            users.id as user_id,
            users_skills.id as user_skills_id,
            users_skills.name_of_skill as name_of_skill,
            skills.name as skill_name

          FROM users_skills LEFT JOIN users ON users_skills.user_id = users.id
          LEFT JOIN skills ON users_skills.skill_id = skills.id')->result();
    }

    public function find($id) {
        return $this->db
            ->where('id', $id)
            ->get($this->_table)
            ->row();
    }

    public function find_with_relation($id) {
         return $this->db->query('SELECT 
            users.id as user_id,
            users_skills.id as user_skills_id,
            users_skills.name_of_skill as name_of_skill,
            skills.name as skill_name

          FROM users_skills LEFT JOIN users ON users_skills.user_id = users.id
          LEFT JOIN skills ON users_skills.skill_id = skills.id
          WHERE users_skills.id = '. $id)->row();
    }

    public function find_by_user($id) {
        return $this->db
            ->where('user_id', $id)
            ->get($this->_table)
            ->result();
    }

    public function find_by_user_with_relation($id) {
         return $this->db->query('SELECT 
            users.id as user_id,
            users_skills.id as user_skills_id,
            users_skills.name_of_skill as name_of_skill,
            skills.name as skill_name

          FROM users_skills LEFT JOIN users ON users_skills.user_id = users.id
          LEFT JOIN skills ON users_skills.skill_id = skills.id
          WHERE users_skills.user_id = '. $id)->result();
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

/* End of file UserSkill.php */
/* Location: ./application/models/UserSkill.php */