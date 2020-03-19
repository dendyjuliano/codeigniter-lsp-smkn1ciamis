<div class="container-fluid">
    <div class="mb-4">
        <h1 class="h3 mb-3 text-gray-800"><?= $title ?></h1>
        <a href="<?= base_url('admin/asesi') ?>"><button class="btn-icon btn btn-primary"><i class="fas fa-arrow-circle-left"></i></button></a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="modal-body">
                        <div class="input-group mb-2 row">
                            <label class="col-sm-4">Nama Asesi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_asesi" readonly value="<?= $asesi['nama_asesi'] ?>">
                                <?= form_error('nama_asesi') ?>
                            </div>
                        </div>
                        <div class="input-group mb-2 row">
                            <label class="col-sm-4">Nik</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="nik" readonly value="<?= $asesi['nik'] ?>">
                                <?= form_error('nik') ?>
                            </div>
                        </div>
                        <div class="input-group mb-2 row">
                            <label class="col-sm-4">Tempat Lahir</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tempat_lahir" readonly value="<?= $asesi['tempat_lahir'] ?>">
                                <?= form_error('tempat_lahir') ?>
                            </div>
                        </div>
                        <div class="input-group mb-2 row">
                            <label class="col-sm-4">Tanggal Lahir</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" name="tanggal_lahir" readonly value="<?= $asesi['tanggal_lahir'] ?>">
                                <?= form_error('tanggal_Lahir') ?>
                            </div>
                        </div>
                        <div class="input-group mb-2 row">
                            <label class="col-sm-4">Kelamin</label>
                            <div class="col-sm-8">
                                <?php if ($asesi['kelamin'] == 'P') : ?>
                                    <input type="text" class="form-control" value="Perempuan" readonly>
                                <?php endif ?>
                                <?php if ($asesi['kelamin'] == 'L') : ?>
                                    <input type="text" class="form-control" value="Laki Laki" readonly>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="input-group mb-2 row">
                            <label class="col-sm-4">Alamat</label>
                            <div class="col-sm-8">
                                <textarea name="alamat" readonly class="form-control"> <?= $asesi['alamat'] ?></textarea>
                                <?= form_error('alamat') ?>
                            </div>
                        </div>
                        <div class="input-group mb-2 row">
                            <label class="col-sm-4">Kode Kota</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="kode_kota" readonly value="<?= $asesi['kode_kota'] ?>">
                                <?= form_error('kode_kota') ?>
                            </div>
                        </div>
                        <div class="input-group mb-2 row">
                            <label class="col-sm-4">Kode Provinsi</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="kode_provinsi" readonly value="<?= $asesi['kode_propinsi'] ?>">
                                <?= form_error('kode_provinsi') ?>
                            </div>
                        </div>
                        <div class="input-group mb-2 row">
                            <label class="col-sm-4">Telepon</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="telepon" readonly value="<?= $asesi['telepon'] ?>">
                                <?= form_error('telepon') ?>
                            </div>
                        </div>
                        <div class="input-group mb-2 row">
                            <label class="col-sm-4">Email</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="email" readonly value="<?= $asesi['email'] ?>">
                                <?= form_error('email') ?>
                            </div>
                        </div>
                        <div class="input-group mb-2 row">
                            <label class="col-sm-4">Kode Pendidikan</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="kode_pendidikan" readonly value="<?= $asesi['kode_pendidikan'] ?>">
                                <?= form_error('kode_pendidikan') ?>
                            </div>
                        </div>
                        <div class="input-group mb-2 row">
                            <label class="col-sm-4">Kode Pekerjaan</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="kode_pekerjaan" readonly value="<?= $asesi['kode_pekerjaan'] ?>">
                                <?= form_error('kode_pekerjaan') ?>
                            </div>
                        </div>
                        <div class="input-group mb-2 row">
                            <label class="col-sm-4">Kode Jadwal</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="jadwal" readonly value="<?= $asesi['kode_jadwal'] ?>">
                                <?= form_error('jadwal') ?>
                            </div>
                        </div>
                        <div class="input-group mb-2 row">
                            <label class="col-sm-4">Tangal Uji</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" name="tanggal_uji" readonly value="<?= $asesi['tanggal_uji'] ?>">
                                <?= form_error('tanggal_uji') ?>
                            </div>
                        </div>
                        <div class="input-group mb-2 row">
                            <label class="col-sm-4">No Reg</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="no_reg" readonly value="<?= $asesi['no_reg'] ?>">
                                <?= form_error('no_reg') ?>
                            </div>
                        </div>
                        <div class="input-group mb-2 row">
                            <label class="col-sm-4">Kode Sumber Anggaran</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="kode_sumber_anggaran" readonly value="<?= $asesi['kode_sumber_anggaran'] ?>">
                                <?= form_error('kode_sumber_anggaran') ?>
                            </div>
                        </div>
                        <div class="input-group mb-2 row">
                            <label class="col-sm-4">Kode Kementrian</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="kode_kementrian" readonly value="<?= $asesi['kode_kementrian'] ?>">
                                <?= form_error('kode_kementrian') ?>
                            </div>
                        </div>
                        <div class="input-group mb-2 row">
                            <label class="col-sm-4">Status</label>
                            <div class="col-sm-8">
                                <?php if ($asesi['status'] == 'K') : ?>
                                    <input type="text" class="form-control" value="Kompeten">
                                <?php endif ?>
                                <?php if ($asesi['status'] == 'BK') : ?>
                                    <input type="text" class="form-control" value="Belum Kompeten">
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="input-group mb-2 row">
                            <label class="col-sm-4">Nilai Akhir</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="nilai_akhir" readonly value="<?= $asesi['nilai_akhir'] ?>">
                                <?= form_error('nilai_akhir') ?>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>