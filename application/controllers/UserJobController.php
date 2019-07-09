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

class UserJobController extends REST_Controller {
	public function __construct() {
        parent::__construct();

        $this->load->model('UserJob');
    }

    // GET DATA
    public function index_get() {
        $data = VERIFY::verify_request();
        if ($data) {
            $id = $this->get('id');

            if ($id == '') {
                $users_jobs =$this->UserJob->get_all();
            } else {
                $users_jobs =$this->UserJob->find($id);
            }

            $this->response($users_jobs, 200);
        }
    }

    // CREATE / INSERT
    public function index_post() { //posting atau create
        $data = VERIFY::verify_request();
        if ($data) { 
            $attributes = [
                'user_id' => $this->post('user_id'),
                'potition' => $this->post('potition'),
                'company' => $this->post('company'),
                'location' => $this->post('location'),
                'start_year' => $this->post('start_year'),
                'end_year' => $this->post('end_year'),
                'start_month' => $this->post('start_month'),
                'end_month' => $this->post('end_month'),
                'motto' => $this->post('motto'),
                'description' => $this->post('description')
            ];

            $id = $this->UserJob->insert($attributes);

            if ($id) {
                $users_jobs =$this->UserJob->find($id);
                $this->response($users_jobs, 200);
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
                'potition' => $this->put('potition'),
                'company' => $this->put('company'),
                'location' => $this->put('location'),
                'start_year' => $this->put('start_year'),
                'end_year' => $this->put('end_year'),
                'start_month' => $this->put('start_month'),
                'end_month' => $this->put('end_month'),
                'motto' => $this->put('motto'),
                'description' => $this->put('description')
            ];

            $update = $this->UserJob->update($id, $attributes);

            if ($update) {
                $users_jobs =$this->UserJob->find($id);
                $this->response($users_jobs, 200);
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
            $delete = $this->UserJob->delete($id);

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

/* End of file UserJobController.php */
/* Location: ./application/controllers/UserJobController.php */