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

class UserSkillController extends REST_Controller {
	public function __construct() {
        parent::__construct();

        $this->load->model('UserSkill');
    }

    // GET DATA
    public function index_get() {
        $data = VERIFY::verify_request();
        if ($data) {
            $id = $this->get('id');
            $user_id = $this->get('user_id');

            if ($id == '' && $user_id == '') {
                $users_skills = $this->UserSkill->get_all_with_relation();
            } else if ($id == '' && $user_id) {
                $users_skills = $this->UserSkill->find_by_user_with_relation($user_id);
            } else {
                $users_skills = $this->UserSkill->find_with_relation($id);
            }

            $this->response($users_skills, 200);
        }
    }

    // CREATE / INSERT
    public function index_post() { //posting atau create
        $data = VERIFY::verify_request();
        if ($data) { 
            $attributes = [
                'user_id' => $this->post('user_id'),
                'skill_id' => $this->post('skill_id'),
                'name_of_skill' => $this->post('name_of_skill')
            ];

            $id = $this->UserSkill->insert($attributes);

            if ($id) {
                $users_skills =$this->UserSkill->find($id);
                $this->response($users_skills, 200);
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
                'skill_id' => $this->put('skill_id'),
                'name_of_skill' => $this->put('name_of_skill')
            ];

            $update = $this->UserSkill->update($id, $attributes);

            if ($update) {
                $users_skills =$this->UserSkill->find($id);
                $this->response($users_skills, 200);
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
            $delete = $this->UserSkill->delete($id);

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

/* End of file UserSkillController.php */
/* Location: ./application/controllers/UserSkillController.php */