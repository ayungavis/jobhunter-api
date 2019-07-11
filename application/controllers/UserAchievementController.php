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

class UserAchievementController extends REST_Controller {
	public function __construct() {
        parent::__construct();

        $this->load->model('UserAchievement');
    }

    // GET DATA
    public function index_get() {
        $data = VERIFY::verify_request();
        if ($data) {
            $id = $this->get('id');
            $user_id = $this->get('user_id');

            if ($id == '') {
                $users_achievements = $this->UserAchievement->get_all();
            } elseif ($user_id) {
                $users_achievements = $this->UserAchievement->find_by_user($id);
            } else {
                $users_achievements = $this->UserAchievement->find($id);
            }

            $this->response($users_achievements, 200);
        }
    }

    // CREATE / INSERT
    public function index_post() { //posting atau create
        $data = VERIFY::verify_request();
        if ($data) { 
            $attributes = [
                'user_id' => $this->post('user_id'),
                'name_of_achievement' => $this->post('name_of_achievement'),
                'associated_with' => $this->post('associated_with'),
                'appreciator' => $this->post('appreciator'),
                'release_month' => $this->post('release_month'),
                'release_year' => $this->post('release_year'),
                'description' => $this->post('description')
            ];

            $id = $this->UserAchievement->insert($attributes);

            if ($id) {
                $users_achievements = $this->UserAchievement->find($id);
                $this->response($users_achievements, 200);
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
                'name_of_achievement' => $this->put('name_of_achievement'),
                'associated_with' => $this->put('associated_with'),
                'appreciator' => $this->put('appreciator'),
                'release_month' => $this->put('release_month'),
                'release_year' => $this->put('release_year'),
                'description' => $this->put('description')
            ];

            $update = $this->UserAchievement->update($id, $attributes);

            if ($update) {
                $users_achievements = $this->UserAchievement->find($id);
                $this->response($users_achievements, 200);
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
            $delete = $this->UserAchievement->delete($id);

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

/* End of file UserAchievementController.php */
/* Location: ./application/controllers/UserAchievementController.php */