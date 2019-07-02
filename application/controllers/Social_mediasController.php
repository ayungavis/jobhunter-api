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

class Social_mediasController extends CI_Controller {

	public function __construct() {
        parent::__construct();

        $this->load->model('Social_medias');
    }

    // GET DATA
    public function index_get() {
        $data = VERIFY::verify_request();
        if ($data) {
            $id = $this->get('id');

            if ($id == '') {
                $social_medias = $this->Social_medias->get_all();
            } else {
                $social_medias = $this->Social_medias->find($id);
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

        $id = $this->Social_medias->insert($attributes);

        if ($id) {
            $social_medias = $this->Social_medias->find($id);
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
            'name' => $this->post('name'),
            'icon' => $this->post('icon')
        ];

        $update = $this->Social_medias->update($id, $attributes);

        if ($update) {
            $social_medias = $this->Social_medias->find($id);
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
        $delete = $this->Social_medias->delete($id);

        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail'), 502);
            }
        }
    }

}

/* End of file Social_mediasController.php */
/* Location: ./application/controllers/Social_mediasController.php */