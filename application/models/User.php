<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {
    private $_table = 'users';

    public function get_all() {
        return $this->db->get($this->_table)->result();
    }

    public function get_all_with_relation() {
        return $this->db->query('SELECT 
            users.id as user_id,
            users.first_name as user_first_name,
            users.last_name as user_last_name,
            users.username as username,
            users.email as user_email,
            users.password as user_password,
            profiles.description as profile_description,
            profiles.headline as profile_headline,
            profiles.gender as profile_gender,
            profiles.place_of_birth as profile_place_of_birth,
            profiles.date_of_birth as profile_date_of_birth,
            profiles.photo_profile as profile_photo_profile,
            profiles.photo_header as profile_photo_header,
            levels.name as level_name,
            religions.name as religion_name,
            contacts.address as contact_address,
            contacts.city as contact_city,
            contacts.state as contact_state,
            contacts.country as contact_country,
            contacts.zip_code as contact_zip_code,
            contacts.domicile_address as contact_domicile_address,
            contacts.domicile_city as contact_domicile_city,
            contacts.domicile_state as contact_domicile_state,
            contacts.domicile_country as contact_domicile_country,
            contacts.domicile_zip_code as contact_domicile_zip_code

         FROM users LEFT JOIN profiles ON profiles.user_id = users.id LEFT JOIN levels ON levels.id = users.level_id LEFT JOIN religions ON religions.id = users.religion_id LEFT JOIN contacts ON contacts.user_id = users.id')->result();
    }
    
    public function get_by_email($email) {
        return $this->db
            ->where('email', $email)
            ->get($this->_table)
            ->row();
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

        public function find_with_relation($id) {
        return $this->db->query('SELECT 
            users.id as user_id,
            users.first_name as user_first_name,
            users.last_name as user_last_name,
            users.username as username,
            users.email as user_email,
            users.password as user_password,
            profiles.description as profile_description,
            profiles.headline as profile_headline,
            profiles.gender as profile_gender,
            profiles.place_of_birth as profile_place_of_birth,
            profiles.date_of_birth as profile_date_of_birth,
            profiles.photo_profile as profile_photo_profile,
            profiles.photo_header as profile_photo_header,
            levels.name as level_name,
            religions.name as religion_name,
            contacts.address as contact_address,
            contacts.city as contact_city,
            contacts.state as contact_state,
            contacts.country as contact_country,
            contacts.zip_code as contact_zip_code,
            contacts.domicile_address as contact_domicile_address,
            contacts.domicile_city as contact_domicile_city,
            contacts.domicile_state as contact_domicile_state,
            contacts.domicile_country as contact_domicile_country,
            contacts.domicile_zip_code as contact_domicile_zip_code

         FROM users LEFT JOIN profiles ON profiles.user_id = users.id LEFT JOIN levels ON levels.id = users.level_id LEFT JOIN religions ON religions.id = users.religion_id LEFT JOIN contacts ON contacts.user_id = users.id WHERE users.id = '. $id)->result();
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