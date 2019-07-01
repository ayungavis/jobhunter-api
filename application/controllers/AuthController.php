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
class AuthController extends REST_Controller {
    public function __construct() {
        parent::__construct();
        
        // Load these helper to create JWT tokens
        $this->load->helper(['jwt', 'authorization']); 

        $this->load->model('User');
    }

    public function index_get() {
        // Call the verification method and store the return value in the variable
        $data = $this->verify_request();
        if ($data) {
            // Send the return data as reponse
            $status = parent::HTTP_OK;
            $response = ['status' => $status, 'data' => $data];
            $this->response($response, $status);    
        }
    }

    public function index_post() {
        $action = $this->uri->segment(3);

        switch ($action) {
            case 'login':
                $username = $this->post('username');
                $password = $this->post('password');

                $user = $this->User->get_by_username($username);
                if ($user && ($user->password == $password)) {
                    // Create a token from the user data and send it as reponse
                    $token = AUTHORIZATION::generateToken(['id' => $user->id]);

                    // Prepare the response
                    $status = parent::HTTP_OK;
                    $response = ['status' => $status, 'token' => $token, 'user' => $user];

                    $this->response($response, $status);
                } else {
                    $this->response(array('status' => 'fail'), 502);
                }
                break;
            
            case 'register':
                $first_name = $this->post('first_name');
                $last_name = $this->post('last_name');
                $username = $this->post('username');
                $email = $this->post('email');
                $password = $this->post('password');

                $attributes = [
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'username' => $username,
                    'email' => $email,
                    'password' => $password
                ];

                $id = $this->User->insert($attributes);

                if ($id) {
                    $user = $this->User->find($id);
                    // Create a token from the user data and send it as reponse
                    $token = AUTHORIZATION::generateToken(['id' => $user->id]);

                    // Prepare the response
                    $status = parent::HTTP_OK;
                    $response = ['status' => $status, 'token' => $token, 'user' => $user];

                    $this->response($response, $status);
                }
                break;
            
            default:
                $this->response(array('status' => 'fail'), 502);
                break;
        }
    }

    private function verify_request() {
        // Get all the headers
        $headers = $this->input->request_headers();
        // Extract the token
        $token = $headers['Authorization'];
        // Use try-catch
        // JWT library throws exception if the token is not valid
        try {
            // Validate the token
            // Successfull validation will return the decoded user data else returns false
            $data = AUTHORIZATION::validateToken($token);
            if ($data === false) {
                $status = parent::HTTP_UNAUTHORIZED;
                $response = ['status' => $status, 'msg' => 'Unauthorized Access!'];
                $this->response($response, $status);
                exit();
            } else {
                return $data;
            }
        } catch (Exception $e) {
            // Token is invalid
            // Send the unathorized access message
            $status = parent::HTTP_UNAUTHORIZED;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access!'];
            $this->response($response, $status);
        }
    }
}