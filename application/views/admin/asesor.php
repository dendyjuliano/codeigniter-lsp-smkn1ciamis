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

    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table data" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No Req</th>
                            <th>Nama</th>
                            <th>Asal LSP</th>
                            <th>Password</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($asesordata as $row) :
                        ?>
                            <tr>
                                <td><?= $row['no_reg'] ?></td>
                                <td><?= $row['nama_asesor'] ?></td>
                                <td><?= $row['asal_lsp'] ?></td>
                                <td><?= $row['password'] ?></td>
                                <td>
                                    <a class=" btn btn-danger tombol-hapus" href="<?= base_url('admin/delete_asesor/') ?><?= $row['id'] ?>"><i class="fas fa-trash"></i></a>
                                    <a class="btn btn-success" href="<?= base_url('admin/edit_asesor/') ?><?= $row['id'] ?>"><i class="fas fa-edit"></i></a>
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
            <form action="<?= base_url('admin/asesor/add') ?>" method="post">
                <div class="modal-body">
                    <div class="input-group mb-3 row">
                        <label class="col-sm-4 col-form-label">No Reg</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="no_reg">
                            <?= form_error('no_reg') ?>
                        </div>
                    </div>
                    <div class="input-group mb-3 row">
                        <label class="col-sm-4 col-form-lavel">Nama</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="name_asesor">
                            <?= form_error('name_asesor') ?>
                        </div>
                    </div>
                    <div class="input-group mb-3 row">
                        <label class="col-sm-4 col-form-label">Skema</label>
                        <div class="col-sm-8">
                            <select name="id_skema" class="form-control">
                                <?php foreach ($id_skema as $item) : ?>
                                    <option value="<?= $item['id_skema'] ?>"><?= $item['id_skema'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="input-group mb-3 row">
                        <label class="col-sm-4 col-form-label">Asal Lsp</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="asal_lsp">
                            <?= form_error('asal_lsp') ?>
                        </div>
                    </div>
                    <div class="input-group mb-3 row">
                        <label class="col-sm-4 col-form-label">Password</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="password">
                            <?= form_error('password') ?>
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
            <form action="<?= base_url('admin/importFileAsesor') ?>" method="post" enctype="multipart/form-data">
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
                    <input type="submit" name="submit2" value="Upload" class="btn btn-primary"></input>
                </div>
            </form>
        </div>
    </div>
</div>