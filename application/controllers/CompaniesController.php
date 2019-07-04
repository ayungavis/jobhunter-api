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
class CompaniesController extends CI_Controller {

	public function __construct() {
        parent::__construct();

        $this->load->model('Companies');
    }

    // GET DATA
    public function index_get() {
        $data = VERIFY::verify_request();
        if ($data) {
            $id = $this->get('id');

            if ($id == '') {
                $companies = $this->Companies->get_all();
            } else {
                $companies = $this->Companies->find($id);
            }

            $this->response($users, 200);
        }
    }

    // CREATE / INSERT
    public function index_post() { //posting atau create
        $data = VERIFY::verify_request();
        if ($data) { 
            $attributes = [
                'name' => $this->post('name'),
                'photo_profile' => $this->post('photo_profile'),
                'photo_header' => $this->post('photo_header'),
                'city' => $this->post('city'),
                'country' => $this->post('country'),
                'description' => $this->post('description'),
                'website' => $this->post('website'),
                'company_category_id' => $this->post('company_category_id')
            ];

            $id = $this->Companies->insert($attributes);

            if ($id) {
                $companies = $this->Companies->find($id);
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
                'name' => $this->post('name'),
                'photo_profile' => $this->post('photo_profile'),
                'photo_header' => $this->post('photo_header'),
                'city' => $this->post('city'),
                'country' => $this->post('country'),
                'description' => $this->post('description'),
                'website' => $this->post('website'),
                'company_category_id' => $this->post('company_category_id')
            ];

            $update = $this->Companies->update($id, $attributes);

            if ($update) {
                $companies = $this->Companies->find($id);
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
            $delete = $this->Companies->delete($id);

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

/* End of file CompaniesController.php */
/* Location: ./application/controllers/CompaniesController.php */