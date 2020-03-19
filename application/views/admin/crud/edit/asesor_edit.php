<div class="container-fluid">
    <div class="mb-4">
        <h1 class="h3 mb-3 text-gray-800"><?= $title ?></h1>
        <a href="<?= base_url('admin/asesor') ?>"><button class="btn-icon btn btn-primary"><i class="fas fa-arrow-circle-left"></i></button></a>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-6 col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="<?= base_url('admin/edit_asesor/') . $asesor['id'] ?>" method="post">
                        <input type="hidden" name="id" value="<?= $asesor['id'] ?>">
                        <div class="input-group row mb-3">
                            <label class="col-sm-4 col-form-label">No Reg</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="no_reg" value="<?= $asesor['no_reg'] ?>">
                                <?= form_error('no_reg') ?>
                            </div>
                        </div>
                        <div class="input-group row mb-3">
                            <label class="col-sm-4 col-form-label">Nama Asesor</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="name_asesor" value="<?= $asesor['nama_asesor'] ?>">
                                <?= form_error('name_asesor') ?>
                            </div>
                        </div>
                        <div class="input-group row mb-3">
                            <label class="col-sm-4 col-form-label">Id Skema</label>
                            <div class="col-sm-8">
                                <select name="id_skema" class="form-control">
                                    <?php foreach ($skema as $item) : ?>
                                        <?php if ($asesor['id_skema'] == $item['id_skema']) : ?>
                                            <option selected value="<?= $item['id_skema'] ?>"><?= $item['id_skema'] ?></option>
                                        <?php else : ?>
                                            <option value="<?= $item['id_skema'] ?>"><?= $item['id_skema'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach ?>
                                </select>
                                <?= form_error('no_reg') ?>
                            </div>
                        </div>
                        <div class="input-group row mb-3">
                            <label class="col-sm-4 col-form-label">Asal Lsp</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="asal_lsp" value="<?= $asesor['asal_lsp'] ?>">
                                <?= form_error('asal_lsp') ?>
                            </div>
                        </div>
                        <div class="input-group row mb-3">
                            <label class="col-sm-4 col-form-label">Role Id</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="role_id" value="<?= $asesor['role_id'] ?>">
                                <?= form_error('role_id') ?>
                            </div>
                        </div>
                        <div class="float-right mr-4">
                            <button type="submit" class="btn btn-primary">submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="<?= base_url('admin/asesor_update_password') ?>" method="post">
                        <input type="hidden" name="id" value="<?= $asesor['id'] ?>">
                        <div class="input-group row mb-3">
                            <label class="col-sm-4"> Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="password">
                                <?= form_error('password') ?>
                            </div>
                        </div>
                        <div class="input-group row mb-3">
                            <label class="col-sm-4">Konfirm</label>
                            <div class="col-sm-8">
                                <input type="password" name="konfirmasi" class="form-control">
                            </div>
                        </div>
                        <div class="float-right mr-4">
                            <button type="submit" class="btn btn-primary">submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>