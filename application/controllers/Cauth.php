<?php

class Cauth extends CI_Controller
{
	public function index()
	{
		show_404();
	}

	public function login()
	{
		$this->load->model('mauth');
		$this->load->library('form_validation');

		$data = ['title'=>'Login'];

		$rules = $this->mauth->rules();
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() == FALSE){
			return $this->load->view('v_login',$data);
		}

		$username = $this->input->post('username');
		$password = $this->input->post('password');

        // print_r( $this->input->post() );
		if($this->mauth->login($username, $password)){
			redirect('admin');
		} else {
			$this->session->set_flashdata('message_login_error', 'Login Gagal, pastikan username dan password benar!');
		}

		$this->load->view('v_login',$data);
	}

	public function logout()
	{
		$this->load->model('mauth');
		$this->mauth->logout();
		redirect('adminlogin');
	}
}