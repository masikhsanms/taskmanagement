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

    public function save_user(){
        $mpengguna  = $this->CI->mpengguna;
        $rules      = $mpengguna->rules();        
        $form_validation = $this->CI->form_validation;

        $form_validation->set_rules( $rules );

        if( $form_validation->run() == FALSE ){
            redirect(site_url('tambahpengguna'));
        }

        if($mpengguna->simpan() > 0){
            redirect(site_url('pengguna'));
        }
    }

    public function update_user(){
        $mpengguna  = $this->CI->mpengguna;
        $rules      = $mpengguna->rules();
        $form_validation = $this->CI->form_validation;
        
        $form_validation->set_rules( $rules );
                                
        if( $form_validation->run() == FALSE ){
            redirect('editpengguna/'.$this->CI->input->post('id',true));
        }

        $mpengguna->update(); 
        
        redirect(site_url('pengguna'));
    }

    public function delete_user(){
        $mpengguna  = $this->CI->mpengguna;
        $id = $this->CI->input->post('id',true);
        
        if($mpengguna->delete($id)){
            $retun = ['code'=>200,'msg'=>'Success'];
        }else{
            $retun = ['code'=>201,'msg'=>'Failed'];
        }

        return $retun;
    }
}