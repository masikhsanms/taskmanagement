<?php
class Minventory extends CI_Model
{
    protected $tb_stokbarang    = 'stokbarang';
    protected $tb_databarang    = 'databarang';
    protected $tb_datasuplier   = 'datasuplier';
    protected $tb_barangmasuk   = 'barangmasuk';
    protected $tb_barangkeluar  = 'barangkeluar';

    function rules_stokbarang(){
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
        );

        return $rules;
    }

    function rules_barangmasuk(){
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
                'field' => 'tglmasuk',
                'label' => 'Tanggal Masuk',
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
        );

        return $rules;
    }

    function rules_barangkeluar(){
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
                'field' => 'tglkeluar',
                'label' => 'Tanggal Keluar',
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
        );

        return $rules;
    }

    function simpanstokbarang(){
        $post = $this->input->post();
        $post['datecreated']  = indonesia_time(); 
        $this->db->insert($this->tb_stokbarang, $post);
        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    function get_all_inventory(){
        $query = $this->db->select("sb.idstokbarang,ds.namasuplier,CONCAT(db.namabarang,' [',db.kode,']') as namabarang,sb.jumlah,sb.satuan")
                          ->from($this->tb_stokbarang.' sb')
                          ->join($this->tb_datasuplier.' ds','ds.idsuplier = sb.idsupplier')
                          ->join($this->tb_databarang.' db','db.idbarang = sb.idbarang')
                          ->get()->result_array();
        return $query;
    }

    function get_stokbarang_by_id($id=null){
        $query = $this->db->select('*')
                          ->where('idstokbarang',$id)
                          ->get($this->tb_stokbarang)
                          ->row_array();

        return $query;
    }

    function updatestokbarang(){
        $post       = $this->input->post();
        $id         = $post['idhidden'];
        $idsupplier = $post['idsupplier'];
        $idbarang   = $post['idbarang'];
        $jumlah     = $post['jumlah'];
        $satuan     = $post['satuan'];

        $data = compact('idsupplier','idbarang','jumlah','satuan');

        $this->db->where('idstokbarang',$id);
        $this->db->update($this->tb_stokbarang,$data);

    }

    function deletestokbarang($id){
        $query = $this->db->delete($this->tb_stokbarang,['idstokbarang'=>$id]);
        return $query;
    }

    /**
     * BARANG MASUK
     */
    function simpanbarangmasuk(){
        $post = $this->input->post();
        $post['datecreated']  = indonesia_time(); 
        $this->db->insert($this->tb_barangmasuk, $post);
        $insert_id = $this->db->insert_id();

        $get_stok = $this->db->select('jumlah')
                    ->where('idbarang', $post['idbarang'])
                    ->where('idsupplier', $post['idsupplier'])
                    ->get('stokbarang')->row();

        $data_stok = array(
            'jumlah' => (int)$get_stok->jumlah + (int)$post['jumlah'],
        );
        
        $this->db->where('idbarang', $post['idbarang']);
        $this->db->where('idsupplier', $post['idsupplier']);
        $this->db->update('stokbarang', $data_stok);
        

        return $insert_id;
    }

    function get_all_barangmasuk(){
        $query = $this->db->select("bm.idbarangmasuk,bm.tglmasuk,ds.namasuplier,CONCAT(db.namabarang,' [',db.kode,']') as namabarang,bm.jumlah,bm.satuan")
                          ->from($this->tb_barangmasuk.' bm')
                          ->join($this->tb_datasuplier.' ds','ds.idsuplier = bm.idsupplier')
                          ->join($this->tb_databarang.' db','db.idbarang = bm.idbarang')
                          ->get()->result_array();
        return $query;
    }

    function get_barangmasuk_by_id($id=null){
        $query = $this->db->select('*')
                        ->where('idbarangmasuk',$id)
                        ->get($this->tb_barangmasuk)
                        ->row_array();

        return $query;
    }

    function updatebarangmasuk(){
        $post       = $this->input->post();
        $id         = $post['idhidden'];
        $idsupplier = $post['idsupplier'];
        $idbarang   = $post['idbarang'];
        $tglmasuk   = $post['tglmasuk'];
        $jumlah     = $post['jumlah'];
        $satuan     = $post['satuan'];

        $data = compact('idsupplier','idbarang','tglmasuk','jumlah','satuan');

        $this->db->where('idbarangmasuk',$id);
        $this->db->update($this->tb_barangmasuk,$data);

        $get_stok = $this->db->select('jumlah')
        ->where('idbarang', $post['idbarang'])
        ->where('idsupplier', $post['idsupplier'])
        ->get('stokbarang')->row();

        $data_stok = array(
        'jumlah' => (int)$get_stok->jumlah + (int)$post['jumlah'],
        );

        $this->db->where('idbarang', $post['idbarang']);
        $this->db->where('idsupplier', $post['idsupplier']);
        $this->db->update('stokbarang', $data_stok);
    }

    public function deletebarangmasuk($id){
        $query = $this->db->delete($this->tb_barangmasuk,['idbarangmasuk'=>$id]);
        return $query;
    }

    /**
     * BARANG KELUAR
     */
    function simpanbarangkeluar(){
        $post = $this->input->post();
        $post['datecreated']  = indonesia_time(); 
        $this->db->insert($this->tb_barangkeluar, $post);
        $insert_id = $this->db->insert_id();

        $get_stok = $this->db->select('jumlah')
        ->where('idbarang', $post['idbarang'])
        ->where('idsupplier', $post['idsupplier'])
        ->get('stokbarang')->row();

        $data_stok = array(
        'jumlah' => (int)$get_stok->jumlah - (int)$post['jumlah'],
        );

        $this->db->where('idbarang', $post['idbarang']);
        $this->db->where('idsupplier', $post['idsupplier']);
        $this->db->update('stokbarang', $data_stok);

        return $insert_id;
    }

    function get_all_barangkeluar(){
        $query = $this->db->select("bk.idbarangkeluar,bk.tglkeluar,ds.namasuplier,CONCAT(db.namabarang,' [',db.kode,']') as namabarang,bk.jumlah,bk.satuan")
                          ->from($this->tb_barangkeluar.' bk')
                          ->join($this->tb_datasuplier.' ds','ds.idsuplier = bk.idsupplier')
                          ->join($this->tb_databarang.' db','db.idbarang = bk.idbarang')
                          ->get()->result_array();
        return $query;
    }

    function get_barangkeluar_by_id($id=null){
        $query = $this->db->select('*')
            ->where('idbarangkeluar',$id)
            ->get($this->tb_barangkeluar)
            ->row_array();

        return $query;
    }

    function updatebarangkeluar(){
        $post       = $this->input->post();
        $id         = $post['idhidden'];
        $idsupplier = $post['idsupplier'];
        $idbarang   = $post['idbarang'];
        $tglkeluar  = $post['tglkeluar'];
        $jumlah     = $post['jumlah'];
        $satuan     = $post['satuan'];

        $data = compact('idsupplier','idbarang','tglkeluar','jumlah','satuan');

        $this->db->where('idbarangkeluar',$id);
        $this->db->update($this->tb_barangkeluar,$data);

        $get_stok = $this->db->select('jumlah')
        ->where('idbarang', $post['idbarang'])
        ->where('idsupplier', $post['idsupplier'])
        ->get('stokbarang')->row();

        $data_stok = array(
        'jumlah' => (int)$get_stok->jumlah - (int)$post['jumlah'],
        );

        $this->db->where('idbarang', $post['idbarang']);
        $this->db->where('idsupplier', $post['idsupplier']);
        $this->db->update('stokbarang', $data_stok);
    }

    function deletebarangkeluar($id){
        $query = $this->db->delete($this->tb_barangkeluar,['idbarangkeluar'=>$id]);
        return $query;
    }
}