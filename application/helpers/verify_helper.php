<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VERIFY {
    /* public function __construct() {
       parent::Controller();
    } */

    public static function verify_request() {
        $ci =& get_instance();
        // Get all the headers
        $headers = $ci->input->request_headers();
        // Extract the token
        $token = $headers['Authorization'];
        // Use try-catch
        // JWT library throws exception if the token is not valid
        try {
            // Validate the token
            // Successfull validation will return the decoded user data else returns false
            $data = AUTHORIZATION::validateToken($token);
            if ($data === false) {
                $status = 401;
                $response = ['status' => $status, 'msg' => 'Unauthorized Access!'];
                $ci->response($response, $status);
                exit();
            } else {
                return $data;
            }
        } catch (Exception $e) {
            // Token is invalid
            // Send the unathorized access message
            $status = 401;
            $response = ['status' => $status, 'msg' => 'Unauthorized Access!'];
            $ci->response($response, $status);
        }
    }
}