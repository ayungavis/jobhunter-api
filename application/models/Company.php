<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Model {

	private $_table = 'companies';

    public function get_all() {
        return $this->db->get($this->_table)->result();
    }

    public function get_all_with_relation() {
         return $this->db->query('SELECT 
            companies.id as company_id,
            companies.name as companies_name,
            companies.photo_profile as companies_photo_profile,
            companies.photo_header as companies_photo_header,
            companies.description as companies_description,
            companies.website as companies_website,
            company_categories.name as company_categories_name

         FROM companies LEFT JOIN company_categories ON companies.company_category_id = company_categories.id')->result();
    }

    public function find($id) {
        return $this->db
            ->where('id', $id)
            ->get($this->_table)
            ->row();
    }

    public function find_with_relation() {
         return $this->db->query('SELECT 
            companies.id as company_id,
            companies.name as companies_name,
            companies.photo_profile as companies_photo_profile,
            companies.photo_header as companies_photo_header,
            companies.description as companies_description,
            companies.website as companies_website,
            company_categories.name as company_categories_name

         FROM companies LEFT JOIN company_categories ON companies.company_category_id = company_categories.id WHERE companies.id = '. $id)->result();
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

/* End of file Companies.php */
/* Location: ./application/models/Companies.php */