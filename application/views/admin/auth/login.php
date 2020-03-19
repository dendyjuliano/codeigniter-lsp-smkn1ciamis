<body>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-7">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center mb-5">
                                        <img src="<?= base_url('assets/img/logo.png') ?>" width="100" alt="">
                                    </div>
                                    <?= $this->session->flashdata('message') ?>
                                    <form class="user" method="POST" action="<?= base_url('auth') ?>">
                                        <div class="form-group">
                                            <input type="text" value="<?= set_value('username') ?>" class="form-control form-control-user" id="username" name="username" placeholder="No Reg MET">
                                            <?= form_error('username', ' <small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                            <?= form_error('password', ' <small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <button type="submit" class="btn btn-danger btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>