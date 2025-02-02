<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('ApiServices/loginservices');
    }

    public function index() {
        try {
            $response = $this->loginservices->auth();
            echo json_encode($response);
        } catch (\Throwable $th) {
            $error_response = [
                'code' => 201,
                'status' => 'error',
                'message' => 'Something went wrong. Please try again later.',
            ];
            echo json_encode($error_response);  // Send error response to client
        }
    }
}
