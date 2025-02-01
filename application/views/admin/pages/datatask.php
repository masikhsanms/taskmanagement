<div class="row">
    
    <?php if( $mode == 'view' ):  ?>
    <div class="col-md-12">

        <div class="button-action-group">
            <a href="<?= site_url('tambahtask'); ?>" class="btn btn-primary"><i class="fa fa-plus-square"></i> Tambah</a>
        </div>
        <!-- end button-action-group -->

        <div class="content-wrapper">
            <table class="table table-striped table-hover dttb">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Judul Tugas</th>
                        <th>Deskripsi</th>
                        <th>Tgl.Tempo</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach($datatask as $row): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= ucfirst( $row['judul'] ); ?></td>
                        <td><?= $row['deskripsi']; ?></td>
                        <td><?= format_datetime($row['tanggaltempo'],'d M Y'); ?></td>
                        <td><?= status_task($row['status']); ?></td>
                        <td>
                            <a href="<?= site_url('edittask/'.$row['ID']); ?>" class="btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
                            <a href="javascript:void(0);" data-id="<?= $row['ID'] ?>" class="hapusbarang btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                            <a href="javascript:void(0);" data-id="<?= $row['ID'] ?>" class="detail btn-sm btn-primary"><i class="fa fa-eye"></i> Detail</a>
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
        
            <form action="<?= site_url('simpandatabarang'); ?>" method="POST">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Kode Barang <span class="required">*</span></label>
                                    <input placeholder="Tuliskan Disini ..." type="text" name="kode" autocomplete="off" class="form-control <?= form_error('kode') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('kode'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Nama Barang <span class="required">*</span></label>
                                    <input placeholder="Tuliskan Disini ..." type="text" name="namabarang" autocomplete="off" class="form-control <?= form_error('namabarang') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('namabarang'); ?></div>
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
        
            <form action="<?= site_url('updatebarang'); ?>" method="POST">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Kode Barang <span class="required">*</span></label>
                                    <input type="hidden" name="idhidden" value="<?= $getdatabyid['idbarang'] ?? ''; ?>">
                                    <input value="<?= $getdatabyid['kode'] ?? ''; ?>" placeholder="Tuliskan Disini ..." type="text" name="kode" autocomplete="off" class="form-control <?= form_error('kode') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('kode'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Nama Barang <span class="required">*</span></label>
                                    <input value="<?= $getdatabyid['namabarang'] ?? ''; ?>" placeholder="Tuliskan Disini ..." type="text" name="namabarang" autocomplete="off" class="form-control <?= form_error('namabarang') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('namabarang'); ?></div>
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