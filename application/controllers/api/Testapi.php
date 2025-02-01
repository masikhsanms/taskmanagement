<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Testapi extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        // $id = $this->get('id');
        // if ($id == '') {
            // $kontak = $this->db->get('users')->result();
            $kontak = $this->db->query("SELECT a.id_user, b.username,c.course,c.mentor,c.title FROM userCourse a JOIN users b ON b.id = a.id_user JOIN courses c ON c.id = a.id_course WHERE c.title LIKE '%S%'")->result();
        // } else {
        //     $this->db->where('id', $id);
        //     $kontak = $this->db->get('users')->result();
        // }
        $this->response($kontak, 200);
    }

    function point5_get() {
       
        $kontak = $this->db->query("SELECT a.id_user, b.username,c.course,c.mentor,c.title FROM userCourse a JOIN users b ON b.id = a.id_user JOIN courses c ON c.id = a.id_course WHERE c.title LIKE '%S%'")->result();
    
        $this->response($kontak, 200);
    }

    function point6_get() {
       
        $kontak = $this->db->query("SELECT a.id_user, b.username,c.course,c.mentor,c.title FROM userCourse a JOIN users b ON b.id = a.id_user JOIN courses c ON c.id = a.id_course WHERE c.title NOT LIKE '%S%'")->result();
    
        $this->response($kontak, 200);
    }

    function point7_get() {
       
        $kontak = $this->db->query("SELECT c.course,c.mentor,c.title, COUNT(c.id) as jumlah_peserta FROM userCourse a JOIN users b ON b.id = a.id_user JOIN courses c ON c.id = a.id_course WHERE 1 GROUP BY c.id")->result();
    
        $this->response($kontak, 200);
    }

    function point8_get() {
       
        $kontak = $this->db->query("SELECT c.mentor,c.title, COUNT(c.id) as jumlah_peserta, COUNT(c.id)*2000000 as total_fee FROM userCourse a JOIN users b ON b.id = a.id_user JOIN courses c ON c.id = a.id_course WHERE 1 GROUP BY c.mentor")->result();
    
        $this->response($kontak, 200);
    }


    //Masukan function selanjutnya disini
}
?>
