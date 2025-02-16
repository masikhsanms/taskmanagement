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
                            <a href="javascript:void(0);" data-id="<?= $row['ID'] ?>" class="hapustask btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
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
        
            <form action="<?= site_url('simpantask'); ?>" method="POST" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                
                                <?php if ($this->session->flashdata('error')): ?>
                                    <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
                                <?php elseif ($this->session->flashdata('success')) : ?>
                                    <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
                                <?php endif; ?>

                                <div class="form-group">
                                    <label>Judul Tugas <span class="required">*</span></label>
                                    <input placeholder="Tuliskan Disini ..." type="text" name="judul" autocomplete="off" class="form-control <?= form_error('judul') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('judul'); ?></div>
                                </div>

                                <div class="form-group">
                                    <label>Deskripsi Tugas <em>(opsional)</em></label>
                                    <textarea name="deskripsi" class="form-control" placeholder="Tuliskan Disini ..."></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Jatuh Tempo <span class="required">*</span></label>
                                    <input type="date" name="tanggaltempo"  class="form-control <?= form_error('tanggaltempo') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('tanggaltempo'); ?></div>
                                </div>

                                <div class="form-group">
                                    <label>Status Tugas <span class="required">*</span></label>
                                    <select name="status" class="form-control <?= form_error('status') ? 'invalid' : ''; ?>">
                                        <option value="">Pilih Status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Completed">Completed</option>
                                    </select>
                                    <div class="invalid-feedbacks"><?= form_error('status'); ?></div>
                                </div>

                                <div class="form-group">
                                    <label>File Pendukung <em>(opsional)</em></label>
                                    <input type="file" name="lampiran" class="form-control">
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
        
            <form action="<?= site_url('updatetask'); ?>" method="POST" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                        
                                <?php if ($this->session->flashdata('error')): ?>
                                    <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
                                <?php elseif ($this->session->flashdata('success')) : ?>
                                    <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
                                <?php endif; ?>

                                <div class="form-group">
                                    <input type="hidden" name="idhidden" value="<?= $getdatabyid['ID'] ?? ''; ?>">
                                    <label>Judul Tugas <span class="required">*</span></label>
                                    <input value="<?= $getdatabyid['judul'] ?? ''; ?>" placeholder="Tuliskan Disini ..." type="text" name="judul" autocomplete="off" class="form-control <?= form_error('judul') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('judul'); ?></div>
                                </div>

                                <div class="form-group">
                                    <label>Deskripsi Tugas <em>(opsional)</em></label>
                                    <textarea value="<?= $getdatabyid['deskripsi'] ?? ''; ?>" name="deskripsi" class="form-control" placeholder="Tuliskan Disini ..."><?php echo $getdatabyid['deskripsi']; ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Jatuh Tempo <span class="required">*</span></label>
                                    <input type="date" value="<?= $getdatabyid['tanggaltempo'] ?? ''; ?>" name="tanggaltempo"  class="form-control <?= form_error('tanggaltempo') ? 'invalid' : ''; ?>">
                                    <div class="invalid-feedbacks"><?= form_error('tanggaltempo'); ?></div>
                                </div>

                                <div class="form-group">
                                    <label>Status Tugas <span class="required">*</span></label>
                                    <select name="status" class="form-control <?= form_error('status') ? 'invalid' : ''; ?>">
                                        <option value="">Pilih Status</option>
                                        <option value="Pending" <?php echo (isset($getdatabyid['status']) && $getdatabyid['status'] === 'Pending'  ? 'selected' : '' ); ?> >Pending</option>
                                        <option value="In Progress" <?php echo (isset($getdatabyid['status']) && $getdatabyid['status'] === 'In Progress'  ? 'selected' : '' ); ?>>In Progress</option>
                                        <option value="Completed" <?php echo (isset($getdatabyid['status']) && $getdatabyid['status'] === 'Completed'  ? 'selected' : '' ); ?>>Completed</option>
                                    </select>
                                    <div class="invalid-feedbacks"><?= form_error('status'); ?></div>
                                </div>

                                <div class="form-group">
                                    <label>File Pendukung <em>(opsional)</em></label>
                                    <?php 
                                        $image_html = '';
                                        if( isset($getdatabyid['file_ID']) && !empty($getdatabyid['file_ID']) ){
                                            $image_html = '<div class="form-group fileEdit">
                                                <input type="hidden" name="file_ID" value="'.$getdatabyid['file_ID'].'">
                                                Lampiran Tersedia : <a href="'.base_url(IMAGE_PATH.$getdatabyid['nama_file']).'" target="_blank"><i class="fa fa-file-pdf"></i> Download '.ucfirst($getdatabyid['judul']).' PDF</a>
                                            </div>';
                                        }       
                                        echo $image_html;
                                    ?>
                                    <input type="file" name="lampiran" class="form-control">
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