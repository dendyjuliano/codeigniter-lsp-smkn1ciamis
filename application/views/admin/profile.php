<div class="container-fluid">
    <div class="mb-4">
        <h1 class="h3 mb-3 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-6 col-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="<?= base_url('admin/edit_asesor/') . $profile['id'] ?>" method="post">
                        <input type="hidden" name="id" value="<?= $profile['id'] ?>">
                        <div class="input-group row mb-3">
                            <label class="col-sm-4 col-form-label">No Reg</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" name="no_reg" value="<?= $profile['no_reg'] ?>">
                                <?= form_error('no_reg') ?>
                            </div>
                        </div>
                        <div class="input-group row mb-3">
                            <label class="col-sm-4 col-form-label">Nama Asesor</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" name="name_asesor" value="<?= $profile['nama_asesor'] ?>">
                                <?= form_error('name_asesor') ?>
                            </div>
                        </div>
                        <div class="input-group row mb-3">
                            <label class="col-sm-4 col-form-label">Id Skema</label>
                            <div class="col-sm-8">
                                <select name="id_skema" readonly disabled class="form-control">
                                    <?php if ($this->session->userdata('role_id') != 1) : ?>
                                        <?php foreach ($skema as $item) : ?>
                                            <?php if ($profile['id_skema'] == $item['id_skema']) : ?>
                                                <option selected value="<?= $item['id_skema'] ?>"><?= $item['id_skema'] ?></option>
                                            <?php else : ?>
                                                <option value="<?= $item['id_skema'] ?>"><?= $item['id_skema'] ?></option>
                                            <?php endif; ?>
                                        <?php endforeach ?>
                                    <?php else : ?>
                                        <option>-</option>
                                    <?php endif; ?>
                                </select>
                                <?= form_error('no_reg') ?>
                            </div>
                        </div>
                        <div class="input-group row mb-3">
                            <label class="col-sm-4 col-form-label">Asal Lsp</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" name="asal_lsp" value="<?= $profile['asal_lsp'] ?>">
                                <?= form_error('asal_lsp') ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?= form_open_multipart(); ?>
            <div class="card mb-4">
                <div class="card-body">
                    <input type="hidden" name="id" value="<?= $profile['id'] ?>">
                    <div class="input-group row mb-3">
                        <label class="col-sm-4"> Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="password">
                            <?= form_error('password', ' <small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="input-group row mb-3">
                        <label class="col-sm-4">Konfirm</label>
                        <div class="col-sm-8">
                            <input type="password" name="konfirmasi" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm">
                            <p>Edit Poto Profile</p>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                <label class="custom-file-label" for="gambar">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="float-right mr-4">
                        <button type="submit" class="btn btn-primary">submit</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
        <div class="col-md-6 col-lg-6 col-12">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="<?= base_url() . 'assets/uploads/' . $profile['image']; ?>" width="300" alt="">
                </div>
            </div>
        </div>
    </div>

</div>