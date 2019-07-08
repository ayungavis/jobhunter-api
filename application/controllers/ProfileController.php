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

class ProfileController extends REST_Controller {

	public function __construct() {
        parent::__construct();

        $this->load->model('Profile');
    }

    // GET DATA
    public function index_get() {
        $data = VERIFY::verify_request();
        if ($data) {
            $id = $this->get('id');

            if ($id == '') {
                $profiles = $this->Profile->get_all();
            } else {
                $profiles = $this->Profile->find($id);
            }

            $this->response($profiles, 200);
        }
    }

    // CREATE / INSERT
    public function index_post() { //posting atau create
        $data = VERIFY::verify_request();
        if ($data) { 
            $attributes = [
                'first_name' => $this->post('first_name'),
                'user_id' => $this->post('user_id'),
                'description' => $this->post('description'),
                'headline' => $this->post('headline'),
                'gender' => $this->post('gender'),
                'place_of_birth' => $this->post('place_of_birth'),
                'date_of_birth' => $this->post('date_of_birth'),
                'religion_id' => $this->post('religion_id'),
                'photo_profile' => $this->post('photo_profile'),
                'photo_header' => $this->post('photo_header')
            ];

            $id = $this->Profile->insert($attributes);

            if ($id) {
                $profiles = $this->Profile->find($id);
                $this->response($profiles, 200);
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
                'first_name' => $this->put('first_name'),
                'user_id' => $this->put('user_id'),
                'description' => $this->put('description'),
                'headline' => $this->put('headline'),
                'gender' => $this->put('gender'),
                'place_of_birth' => $this->put('place_of_birth'),
                'date_of_birth' => $this->put('date_of_birth'),
                'religion_id' => $this->put('religion_id'),
                'photo_profile' => $this->put('photo_profile'),
                'photo_header' => $this->put('photo_header')
            ];

            $update = $this->Profile->update($id, $attributes);

            if ($update) {
                $profiles = $this->Profile->find($id);
                $this->response($profiles, 200);
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
            $delete = $this->Profile->delete($id);

            if ($delete) {
                $this->response(array('status' => 'success'), 201);
            } else {
                $this->response(array('status' => 'fail'), 502);
            }
        }
    }

}

/* End of file ProfileController.php */
/* Location: ./application/controllers/ProfileController.php */