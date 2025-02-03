<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coverview extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('mauth');
        $this->load->model('mpengguna');
		if(!$this->mauth->current_user()){
			redirect('adminlogin');
		}
    }

    public function index()
    {
        $userid = $this->session->userdata('userid');
        
        $row_user = $this->mpengguna->get_by_id($userid);

        $data['content_view']   = 'admin/pages/v_dashboard';
        $data['active_menu']    = 'dashboard';
        $data['active_sub_menu']= '';
        $data['title']          = 'Dashboard';
        $data['mode']           = 'view';
        $data['username']       = $row_user['nama'];
        $data['script_js']      = [];

        $this->load->view('admin/v_overview',$data);
    }
}