<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TaskServices
{

    protected $CI;

    public function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->model('mauth');
        $this->CI->load->model('mpengguna');
        $this->CI->load->model('mtask');
        $this->CI->load->library('upload');
    }

    public function current_user(){
        if(!$this->CI->mauth->current_user()){
            redirect('adminlogin');
        }
    }

    public function call($layout_array){
        $data = [
            'title' => 'List Task',
            'mode' => 'view',
            'datatask' => $this->get_all_tasks(),
            'script_js' => ['masterdata']
        ];

        return array_merge($layout_array, $data);
    }

    private function get_all_tasks(){
        $task = $this->CI->mtask;
        return $task->get_all();
    }

    public function get_users($layout_array){

        $mpengguna  = $this->CI->mpengguna;

        $data = [
            'title' => 'List Users',
            'mode' => 'view',
            'allpengguna' => $mpengguna->get_all(),
            'script_js' => ['pengguna']
        ];
            
        $data = array_merge($layout_array, $data);
        return $data;    
        
    }

    public function save(){
        $mtask  = $this->CI->mtask;
        $rules      = $mtask->rules();
        $form_validation = $this->CI->form_validation;

        $form_validation->set_rules( $rules );

        if( $form_validation->run() == FALSE ){
            $this->CI->session->set_flashdata('error', validation_errors());
            redirect(site_url('tambahtask'));
        }

        $task_ID = $mtask->simpan();

        if ($task_ID > 0) {

            
            // upload file store to database
            $file_store_db = $this->file_upload($this->CI->input->post('judul',true),$task_ID);

            if( $file_store_db > 0 ){
                $this->CI->mtask->update_idfile_task($file_store_db,$task_ID);
            }

            $this->CI->session->set_flashdata('success', 'Task berhasil disimpan!');
            redirect(site_url('datatask'));
        } else {
            $this->CI->session->set_flashdata('error', 'Gagal menyimpan task.');
            redirect(site_url('tambahtask'));
        }

    }

    public function file_upload($filename,$task_ID,$is_updatefile=false){
        $config['upload_path']          = FCPATH.'assets/upload/';
        $config['allowed_types']        = 'pdf';
        $config['file_name']            = $filename;
        $config['overwrite']            = true;
        $config['max_size']             = 5024; // 1MB

        $this->CI->upload->initialize($config);
        
        if ($this->CI->upload->do_upload('lampiran')) {
            $name = $this->CI->upload->data("file_name");
            $full_path = $this->CI->upload->data("full_path");

            $datas = [
                'nama_file' => $name,
                'url_file' => $full_path,
                'task_ID' => $task_ID
            ];

            if($is_updatefile){
                return $this->CI->mtask->update_file(
                    array(
                        'nama_file' => $name,
                        'url_file' => $full_path
                    ),
                    array('task_ID' => $task_ID)
                );
            }

            return $this->CI->mtask->simpan_file($datas);

        }
        
    }

    public function update_service(){
        $mtask  = $this->CI->mtask;
        $rules  = $mtask->rules();
        $form_validation = $this->CI->form_validation;
        
        $id = $this->CI->input->post('idhidden',TRUE);

        $form_validation->set_rules( $rules );
        
        if( $form_validation->run() == FALSE ){
            $this->CI->session->set_flashdata('error', validation_errors());
            redirect('edittask/'.$id);
        }

        $mtask->update(); 

        $file_store_db = $this->file_upload($this->CI->input->post('judul',TRUE),$id,TRUE);

        if( isset($file_store_db['error']) ){
            $this->CI->session->set_flashdata('error', $file_store_db['msg']);
            redirect('edittask/'.$id);
        }
        
        redirect(site_url('datatask'));
    }

    public function delete_service(){
        $id = $this->CI->input->post('id');
        $mtask = $this->CI->mtask;
        
        if($mtask->delete($id)){
            $retun = ['code'=>200,'msg'=>'Success'];
        }else{
            $retun = ['code'=>201,'msg'=>'Failed'];
        }

        return $retun;
        
    }
}