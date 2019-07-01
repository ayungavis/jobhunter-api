<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

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
class UserController extends REST_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->model('User');
    }

    public function index_get() {
        $data = VERIFY::verify_request();
        if ($data) {
            $id = $this->get('id');

            if ($id == '') {
                $users = $this->User->get_all();
            } else {
                $users = $this->User->find($id);
            }

            $this->response($users, 200);
        }
    }

    public function index_post() {
        $attributes = [
            'first_name' => $this->post('first_name'),
            'last_name' => $this->post('last_name'),
            'username' => $this->post('username'),
            'email' => $this->post('email'),
            'password' => $this->post('password')
        ];

        $id = $this->User->insert($attributes);

        if ($id) {
            $users = $this->User->find($id);
            $this->response($users, 200);
        } else {
            $this->response(array('status' => 'fail'), 502);
        }
    }

    public function index_put() {
        $id = $this->put('id');

        $attributes = [
            'first_name'     => $this->put('first_name'),
            'last_name'    => $this->put('last_name')
        ];

        $update = $this->User->update($id, $attributes);

        if ($update) {
            $users = $this->User->find($id);
            $this->response($users, 200);
        } else {
            $this->response(array('status' => 'fail'), 502);
        }
    }

    public function index_delete() {
        $id = $this->delete('id');
        
        $delete = $this->User->delete($id);

        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail'), 502);
        }
    }
}