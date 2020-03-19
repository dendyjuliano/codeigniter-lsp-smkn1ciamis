<div class="container-fluid">
    <div class="mb-4">
        <h1 class="h3 mb-3 text-gray-800"><?= $title ?></h1>
        <a href="<?= base_url('admin/asesi') ?>"><button class="btn-icon btn btn-primary"><i class="fas fa-arrow-circle-left"></i></button></a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('admin/edit_asesi/') . $asesi['id'] ?>" method="post">
                        <input type="hidden" name="id" value="<?= $asesi['id'] ?>">
                        <div class="modal-body">
                            <div class="input-group mb-2 row">
                                <label class="col-sm-4">Nama Asesi</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="nama_asesi" value="<?= $asesi['nama_asesi'] ?>">
                                    <?= form_error('nama_asesi') ?>
                                </div>
                            </div>
                            <div class="input-group mb-2 row">
                                <label class="col-sm-4">Nik</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="nik" value="<?= $asesi['nik'] ?>">
                                    <?= form_error('nik') ?>
                                </div>
                            </div>
                            <div class="input-group mb-2 row">
                                <label class="col-sm-4">Tempat Lahir</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="tempat_lahir" value="<?= $asesi['tempat_lahir'] ?>">
                                    <?= form_error('tempat_lahir') ?>
                                </div>
                            </div>
                            <div class="input-group mb-2 row">
                                <label class="col-sm-4">Tanggal Lahir</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" name="tanggal_lahir" value="<?= $asesi['tanggal_lahir'] ?>">
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
                                    <textarea name="alamat" class="form-control"><?= $asesi['alamat'] ?></textarea>
                                    <?= form_error('alamat') ?>
                                </div>
                            </div>
                            <div class="input-group mb-2 row">
                                <label class="col-sm-4">Kode Kota</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="kode_kota" value="<?= $asesi['kode_kota'] ?>">
                                    <?= form_error('kode_kota') ?>
                                </div>
                            </div>
                            <div class="input-group mb-2 row">
                                <label class="col-sm-4">Kode Provinsi</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="kode_provinsi" value="<?= $asesi['kode_propinsi'] ?>">
                                    <?= form_error('kode_provinsi') ?>
                                </div>
                            </div>
                            <div class="input-group mb-2 row">
                                <label class="col-sm-4">Telepon</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="telepon" value="<?= $asesi['telepon'] ?>">
                                    <?= form_error('telepon') ?>
                                </div>
                            </div>
                            <div class="input-group mb-2 row">
                                <label class="col-sm-4">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="email" value="<?= $asesi['email'] ?>">
                                    <?= form_error('email') ?>
                                </div>
                            </div>
                            <div class="input-group mb-2 row">
                                <label class="col-sm-4">Kode Pendidikan</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="kode_pendidikan" value="<?= $asesi['kode_pendidikan'] ?>">
                                    <?= form_error('kode_pendidikan') ?>
                                </div>
                            </div>
                            <div class="input-group mb-2 row">
                                <label class="col-sm-4">Kode Pekerjaan</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="kode_pekerjaan" value="<?= $asesi['kode_pekerjaan'] ?>">
                                    <?= form_error('kode_pekerjaan') ?>
                                </div>
                            </div>
                            <div class="input-group mb-2 row">
                                <label class="col-sm-4">Kode Jadwal</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="jadwal" value="<?= $asesi['kode_jadwal'] ?>">
                                    <?= form_error('jadwal') ?>
                                </div>
                            </div>
                            <div class="input-group mb-2 row">
                                <label class="col-sm-4">Tangal Uji</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" name="tanggal_uji" value="<?= $asesi['tanggal_uji'] ?>">
                                    <?= form_error('tanggal_uji') ?>
                                </div>
                            </div>
                            <div class="input-group mb-2 row">
                                <label class="col-sm-4">No Reg</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="no_reg" value="<?= $asesi['no_reg'] ?>">
                                    <?= form_error('no_reg') ?>
                                </div>
                            </div>
                            <div class="input-group mb-2 row">
                                <label class="col-sm-4">Kode Sumber Anggaran</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="kode_sumber_anggaran" value="<?= $asesi['kode_sumber_anggaran'] ?>">
                                    <?= form_error('kode_sumber_anggaran') ?>
                                </div>
                            </div>
                            <div class="input-group mb-2 row">
                                <label class="col-sm-4">Kode Kementrian</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="kode_kementrian" value="<?= $asesi['kode_kementrian'] ?>">
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
                                    <input type="number" class="form-control" name="nilai_akhir" value="<?= $asesi['nilai_akhir'] ?>">
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
    </div>
</div>