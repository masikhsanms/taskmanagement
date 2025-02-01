<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cpengguna extends CI_Controller
{
    protected $userService;

    public function __construct(){
        parent::__construct();
        $this->load->model('mpengguna');
        $this->load->model('mauth');
		
        // if(!$this->mauth->current_user()){
		// 	redirect('adminlogin');
		// }

        $this->userService = new UserServices();
    }

    public function setting_layout_pengguna(){
        $data = [
            'content_view' => 'admin/pages/pengguna',
            'title' => '',
            'active_menu' => 'pengguna',
            'sub_active_menu' => '',
            'plugins'=>[PLUGIN_DATATABLE]
        ];

        return $data;
    }

    public function pengguna(){

        $datas = $this->userService->get_users( $this->setting_layout_pengguna() );
        $this->load->view('admin/v_overview',$datas);
        
    }

    public function tambah(){
        $data = $this->setting_layout_pengguna();
        $data['title'] = 'Tambah Pengguna';
        $data['mode'] = 'add';
        $data['script_js'] = ['pengguna'];

        $this->load->view('admin/v_overview',$data);
    }

    public function simpanpengguna(){

        try {
            $this->userService->save_user();
        } catch (\Throwable $th) {
            redirect('tambahpengguna');
        }
    }

    public function editpengguna($id=null){
        $mpengguna = $this->mpengguna;
     
        $data = $this->setting_layout_pengguna();
        $data['title'] = 'Edit Pengguna';
        $data['mode'] = 'edit';
        $data['getdatabyid'] = $mpengguna->get_by_id($id);
        $data['script_js'] = ['pengguna'];

        $this->load->view('admin/v_overview',$data);
    }

    public function updatepengguna(){
        try {
            $this->userService->update_user();
            
        } catch (\Throwable $th) {
            redirect('editpengguna/'.$this->input->post('id',TRUE));
        }
    }

    public function hapuspengguna(){
        try {
            $data = $this->userService->delete_user();
            echo json_encode($data);
        } catch (\Throwable $th) {
            redirect('pengguna');
        }
    }
}