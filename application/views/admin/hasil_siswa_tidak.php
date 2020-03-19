<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div> <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Informasi Asesi</h6>
            <h6></h6>
            <div class="informasi ml-auto">
                <input type="text" class="form-control" readonly id="nomor_ujian" value="<?= $head['nomor_ujian'] ?>">
            </div>
        </div>
        <div class="card-body">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nama">Nama Asesi</label>
                        <input type="text" class="form-control" readonly id="nama" value="<?= $asesidata_id['nama_asesi'] ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="noskema">No Skema</label>
                        <input type="text" class="form-control" readonly id="noskema" value="<?= $asesidata_id['id_skema'] ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nama">NIK</label>
                        <input type="text" class="form-control" readonly id="nik" value="<?= $asesidata_id['nik'] ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="noskema">Tempat,Tanggal Lahir</label>
                        <input type="text" class="form-control" id="lahir" readonly value="<?= $asesidata_id['tempat_lahir'] ?>, <?= $asesidata_id['tanggal_lahir'] ?>">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Penilaian Asesi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="<?= base_url('admin/input_nilai') ?>" method="post">
                    <table class="table data" id="table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Unit</th>
                                <th>Judul Unit</th>
                                <th>Nilai</th>
                                <th>K/BK</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr class="text-center">
                                <td colspan="5">Belum ada Nilai</td>
                            </tr>
                        </tbody>
                        <!-- <tfoot>
                            <tr>
                                <th colspan="4">Nilai Rata-Rata</th>
                                <th><?= $rata_rata ?></th>
                                <th><?= $status ?></th>
                            </tr>
                        </tfoot> -->
                    </table>
                </form>
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

<div id="success"></div>