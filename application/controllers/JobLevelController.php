<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JobLevelController extends REST_Controller {

	public function __construct() {
        parent::__construct();

        $this->load->model('JobLevel');
    }

    // GET DATA
    public function index_get() {
        $id = $this->get('id');

        if ($id == '') {
            $job_levels = $this->JobLevel->get_all();
        } else {
            $job_levels = $this->JobLevel->find($id);
        }

        $this->response($job_levels, 200);
    }

    // CREATE / INSERT
    public function index_post() { //posting atau create
        $data = VERIFY::verify_request();
        if ($data) { 
            $attributes = [
                'name' => $this->post('name')
            ];

            $id = $this->JobLevel->insert($attributes);

            if ($id) {
                $job_levels = $this->JobLevel->find($id);
                $this->response($job_levels, 200);
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

            $update = $this->JobLevel->update($id, $attributes);

            if ($update) {
                $job_levels = $this->JobLevel->find($id);
                $this->response($job_levels, 200);
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
            $delete = $this->JobLevel->delete($id);

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

/* End of file JobLevelController.php */
/* Location: ./application/controllers/JobLevelController.php */