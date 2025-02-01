<!-- Barang Keluar -->
<div class="row">

    <?php if( $mode == 'view' ):  ?>
    <div class="col-md-12">

        <div class="button-action-group">
            <a href="<?= site_url('tambahpembelian'); ?>" class="btn btn-primary"><i class="fa fa-plus-square"></i> Tambah</a>
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
                        <th>Harga Satuan</th>
                        <th>Total</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach($pembelian as $row): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['namasuplier']; ?></td>
                        <td><?= $row['namabarang']; ?></td>
                        <td><?= format_datetime($row['tglpembelian'],'d M Y'); ?></td>
                        <td><?= $row['jumlah']; ?></td>
                        <td><?= $row['satuan']; ?></td>
                        <td><?= format_rupiah($row['hargasatuan']); ?></td>
                        <td><?= format_rupiah($row['total']); ?></td>
                        <td>
                            <a href="<?= site_url('editpembelian/'.$row['idpembelian']); ?>" class="btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
                            <a href="javascript:void(0);" data-id="<?= $row['idpembelian'] ?>" class="hapuspembelian btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
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
    <div class="col-md-12">
        <div class="content-wrapper">
        
            <form action="<?= site_url('simpanpembelian'); ?>" method="POST">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- <div class="col-md-12"> -->
                                <div class="form-group col-md-4">
                                    <label>Suplier <span class="required">*</span></label>
                                    <select name="idsupplier" class="dtselect2 form-control <?= form_error('idsupplier') ? 'invalid' : ''; ?>">
                                        <option value="">Pilih</option>
                                        <?php foreach( $datasupplier as $row ): ?>
                                            <option value="<?= $row['idsuplier'] ?>"><?= $row['namasuplier']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedbacks"><?= form_error('idsupplier'); ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Nama Barang <span class="required">*</span></label>
                                    <select name="idbarang" class="dtselect2 form-control <?= form_error('idbarang') ? 'invalid' : ''; ?>">
                                        <option value="">Pilih</option>
                                        <?php foreach( $databarang as $row ): ?>
                                            <option value="<?= $row['idbarang'] ?>"><?= $row['namabarang']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedbacks"><?= form_error('idbarang'); ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Tanggal Pembelian <span class="required">*</span></label>
                                    <input type="date" name="tglpembelian" autocomplete="off" class="form-control <?= form_error('tglpembelian') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('tglpembelian'); ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Jumlah <span class="required">*</span></label>
                                    <input placeholder="Tuliskan Disini ..." step="any" min="0" type="number" name="jumlah" autocomplete="off" class="form-control <?= form_error('jumlah') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('jumlah'); ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Satuan <span class="required">*</span></label>
                                    <input placeholder="Tuliskan Disini ..." type="text"  name="satuan" autocomplete="off" class="form-control <?= form_error('satuan') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('satuan'); ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Harga Satuan <span class="required">*</span></label>
                                    <input placeholder="Tuliskan Disini ..." step="any" min="0" type="number" name="hargasatuan" autocomplete="off" class="form-control <?= form_error('hargasatuan') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('hargasatuan'); ?></div>
                                </div>
                                <div class="form-group">
                                    <span class="wraptotal"></span>
                                    <input type="hidden" name="total" autocomplete="off" class="form-control <?= form_error('total') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('total'); ?></div>
                                </div>
                            <!-- </div>  -->
                        </div><!-- end row -->
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
    <div class="col-md-12">
        <div class="content-wrapper">
        
            <form action="<?= site_url('updatepembelian'); ?>" method="POST">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- <div class="col-md-12"> -->
                                <div class="form-group col-md-4">
                                    <label>Suplier <span class="required">*</span></label>
                                    <input type="hidden" name="idhidden" value="<?= $getdatabyid['idpembelian'] ?? ''; ?>">
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
                                <div class="form-group col-md-4">
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
                                <div class="form-group col-md-4">
                                    <label>Tanggal Keluar <span class="required">*</span></label>
                                    <input value="<?= $getdatabyid['tglpembelian'] ?>" type="date" name="tglpembelian" autocomplete="off" class="form-control <?= form_error('tglpembelian') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('tglpembelian'); ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Jumlah <span class="required">*</span></label>
                                    <input value="<?= $getdatabyid['jumlah'] ?? ''; ?>" placeholder="Tuliskan Disini ..." step="any" min="0" type="number" name="jumlah" autocomplete="off" class="form-control <?= form_error('jumlah') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('jumlah'); ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Satuan <span class="required">*</span></label>
                                    <input value="<?= $getdatabyid['satuan'] ?? ''; ?>" placeholder="Tuliskan Disini ..." type="text"  name="satuan" autocomplete="off" class="form-control <?= form_error('satuan') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('satuan'); ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Harga Satuan <span class="required">*</span></label>
                                    <input value="<?= $getdatabyid['hargasatuan'] ?? ''; ?>" placeholder="Tuliskan Disini ..." step="any" min="0" type="number" name="hargasatuan" autocomplete="off" class="form-control <?= form_error('hargasatuan') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('hargasatuan'); ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <span class="wraptotal">
                                        <?php 
                                            $html = "Harga Satuan : ".format_rupiah($getdatabyid['hargasatuan'])."</br>";
                                            $html .= "Jumlah : ".$getdatabyid['jumlah']."</br>";
                                            $html .= "<b>Total : ".format_rupiah($getdatabyid['total'])."</b>";
                                            echo $html;
                                        ?>
                                    </span>
                                    <input value="<?= $getdatabyid['total'] ?? ''; ?>" type="hidden" name="total" autocomplete="off" class="form-control <?= form_error('total') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('total'); ?></div>
                                </div>
                            <!-- </div>   -->
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