<!-- Barang Keluar -->
<div class="row">

    <?php if( $mode == 'view' ):  ?>
    <div class="col-md-12">

        <div class="button-action-group">
            <a href="<?= site_url('tambahpenjualan'); ?>" class="btn btn-primary"><i class="fa fa-plus-square"></i> Tambah</a>
        </div>
        <!-- end button-action-group -->

        <div class="content-wrapper">
            <table class="table table-striped table-hover dttb">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Buyer</th>
                        <th>Produk</th>
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
                    foreach($penjualan as $row): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['namabuyer']; ?></td>
                        <td><?= $row['namaproduk']; ?></td>
                        <td><?= format_datetime($row['tglpenjualan'],'d M Y'); ?></td>
                        <td><?= $row['jumlah']; ?></td>
                        <td><?= $row['satuan']; ?></td>
                        <td><?= format_rupiah($row['hargasatuan']); ?></td>
                        <td><?= format_rupiah($row['total']); ?></td>
                        <td>
                            <a href="<?= site_url('editpenjualan/'.$row['idpenjualan']); ?>" class="btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
                            <a href="javascript:void(0);" data-id="<?= $row['idpenjualan'] ?>" class="hapuspenjualan btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
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
        
            <form action="<?= site_url('simpanpenjualan'); ?>" method="POST">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- <div class="col-md-12"> -->
                                <div class="form-group col-md-4">
                                    <label>Buyer <span class="required">*</span></label>
                                    <select name="idbuyer" class="buyer_penjualan dtselect2 form-control <?= form_error('idbuyer') ? 'invalid' : ''; ?>">
                                        <option value="">Pilih</option>
                                        <?php foreach( $databuyer as $row ): ?>
                                            <option value="<?= $row['idbuyer'] ?>"><?= $row['namabuyer']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedbacks"><?= form_error('idbuyer'); ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Nama Produk <span class="required">*</span></label>
                                    <select name="idproduk" class="produk_penjualan dtselect2 form-control <?= form_error('idproduk') ? 'invalid' : ''; ?>">
                                        <option value="">Pilih</option>
                                        <?php foreach( $dataproduk as $row ): ?>
                                            <option value="<?= $row['idproduk'] ?>"><?= $row['namaproduk'].'['.$row['kodeproduk'].']'; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedbacks"><?= form_error('idproduk'); ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Tanggal Penjualan <span class="required">*</span></label>
                                    <input type="date" name="tglpenjualan" autocomplete="off" class="form-control <?= form_error('tglpenjualan') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('tglpenjualan'); ?></div>
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
        
            <form action="<?= site_url('updatepenjualan'); ?>" method="POST">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- <div class="col-md-12"> -->
                                <div class="form-group col-md-4">
                                    <label>Buyer <span class="required">*</span></label>
                                    <input type="hidden" name="idhidden" value="<?= $getdatabyid['idpenjualan'] ?? ''; ?>">
                                    <select name="idbuyer" class="buyer_penjualan dtselect2 form-control <?= form_error('idbuyer') ? 'invalid' : ''; ?>">
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
                                <div class="form-group col-md-4">
                                    <label>Nama Produk <span class="required">*</span></label>
                                    <select name="idproduk" class="produk_penjualan dtselect2 form-control <?= form_error('idproduk') ? 'invalid' : ''; ?>">
                                        <option value="">Pilih</option>
                                        <?php foreach( $dataproduk as $row ): 
                                            if( !empty($getdatabyid['idproduk']) ){
                                                $selected = ( $getdatabyid['idproduk'] == $row['idproduk'] ) ? 'selected' : '';
                                            }else{
                                                $selected = '';
                                            }    
                                        ?>
                                            <option <?= $selected; ?> value="<?= $row['idproduk'] ?>"><?= $row['namaproduk'].'['.$row['kodeproduk'].']'; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedbacks"><?= form_error('idproduk'); ?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Tanggal Penjualan <span class="required">*</span></label>
                                    <input value="<?= $getdatabyid['tglpenjualan'] ?>" type="date" name="tglpenjualan" autocomplete="off" class="form-control <?= form_error('tglpenjualan') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('tglpenjualan'); ?></div>
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