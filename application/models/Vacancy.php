<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vacancy extends CI_Model {

	private $_table = 'vacancies';

    public function get_all() {
        return $this->db->get($this->_table)->result();
    }

    public function get_all_with_relation() {
        return $this->db->query('SELECT 
            vacancies.description as job_description,
            vacancies.qualification as job_qualification,
            vacancies.position as job_position,
            vacancies.city as job_city,
            vacancies.country as job_country,
            vacancies.start_salary as start_salary_job,
            vacancies.end_salary as end_salary_job,
            vacancies.closing_date as closing_date,
            companies.name as companies_name,
            companies.photo_profile as companies_photo_profile,
            companies.photo_header as companies_photo_header,
            companies.description as companies_description,
            companies.website as companies_website,
            job_types.name as job_types_name,
            job_levels.name as job_levels_name,
            job_categories.name as job_categories_name,
            educational_levels.name as educational_levels_name

         FROM vacancies LEFT JOIN companies ON vacancies.company_id = companies.id LEFT JOIN job_types ON vacancies.job_type_id = job_types.id LEFT JOIN skills ON vacancies.skill_id = skills.id LEFT JOIN job_levels ON vacancies.job_level_id = job_levels.id LEFT JOIN job_categories ON vacancies.job_category_id = job_categories.id LEFT JOIN educational_levels ON vacancies.educational_level_id = educational_levels.id')->result();
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

/* End of file Vacancies.php */
/* Location: ./application/models/Vacancies.php */