<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Cmasterdata extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('mtask');
        $this->load->model('mauth');

        $this->load->library('taskservices');

		if(!$this->mauth->current_user()){
			redirect('adminlogin');
		}
    }

    public function setting_layout_task(){
        $data = [
            'content_view' => 'admin/pages/datatask',
            'title' => '',
            'active_menu' => 'task',
            'sub_active_menu' => '',
            'plugins'=>[PLUGIN_DATATABLE,PLUGIN_SELECT2]
        ];

        return $data;
    }

    public function datatask(){
        
        $datas = $this->taskservices->call( $this->setting_layout_task() );
        
        $this->load->view('admin/v_overview',$datas);
    }

    

    public function tambahtask(){
        $data = $this->setting_layout_task();
        $data['title'] = 'Tambah Task Management';
        $data['mode'] = 'add';
        $data['script_js'] = ['masterdata'];
        $data['plugins'] = [PLUGIN_SELECT2,PLUGIN_DATATABLE];

        $this->load->view('admin/v_overview',$data);
    }

    public function simpantask(){
        try {
            $this->taskservices->save();
        } catch (\Throwable $th) {
            redirect('tambahtask');
        }
    }

    public function edit($id=null){
        $mtask = $this->mtask;

        $data = $this->setting_layout_task();
        $data['title'] = 'Edit Task Management';
        $data['mode'] = 'edit';
        $data['getdatabyid'] = $mtask->get_by_id($id);
        $data['script_js'] = ['masterdata'];
        $data['plugins'] = [PLUGIN_SELECT2,PLUGIN_DATATABLE];

        $this->load->view('admin/v_overview',$data);
    }

    public function update(){
        try {
            $this->taskservices->update_service();
        } catch (\Throwable $th) {
            redirect('edittask/'.$this->input->post('id',TRUE));
        }
    }

    public function delete(){
        try {
            $data = $this->taskservices->delete_service();
            echo json_encode($data);
        } catch (\Throwable $th) {
            redirect('datatask');
        }
        
    }

            
}
 
?>