<div class="row">
    <div class="col-md-12">
        
    <?php if( $mode == 'view' ):  ?>

        <div class="button-action-group">
            <a href="<?= site_url('tambahpengguna'); ?>" class="btn btn-primary"><i class="fa fa-plus-square"></i> Tambah</a>
        </div>
        <!-- end button-action-group -->

        <div class="content-wrapper">
            <table class="table table-striped table-hover dttb">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach( $allpengguna as $row ): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['username']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td>
                            <a href="<?= site_url('editpengguna/'.$row['ID']); ?>" class="btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
                            <a href="javascript:void(0);" data-id="<?= $row['ID']; ?>" class="hapuspengguna btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- end content-wrapper -->
    <?php endif; ?>

    <?php if( $mode == 'add' ): ?>
        <div class="content-wrapper">
            
            <form action="<?= site_url('simpanpengguna'); ?>" method="POST">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama <span class="required">*</span></label>
                                    <input placeholder="Tuliskan Disini ..." type="text" name="nama" autocomplete="off" class="form-control <?= form_error('nama') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('nama'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Username <span class="required">*</span> </label>
                                    <input placeholder="Tuliskan Disini ..." type="text" name="username" autocomplete="off" class="form-control <?= form_error('username') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('username'); ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label>Email <span class="required">*</span> </label>
                                    <input placeholder="Tuliskan Disini ..." type="text" name="email" autocomplete="off" class="form-control <?= form_error('email') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('email'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Password <span class="required">*</span></label>
                                    <input placeholder="Tuliskan Disini ..." type="password" name="password" autocomplete="off" class="form-control <?= form_error('password') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('password'); ?></div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- end card-body -->
                    <div class="card-footer">
                        <button type="button" onclick="window.history.back();" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</button>
                        <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </div>
                <!-- end card -->
            </form>
        </div>
    <?php endif; ?>

    <?php if( $mode == 'edit' ): ?>
        <div class="content-wrapper">
            <form action="<?= site_url('updatepengguna'); ?>" method="POST">
                
                <input type="hidden" name="id" value="<?= $getdatabyid['ID'] ?? ''; ?>">

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama <span class="required">*</span></label>
                                    <input value="<?= $getdatabyid['nama'] ?? ''; ?>" placeholder="Tuliskan Disini ..." type="text" name="nama" autocomplete="off" class="form-control <?= form_error('nama') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('nama'); ?></div>
                                </div>

                                <div class="form-group">
                                    <label>Username <span class="required">*</span> </label>
                                    <input value="<?= $getdatabyid['username'] ?? ''; ?>" placeholder="Tuliskan Disini ..." type="text" name="username" autocomplete="off" class="form-control <?= form_error('username') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('username'); ?></div>
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                

                                <div class="form-group">
                                    <label>Email <span class="required">*</span> </label>
                                    <input value="<?= $getdatabyid['email'] ?? ''; ?>" placeholder="Tuliskan Disini ..." type="text" name="email" autocomplete="off" class="form-control <?= form_error('email') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('email'); ?></div>
                                </div>

                                <div class="form-group">
                                    <label>Password <span class="required">*</span></label>
                                    <input value="" placeholder="Tuliskan Disini ..." type="password" name="password" autocomplete="off" class="form-control <?= form_error('password') ? 'invalid' : ''; ?>">
    
                                    <div class="checkbox">
                                      <label><input type="checkbox" class="showpassword"> Lihat Password</label>
                                    </div>
    
                                    <div class="invalid-feedbacks"><?= form_error('password'); ?></div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <!-- end card-body -->
                    <div class="card-footer">
                        <button type="button" onclick="window.history.back();" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</button>
                        <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </div>
                <!-- end card -->
            </form>      
        </div>
    <?php endif; ?>

    </div>
</div>