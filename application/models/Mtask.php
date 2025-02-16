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
        $row_lampiran = $this->db->select('ID')
                                ->where('task_ID',$id)
                                ->get($this->table_file)
                                ->row_array();
        if( !empty($row_lampiran) ){
            $row = $this->db->select('t.*,l.nama_file,l.url_file')
                ->join($this->table_file.' l','t.ID = l.task_ID')
                ->where('t.ID',$id)
                ->get($this->table.' t')
                ->row_array();
        }else{
            $row = $this->db->select('*')
                ->where('ID',$id)
                ->get($this->table)
                ->row_array();
        }

        return $row;
    }

    function update(){
        $post = $this->input->post(NULL,TRUE); // enables XSS filtering
        
        $ID = $post['idhidden'];
        $judul = $post['judul'];
        $status = $post['status'];
        $tanggaltempo = $post['tanggaltempo'];
        $deskripsi = $post['deskripsi'];

        $data = compact('judul','status','tanggaltempo','deskripsi');
        
        $this->db->where('ID',$ID);
        $this->db->update($this->table,$data);

    }

    function update_file($data,$where){
        $row_lampiran = $this->db->select('nama_file')
                                ->where($where)
                                ->get($this->table_file)
                                ->row_array();
        
        if( !empty($row_lampiran) && isset($row_lampiran['nama_file']) ){
            if( $data['is_header_api'] == TRUE ){
                $this->db->update(
                    $this->table_file,
                    ['nama_file'=>$data['nama_file'],'url_file'=>$data['url_file']],
                    $where
                );
            }else{
                $is_removefile = remove_file($row_lampiran['nama_file']);
                if( $is_removefile ){
                    $this->db->update(
                        $this->table_file,$data,$where
                    );
                }
            }
        }


    }

    function update_idfile_task($file_ID,$task_ID){
        $data = compact('file_ID');
        $this->db->where('ID',$task_ID);
        $this->db->update($this->table,$data);
    }

    function delete($id){
        $row_lampiran = $this->db->select('*')
            ->where(['task_ID'=>$id])
            ->get($this->table_file)
            ->row_array();

            
        if( !empty($row_lampiran) ){
            
            $is_remove = remove_file($row_lampiran['nama_file']);

            if( $is_remove ){
                $this->db->delete($this->table_file,['ID'=>$row_lampiran['ID']]);
            }

        }
        
        $query = $this->db->delete($this->table,['id'=>$id]);
        
        return $query;
    }

    function api_simpan_task($datas){

        $data = [
            'judul' => $datas['title'],
            'deskripsi' => $datas['description'],
            'status' => $datas['status'],
            'tanggaltempo' => $datas['due_date'],
            'user_ID' => $datas['user_id'],
        ];

        $this->db->insert($this->table, $data);

        $insert_id = $this->db->insert_id();

        return $insert_id;
    }

    function api_simpan_file($data){
        $this->db->insert(
            $this->table_file, 
            [
                'nama_file'=>$data['nama_file'],
                'url_file'=>$data['url_file'],
                'task_ID'=>$data['task_ID']
            ]
        );

        $file_id = $this->db->insert_id();

        if( $file_id > 0 ){
            $this->update_idfile_task($file_id,$data['task_ID']);
        }

    }

    function api_get_by_userid($userid){

        $row_mtask = $this->db->select('ID')->get_where($this->table,['user_ID'=>$userid])->row_array();
        
        if(!empty( $row_mtask )){
            $id = $row_mtask['ID'];
            $row_lampiran = $this->db->select('ID')
                                    ->where('task_ID',$id)
                                    ->get($this->table_file)
                                    ->row_array();
    
            if( !empty($row_lampiran) ){
                $row = $this->db->select('t.*,l.nama_file,l.url_file')
                    ->join($this->table_file.' l','t.ID = l.task_ID')
                    ->where('t.user_ID',$userid)
                    ->get($this->table.' t')
                    ->result_array();
            }else{
                $row = $this->db->select('*')
                    ->where('user_ID',$userid)
                    ->get($this->table)
                    ->result_array();
            }
    
            return $row;
        }
    }

    function get_by_taskid_userid($taskid,$userid){
        $row_lampiran = $this->db->select('ID')
                                ->where('task_ID',$taskid)
                                ->get($this->table_file)
                                ->row_array();
        if( !empty($row_lampiran) ){
            $row = $this->db->select('t.*,l.nama_file,l.url_file')
                ->join($this->table_file.' l','t.ID = l.task_ID')
                ->where('t.ID',$taskid)
                ->where('t.user_ID',$userid)
                ->get($this->table.' t')
                ->row_array();
        }else{
            $row = $this->db->select('*')
                ->where('ID',$taskid)
                ->where('user_ID',$userid)
                ->get($this->table)
                ->row_array();
        }

        return $row;
    }

    function api_update_task($datas){
        
        $data = [
            'judul' => $datas['title'],
            'deskripsi' => $datas['description'],
            'status' => $datas['status'],
            'tanggaltempo' => $datas['due_date'],
        ];

        $this->db->where(['ID'=>$datas['task_id'],'user_ID'=>$datas['user_id']]);
        $this->db->update($this->table,$data);

        $this->update_file(
            array(
                'nama_file' => $datas['file_name'],
                'url_file' => $datas['attachment_url'],
                'is_header_api' => $datas['is_header_api'],
            ),
            array('task_ID' => $datas['task_id'])
        );
        
    }

    public function api_delete_task($data){
        $id = $data['task_id'];
        $user_id = $data['user_id'];
        
        $row_lampiran = $this->db->select('*')
        ->where(['task_ID'=>$id])
        ->get($this->table_file)
        ->row_array();

        
        if( !empty($row_lampiran) ){
            
            $is_remove = remove_file($row_lampiran['nama_file']);

            if( $is_remove ){
                $this->db->delete($this->table_file,['ID'=>$row_lampiran['ID']]);
            }

        }
        
        $query = $this->db->delete($this->table,['id'=>$id,'user_ID'=>$user_id]);
        
        return $query;
    }

    public function api_upload_file_task($datas){
        $row_lampiran = $this->db->select('ID')
        ->where('task_ID',$datas['task_id'])
        ->get($this->table_file)
        ->row_array();

        if( empty($row_lampiran) ){
            $this->api_simpan_file(
                array(
                    'nama_file'=>$datas['file_name'],
                    'url_file'=>$datas['attachment_url'],
                    'task_ID'=>$datas['task_id'] 
                )
            );
        }else{
            $this->update_file(
                array(
                    'nama_file' => $datas['file_name'],
                    'url_file' => $datas['attachment_url'],
                    'is_header_api' => $datas['is_header_api']
                ),
                array('task_ID' => $datas['task_id'])
            );
        }
    }

    function getfileurl_by_taskid_userid($taskid,$userid){
        $row_lampiran = $this->db->select('ID')
                                ->where('task_ID',$taskid)
                                ->get($this->table_file)
                                ->row_array();
        if( !empty($row_lampiran) ){
            $row = $this->db->select('l.nama_file,l.url_file')
                ->join($this->table_file.' l','t.ID = l.task_ID')
                ->where('t.ID',$taskid)
                ->where('t.user_ID',$userid)
                ->get($this->table.' t')
                ->row_array();

            return $row;
        }

    }

}