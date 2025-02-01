<?php
class Mtask extends CI_Model
{
    protected $table = 'datatask';
    protected $table_file = 'lampiran';

    function rules(){
        $rules = array(
            array(
                'field' => 'judul',
                'label' => 'Judul Tugas',
                'rules' => 'required'
            ),
            array(
                'field' => 'status',
                'label' => 'Status Tugas',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide a %s.',
                ),
            ),
            array(
                'field' => 'tanggaltempo',
                'label' => 'Tanggal Jatuh Tempo',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide a %s.',
                ),
            ),
        );

        return $rules;
    }

    function simpan(){
        
        $post = $this->input->post(NUll,TRUE); // enables XSS filtering

        $this->db->insert($this->table, $post);

        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    function simpan_file($data){
        return $this->db->insert(
            $this->table_file, 
            [
                'nama_file'=>$data['nama_file'],
                'url_file'=>$data['url_file'],
                'task_ID'=>$data['task_ID']
            ]
        );
    }


    function get_all(){
        $query = $this->db->select('*')
                          ->from($this->table)
                          ->get()->result_array();
        return $query;
    }

    function get_by_id($id=null){
        $query = $this->db->select('*')
                          ->where('id',$id)
                          ->get($this->table)
                          ->row_array();

        return $query;
    }

    function update(){
        $post = $this->input->post(NULL,TRUE); // enables XSS filtering
        $id = $post['id'];
        $nama = $post['nama'];
        $username = $post['username'];
        $email = $post['email'];
        $password = password_hash($post['password'], PASSWORD_BCRYPT);

        $data = compact('nama','username','email','password');

        $this->db->where('id',$id);
        $this->db->update($this->table,$data);

    }

    function update_idfile_task($file_ID,$task_ID){
        $data = compact('file_ID');
        $this->db->where('ID',$task_ID);
        $this->db->update($this->table,$data);
    }

    function delete($id){
        $query = $this->db->delete($this->table,['id'=>$id]);
        return $query;
    }

}