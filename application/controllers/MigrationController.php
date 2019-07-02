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

class MigrationController extends CI_Controller {

	public function __construct() {
        parent::__construct();

        $this->load->model('Migration');
    }

    // GET DATA
    public function index_get() {
        $data = VERIFY::verify_request();
        if ($data) {
            $id = $this->get('id');

            if ($id == '') {
                $migrations = $this->Migration->get_all();
            } else {
                $migrations = $this->Migration->find($id);
            }

            $this->response($migrations, 200);
        }
    }

    // CREATE / INSERT
    public function index_post() { //posting atau create
        $data = VERIFY::verify_request();
        if ($data) { 
        $attributes = [
            'migration' => $this->post('migration'),
            'batch' => $this->post('batch')
        ];

        $id = $this->Migration->insert($attributes);

        if ($id) {
            $migrations = $this->Migration->find($id);
            $this->response($migrations, 200);
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
            'migration' => $this->post('migration'),
            'batch' => $this->post('batch')
        ];

        $update = $this->Migration->update($id, $attributes);

        if ($update) {
            $migrations = $this->Migration->find($id);
            $this->response($migrations, 200);
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
        $delete = $this->Migration->delete($id);

        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail'), 502);
            }
        }
    }

}

/* End of file MigrationController.php */
/* Location: ./application/controllers/MigrationController.php */