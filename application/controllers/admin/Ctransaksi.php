<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Ctransaksi extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('mmasterdata');
        $this->load->model('mtransaksi');
        $this->load->model('mauth');
        $this->load->model('mpengguna');
		if(!$this->mauth->current_user()){
			redirect('adminlogin');
		}
    }

    public function setting_layout_pembelian(){
        $data = [
            'content_view' => 'admin/pages/pembelian',
            'title' => '',
            'active_menu' => 'pemebelianbarang',
            'sub_active_menu' => '',
            'plugins'=>[PLUGIN_DATATABLE,PLUGIN_SELECT2]
        ];

        return $data;
    }

    public function setting_layout_penjualan(){
        $data = [
            'content_view' => 'admin/pages/penjualan',
            'title' => '',
            'active_menu' => 'penjualanbarang',
            'sub_active_menu' => '',
            'plugins'=>[PLUGIN_DATATABLE,PLUGIN_SELECT2]
        ];

        return $data;
    }

    public function pembelian(){
        $mtransaksi  = $this->mtransaksi;
        
        $data = $this->setting_layout_pembelian();
        $data['title']     = 'Data Pembelian';
        $data['mode']      = 'view';
        $data['pembelian'] = $mtransaksi->get_all_pembelian();
        $data['script_js'] = ['transaksi'];

        $this->load->view('admin/v_overview',$data);
    }

    public function tambahpembelian(){
        $mmasterdata  = $this->mmasterdata;

        $data = $this->setting_layout_pembelian();
        $data['title'] = 'Tambah Data Pembelian';
        $data['mode'] = 'add';
        $data['databarang'] = $mmasterdata->get_all_barang();
        $data['datasupplier'] = $mmasterdata->get_all_suplier();
        $data['script_js'] = ['transaksi'];

        $this->load->view('admin/v_overview',$data);
    }

    public function simpanpembelian(){
        $mtransaksi  = $this->mtransaksi;
        $rules      = $mtransaksi->rules_pembelian();
        $this->form_validation->set_rules( $rules );

        if( $this->form_validation->run() == FALSE ){
            return $this->tambahpembelian();
        }

        if($mtransaksi->simpanpembelian() > 0){
            redirect(site_url('pembelianbarang'));
        }
    }

    public function editpembelian($id=null){
        $mmasterdata    = $this->mmasterdata;
        $mtransaksi     = $this->mtransaksi;

        $data = $this->setting_layout_pembelian();
        $data['title'] = 'Edit Pembelian';
        $data['mode'] = 'edit';
        $data['getdatabyid'] = $mtransaksi->get_pembelian_by_id($id);
        $data['databarang'] = $mmasterdata->get_all_barang();
        $data['datasupplier'] = $mmasterdata->get_all_suplier();
        $data['script_js'] = ['transaksi'];

        $this->load->view('admin/v_overview',$data);
    }

    public function updatepembelian(){
        $mtransaksi     = $this->mtransaksi;
        $rules      = $mtransaksi->rules_pembelian();
        
        $id         = $this->input->post('idhidden');

        $this->form_validation->set_rules( $rules );

        if( $this->form_validation->run() == FALSE ){
            return $this->editpembelian($id);
        }

        $mtransaksi->updatepembelian(); 
        
        redirect(site_url('pembelianbarang'));
    }

    public function deletepembelian(){
        $id = $this->input->post('id');
        $mtransaksi = $this->mtransaksi;
        
        if($mtransaksi->deletepembelian($id)){
            $retun = ['code'=>200,'msg'=>'Success'];
        }else{
            $retun = ['code'=>201,'msg'=>'Failed'];
        }

        echo json_encode($retun);
    }

    /**
     * Penjualan
     */
    public function penjualanbarang(){
        $mtransaksi  = $this->mtransaksi;
        
        $data = $this->setting_layout_penjualan();
        $data['title']     = 'Data Penjualan';
        $data['mode']      = 'view';
        $data['penjualan'] = $mtransaksi->get_all_penjualan();
        // $data['penjualan'] = [];
        $data['script_js'] = ['transaksi'];

        $this->load->view('admin/v_overview',$data);
    }

    public function tambahpenjualan(){
        $mmasterdata  = $this->mmasterdata;

        $data = $this->setting_layout_penjualan();
        $data['title'] = 'Tambah Data Penjualan';
        $data['mode'] = 'add';
        // $data['dataproduk'] = $mmasterdata->get_all_produk();
        $data['databuyer'] = $mmasterdata->get_all_buyer();
        $data['script_js'] = ['transaksi'];

        $this->load->view('admin/v_overview',$data);
    }

    public function simpanpenjualan(){
        $mtransaksi  = $this->mtransaksi;
        $rules      = $mtransaksi->rules_penjualan();
        $this->form_validation->set_rules( $rules );

        if( $this->form_validation->run() == FALSE ){
            return $this->tambahpenjualan();
        }

        if($mtransaksi->simpanpenjualan() > 0){
            redirect(site_url('penjualanbarang'));
        }
    }

    public function editpenjualan($id=null){
        $mmasterdata    = $this->mmasterdata;
        $mtransaksi     = $this->mtransaksi;

        $data = $this->setting_layout_penjualan();
        $data['title'] = 'Edit Penjualan';
        $data['mode'] = 'edit';
        $data['getdatabyid'] = $mtransaksi->get_penjualan_by_id($id);
        $data['dataproduk'] = $mmasterdata->get_all_produk();
        $data['databuyer'] = $mmasterdata->get_all_buyer();
        $data['script_js'] = ['transaksi'];

        $this->load->view('admin/v_overview',$data);
    }

    public function updatepenjualan(){
        $mtransaksi     = $this->mtransaksi;
        $rules          = $mtransaksi->rules_penjualan();
        
        $id             = $this->input->post('idhidden');

        $this->form_validation->set_rules( $rules );

        if( $this->form_validation->run() == FALSE ){
            return $this->editpenjualan($id);
        }

        $mtransaksi->updatepenjualan(); 
        
        redirect(site_url('penjualanbarang'));
    }

    public function deletepenjualan(){
        $id = $this->input->post('id');
        $mtransaksi = $this->mtransaksi;
        
        if($mtransaksi->deletepenjualan($id)){
            $retun = ['code'=>200,'msg'=>'Success'];
        }else{
            $retun = ['code'=>201,'msg'=>'Failed'];
        }

        echo json_encode($retun);
    }

    public function buyer_penjualan(){
        $id = $this->input->post('id');
        $mtransaksi = $this->mtransaksi;
        $mmasterdata    = $this->mmasterdata;

        $dataproduk = $mmasterdata->get_all_produk_by_buyer($id);
        if( empty( $dataproduk ) ){
            $html = '';
        }else{
            $html = '<option value="'.$dataproduk['idproduk'].'">'.$dataproduk['namaproduk'].'['.$dataproduk['kodeproduk'].']'."</option>";
        }
        echo $html;
    }
}