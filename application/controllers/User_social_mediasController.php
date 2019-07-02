<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_social_mediasController extends CI_Controller {

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
	public function __construct() {
        parent::__construct();

        $this->load->model('Users_social_medias');
    }

    // GET DATA
    public function index_get() {
        $data = VERIFY::verify_request();
        if ($data) {
            $id = $this->get('id');

            if ($id == '') {
                $users_social_medias = $this->User_social_medias->get_all();
            } else {
                $users_social_medias = $this->User_social_medias->find($id);
            }

            $this->response($users_social_medias, 200);
        }
    }

    // CREATE / INSERT
    public function index_post() { //posting atau create
        $data = VERIFY::verify_request();
        if ($data) { 
        $attributes = [
            'user_id' => $this->post('user_id'),
            'social_id' => $this->post('social_id'),
            'url' => $this->post('url')
        ];

        $id = $this->User_social_medias->insert($attributes);

        if ($id) {
            $users_social_medias = $this->User_social_medias->find($id);
            $this->response($users_social_medias, 200);
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
            'social_id' => $this->post('social_id'),
            'url' => $this->post('url')
        ];

        $update = $this->User_social_medias->update($id, $attributes);

        if ($update) {
            $users_social_medias = $this->User_social_medias->find($id);
            $this->response($users_social_medias, 200);
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
        $delete = $this->User_social_medias->delete($id);

        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail'), 502);
            }
        }
    }

}

/* End of file User_social_mediasController.php */
/* Location: ./application/controllers/User_social_mediasController.php */