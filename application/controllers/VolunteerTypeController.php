<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VolunteerTypeController extends REST_Controller {

	public function __construct() {
        parent::__construct();

        $this->load->model('VolunteerType');
    }

    // GET DATA
    public function index_get() {
        $data = VERIFY::verify_request();
        if ($data) {
            $id = $this->get('id');

            if ($id == '') {
                $volunteer_types = $this->VolunteerType->get_all();
            } else {
                $volunteer_types = $this->VolunteerType->find($id);
            }

            $this->response($volunteer_types, 200);
        }
    }

    // CREATE / INSERT
    public function index_post() { //posting atau create
        $data = VERIFY::verify_request();
        if ($data) { 
            $attributes = [
                'name' => $this->post('name')
            ];

            $id = $this->VolunteerType->insert($attributes);

            if ($id) {
                $volunteer_types = $this->VolunteerType->find($id);
                $this->response($volunteer_types, 200);
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

            $update = $this->VolunteerType->update($id, $attributes);

            if ($update) {
                $volunteer_types = $this->VolunteerType->find($id);
                $this->response($volunteer_types, 200);
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
            $delete = $this->VolunteerType->delete($id);

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

/* End of file VolunteerTypeController.php */
/* Location: ./application/controllers/VolunteerTypeController.php */