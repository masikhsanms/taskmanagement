 <meta charset="utf-8" />
 <meta http-equiv="X-UA-Compatible" content="IE=edge" />
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
 <meta name="description" content="" />
 <meta name="author" content="" /> 
 <link rel="icon" href="<?php echo base_url(); ?>assets/img/icon.png"> <title> <?= $title; ?> - Task Management </title>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 <link href="<?= base_url(); ?>css/styles.css" rel="stylesheet" />
 <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

 <?php
 if( isset( $plugins ) ){
    if(!empty($plugins)){
        foreach($plugins as $val){
            $this->load->view('plugins/'.$val.'css');
        }
    }
}
 ?>