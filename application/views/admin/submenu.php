<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <div class="buton ml-auto">
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
                            <th>No</th>
                            <th>Menu</th>
                            <th>Judul</th>
                            <th>Url</th>
                            <th>Icon</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($submenudata as $row) :
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['menu'] ?></td>
                                <td><?= $row['title'] ?></td>
                                <td><?= $row['url'] ?></td>
                                <td><?= $row['icon'] ?></td>
                                <td>
                                    <a class="btn btn-danger tombol-hapus" href="<?= base_url('admin/delete_menu/') ?><?= $row['id'] ?>"><i class="fas fa-trash"></i></a>
                                    <a class="btn btn-success" href="<?= base_url('admin/edit_menu/') ?><?= $row['id'] ?>"><i class="fas fa-edit"></i></a>
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
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/insert_submenu') ?>" method="post">
                    <div class="form-group">
                        <label for="role">Menu ID</label>
                        <select class="form-control" name="menu" id="menu">
                            <option value="" disabled selected>--Select Role--</option>
                            <?php foreach ($menu as $row) : ?>
                                <option value="<?= $row['id'] ?>"><?= $row['menu'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Judul</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Input Title">
                    </div>
                    <div class="form-group">
                        <label for="username">URL</label>
                        <input type="text" class="form-control" id="url" name="url" placeholder="Input url">
                    </div>
                    <div class="form-group">
                        <label for="icon">Icon</label>
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Input Icon Class">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>