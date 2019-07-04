<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */

class VacanciesController extends CI_Controller {

	public function __construct() {
        parent::__construct();

        $this->load->model('Vacancies');
    }

    // GET DATA
    public function index_get() {
        $data = VERIFY::verify_request();
        if ($data) {
            $id = $this->get('id');

            if ($id == '') {
                $vacancies = $this->Vacancies->get_all();
            } else {
                $vacancies = $this->Vacancies->find($id);
            }

            $this->response($users, 200);
        }
    }

    // CREATE / INSERT
    public function index_post() { //posting atau create
        $data = VERIFY::verify_request();
        if ($data) { 
            $attributes = [
                'description' => $this->post('description'),
                'qualification' => $this->post('qualification'),
                'skill_id' => $this->post('skill_id'),
                'position' => $this->post('position'),
                'company_id' => $this->post('company_id'),
                'city' => $this->post('city'),
                'country' => $this->post('country'),
                'start_salary' => $this->post('start_salary'),
                'end_salary' => $this->post('end_salary'),
                'job_type_id' => $this->post('job_type_id'),
                'closing_date' => $this->post('closing_date'),
                'job_level_id' => $this->post('job_level_id'),
                'job_category_id' => $this->post('job_category_id'),
                'educational_level_id' => $this->post('educational_level_id')
            ];

            $id = $this->Vacancies->insert($attributes);

            if ($id) {
                $vacancies = $this->Vacancies->find($id);
                $this->response($users, 200);
            } else {
                $this->response(array('status' => 'fail'), 502);
            }
        }
    }

    // UPDATE
    public function index_put() { //edit
        $id = $this->put('id');
        $data = VERIFY::verify_request();
        if ($data) {
            $attributes = [
                'description' => $this->post('description'),
                'qualification' => $this->post('qualification'),
                'skill_id' => $this->post('skill_id'),
                'position' => $this->post('position'),
                'company_id' => $this->post('company_id'),
                'city' => $this->post('city'),
                'country' => $this->post('country'),
                'start_salary' => $this->post('start_salary'),
                'end_salary' => $this->post('end_salary'),
                'job_type_id' => $this->post('job_type_id'),
                'closing_date' => $this->post('closing_date'),
                'job_level_id' => $this->post('job_level_id'),
                'job_category_id' => $this->post('job_category_id'),
                'educational_level_id' => $this->post('educational_level_id')
            ];

            $update = $this->Vacancies->update($id, $attributes);

            if ($update) {
                $vacancies = $this->Vacancies->find($id);
                $this->response($users, 200);
            } else {
                $this->response(array('status' => 'fail'), 502);
            }
        }
    }

    // DELETE
    public function index_delete() {
        $id = $this->delete('id');
        $data = VERIFY::verify_request();
        if ($data) {
            $delete = $this->Vacancies->delete($id);

            if ($delete) {
                $this->response(array('status' => 'success'), 201);
            } else {
                $this->response(array('status' => 'fail'), 502);
            }
        }
    }

    public function index_options() {
        return $this->response(NULL, REST_Controller::HTTP_OK);
    }

}

/* End of file VacanciesController.php */
/* Location: ./application/controllers/VacanciesController.php */