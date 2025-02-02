<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class LoginServices
{

    protected $CI;
    private $secret_key = SECRET_KEY;

    public function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->model('mauth');
        $this->CI->load->model('mpengguna');
        $this->CI->load->helper('security');
    }

    public function auth(){
        // Ambil data JSON dari body request
        $input = json_decode(file_get_contents("php://input"), true);

        if (!$input) {
            echo json_encode(['code'=>201, 'status' => 'error', 'message' => 'Invalid JSON format']);
            die();
        }

        $datas = $this->add_fomvalidation($input);

        if (!empty($datas) ) {
            // Jika sukses, buat JWT token
            $token_data = [
                'id' => $datas['ID'],
                'username' => $datas['username'],
                'email' => $datas['email'],
                'iat' => time(),
                'exp' => time() + (60 * 60)  // Token berlaku selama 1 jam
            ];

            // Generate JWT
            $jwt = JWT::encode($token_data, $this->secret_key, 'HS256');

            // Kembalikan response sukses dengan JWT token
            $response = [
                'status' => 'success',
                'code'=>200,
                'message' => 'Login Berhasil.',
                'token' => $jwt
            ];
        } else {
            $response = [
                'status' => 'error',
                'code'=>201,
                'message' => 'Login Ditolak.'
            ];
        }

        return $response;

    }

    private function add_fomvalidation($input){
        
        // Set rules untuk form validation
        $form_validation = $this->CI->form_validation;
        $form_validation->set_data($input); // Set data input agar bisa divalidasi
        $form_validation->set_rules('email', 'Email', 'required|valid_email');
        $form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if ($form_validation->run() === FALSE) {
            // Jika validasi gagal, kirimkan error dalam format JSON
            echo json_encode([
                'status' => 'error',
                'message' => validation_errors()
            ]);
            die();
        }

        // Ambil data dari request
        $email = $input['email'];
        $password = $input['password'];

        if (!$this->CI->mpengguna->is_email_exist($email)) {
            echo json_encode([
                'status' => 'error',
                'code' => 404,
                'message' => 'Email Tidak ditemukan.'
            ]);
            die();
        }

        $row_user = $this->CI->mpengguna->get_user_by_email($email);

        $user_data = [
            'ID' => $row_user['ID'],
            'username'=>$row_user['username'],
            'email' => $email,
            'password' => $password
        ];

        return $user_data;

    }
}