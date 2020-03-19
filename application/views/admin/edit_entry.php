<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div> <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Informasi Asesi</h6>
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
                        <input type="text" class="form-control" readonly id="noskema" value="<?= $asesidata_id['asal_lsp'] ?>">
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

    <?php
    $asal   = $asesidata_id['asal_lsp'];
    $hasil = $this->db->get_where('tb_master_skema', ['id_skema' => $asal])->result_array();
    $hasil2 = $this->db->get_where('tb_master_unit', ['id_skema' => $asal])->row_array();
    $id_skema = $hasil2['id_skema'];
    // $hasil3 = $this->db->get_where('tb_master_elemen', ['id_skema' => $id_skema])->result_array();
    $jumlah = $this->db->get_where('tb_master_elemen', ['id_skema' => $id_skema])->num_rows();
    $keahlian = $this->db->get('tb_keahlian')->result_array();
    ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Penilaian Asesi</h6>
        </div>
        <div class="card-body">
            <div>
                <form id="fom" action="<?= base_url('admin/update_nilai') ?>" method="post">
                    <table class="table data-2" id="table2" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Unit</th>
                                <th>ID_Elemen</th>
                                <th>ID_KUK</th>
                                <th>Judul KUK</th>
                                <th>Nilai</th>
                                <th>K/BK</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $no2 = 1;
                            $no3 = 1;
                            foreach ($elemen_id as $row) :
                            ?>
                                <tr class="ta">
                                    <td><?= $row['id_unit'] ?></td>
                                    <td><?= $row['id_elemen'] ?></td>
                                    <td><?= $row['id_kuk'] ?></td>
                                    <td><?= $row['judul_kuk'] ?></td>
                                    <td width="10%">
                                        <input type="number" data-id2="<?= $no3++ ?>" max="100" class="form-control nilai" name="nilai[]" value="<?= $row['nilai'] ?>" id="nilai2-<?= $no++ ?>">
                                    </td>
                                    <input type="hidden" class="form-control" name="id[]" id="id" value="<?= $row['id'] ?>">
                                    <input type="hidden" class="form-control" name="no_ujian[]" id="no_ujian" value="<?= $row['nomor_ujian'] ?>">
                                    <input type="hidden" class="form-control" name="id_skema[]" id="id_skema" value="<?= $row['id_skema'] ?>">
                                    <input type="hidden" class="form-control" name="id_unit[]" id="id_unit" value="<?= $row['id_unit'] ?>">
                                    <input type="hidden" class="form-control" name="id_elemen[]" id="id_elemen" value="<?= $row['id_elemen'] ?>">
                                    <input type="hidden" class="form-control" name="id_kuk[]" id="id_kuk" value="<?= $row['id_kuk'] ?>">
                                    <input type="hidden" class="form-control" name="judul_kuk[]" id="judul_kuk" value="<?= $row['judul_kuk'] ?>">
                                    <td>
                                        <p class="kompoten2-<?= $no2++ ?>"><?= $row['hasil'] ?></p>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary tombol-nilai">Update</button>
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
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="nilai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>