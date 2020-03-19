<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Asesor</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $asesor_row ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fas fa-user-tie fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">asesi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $asesi_row ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fas fa-graduation-cap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">skema</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $skema_row ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fas fa-bookmark fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Unit</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $unit_row ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Nilai</h6>
                    <div class="col-md-6">
                        <select class="custom-select" id="jurusan">
                            <option selected disabled>--Pilih Skema--</option>
                            <?php foreach ($skema as $row) : ?>
                                <option value="<?= $row['id_skema'] ?>"><?= $row['judul_skema'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div id="tampil">

                    </div>
                </div>
                <div class="card-body" style="overflow: hidden">
                    <div id="myfirstchart" style="height: 250px;"></div>
                </div>
                <!-- Card Body -->
                <!-- <div class="card-body">
                    <div class="chart-area">
                        <canvas class="areanilai"></canvas>
                    </div>
                </div> -->
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Seluruh Nilai</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div id="pienilai" style="height: 250px;"></div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> <?= $nilai_a ?> Kompeten
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-danger"></i> <?= $nilai_b ?> Belum Kompeten
                        </span>
                    </div>
                    <input type="hidden" value="<?= $nilai_a ?>" id="woilah_k">
                    <input type="hidden" value="<?= $nilai_b ?>" id="woilah_bk">
                </div>
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
            <span>Copyright &copy; Your Website 2019</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->