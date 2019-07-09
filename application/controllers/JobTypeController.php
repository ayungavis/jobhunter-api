<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JobTypeController extends REST_Controller {

	public function __construct() {
        parent::__construct();

        $this->load->model('JobType');
    }

    // GET DATA
    public function index_get() {
        $id = $this->get('id');

        if ($id == '') {
            $job_types = $this->JobType->get_all();
        } else {
            $job_types = $this->JobType->find($id);
        }

        $this->response($job_types, 200);
    }

    // CREATE / INSERT
    public function index_post() { //posting atau create
        $data = VERIFY::verify_request();
        if ($data) { 
            $attributes = [
                'name' => $this->post('name')
            ];

            $id = $this->JobType->insert($attributes);

            if ($id) {
                $job_types = $this->JobType->find($id);
                $this->response($job_types, 200);
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

            $update = $this->JobType->update($id, $attributes);

            if ($update) {
                $job_types = $this->JobType->find($id);
                $this->response($job_types, 200);
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
            $delete = $this->JobType->delete($id);

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

/* End of file JobTypeController.php */
/* Location: ./application/controllers/JobTypeController.php */