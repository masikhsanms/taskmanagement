<div class="row">
    <?php if( $mode == 'view' ):  ?>
    <div class="col-md-12">

        <div class="button-action-group">
            <a href="<?= site_url('tambahproduk'); ?>" class="btn btn-primary"><i class="fa fa-plus-square"></i> Tambah</a>
        </div>
        <!-- end button-action-group -->

        <div class="content-wrapper">
            <table class="table table-striped table-hover dttb">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Satuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach($dataproduk as $row): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['kodeproduk']; ?></td>
                        <td><?= $row['namaproduk']; ?></td>
                        <td><?= $row['harga']; ?></td>
                        <td><?= $row['satuan']; ?></td>
                        <td>
                            <a href="<?= site_url('editproduk/'.$row['idproduk']); ?>" class="btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
                            <a href="javascript:void(0);" data-id="<?= $row['idproduk'] ?>" class="hapusproduk btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
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
        
            <form action="<?= site_url('simpanproduk'); ?>" method="POST">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Kode Produk <span class="required">*</span></label>
                                    <input placeholder="Tuliskan Disini ..." type="text" name="kodeproduk" autocomplete="off" class="form-control <?= form_error('kodeproduk') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('kodeproduk'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Nama Produk <span class="required">*</span></label>
                                    <input placeholder="Tuliskan Disini ..." type="text" name="namaproduk" autocomplete="off" class="form-control <?= form_error('namaproduk') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('namaproduk'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Buyer <span class="required">*</span></label>
                                    <select name="idbuyer" class="dtselect2 form-control <?= form_error('idbuyer') ? 'invalid' : ''; ?>">
                                        <option value="">Pilih</option>
                                        <?php foreach( $databuyer as $row ): ?>
                                            <option value="<?= $row['idbuyer'] ?>"><?= $row['namabuyer']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedbacks"><?= form_error('idbuyer'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Porses Produksi <span class="required">*</span></label>
                                    <select name="proses_produksi" class="dtselect2 form-control <?= form_error('proses_produksi') ? 'invalid' : ''; ?>">
                                        <option value="">Pilih</option>
                                        <?php 
                                        $produksi = array(1=>'Bordir', 2=>'TPR', 3=>'Printing', 4=>'Emboss');
                                        foreach( $produksi as $key=>$row ): ?>
                                            <option value="<?= $key; ?>"><?= $row; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedbacks"><?= form_error('proses_produksi'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Harga <span class="required">*</span></label>
                                    <input placeholder="Tuliskan Disini ..." step="any" min="0" type="number" name="harga" autocomplete="off" class="form-control <?= form_error('harga') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('harga'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Satuan <span class="required">*</span></label>
                                    <input placeholder="Tuliskan Disini ..." type="number" min="1" name="satuan" autocomplete="off" class="form-control <?= form_error('satuan') ? 'invalid' : ''; ?>">
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
        
            <form action="<?= site_url('updateproduk'); ?>" method="POST">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Kode Produk <span class="required">*</span></label>
                                    <input type="hidden" name="idhidden" value="<?= $getdatabyid['idproduk'] ?? ''; ?>">
                                    <input value="<?= $getdatabyid['kodeproduk'] ?? ''; ?>" placeholder="Tuliskan Disini ..." type="text" name="kodeproduk" autocomplete="off" class="form-control <?= form_error('kodeproduk') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('kodeproduk'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Nama Produk <span class="required">*</span></label>
                                    <input value="<?= $getdatabyid['namaproduk'] ?? ''; ?>" placeholder="Tuliskan Disini ..." type="text" name="namaproduk" autocomplete="off" class="form-control <?= form_error('namaproduk') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('namaproduk'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Buyer <span class="required">*</span></label>
                                    <select name="idbuyer" class="dtselect2 form-control <?= form_error('idbuyer') ? 'invalid' : ''; ?>">
                                        <option value="">Pilih</option>
                                        <?php foreach( $databuyer as $row ): 
                                            if( !empty($getdatabyid['idbuyer']) ){
                                                $selected = ( $getdatabyid['idbuyer'] == $row['idbuyer'] ) ? 'selected' : '';
                                            }else{
                                                $selected = '';
                                            }    
                                        ?>
                                        <option <?= $selected; ?> value="<?= $row['idbuyer'] ?>"><?= $row['namabuyer']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedbacks"><?= form_error('idbuyer'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Porses Produksi <span class="required">*</span></label>
                                    <select name="proses_produksi" class="dtselect2 form-control <?= form_error('proses_produksi') ? 'invalid' : ''; ?>">
                                        <option value="">Pilih</option>
                                        <?php 
                                        $produksi = array(1=>'Bordir', 2=>'TPR', 3=>'Printing', 4=>'Emboss');
                                        foreach( $produksi as $key=>$row ): 
                                            if( !empty($getdatabyid['proses_produksi']) ){
                                                $selected = ( $getdatabyid['proses_produksi'] == $key ) ? 'selected' : '';
                                            }else{
                                                $selected = '';
                                            }
                                        ?>
                                            <option <?= $selected; ?> value="<?= $key; ?>"><?= $row; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedbacks"><?= form_error('proses_produksi'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Harga <span class="required">*</span></label>
                                    <input value="<?= $getdatabyid['harga'] ?? ''; ?>" placeholder="Tuliskan Disini ..." step="any" min="0" type="number" name="harga" autocomplete="off" class="form-control <?= form_error('harga') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('harga'); ?></div>
                                </div>
                                <div class="form-group">
                                    <label>Satuan <span class="required">*</span></label>
                                    <input value="<?= $getdatabyid['satuan'] ?? ''; ?>" placeholder="Tuliskan Disini ..." type="number" min="1" name="satuan" autocomplete="off" class="form-control <?= form_error('satuan') ? 'invalid' : ''; ?>">
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