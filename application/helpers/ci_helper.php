<?php
function level_users(int $idlevel){
    $users = get_level_users();

    $level = '';
    foreach( $users as $key => $row ){
        if( $key == $idlevel ){
            $level .= $row;
        }
    }

    return $level;
}

function get_level_users(){
    $users = [
        '1'=>'Admin',
        '2'=>'Gudang',
        '3'=>'Akuntan',
        '4'=>'Eksekutif',
    ];
    return $users;
}

function indonesia_time(){
    date_default_timezone_set("Asia/Bangkok");
    return date('Y-m-d H:i:s');
}

function format_datetime($tgl,$format="Y-m-d H:i:s"){
    $date = date_create($tgl);
    return date_format($date,$format);
}

function format_number($nilai){
    return number_format($nilai,0,",",".");
}

function format_rupiah($nilai){
    return 'Rp. '.format_number($nilai);
}

function check_userakses($level){
    $levels = [
        '1'=> 'Admin',
        '2'=> 'Gudang',
        '3'=> 'Akuntan',
        '4'=> 'Eksekutif',
    ];
    
    switch ($level) {
        case '1':
            $akses = 'admin';
            break;
        case '2':
            $akses = 'gudang';
            break;
        case '3':
            $akses = 'akuntan';
            break;
        case '4':
            $akses = 'eksekutif';
            break;
    }

    return $akses;
}

function status_task($status){
    
    switch ($status) {
        case 'Pending':
            $badge = '<span class="badge badge-danger">'.$status.'</span>';
            break;
        case 'In Progress':
            $badge = '<span class="badge badge-warning">'.$status.'</span>';
            break;
        case 'Completed':
            $badge = '<span class="badge badge-success">'.$status.'</span>';
            break;
        default:
            $badge = '<span class="badge badge-secondary">Not Valid</span>';
            break;
    }

    return $badge;
}

/**
 * file_name_extension : test.pdf
 */
function remove_file($file_name_extension){
    $file_path = IMAGE_PATH . $file_name_extension;
    
    // Memastikan file ada sebelum menghapus
    if (file_exists($file_path)) {
        if (unlink($file_path)) {
            return true; // File berhasil dihapus
        } else {
            return false; // Gagal menghapus file
        }
    } else {
        return false; // File tidak ditemukan
    }
}