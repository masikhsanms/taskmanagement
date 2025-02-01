<?php
class Mmasterdata extends CI_Model
{
    protected $tb_databarang    = 'databarang';
    protected $tb_datasuplier   = 'datasuplier';
    protected $tb_dataproduk    = 'dataproduk';
    protected $tb_databuyer     = 'databuyer';

    function rules_barang(){
        $rules = array(
            array(
                'field' => 'kode',
                'label' => 'Kode',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Kolom %s wajib di isi!',
                ),
            ),
            array(
                'field' => 'namabarang',
                'label' => 'Nama Barang',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Kolom %s wajib di isi!',
                ),
            ),
        );

        return $rules;
    }

    function rules_suplier(){
        $rules = array(
            array(
                'field' => 'namasuplier',
                'label' => 'Nama',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Kolom %s wajib di isi!',
                ),
            ),
            array(
                'field' => 'telepon',
                'label' => 'Telepon',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Kolom %s wajib di isi!',
                ),
            ),
            array(
                'field' => 'alamat',
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Kolom %s wajib di isi!',
                ),
            ),
        );

        return $rules;
    }

    function rules_produk(){
        $rules = array(
            array(
                'field' => 'kodeproduk',
                'label' => 'Kode Produk',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Kolom %s wajib di isi!',
                ),
            ),
            array(
                'field' => 'namaproduk',
                'label' => 'Nama Produk',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Kolom %s wajib di isi!',
                ),
            ),
            array(
                'field' => 'harga',
                'label' => 'Harga',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Kolom %s wajib di isi!',
                ),
            ),
            array(
                'field' => 'satuan',
                'label' => 'Satuan',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Kolom %s wajib di isi!',
                ),
            ),
        );

        return $rules;
    }

    function rules_buyer(){
        $rules = array(
            array(
                'field' => 'namabuyer',
                'label' => 'Nama Buyer',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Kolom %s wajib di isi!',
                ),
            ),
            array(
                'field' => 'telepon',
                'label' => 'Telepon',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Kolom %s wajib di isi!',
                ),
            ),
            array(
                'field' => 'alamat',
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Kolom %s wajib di isi!',
                ),
            ),
        );

        return $rules;
    }

    function simpanbarang(){
        $post = $this->input->post();
        $post['tanggal']  = indonesia_time(); 
        $this->db->insert($this->tb_databarang, $post);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    function get_all_barang(){
        $query = $this->db->select('*')
                          ->from($this->tb_databarang)
                          ->get()->result_array();
        return $query;
    }

    function get_by_id($id=null){
        $query = $this->db->select('*')
                          ->where('idbarang',$id)
                          ->get($this->tb_databarang)
                          ->row_array();

        return $query;
    }

    function update(){
        $post = $this->input->post();
        $id = $post['idhidden'];
        $kode = $post['kode'];
        $namabarang = $post['namabarang'];

        $data = compact('kode','namabarang');

        $this->db->where('idbarang',$id);
        $this->db->update($this->tb_databarang,$data);

    }

    function delete($id){
        $query = $this->db->delete($this->tb_databarang,['idbarang'=>$id]);
        return $query;
    }

    /**
     * Suplier
     */
    function simpansuplier(){
        $post = $this->input->post();
        $post['datecreated']  = indonesia_time(); 
        $this->db->insert($this->tb_datasuplier, $post);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    function get_all_suplier(){
        $query = $this->db->select('*')
                          ->from($this->tb_datasuplier)
                          ->get()->result_array();
        return $query;
    }

    function get_suplier_by_id($id=null){
        $query = $this->db->select('*')
                          ->where('idsuplier',$id)
                          ->get($this->tb_datasuplier)
                          ->row_array();

        return $query;
    }

    function updatesuplier(){
        $post = $this->input->post();
        $id = $post['idhidden'];
        $namasuplier = $post['namasuplier'];
        $telepon = $post['telepon'];
        $alamat = $post['alamat'];

        $data = compact('namasuplier','telepon','alamat');

        $this->db->where('idsuplier',$id);
        $this->db->update($this->tb_datasuplier,$data);

    }

    function hapussuplier($id){
        $query = $this->db->delete($this->tb_datasuplier,['idsuplier'=>$id]);
        return $query;
    }

    /**
     * Produk
     */
    function simpanproduk(){
        $post = $this->input->post();
        $post['datecreated']  = indonesia_time(); 
        $this->db->insert($this->tb_dataproduk, $post);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    function get_all_produk(){
        $query = $this->db->select('*')
                          ->from($this->tb_dataproduk)
                          ->get()->result_array();
        return $query;
    }

    function get_all_produk_by_buyer($id){
        $query = $this->db->select('*')
                          ->from($this->tb_dataproduk)
                          ->where('idbuyer',$id)
                          ->get()->row_array();
        return $query;
    }

    function get_produk_by_id($id=null){
        $query = $this->db->select('p.*,b.namabuyer')
                          ->join('databuyer b','p.idbuyer=b.idbuyer')
                          ->where('idproduk',$id)   
                          ->get($this->tb_dataproduk.' p')
                          ->row_array();

        return $query;
    }

    function updateproduk(){
        $post           = $this->input->post();
        $id             = $post['idhidden'];
        $kodeproduk     = $post['kodeproduk'];
        $namaproduk     = $post['namaproduk'];
        $idbuyer        = (int)$post['idbuyer'];
        $proses_produksi = (int)$post['proses_produksi'];
        $harga          = (float)$post['harga'];
        $satuan         = (int)$post['satuan'];

        $data = compact('kodeproduk','proses_produksi','idbuyer','namaproduk','harga','satuan');

        $this->db->where('idproduk',$id);
        $this->db->update($this->tb_dataproduk,$data);

    }

    function hapusproduk($id){
        $query = $this->db->delete($this->tb_dataproduk,['idproduk'=>$id]);
        return $query;
    }

    /**
     * buyer
     */
    function simpanbuyer(){
        $post = $this->input->post();
        $post['datecreated']  = indonesia_time(); 
        $this->db->insert($this->tb_databuyer, $post);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    function get_all_buyer(){
        $query = $this->db->select('*')
                          ->from($this->tb_databuyer)
                          ->get()->result_array();
        return $query;
    }

    function get_buyer_by_id($id=null){
        $query = $this->db->select('*')
                          ->where('idbuyer',$id)
                          ->get($this->tb_databuyer)
                          ->row_array();

        return $query;
    }

    function updatebuyer(){
        $post           = $this->input->post();
        $id             = $post['idhidden'];
        $namabuyer       = $post['namabuyer'];
        $telepon        = $post['telepon'];
        $alamat         = $post['alamat'];

        $data = compact('namabuyer','telepon','alamat');

        $this->db->where('idbuyer',$id);
        $this->db->update($this->tb_databuyer,$data);

    }

    function hapusbuyer($id){
        $query = $this->db->delete($this->tb_databuyer,['idbuyer'=>$id]);
        return $query;
    }
}