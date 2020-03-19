<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <!-- <div class="buton ml-auto">
            <a id="exel" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-file-excel  text-white-50"></i> Export Excel</a>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-file-pdf  text-white-50"></i> Export PDF</a>
        </div> -->
    </div>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
    <!-- DataTales Example -->
    <?php if ($this->session->userdata('role_id') == 1) : ?>
        <div class="input-group mb-3 col-md-5">
            <select class="custom-select" id="skema">
                <option selected disabled>--Pilih Skema--</option>
                <?php foreach ($skema as $row) : ?>
                    <option value="<?= $row['id_skema'] ?>"><?= $row['judul_skema'] ?></option>
                <?php endforeach; ?>
            </select>
            <div class="input-group-append">
                <label class="input-group-text" for="inputGroupSelect02">Skema</label>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table data_nilai" width="100%" id="t" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Skema</th>
                                <th>Nilai</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="b">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table data text-center" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Nilai</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($rekap2 as $row) :
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['nik'] ?></td>
                                    <td><?= $row['nama_asesi'] ?></td>
                                    <td><?= round($row['nilai_akhir'], 2) ?></td>
                                    <td>
                                        <?php if ($row['status'] == 'BK') : ?>
                                            Tidak Lulus
                                        <?php else : ?>
                                            Lulus
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>
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

<script>
    $(document).ready(function() {
        var table;
        table = $('.data_nilai').DataTable({
            "processing": true,
            "serverSide": true,
            order: [
                [1, "ASC"]
            ],
            "ajax": {
                url: "<?= base_url('admin/data_nilai') ?>",
                type: "POST",
                data: function(e) {
                    e.SKEMA = $('#skema').val();
                }
            },
        });

        $('#skema').on('change', function() {
            var skema = $(this).val();
            table.ajax.reload();
            // $.ajax({
            //     url: "<?php echo base_url('admin/rekap'); ?>",
            //     type: "POST",
            //     data: {
            //         'skema': skema
            //     },
            //     dataType: "html",
            //     success: function(data) {
            //         $('#b').html(data);
            //     },
            //     error: function() {

            //     }
            // });

        });

        $('#exel').on('click', function() {
            var url = "<?= base_url('admin/export_excel_rekap') ?>";
            var skema = $('#skema').val();
            if (skema != null) {
                url += "skema=" + skema;
            }

            console.log(url);
            window.location.href = url;
        })
    })
</script>