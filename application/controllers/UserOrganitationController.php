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

class UserOrganitationController extends REST_Controller {
	public function __construct() {
        parent::__construct();

        $this->load->model('UserOrganitation');
    }

    // GET DATA
    public function index_get() {
        $data = VERIFY::verify_request();
        if ($data) {
            $id = $this->get('id');
            $user_id = $this->get('user_id');

            if ($id == '' && $user_id == '') {
                $users_organitations = $this->UserOrganitation->get_all();
            } else if ($id == '' && $user_id) {
                $users_organitations = $this->UserOrganitation->find_by_user($user_id);
            } else {
                $users_organitations = $this->UserOrganitation->find($id);
            }

            $this->response($users_organitations, 200);
        }
    }

    // CREATE / INSERT
    public function index_post() { //posting atau create
        $data = VERIFY::verify_request();
        if ($data) { 
            $attributes = [
                'user_id' => $this->post('user_id'),
                'name_of_organitation' => $this->post('name_of_organitation'),
                'associated_with' => $this->post('associated_with'),
                'start_year' => $this->post('start_year'),
                'end_year' => $this->post('end_year'),
                'start_month' => $this->post('start_month'),
                'end_month' => $this->post('end_month'),
                'description' => $this->post('description')
            ];

            $id = $this->UserOrganitation->insert($attributes);

            if ($id) {
                $users_organitations =$this->UserOrganitation->find($id);
                $this->response($users_organitations, 200);
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
                'name_of_organitation' => $this->put('name_of_organitation'),
                'associated_with' => $this->put('associated_with'),
                'start_year' => $this->put('start_year'),
                'end_year' => $this->put('end_year'),
                'start_month' => $this->put('start_month'),
                'end_month' => $this->put('end_month'),
                'description' => $this->put('description')
            ];

            $update = $this->UserOrganitation->update($id, $attributes);

            if ($update) {
                $users_organitations =$this->UserOrganitation->find($id);
                $this->response($users_organitations, 200);
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
            $delete = $this->UserOrganitation->delete($id);

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

/* End of file UserOrganitationController.php */
/* Location: ./application/controllers/UserOrganitationController.php */