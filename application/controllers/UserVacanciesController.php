<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
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

class UserVacanciesController extends REST_Controller {
	public function __construct() {
        parent::__construct();

        $this->load->model('UserVacancy');
    }

    // GET DATA
    public function index_get() {
        $data = VERIFY::verify_request();
        if ($data) {
            $id = $this->get('id');
            $user_id = $this->get('user_id');

            if ($id == '') {
                $users_vacancies =$this->UserVacancy->get_all();
            } elseif ($user_id) {
                $users_vacancies = $this->UserVacancy->find_by_user($id);
            } else {
                $users_vacancies =$this->UserVacancy->find($id);
            }

            $this->response($users_vacancies, 200);
        }
    }

    // CREATE / INSERT
    public function index_post() { //posting atau create
        $data = VERIFY::verify_request();
        if ($data) { 
            $attributes = [
                'user_id' => $this->post('user_id'),
                'vacancies_id' => $this->post('vacancies_id'),
                'message' => $this->post('message')
            ];

            $id = $this->UserVacancy->insert($attributes);

            if ($id) {
                $users_vacancies =$this->UserVacancy->find($id);
                $this->response($users_vacancies, 200);
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
                'user_id' => $this->put('user_id'),
                'vacancies_id' => $this->put('vacancies_id'),
                'message' => $this->put('message')
            ];

            $update = $this->UserVacancy->update($id, $attributes);

            if ($update) {
                $users_vacancies =$this->UserVacancy->find($id);
                $this->response($users_vacancies, 200);
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
            $delete = $this->UserVacancy->delete($id);

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

/* End of file UserVacanciesController.php */
/* Location: ./application/controllers/UserVacanciesController.php */