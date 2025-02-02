<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('ApiServices/tasksservices');
    }

    public function index() {
        try {
            $response = $this->tasksservices->tasks();
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

    public function all(){
        try {
            $response = $this->tasksservices->all();
            echo json_encode($response);
            
        } catch (\Throwable $th) {
            $error_response = [
                'code' => 201,
                'status' =>  'error',
                'message' => 'Something went wrong. Please try again later.'
            ];
            echo json_encode($error_response);  // Send error response to client
        }
    }

    public function get_task($id){
        try {
            $response = $this->tasksservices->get_task_by_ID($id);
            echo json_encode( $response );
        } catch (\Throwable $th) {
            $error_response = [
                'code' => 201,
                'status' =>  'error',
                'message' => 'Something went wrong. Please try again later.'
            ];
            echo json_encode($error_response);  // Send error response to client
        }
    }
}
