<div class="row">

    <?php if( $mode == 'view' ):  ?>
    <div class="col-md-12">

        <div class="button-action-group">
            <a href="<?= site_url('tambahbuyer'); ?>" class="btn btn-primary"><i class="fa fa-plus-square"></i> Tambah</a>
        </div>
        <!-- end button-action-group -->

        <div class="content-wrapper">
            <table class="table table-striped table-hover dttb">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Buyer</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach($databuyer as $row): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['namabuyer']; ?></td>
                        <td><?= $row['telepon']; ?></td>
                        <td><?= $row['alamat']; ?></td>
                        <td>
                            <a href="<?= site_url('editbuyer/'.$row['idbuyer']); ?>" class="btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
                            <a href="javascript:void(0);" data-id="<?= $row['idbuyer'] ?>" class="hapusbuyer btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- end content-wrapper -->
    </div>
    <?php endif; ?>

    <?php if( $mode == 'add' ): ?>
    <div class="col-md-6">
        <div class="content-wrapper">
        
            <form action="<?= site_url('simpanbuyer'); ?>" method="POST">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama Buyer <span class="required">*</span></label>
                                    <input placeholder="Tuliskan Disini ..." type="text" name="namabuyer" autocomplete="off" class="form-control <?= form_error('namabuyer') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('namabuyer'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Telepon <span class="required">*</span></label>
                                    <input placeholder="Tuliskan Disini ..." type="text" name="telepon" autocomplete="off" class="form-control <?= form_error('telepon') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('telepon'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Alamat <span class="required">*</span></label>
                                    <textarea name="alamat" class="form-control <?= form_error('alamat') ? 'invalid' : ''; ?>" placeholder="Tuliskan Disini ..."></textarea>
                                    <div class="invalid-feedbacks"><?= form_error('alamat'); ?></div>
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
    </div>
    <?php endif; ?>

    <?php if( $mode == 'edit' ): ?>
    <div class="col-md-6">
        <div class="content-wrapper">
        
            <form action="<?= site_url('updatebuyer'); ?>" method="POST">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama Buyer <span class="required">*</span></label>
                                    <input type="hidden" name="idhidden" value="<?= $getdatabyid['idbuyer'] ?? ''; ?>">
                                    <input value="<?= $getdatabyid['namabuyer'] ?? ''; ?>" placeholder="Tuliskan Disini ..." type="text" name="namabuyer" autocomplete="off" class="form-control <?= form_error('namabuyer') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('namabuyer'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Telepon <span class="required">*</span></label>
                                    <input value="<?= $getdatabyid['telepon'] ?? ''; ?>" placeholder="Tuliskan Disini ..." type="text" name="telepon" autocomplete="off" class="form-control <?= form_error('telepon') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('telepon'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Alamat <span class="required">*</span></label>
                                    <textarea value="<?= $getdatabyid['alamat'] ?? ''; ?>" name="alamat" class="form-control <?= form_error('alamat') ? 'invalid' : ''; ?>" placeholder="Tuliskan Disini ..."><?= $getdatabyid['alamat'] ?? ''; ?></textarea>
                                    <div class="invalid-feedbacks"><?= form_error('alamat'); ?></div>
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
    </div>
    <?php endif; ?>

</div>