<!-- Barang Keluar -->
<div class="row">

    <?php if( $mode == 'view' ):  ?>
    <div class="col-md-12">

        <div class="button-action-group">
            <a href="<?= site_url('tambahbarangkeluar'); ?>" class="btn btn-primary"><i class="fa fa-plus-square"></i> Tambah</a>
        </div>
        <!-- end button-action-group -->

        <div class="content-wrapper">
            <table class="table table-striped table-hover dttb">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Supplier</th>
                        <th>Nama Barang</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach($databarangkeluar as $row): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['namasuplier']; ?></td>
                        <td><?= $row['namabarang']; ?></td>
                        <td><?= format_datetime($row['tglkeluar'],'d M Y'); ?></td>
                        <td><?= $row['jumlah']; ?></td>
                        <td><?= $row['satuan']; ?></td>
                        <td>
                            <a href="<?= site_url('editbarangkeluar/'.$row['idbarangkeluar']); ?>" class="btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
                            <a href="javascript:void(0);" data-id="<?= $row['idbarangkeluar'] ?>" class="hapusbarangkeluar btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
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
        
            <form action="<?= site_url('simpanbarangkeluar'); ?>" method="POST">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Suplier <span class="required">*</span></label>
                                    <select name="idsupplier" class="dtselect2 form-control <?= form_error('idsupplier') ? 'invalid' : ''; ?>">
                                        <option value="">Pilih</option>
                                        <?php foreach( $datasupplier as $row ): ?>
                                            <option value="<?= $row['idsuplier'] ?>"><?= $row['namasuplier']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedbacks"><?= form_error('idsupplier'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Nama Barang <span class="required">*</span></label>
                                    <select name="idbarang" class="dtselect2 form-control <?= form_error('idbarang') ? 'invalid' : ''; ?>">
                                        <option value="">Pilih</option>
                                        <?php foreach( $databarang as $row ): ?>
                                            <option value="<?= $row['idbarang'] ?>"><?= $row['namabarang']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedbacks"><?= form_error('idbarang'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Keluar <span class="required">*</span></label>
                                    <input type="date" name="tglkeluar" autocomplete="off" class="form-control <?= form_error('tglkeluar') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('tglkeluar'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah <span class="required">*</span></label>
                                    <input placeholder="Tuliskan Disini ..." step="any" min="0" type="number" name="jumlah" autocomplete="off" class="form-control <?= form_error('jumlah') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('jumlah'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Satuan <span class="required">*</span></label>
                                    <input placeholder="Tuliskan Disini ..." type="text"  name="satuan" autocomplete="off" class="form-control <?= form_error('satuan') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('satuan'); ?></div>
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
        
            <form action="<?= site_url('updatebarangkeluar'); ?>" method="POST">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Suplier <span class="required">*</span></label>
                                    <input type="hidden" name="idhidden" value="<?= $getdatabyid['idbarangkeluar'] ?? ''; ?>">
                                    <select name="idsupplier" class="dtselect2 form-control <?= form_error('idsupplier') ? 'invalid' : ''; ?>">
                                        <option value="">Pilih</option>
                                        <?php foreach( $datasupplier as $row ): 
                                            if( !empty($getdatabyid['idsupplier']) ){
                                                $selected = ( $getdatabyid['idsupplier'] == $row['idsuplier'] ) ? 'selected' : '';
                                            }else{
                                                $selected = '';
                                            }    
                                        ?>
                                            <option <?= $selected; ?> value="<?= $row['idsuplier'] ?>"><?= $row['namasuplier']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedbacks"><?= form_error('idsupplier'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Nama Barang <span class="required">*</span></label>
                                    <select name="idbarang" class="dtselect2 form-control <?= form_error('idbarang') ? 'invalid' : ''; ?>">
                                        <option value="">Pilih</option>
                                        <?php foreach( $databarang as $row ): 
                                            if( !empty($getdatabyid['idbarang']) ){
                                                $selected = ( $getdatabyid['idbarang'] == $row['idbarang'] ) ? 'selected' : '';
                                            }else{
                                                $selected = '';
                                            }    
                                        ?>
                                            <option <?= $selected; ?> value="<?= $row['idbarang'] ?>"><?= $row['namabarang']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedbacks"><?= form_error('idbarang'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Keluar <span class="required">*</span></label>
                                    <input value="<?= $getdatabyid['tglkeluar'] ?>" type="date" name="tglkeluar" autocomplete="off" class="form-control <?= form_error('tglkeluar') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('tglkeluar'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah <span class="required">*</span></label>
                                    <input value="<?= $getdatabyid['jumlah'] ?? ''; ?>" placeholder="Tuliskan Disini ..." step="any" min="0" type="number" name="jumlah" autocomplete="off" class="form-control <?= form_error('jumlah') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('jumlah'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Satuan <span class="required">*</span></label>
                                    <input value="<?= $getdatabyid['satuan'] ?? ''; ?>" placeholder="Tuliskan Disini ..." type="text"  name="satuan" autocomplete="off" class="form-control <?= form_error('satuan') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('satuan'); ?></div>
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