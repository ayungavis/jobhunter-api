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

class ContactController extends CI_Controller {

	public function __construct() {
        parent::__construct();

        $this->load->model('Contact');
    }

    // GET DATA
    public function index_get() {
        $data = VERIFY::verify_request();
        if ($data) {
            $id = $this->get('id');

            if ($id == '') {
                $contacts = $this->Contact->get_all();
            } else {
                $contacts = $this->Contact->find($id);
            }

            $this->response($users, 200);
        }
    }

    // CREATE / INSERT
    public function index_post() { //posting atau create
        $data = VERIFY::verify_request();
        if ($data) { 
        $attributes = [
            'user_id' => $this->post('user_id'),
            'address' => $this->post('address'),
            'city' => $this->post('city'),
            'state' => $this->post('state'),
            'country' => $this->post('country'),
            'zip_code' => $this->post('zip_code'),
            'domicile_address' => $this->post('domicile_address'),
            'domicile_city' => $this->post('domicile_city'),
            'domicile_state' => $this->post('domicile_state'),
            'domicile_country' => $this->post('domicile_country'),
            'domicile_zip_code' => $this->post('domicile_zip_code')
        ];

        $id = $this->Contact->insert($attributes);

        if ($id) {
            $contacts = $this->Contact->find($id);
            $this->response($contacts, 200);
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
            'user_id' => $this->post('user_id'),
            'address' => $this->post('address'),
            'city' => $this->post('city'),
            'state' => $this->post('state'),
            'country' => $this->post('country'),
            'zip_code' => $this->post('zip_code'),
            'domicile_address' => $this->post('domicile_address'),
            'domicile_city' => $this->post('domicile_city'),
            'domicile_state' => $this->post('domicile_state'),
            'domicile_country' => $this->post('domicile_country'),
            'domicile_zip_code' => $this->post('domicile_zip_code')
        ];

        $update = $this->Contact->update($id, $attributes);

        if ($update) {
            $contacts = $this->Contact->find($id);
            $this->response($contacts, 200);
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
        $delete = $this->Contact->delete($id);

        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail'), 502);
            }
        }
    }

}

/* End of file ContactController.php */
/* Location: ./application/controllers/ContactController.php */