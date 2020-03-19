<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <div class="buton ml-auto">
            <a href="#" data-toggle="modal" data-target="#excel" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-file-excel  text-white-50"></i> Inport Excel</a>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-file-pdf  text-white-50"></i> Export PDF</a>
            <a href="#" data-toggle="modal" data-target="#tambah" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus  text-white-50"></i> Tambah <?= $title ?></a>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table data" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Tanggal Uji</th>
                            <th>No Reg</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($asesidata as $row) :
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['nik'] ?></td>
                                <td><?= $row['nama_asesi'] ?></td>
                                <td><?= $row['tanggal_uji'] ?></td>
                                <td><?= $row['no_reg'] ?></td>
                                <td>
                                    <a class="btn btn-danger tombol-hapus" href="<?= base_url('admin/delete_asesi/') ?><?= $row['id'] ?>"><i class="fas fa-trash"></i></a>
                                    <a class="btn btn-success" href="<?= base_url('admin/edit_asesi/') ?><?= $row['id'] ?>"><i class="fas fa-edit"></i></a>
                                    <a class="btn btn-primary" href="<?= base_url('admin/detail_asesi/') ?><?= $row['id'] ?>"><i class="fas fa-search-plus"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; LSP SMKN 1 CIAMIS</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Modal -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/asesi') ?>" method="post">
                <div class="modal-body">
                    <div class="input-group mb-2 row">
                        <label class="col-sm-4">Nama Asesi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="nama_asesi" value="<?= set_value('nama_asesi') ?>">
                            <?= form_error('nama_asesi') ?>
                        </div>
                    </div>
                    <div class="input-group mb-2 row">
                        <label class="col-sm-4">Nik</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="nik" value="<?= set_value('nik') ?>">
                            <?= form_error('nik') ?>
                        </div>
                    </div>
                    <div class="input-group mb-2 row">
                        <label class="col-sm-4">Tempat Lahir</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="tempat_lahir" value="<?= set_value('tempat_lahir') ?>">
                            <?= form_error('tempat_lahir') ?>
                        </div>
                    </div>
                    <div class="input-group mb-2 row">
                        <label class="col-sm-4">Tanggal Lahir</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" name="tanggal_lahir" value="<?= set_value('tanggal_lahir') ?>">
                            <?= form_error('tanggal_Lahir') ?>
                        </div>
                    </div>
                    <div class="input-group mb-2 row">
                        <label class="col-sm-4">Kelamin</label>
                        <div class="col-sm-8">
                            <select name="kelamin" class="form-control">
                                <option value="P">Perempuan</option>
                                <option value="L">Laki Laki</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-group mb-2 row">
                        <label class="col-sm-4">Alamat</label>
                        <div class="col-sm-8">
                            <textarea name="alamat" class="form-control"></textarea>
                            <?= form_error('alamat') ?>
                        </div>
                    </div>
                    <div class="input-group mb-2 row">
                        <label class="col-sm-4">Kode Kota</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="kode_kota" value="<?= set_value('kode_kota') ?>">
                            <?= form_error('kode_kota') ?>
                        </div>
                    </div>
                    <div class="input-group mb-2 row">
                        <label class="col-sm-4">Kode Provinsi</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="kode_provinsi" value="<?= set_value('kode_provinsi') ?>">
                            <?= form_error('kode_provinsi') ?>
                        </div>
                    </div>
                    <div class="input-group mb-2 row">
                        <label class="col-sm-4">Telepon</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="telepon" value="<?= set_value('telepon') ?>">
                            <?= form_error('telepon') ?>
                        </div>
                    </div>
                    <div class="input-group mb-2 row">
                        <label class="col-sm-4">Email</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="email" value="<?= set_value('email') ?>">
                            <?= form_error('email') ?>
                        </div>
                    </div>
                    <div class="input-group mb-2 row">
                        <label class="col-sm-4">Kode Pendidikan</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="kode_pendidikan" value="<?= set_value('kode_pendidikan') ?>">
                            <?= form_error('kode_pendidikan') ?>
                        </div>
                    </div>
                    <div class="input-group mb-2 row">
                        <label class="col-sm-4">Kode Pekerjaan</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="kode_pekerjaan" value="<?= set_value('kode_pekerjaan') ?>">
                            <?= form_error('kode_pekerjaan') ?>
                        </div>
                    </div>
                    <div class="input-group mb-2 row">
                        <label class="col-sm-4">Kode Jadwal</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="jadwal" value="<?= set_value('jadwal') ?>">
                            <?= form_error('jadwal') ?>
                        </div>
                    </div>
                    <div class="input-group mb-2 row">
                        <label class="col-sm-4">Tangal Uji</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" name="tanggal_uji" value="<?= set_value('tanggal_uji') ?>">
                            <?= form_error('tanggal_uji') ?>
                        </div>
                    </div>
                    <div class="input-group mb-2 row">
                        <label class="col-sm-4">No Reg</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="no_reg" value="<?= set_value('no_reg') ?>">
                            <?= form_error('no_reg') ?>
                        </div>
                    </div>
                    <div class="input-group mb-2 row">
                        <label class="col-sm-4">Kode Sumber Anggaran</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="kode_sumber_anggaran" value="<?= set_value('kode_sumber_anggaran') ?>">
                            <?= form_error('kode_sumber_anggaran') ?>
                        </div>
                    </div>
                    <div class="input-group mb-2 row">
                        <label class="col-sm-4">Kode Kementrian</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="kode_kementrian" value="<?= set_value('kode_kementrian') ?>">
                            <?= form_error('kode_kementrian') ?>
                        </div>
                    </div>
                    <div class="input-group mb-2 row">
                        <label class="col-sm-4">Status</label>
                        <div class="col-sm-8">
                            <select name="status" class="form-control">
                                <option value="K">K</option>
                                <option value="BK">BK</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-group mb-2 row">
                        <label class="col-sm-4">Nilai Akhir</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="nilai_akhir" value="<?= set_value('nilai_akhir') ?>">
                            <?= form_error('nilai_akhir') ?>
                        </div>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="excel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Inport Excel <?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/importFileAsesi') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file">Import File</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" name="uploadFile">
                            <label class="custom-file-label" for="image">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" name="submit1" value="Upload" class="btn btn-primary"></input>
                </div>
            </form>
        </div>
    </div>
</div>