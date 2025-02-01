<?php
class Mtransaksi extends CI_Model
{
    protected $tb_dataproduk    = 'dataproduk';
    protected $tb_databuyer     = 'databuyer';
    protected $tb_penjualan     = 'penjualan';
    protected $tb_datasuplier     = 'datasuplier';
    protected $tb_databarang     = 'databarang';
    protected $tb_pembelian     = 'pembelian';

    function rules_pembelian(){
        $rules = array(
            array(
                'field' => 'idsupplier',
                'label' => 'Supplier',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Kolom %s wajib di isi!',
                ),
            ),
            array(
                'field' => 'idbarang',
                'label' => 'Nama Barang',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Kolom %s wajib di isi!',
                ),
            ),
            array(
                'field' => 'tglpembelian',
                'label' => 'Tanggal Pembelian',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Kolom %s wajib di isi!',
                ),
            ),
            array(
                'field' => 'jumlah',
                'label' => 'Jumlah',
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
            array(
                'field' => 'hargasatuan',
                'label' => 'Harga Satuan',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Kolom %s wajib di isi!',
                ),
            ),
            array(
                'field' => 'total',
                'label' => 'Total',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Kolom %s wajib di isi!',
                ),
            ),
        );

        return $rules;
    }

    function rules_penjualan(){
        $rules = array(
            array(
                'field' => 'idbuyer',
                'label' => 'Buyer',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Kolom %s wajib di isi!',
                ),
            ),
            array(
                'field' => 'idproduk',
                'label' => 'Nama Produk',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Kolom %s wajib di isi!',
                ),
            ),
            array(
                'field' => 'tglpenjualan',
                'label' => 'Tanggal Penjualan',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Kolom %s wajib di isi!',
                ),
            ),
            array(
                'field' => 'jumlah',
                'label' => 'Jumlah',
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
            array(
                'field' => 'hargasatuan',
                'label' => 'Harga Satuan',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Kolom %s wajib di isi!',
                ),
            ),
            array(
                'field' => 'total',
                'label' => 'Total',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Kolom %s wajib di isi!',
                ),
            ),
        );

        return $rules;
    }

    function simpanpembelian(){
        $post = $this->input->post();
        $post['datecreated']  = indonesia_time(); 
        $this->db->insert($this->tb_pembelian, $post);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    function get_all_pembelian(){
        $query = $this->db->select("p.idpembelian,ds.namasuplier,CONCAT(db.namabarang,' [',db.kode,']') as namabarang,p.tglpembelian,p.jumlah,p.satuan,p.hargasatuan,p.total")
                          ->from($this->tb_pembelian.' p')
                          ->join($this->tb_datasuplier.' ds','ds.idsuplier = p.idsupplier')
                          ->join($this->tb_databarang.' db','db.idbarang = p.idbarang')
                          ->get()->result_array();
        return $query;
    }

    function get_pembelian_by_id($id=null){
        $query = $this->db->select('*')
                          ->where('idpembelian',$id)
                          ->get($this->tb_pembelian)
                          ->row_array();

        return $query;
    }

    function updatepembelian(){
        $post       = $this->input->post();
        $id         = $post['idhidden'];
        $idsupplier = $post['idsupplier'];
        $idbarang   = $post['idbarang'];
        $tglpembelian   = $post['tglpembelian'];
        $jumlah     = $post['jumlah'];
        $satuan     = $post['satuan'];
        $hargasatuan= $post['hargasatuan'];
        $total      = $post['total'];


        $data = compact('idsupplier','idbarang','tglpembelian','jumlah','satuan','hargasatuan','total');

        $this->db->where('idpembelian',$id);
        $this->db->update($this->tb_pembelian,$data);

    }

    function deletepembelian($id){
        $query = $this->db->delete($this->tb_pembelian,['idpembelian'=>$id]);
        return $query;
    }

    /**
     * Penjualan
     */

     function simpanpenjualan(){
        $post = $this->input->post();
        $post['datecreated']  = indonesia_time(); 
        $this->db->insert($this->tb_penjualan, $post);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    function get_all_penjualan(){
        $query = $this->db->select("p.idpenjualan,db.namabuyer,CONCAT(dp.namaproduk,' [',dp.kodeproduk,']') as namaproduk,p.tglpenjualan,p.jumlah,p.satuan,p.hargasatuan,p.total")
                          ->from($this->tb_penjualan.' p')
                          ->join($this->tb_dataproduk.' dp','dp.idproduk = p.idproduk')
                          ->join($this->tb_databuyer.' db','db.idbuyer = p.idbuyer')
                          ->get()->result_array();
        return $query;
    }

    function get_penjualan_by_id($id=null){
        $query = $this->db->select('*')
                ->where('idpenjualan',$id)
                ->get($this->tb_penjualan)
                ->row_array();

        return $query;
    }

    function updatepenjualan(){
        $post       = $this->input->post();
        $id         = $post['idhidden'];
        $idbuyer    = $post['idbuyer'];
        $idproduk   = $post['idproduk'];
        $tglpenjualan   = $post['tglpenjualan'];
        $jumlah     = $post['jumlah'];
        $satuan     = $post['satuan'];
        $hargasatuan= $post['hargasatuan'];
        $total      = $post['total'];


        $data = compact('idbuyer','idproduk','tglpenjualan','jumlah','satuan','hargasatuan','total');

        $this->db->where('idpenjualan',$id);
        $this->db->update($this->tb_penjualan,$data);
    }

    function deletepenjualan($id){
        $query = $this->db->delete($this->tb_penjualan,['idpenjualan'=>$id]);
        return $query;
    }
}