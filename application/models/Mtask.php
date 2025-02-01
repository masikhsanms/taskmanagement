<?php
class Mtask extends CI_Model
{
    protected $table = 'datatask';

    function rules(){
        $rules = array(
            array(
                'field' => 'judul',
                'label' => 'Judul Tugas',
                'rules' => 'required'
            ),
            array(
                'field' => 'deskripsi',
                'label' => 'Deskripsi Tugas',
                'rules' => '',
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
                'field' => 'tanggal',
                'label' => 'Tanggal Jatuh Tempo',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide a %s.',
                ),
            ),
            array(
                'field' => 'attachment',
                'label' => 'Attachment file (PDF)',
                'rules' => 'callback_validate_pdf',
                'errors' => array(
                    'validate_pdf' => 'The %s must be a valid PDF file.',
                ),
            ),
        );

        return $rules;
    }

    function simpan(){
        $post = $this->input->post(NUll,TRUE); // enables XSS filtering

        $post['password'] = password_hash($post['password'], PASSWORD_BCRYPT);

        $this->db->insert($this->table, $post);

        $insert_id = $this->db->insert_id();

        return $insert_id;
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

    function delete($id){
        $query = $this->db->delete($this->table,['id'=>$id]);
        return $query;
    }

}