<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserSocialMedia extends CI_Model {

    private $_table = 'users_social_medias';

    public function get_all() {
        return $this->db->get($this->_table)->result();
    }

    public function get_all_with_relation() {
         return $this->db->query('SELECT
            users.id as user_id,
            users_social_medias.id as user_social_media_id,
            users_social_medias.url as user_social_media_url,
            social_medias.name as social_media_name,
            social_medias.icon as social_media_icon

          FROM users_social_medias 
            LEFT JOIN users ON users_social_medias.user_id = users.id
            LEFT JOIN social_medias ON users_social_medias.social_id = social_medias.id')->result();
    }

    public function find($id) {
        return $this->db
            ->where('id', $id)
            ->get($this->_table)
            ->row();
    }

    public function find_by_user($id) {
        return $this->db->query('SELECT
            users.id as user_id 
            users_social_medias.id as user_social_media_id,
            users_social_medias.url as user_soial_media_url,
            social_medias.name as social_media_name,
            social_medias.icon as social_media_icon

          FROM users_social_medias 
            LEFT JOIN users ON users_social_medias.user_id = users.id
            LEFT JOIN social_medias ON user_social_medias.social_media_id = social_medias.id WHERE 
            users_social_medias.user_id = '. $id)->result();
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

/* End of file UserSocialMedia.php */
/* Location: ./application/models/UserSocialMedia.php */