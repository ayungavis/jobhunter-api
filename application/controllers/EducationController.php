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

class EducationController extends CI_Controller {

	public function __construct() {
        parent::__construct();

        $this->load->model('Education');
    }

    // GET DATA
    public function index_get() {
        $data = VERIFY::verify_request();
        if ($data) {
            $id = $this->get('id');

            if ($id == '') {
                $educations = $this->Education->get_all();
            } else {
                $educations = $this->Education->find($id);
            }

            $this->response($educations, 200);
        }
    }

    // CREATE / INSERT
    public function index_post() { //posting atau create
        $data = VERIFY::verify_request();
        if ($data) { 
        $attributes = [
            'user_id' => $this->post('user_id'),
            'school_name' => $this->post('school_name'),
            'degree' => $this->post('degree'),
            'field_of_study' => $this->post('field_of_study'),
            'start_year' => $this->post('start_year'),
            'end_year' => $this->post('end_year'),
            'description' => $this->post('description')
        ];

        $id = $this->Education->insert($attributes);

        if ($id) {
            $educations = $this->Education->find($id);
            $this->response($educations, 200);
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
            'school_name' => $this->post('school_name'),
            'degree' => $this->post('degree'),
            'field_of_study' => $this->post('field_of_study'),
            'start_year' => $this->post('start_year'),
            'end_year' => $this->post('end_year'),
            'description' => $this->post('description')
        ];

        $update = $this->Education->update($id, $attributes);

        if ($update) {
            $educations = $this->Education->find($id);
            $this->response($educations, 200);
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
        $delete = $this->Education->delete($id);

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

/* End of file EducationController.php */
/* Location: ./application/controllers/EducationController.php */