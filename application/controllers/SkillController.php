<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SkillController extends REST_Controller {

	public function __construct() {
        parent::__construct();

        $this->load->model('Skill');
    }

    // GET DATA
    public function index_get() {
        $data = VERIFY::verify_request();
        if ($data) {
            $id = $this->get('id');

            if ($id == '') {
                $skills = $this->Skill->get_all();
            } else {
                $skills = $this->Skill->find($id);
            }

            $this->response($skills, 200);
        }
    }

    // CREATE / INSERT
    public function index_post() { //posting atau create
        $data = VERIFY::verify_request();
        if ($data) { 
            $attributes = [
                'name' => $this->post('name')
            ];

            $id = $this->Skill->insert($attributes);

            if ($id) {
                $skills = $this->Skill->find($id);
                $this->response($skills, 200);
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
                'name' => $this->put('name')
            ];

            $update = $this->Skill->update($id, $attributes);

            if ($update) {
                $skills = $this->Skill->find($id);
                $this->response($skills, 200);
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
            $delete = $this->Skill->delete($id);

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

/* End of file SkillController.php */
/* Location: ./application/controllers/SkillController.php */