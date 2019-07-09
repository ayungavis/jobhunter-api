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

class SocialMediaController extends REST_Controller {
	public function __construct() {
        parent::__construct();

        $this->load->model('SocialMedia');
    }

    // GET DATA
    public function index_get() {
        $data = VERIFY::verify_request();
        if ($data) {
            $id = $this->get('id');

            if ($id == '') {
                $social_medias = $this->SocialMedia->get_all();
            } else {
                $social_medias = $this->SocialMedia->find($id);
            }

            $this->response($social_medias, 200);
        }
    }

    // CREATE / INSERT
    public function index_post() { //posting atau create
        $data = VERIFY::verify_request();
        if ($data) { 
            $attributes = [
                'name' => $this->post('name'),
                'icon' => $this->post('icon')
            ];

            $id = $this->SocialMedia->insert($attributes);

            if ($id) {
                $social_medias = $this->SocialMedia->find($id);
                $this->response($social_medias, 200);
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
                'name' => $this->put('name'),
                'icon' => $this->put('icon')
            ];

            $update = $this->SocialMedia->update($id, $attributes);

            if ($update) {
                $social_medias = $this->SocialMedia->find($id);
                $this->response($social_medias, 200);
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
            $delete = $this->SocialMedia->delete($id);

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

/* End of file SocialMediaController.php */
/* Location: ./application/controllers/SocialMediaController.php */