<div class="container-fluid">
    <div class="mb-4">
        <h1 class="h3 mb-3 text-gray-800"><?= $title ?></h1>
        <a href="<?= base_url('admin/skema') ?>"><button class="btn-icon btn btn-primary"><i class="fas fa-arrow-circle-left"></i></button></a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('admin/edit_skema/') . $skema['id'] ?>" method="post">
                        <input type="hidden" name="id" value="<?= $skema['id'] ?>">
                        <div class="input-group mb-3 row">
                            <label class="col-sm-4">Id Skema</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="id_skema" value="<?= $skema['id_skema'] ?>">
                                <?= form_error('id_skema') ?>
                            </div>
                        </div>
                        <div class="input-group mb-3 row">
                            <label class="col-sm-4">Jenis Ujian</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="jenis_ujian" value="<?= $skema['jenis_ujian'] ?>">
                                <?= form_error('jenis_ujian') ?>
                            </div>
                        </div>
                        <div class="input-group mb-3 row">
                            <label class="col-sm-4">Judul Skema</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="judul_skema" value="<?= $skema['judul_skema'] ?>">
                                <?= form_error('judul_skema') ?>
                            </div>
                        </div>
                        <div class="float-right mr-4">
                            <button class="btn btn-primary" type="submit">submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>