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

class UserLanguangeController extends REST_Controller {

	public function __construct() {
        parent::__construct();

        $this->load->model('UserLanguange');
    }

    // GET DATA
    public function index_get() {
        $data = VERIFY::verify_request();
        if ($data) {
            $id = $this->get('id');

            if ($id == '') {
                $users_languanges =$this->UserLanguange->get_all();
            } else {
                $users_languanges =$this->UserLanguange->find($id);
            }

            $this->response($users_languanges, 200);
        }
    }

    // CREATE / INSERT
    public function index_post() { //posting atau create
        $data = VERIFY::verify_request();
        if ($data) { 
            $attributes = [
                'user_id' => $this->post('user_id'),
                'languange' => $this->post('languange'),
                'level' => $this->post('level')

            $id = $this->UserLanguange->insert($attributes);

            if ($id) {
                $users_languanges =$this->UserLanguange->find($id);
                $this->response($users_languanges, 200);
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
                'languange' => $this->put('languange'),
                'level' => $this->put('level')
            ];

            $update = $this->UserLanguange->update($id, $attributes);

            if ($update) {
                $users_languanges =$this->UserLanguange->find($id);
                $this->response($users_languanges, 200);
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
            $delete = $this->UserLanguange->delete($id);

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

/* End of file UserLanguangeController.php */
/* Location: ./application/controllers/UserLanguangeController.php */