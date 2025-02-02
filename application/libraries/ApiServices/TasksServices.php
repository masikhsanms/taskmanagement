<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class TasksServices
{

    protected $CI;
    private $secret_key = SECRET_KEY;

    public function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->model('mtask');
        $this->CI->load->helper('security');
        $this->CI->load->model('mpengguna');
    }

    public function tasks(){

        //cek token header ketika generate token login
        $this->validate_header();
        
        // Ambil data JSON dari body request
        $input = json_decode(file_get_contents("php://input"), true);

        if (!$input) {
            echo json_encode(['code'=>201, 'status' => 'error', 'message' => 'Invalid JSON format']);
            die();
        }

        $task_id = $this->add_fomvalidation($input);

        if ($task_id > 0) {

            if( !empty($input['file_name']) && !empty($input['attachment_url']) ){
                $data_attach = [
                    'task_ID' => $task_id,
                    'nama_file'=> $input['file_name'],
                    'url_file' => $input['attachment_url']
                ];
                
                //file store db
                $this->CI->mtask->api_simpan_file($data_attach);
            }


            // Kembalikan response sukses dengan JWT token
            $response = [
                'status' => 'success',
                'code'=>200,
                'message' => 'Berhasil Menambahakan Tugas (Task).',
            ];
        } else {
            $response = [
                'status' => 'error',
                'code'=>201,
                'message' => 'Gagal Menambahkan Tugas (Task).'
            ];
        }

        return $response;

    }

    private function add_fomvalidation($input){
        
        // Set rules untuk form validation
        $form_validation = $this->CI->form_validation;
        $form_validation->set_data($input); // Set data input agar bisa divalidasi
        $form_validation->set_rules('title', 'Title', 'required');
        $form_validation->set_rules('status', 'Status', 'required');
        $form_validation->set_rules('due_date', 'Due Date', 'required');

        if ($form_validation->run() === FALSE) {
            // Jika validasi gagal, kirimkan error dalam format JSON
            echo json_encode([
                'status' => 'error',
                'message' => validation_errors()
            ]);
            die();
        }

        $decode_data = (array) $this->decode_data_jwt();

        $task_data = [
            'title' => $input['title'],
            'description' => $input['description'] ?? '',
            'status' => $input['status'],
            'due_date' => $input['due_date'],
            'user_id' => $decode_data['id'],
            'attachment_url' => $input['attachment_url'] ?? '',
            'file_name' => $input['file_name'] ?? ''
        ];

        $cek_user_by_task = $this->CI->mpengguna->get_by_id($decode_data['user_id']);
        
        if( empty($cek_user_by_task) ){
            echo json_encode([
                'status' => 'error',
                'code' =>201,
                'message' => 'user ID Tidak Sesuai'
            ]);
            die();
        }
        
        $row_user = $this->CI->mtask->api_simpan_task($task_data);

        return $row_user;

    }

    public function validate_header(){

        $headers = $this->CI->input->request_headers();
        
        // Cek apakah Authorization header ada
        if (!isset($headers['authorization'])) {
            $response = [
                'status' => 'error',
                'code'=>404,
                'message' => 'Authorization header not found'
            ];
            echo json_encode($response);
            die();
        }

        // Ambil token dari header Authorization
        $token = str_replace('Bearer ', '', $headers['authorization']);

        // Verifikasi token
        $decoded = JWT::decode($token, new Key($this->secret_key, 'HS256'));

        if ($decoded === null) {
            $response = [
                'status' => 'error',
                'code'=>201,
                'message' => 'Invalid or expired token'
            ];
            echo json_encode($response);
            die();
        }
    }

    public function all(){
        //cek token header ketika generate token login
        $this->validate_header();

        $decode_data = (array) $this->decode_data_jwt();
        
        $user_id = $decode_data['id'];

        $get_all = $this->CI->mtask->api_get_by_userid($user_id);

        if( empty($get_all) ){
            $response = [
                'status' => 'error',
                'code'=>404,
                'message' => 'Data Tidak ditemukan'
            ];
            echo json_encode($response);
            die();
        }

        return $get_all;

    }

    public function decode_data_jwt(){
        $headers = $this->CI->input->request_headers();
        $token = str_replace('Bearer ', '', $headers['authorization']);
        $decoded = JWT::decode($token, new Key($this->secret_key, 'HS256'));
        return $decoded;
    }

    public function get_task_by_ID($task_id){
        //cek token header ketika generate token login
        $this->validate_header();

        $decode_data = (array) $this->decode_data_jwt();        
        $user_id = $decode_data['id'];

        $query = $this->CI->mtask->get_by_taskid_userid( $task_id, $user_id);
        
        if( empty($query) ){
            $response = [
                'status' => 'error',
                'code'=>404,
                'message' => 'Data Tidak ditemukan',
                'data'=>[]
            ];
            echo json_encode($response);
            die();
        }

        $response = [
            'status' => 'success',
            'code'=>200,
            'message'=>'Data Berhasil di temukan',
            'data' => $query
        ];

        return $response;
    }

    public function update_task_services($task_id){
        //cek token header ketika generate token login
        $this->validate_header();
        
        $decode_data = (array) $this->decode_data_jwt();        
        $user_id = $decode_data['id'];

        // Ambil data JSON dari body request
        $input = json_decode(file_get_contents("php://input"), true);

        if (!$input) {
            echo json_encode(['code'=>201, 'status' => 'error', 'message' => 'Invalid JSON format']);
            die();
        }

        // Set rules untuk form validation
        $form_validation = $this->CI->form_validation;
        $form_validation->set_data($input); // Set data input agar bisa divalidasi
        $form_validation->set_rules('title', 'Title', 'required');
        $form_validation->set_rules('status', 'Status', 'required');
        $form_validation->set_rules('due_date', 'Due Date', 'required');

        if ($form_validation->run() === FALSE) {
            // Jika validasi gagal, kirimkan error dalam format JSON
            echo json_encode([
                'status' => 'error',
                'message' => validation_errors()
            ]);
            die();
        }


        $cek_user_by_task = $this->CI->mpengguna->get_by_id($user_id);
        
        if( empty($cek_user_by_task) ){
            echo json_encode([
                'status' => 'error',
                'code' =>201,
                'message' => 'user ID Tidak Sesuai'
            ]);
            die();
        }

        $task_data = [
            'task_id' => $task_id,
            'title' => $input['title'],
            'description' => $input['description'] ?? '',
            'status' => $input['status'],
            'due_date' => $input['due_date'],
            'user_id' => $decode_data['id'],
            'attachment_url' => $input['attachment_url'] ?? '',
            'file_name' => $input['file_name'] ?? ''
        ];
        
        $this->CI->mtask->api_update_task($task_data);

        return [
            'status'=>'success',
            'code' =>200,
            'message' => 'Data Berhasil di Update'
        ];
        

    }
}