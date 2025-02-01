<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Cinventory extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('mmasterdata');
        $this->load->model('minventory');
        $this->load->model('mauth');
        $this->load->model('mpengguna');
		if(!$this->mauth->current_user()){
			redirect('adminlogin');
		}
    }

    public function setting_layout_stokbarang(){
        $data = [
            'content_view' => 'admin/pages/stokbarang',
            'title' => '',
            'active_menu' => 'stokbarang',
            'sub_active_menu' => '',
            'plugins'=>[PLUGIN_DATATABLE,PLUGIN_SELECT2]
        ];

        return $data;
    }

    public function setting_layout_barangmasuk(){
        $data = [
            'content_view' => 'admin/pages/barangmasuk',
            'title' => '',
            'active_menu' => 'barangmasuk',
            'sub_active_menu' => '',
            'plugins'=>[PLUGIN_DATATABLE,PLUGIN_SELECT2]
        ];

        return $data;
    }

    public function setting_layout_barangkeluar(){
        $data = [
            'content_view' => 'admin/pages/barangkeluar',
            'title' => '',
            'active_menu' => 'barangkeluar',
            'sub_active_menu' => '',
            'plugins'=>[PLUGIN_DATATABLE,PLUGIN_SELECT2]
        ];

        return $data;
    }

    public function stokbarang(){
        
        $minventory  = $this->minventory;
        
        $data = $this->setting_layout_stokbarang();
        $data['title']     = 'Data Stok Barang';
        $data['mode']      = 'view';
        $data['datastokbarang'] = $minventory->get_all_inventory();
        $data['script_js'] = ['inventory'];

        $this->load->view('admin/v_overview',$data);
    }

    

    public function tambahstokbarang(){
        $mmasterdata  = $this->mmasterdata;

        $data = $this->setting_layout_stokbarang();
        $data['title'] = 'Tambah Data Stok Barang';
        $data['mode'] = 'add';
        $data['databarang'] = $mmasterdata->get_all_barang();
        $data['datasupplier'] = $mmasterdata->get_all_suplier();
        $data['script_js'] = ['inventory'];

        $this->load->view('admin/v_overview',$data);
    }

    public function simpanstokbarang(){
        $minventory  = $this->minventory;
        $rules      = $minventory->rules_stokbarang();
        $this->form_validation->set_rules( $rules );

        if( $this->form_validation->run() == FALSE ){
            return $this->tambahstokbarang();
        }

        if($minventory->simpanstokbarang() > 0){
            redirect(site_url('stokbarang'));
        }
    }

    public function editstokbarang($id=null){
        $mmasterdata    = $this->mmasterdata;
        $minventory     = $this->minventory;

        $data = $this->setting_layout_stokbarang();
        $data['title'] = 'Edit Stok Barang';
        $data['mode'] = 'edit';
        $data['getdatabyid'] = $minventory->get_stokbarang_by_id($id);
        $data['databarang'] = $mmasterdata->get_all_barang();
        $data['datasupplier'] = $mmasterdata->get_all_suplier();
        $data['script_js'] = ['inventory'];

        $this->load->view('admin/v_overview',$data);
    }

    public function updatestokbarang(){
        $minventory  = $this->minventory;
        $rules      = $minventory->rules_stokbarang();
        
        $id         = $this->input->post('idhidden');

        $this->form_validation->set_rules( $rules );

        if( $this->form_validation->run() == FALSE ){
            return $this->editstokbarang($id);
        }

        $minventory->updatestokbarang(); 
        
        redirect(site_url('stokbarang'));
    }

    public function deletestokbarang(){
        $id = $this->input->post('id');
        $minventory = $this->minventory;
        
        if($minventory->deletestokbarang($id)){
            $retun = ['code'=>200,'msg'=>'Success'];
        }else{
            $retun = ['code'=>201,'msg'=>'Failed'];
        }

        echo json_encode($retun);
    }

    /** BARANG MASUK */
    public function barangmasuk(){
        
        $minventory  = $this->minventory;
        
        $data = $this->setting_layout_barangmasuk();
        $data['title']     = 'Data Barang Masuk';
        $data['mode']      = 'view';
        $data['databarangmasuk'] = $minventory->get_all_barangmasuk();
        $data['script_js'] = ['inventory'];

        $this->load->view('admin/v_overview',$data);
    }

    public function tambahbarangmasuk(){
        $mmasterdata  = $this->mmasterdata;

        $data = $this->setting_layout_barangmasuk();
        $data['title'] = 'Tambah Data Barang Masuk';
        $data['mode'] = 'add';
        $data['databarang'] = $mmasterdata->get_all_barang();
        $data['datasupplier'] = $mmasterdata->get_all_suplier();
        $data['script_js'] = ['inventory'];

        $this->load->view('admin/v_overview',$data);
    }

    public function simpanbarangmasuk(){
        $minventory  = $this->minventory;
        $rules      = $minventory->rules_barangmasuk();
        $this->form_validation->set_rules( $rules );

        if( $this->form_validation->run() == FALSE ){
            return $this->tambahbarangmasuk();
        }

        if($minventory->simpanbarangmasuk() > 0){
            redirect(site_url('barangmasuk'));
        }
    }

    public function editbarangmasuk($id=null){
        $mmasterdata    = $this->mmasterdata;
        $minventory     = $this->minventory;

        $data = $this->setting_layout_barangmasuk();
        $data['title'] = 'Edit Barang Masuk';
        $data['mode'] = 'edit';
        $data['getdatabyid'] = $minventory->get_barangmasuk_by_id($id);
        $data['databarang'] = $mmasterdata->get_all_barang();
        $data['datasupplier'] = $mmasterdata->get_all_suplier();
        $data['script_js'] = ['inventory'];

        $this->load->view('admin/v_overview',$data);
    }

    public function updatebarangmasuk(){
        $minventory  = $this->minventory;
        $rules      = $minventory->rules_barangmasuk();
        
        $id         = $this->input->post('idhidden');

        $this->form_validation->set_rules( $rules );

        if( $this->form_validation->run() == FALSE ){
            return $this->editbarangmasuk($id);
        }

        $minventory->updatebarangmasuk(); 
        
        redirect(site_url('barangmasuk'));
    }

    public function deletebarangmasuk(){
        $id = $this->input->post('id');
        $minventory = $this->minventory;
        
        if($minventory->deletebarangmasuk($id)){
            $retun = ['code'=>200,'msg'=>'Success'];
        }else{
            $retun = ['code'=>201,'msg'=>'Failed'];
        }

        echo json_encode($retun);
    }

    /**
     * BARANG KELUAR
     */
    public function barangkeluar(){
        $minventory  = $this->minventory;
        
        $data = $this->setting_layout_barangkeluar();
        $data['title']     = 'Data Barang Keluar';
        $data['mode']      = 'view';
        $data['databarangkeluar'] = $minventory->get_all_barangkeluar();
        $data['script_js'] = ['inventory'];

        $this->load->view('admin/v_overview',$data);
    }      
    
    public function tambahbarangkeluar(){
        $mmasterdata  = $this->mmasterdata;

        $data = $this->setting_layout_barangkeluar();
        $data['title'] = 'Tambah Data Barang Keluar';
        $data['mode'] = 'add';
        $data['databarang'] = $mmasterdata->get_all_barang();
        $data['datasupplier'] = $mmasterdata->get_all_suplier();
        $data['script_js'] = ['inventory'];

        $this->load->view('admin/v_overview',$data);
    }

    public function simpanbarangkeluar(){
        $minventory  = $this->minventory;
        $rules      = $minventory->rules_barangkeluar();
        $this->form_validation->set_rules( $rules );

        if( $this->form_validation->run() == FALSE ){
            return $this->tambahbarangkeluar();
        }

        if($minventory->simpanbarangkeluar() > 0){
            redirect(site_url('barangkeluar'));
        }
    }

    public function editbarangkeluar($id=null){
        $mmasterdata    = $this->mmasterdata;
        $minventory     = $this->minventory;

        $data = $this->setting_layout_barangkeluar();
        $data['title'] = 'Edit Barang Keluar';
        $data['mode'] = 'edit';
        $data['getdatabyid'] = $minventory->get_barangkeluar_by_id($id);
        $data['databarang'] = $mmasterdata->get_all_barang();
        $data['datasupplier'] = $mmasterdata->get_all_suplier();
        $data['script_js'] = ['inventory'];

        $this->load->view('admin/v_overview',$data);
    }

    public function updatebarangkeluar(){
        $minventory  = $this->minventory;
        $rules      = $minventory->rules_barangkeluar();
        
        $id         = $this->input->post('idhidden');

        $this->form_validation->set_rules( $rules );

        if( $this->form_validation->run() == FALSE ){
            return $this->editbarangkeluar($id);
        }

        $minventory->updatebarangkeluar(); 
        
        redirect(site_url('barangkeluar'));
    }

    public function deletebarangkeluar(){
        $id = $this->input->post('id');
        $minventory = $this->minventory;
        
        if($minventory->deletebarangkeluar($id)){
            $retun = ['code'=>200,'msg'=>'Success'];
        }else{
            $retun = ['code'=>201,'msg'=>'Failed'];
        }

        echo json_encode($retun);
    }
}
 
?>