<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> -->
<script src="<?= base_url(); ?>js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<!-- <script src="<? //base_url(); ?>assets/demo/chart-area-demo.js"></script> -->
<script src="<?= base_url(); ?>js/appci.js"></script>

<?php 

if( isset( $plugins ) ){
    if(!empty($plugins)){
        foreach($plugins as $val){
            $this->load->view('plugins/'.$val.'js');
        }
    }
}

if(isset($script_js)){
  if(empty(!$script_js)){
      foreach ($script_js as $key => $value) : ?>
        <script src="<?= base_url() .'assets/pages/'.$value ?>.js?ver=<?= rand(); ?>"></script>
    <?php endforeach ;
  }
}
?>