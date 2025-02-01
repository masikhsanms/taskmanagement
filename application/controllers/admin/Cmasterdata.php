<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Cmasterdata extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('mmasterdata');
        $this->load->library('taskservices');

        // $this->load->model('mauth');
        // $this->load->model('mpengguna');
		// if(!$this->mauth->current_user()){
		// 	redirect('adminlogin');
		// }
    }

    public function setting_layout_task(){
        $data = [
            'content_view' => 'admin/pages/datatask',
            'title' => '',
            'active_menu' => 'task',
            'sub_active_menu' => '',
            'plugins'=>[PLUGIN_DATATABLE]
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
        $mmasterdata = $this->mmasterdata;

        $data = $this->setting_layout_task();
        $data['title'] = 'Edit Task Management';
        $data['mode'] = 'edit';
        $data['getdatabyid'] = $mmasterdata->get_by_id($id);
        $data['script_js'] = ['masterdata'];

        $this->load->view('admin/v_overview',$data);
    }

    public function update(){
        $mmasterdata  = $this->mmasterdata;
        $rules      = $mmasterdata->rules_barang();
        
        $id         = $this->input->post('idhidden');

        $this->form_validation->set_rules( $rules );

        if( $this->form_validation->run() == FALSE ){
            return $this->edit($id);
        }

        $mmasterdata->update(); 
        
        redirect(site_url('datatask'));
    }

    public function delete(){
        $id = $this->input->post('id');
        $mmasterdata = $this->mmasterdata;
        
        if($mmasterdata->delete($id)){
            $retun = ['code'=>200,'msg'=>'Success'];
        }else{
            $retun = ['code'=>201,'msg'=>'Failed'];
        }

        echo json_encode($retun);
    }

    /**
     * Suplier
     */
    public function supplier(){
        
        $mmasterdata  = $this->mmasterdata;

        $data = $this->setting_layout_supplier();
        $data['title']      = 'Data Supplier';
        $data['mode']       = 'view';
        $data['datasuplier'] = $mmasterdata->get_all_suplier();
        $data['script_js']  = ['masterdata'];

        $this->load->view('admin/v_overview',$data);
    }

    public function tambahsuplier(){
        $data = $this->setting_layout_supplier();
        $data['title'] = 'Tambah Data Suplier';
        $data['mode'] = 'add';
        $data['script_js'] = ['masterdata'];

        $this->load->view('admin/v_overview',$data);
    }

    public function simpansuplier(){
        $mmasterdata  = $this->mmasterdata;
        $rules      = $mmasterdata->rules_suplier();
        $this->form_validation->set_rules( $rules );

        if( $this->form_validation->run() == FALSE ){
            return $this->tambahsuplier();
        }

        if($mmasterdata->simpansuplier() > 0){
            redirect(site_url('supplier'));
        }
    }

    public function editsuplier($id=null){
        $mmasterdata = $this->mmasterdata;

        $data = $this->setting_layout_supplier();
        $data['title'] = 'Edit Data Suplier';
        $data['mode'] = 'edit';
        $data['getdatabyid'] = $mmasterdata->get_suplier_by_id($id);
        $data['script_js'] = ['masterdata'];

        $this->load->view('admin/v_overview',$data);
    }

    public function updatedatasuplier(){
        $mmasterdata  = $this->mmasterdata;
        $rules      = $mmasterdata->rules_suplier();
        
        $id         = $this->input->post('idhidden');

        $this->form_validation->set_rules( $rules );

        if( $this->form_validation->run() == FALSE ){
            return $this->editsuplier($id);
        }

        $mmasterdata->updatesuplier(); 
        
        redirect(site_url('supplier'));
    }

    public function hapussuplier(){
        $id = $this->input->post('id');
        $mmasterdata = $this->mmasterdata;
        
        if($mmasterdata->hapussuplier($id)){
            $retun = ['code'=>200,'msg'=>'Success'];
        }else{
            $retun = ['code'=>201,'msg'=>'Failed'];
        }

        echo json_encode($retun);
    }

    /**
     * Produk
     */
    public function dataproduk(){
        
        $mmasterdata  = $this->mmasterdata;

        $data = $this->setting_layout_produk();
        $data['title']      = 'Data Produk';
        $data['mode']       = 'view';
        $data['dataproduk'] = $mmasterdata->get_all_produk();
        $data['script_js']  = ['masterdata'];

        $this->load->view('admin/v_overview',$data);
    }

    public function tambahproduk(){
        $mmasterdata  = $this->mmasterdata;

        $data = $this->setting_layout_produk();
        $data['title'] = 'Tambah Data Produk';
        $data['mode'] = 'add';
        $data['databuyer'] = $mmasterdata->get_all_buyer();
        $data['script_js'] = ['masterdata'];

        $this->load->view('admin/v_overview',$data);
    }

    public function simpanproduk(){
        $mmasterdata  = $this->mmasterdata;
        $rules      = $mmasterdata->rules_produk();
        $this->form_validation->set_rules( $rules );

        if( $this->form_validation->run() == FALSE ){
            return $this->tambahproduk();
        }

        if($mmasterdata->simpanproduk() > 0){
            redirect(site_url('produk'));
        }
    }

    public function editproduk($id=null){
        $mmasterdata = $this->mmasterdata;

        $data = $this->setting_layout_produk();
        $data['title'] = 'Edit Data Produk';
        $data['mode'] = 'edit';
        $data['getdatabyid'] = $mmasterdata->get_produk_by_id($id);
        $data['databuyer'] = $mmasterdata->get_all_buyer();
        $data['script_js'] = ['masterdata'];

        $this->load->view('admin/v_overview',$data);
    }
    
    public function updatedataproduk(){
        $mmasterdata  = $this->mmasterdata;
        $rules      = $mmasterdata->rules_produk();
        
        $id         = $this->input->post('idhidden');

        $this->form_validation->set_rules( $rules );

        if( $this->form_validation->run() == FALSE ){
            return $this->editproduk($id);
        }

        $mmasterdata->updateproduk(); 
        
        redirect(site_url('produk'));
    }

    public function hapusproduk(){
        $id = $this->input->post('id');
        $mmasterdata = $this->mmasterdata;
        
        if($mmasterdata->hapusproduk($id)){
            $retun = ['code'=>200,'msg'=>'Success'];
        }else{
            $retun = ['code'=>201,'msg'=>'Failed'];
        }

        echo json_encode($retun);
    }

    /**
     * Produk
     */
    public function databuyer(){
        
        $mmasterdata  = $this->mmasterdata;

        $data = $this->setting_layout_buyer();
        $data['title']      = 'Data Buyer';
        $data['mode']       = 'view';
        $data['databuyer'] = $mmasterdata->get_all_buyer();
        $data['script_js']  = ['masterdata'];

        $this->load->view('admin/v_overview',$data);
    }

    public function tambahbuyer(){
        $data = $this->setting_layout_buyer();
        $data['title'] = 'Tambah Data Buyer';
        $data['mode'] = 'add';
        $data['script_js'] = ['masterdata'];

        $this->load->view('admin/v_overview',$data);
    }

    public function simpanbuyer(){
        $mmasterdata  = $this->mmasterdata;
        $rules      = $mmasterdata->rules_buyer();
        $this->form_validation->set_rules( $rules );

        if( $this->form_validation->run() == FALSE ){
            return $this->tambahbuyer();
        }

        if($mmasterdata->simpanbuyer() > 0){
            redirect(site_url('buyer'));
        }
    }

    public function editbuyer($id=null){
        $mmasterdata = $this->mmasterdata;

        $data = $this->setting_layout_buyer();
        $data['title'] = 'Edit Data Buyer';
        $data['mode'] = 'edit';
        $data['getdatabyid'] = $mmasterdata->get_buyer_by_id($id);
        $data['script_js'] = ['masterdata'];

        $this->load->view('admin/v_overview',$data);
    }

    public function updatedatabuyer(){
        $mmasterdata    = $this->mmasterdata;
        $rules          = $mmasterdata->rules_buyer();
        
        $id             = $this->input->post('idhidden');

        $this->form_validation->set_rules( $rules );

        if( $this->form_validation->run() == FALSE ){
            return $this->editbuyer($id);
        }

        $mmasterdata->updatebuyer(); 
        
        redirect(site_url('buyer'));
    }

    public function hapusbuyer(){
        $id = $this->input->post('id');
        $mmasterdata = $this->mmasterdata;
        
        if($mmasterdata->hapusbuyer($id)){
            $retun = ['code'=>200,'msg'=>'Success'];
        }else{
            $retun = ['code'=>201,'msg'=>'Failed'];
        }

        echo json_encode($retun);
    }
        
}
 
?>