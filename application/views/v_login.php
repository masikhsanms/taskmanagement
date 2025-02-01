<?php $this->load->view('admin/_partials/head.php'); ?>

<style>
    .divider:after,
.divider:before {
content: "";
flex: 1;
height: 1px;
background: #eee;
}
.h-custom {
height: calc(100% - 73px);
}
@media (max-width: 450px) {
.h-custom {
height: 100%;
}
}
</style>
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="<?= base_url(); ?>assets/img/login.jpg"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        
        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <p class="lead fw-normal mb-0 me-3"><b>SIE <small>LOGIN</small></b></p>
        </div>

        <?php if($this->session->flashdata('message_login_error')): ?>
			<div class="invalid-feedback">
					<?= $this->session->flashdata('message_login_error') ?>
			</div>
		<?php endif ?>

        <form action="<?= site_url('adminlogin') ?>" method="post">

          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0">Gunakan Akun Anda</p>
          </div>

          <!-- Email input -->
          <div data-mdb-input-init class="form-outline mb-4">
            <input type="text" autocomplete="off" id="form3Example3" class="<?= form_error('username') ? 'invalid' : '' ?> form-control form-control-lg"
              placeholder="Masukan Username" name="username" value="<?= set_value('username') ?>" />
            <label class="form-label" for="form3Example3">Username</label>
            
            <div class="invalid-feedbacks">
				<?= form_error('username'); ?>
			</div>  

          </div>

          <!-- Password input -->
          <div data-mdb-input-init class="form-outline mb-3">
            <input type="password" id="form3Example4" class="<?= form_error('password') ? 'invalid' : '' ?> form-control form-control-lg"
              placeholder="Masukan Password" name="password" value="<?= set_value('password') ?>" />
            <label class="form-label" for="form3Example4">Password</label>

            <div class="invalid-feedbacks">
				<?= form_error('password'); ?>
			</div>

          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>

<?php $this->load->view('admin/_partials/footer.php'); ?>
