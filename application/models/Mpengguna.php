<?php
class Mpengguna extends CI_Model
{
    protected $tb_pengguna = 'users';

    function rules(){
        $rules = array(
            array(
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required'
            ),
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide a %s.',
                ),
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide a %s.',
                ),
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required'
            ),
        );

        return $rules;
    }

    function simpan(){
        $post = $this->input->post(NUll,TRUE); // enables XSS filtering

        $post['password'] = password_hash($post['password'], PASSWORD_BCRYPT);

        $this->db->insert($this->tb_pengguna, $post);

        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    function get_all(){
        $query = $this->db->select('*')
                          ->from($this->tb_pengguna)
                          ->get()->result_array();
        return $query;
    }

    function get_by_id($id=null){
        $query = $this->db->select('*')
                          ->where('id',$id)
                          ->get($this->tb_pengguna)
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
        $this->db->update($this->tb_pengguna,$data);

    }

    function delete($id){
        $query = $this->db->delete($this->tb_pengguna,['id'=>$id]);
        return $query;
    }


    function api_simpan_pengguna($datas){

        $this->db->insert($this->tb_pengguna, $datas);

        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    function is_username_exist($username){
        $query = $this->db->select('username')
        ->where('username',$username)
        ->get($this->tb_pengguna)
        ->row_array();

        if( !empty($query) && isset($query['username']) && $query['username'] === $username ){
            return true;
        }else{
            return false;
        }
    }

    function is_email_exist($email){
        $query = $this->db->select('email')
        ->where('email',$email)
        ->get($this->tb_pengguna)
        ->row_array();

        if( !empty($query) && isset($query['email']) && $query['email'] === $email ){
            return true;
        }else{
            return false;
        }
    }

    function get_user_by_email($email){
        $query = $this->db->select('*')
        ->where('email',$email)
        ->get($this->tb_pengguna)
        ->row_array();
        
        return $query;
    }
}