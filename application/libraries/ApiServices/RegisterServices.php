<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class RegisterServices
{

    protected $CI;
    private $secret_key = SECRET_KEY;

    public function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->model('mauth');
        $this->CI->load->model('mpengguna');
        $this->CI->load->helper('security');
    }

    public function add(){
        // Ambil data JSON dari body request
        $input = json_decode(file_get_contents("php://input"), true);

        if (!$input) {
            echo json_encode(['code'=>201, 'status' => 'error', 'message' => 'Invalid JSON format']);
            die();
        }

        $inserted = $this->add_fomvalidation($input);

        if ($inserted) {
            // Jika sukses, buat JWT token
            $token_data = [
                'id' => $inserted,
                'username' => $input['username'],
                'email' => $input['email'],
                'iat' => time(),
                'exp' => time() + (60 * 60)  // Token berlaku selama 1 jam
            ];

            // Generate JWT
            $jwt = JWT::encode($token_data, $this->secret_key, 'HS256');

            // Kembalikan response sukses dengan JWT token
            $response = [
                'status' => 'success',
                'message' => 'Pengguna berhasil didaftarkan.',
                'token' => $jwt
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Gagal mendaftar pengguna.'
            ];
        }

        return $response;

    }

    private function add_fomvalidation($input){
        
        // Set rules untuk form validation
        $form_validation = $this->CI->form_validation;
        $form_validation->set_data($input); // Set data input agar bisa divalidasi
        $form_validation->set_rules('nama', 'Nama', 'required|min_length[5]|max_length[50]');
        $form_validation->set_rules('username', 'Username', 'required|alpha_numeric|min_length[5]|max_length[15]');
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
        $nama = $input['nama'];
        $username = $input['username'];
        $email = $input['email'];
        $password = password_hash($input['password'], PASSWORD_DEFAULT); // Enkripsi password

        // ** Cek apakah username atau email sudah ada**
        if ($this->CI->mpengguna->is_username_exist($username)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Username sudah digunakan.'
            ]);
            die();
        }

        if ($this->CI->mpengguna->is_email_exist($email)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Email sudah digunakan.'
            ]);
            die();
        }

        // Simpan ke database
        $user_data = [
            'nama' => $nama,
            'username' => $username,
            'email' => $email,
            'password' => $password
        ];

        return $this->CI->mpengguna->api_simpan_pengguna($user_data);

    }
}