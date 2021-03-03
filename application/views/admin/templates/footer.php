<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin Keluar ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Klick tombol logout untuk Keluar.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->


<script src="<?= base_url(); ?>assets/templates/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url(); ?>assets/templates/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url(); ?>assets/templates/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url(); ?>assets/templates/vendor/chart.js/Chart.min.js"></script>
<!-- Page level custom scripts -->
<script src="<?= base_url(); ?>assets/templates/js/demo/chart-area-demo.js"></script>
<script src="<?= base_url(); ?>assets/templates/js/demo/chart-pie-demo.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url(); ?>assets/templates/js/datatables.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url(); ?>assets/templates/js/demo/datatables-demo.js"></script>
<script src="<?= base_url(); ?>assets/templates/js/sweetalert2.all.min.js"></script>
<script src="<?= base_url(); ?>assets/templates/js/script.js"></script>

<!-- Sweet Alert -->
<?php $this->load->view('admin/templates/alert') ?>

<script src="<?= base_url('assets/templates/vendor/morris/morris.min.js') ?>"></script>
<script src="<?= base_url('assets/templates/vendor/raphael/raphael-min.js') ?>"></script>

<!-- Sweet Alert -->
<?php $this->load->view('admin/templates/alert') ?>

<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>

<script>
    $(document).ready(function() {
        $('.data').DataTable();
    });
</script>
<script>
    $(document).ready(function() {
        $('.data-2').DataTable({
            scrollY: '60vh',
            scrollCollapse: true,
            paging: false
        });
    });
</script>

<script>
    var table = document.getElementById('table');
    var arr = [];


    var cel = "";
    var tableRows = table.rows.length;
    for (var i = 1; i < tableRows; i++) {
        table.rows[i].onkeyup = function() {
            cel = this.cells[5];
        };

        var nilai3 = document.getElementById('nilai-' + i);
        nilai3.onkeyup = function(e) {
            var nilai = (this.value)
            var astaga = e.target.getAttribute('data-id');
            var woilah = document.querySelector('.kompoten-' + astaga);

            if (nilai > 79) {
                woilah.innerHTML = "K";
            } else {
                woilah.innerHTML = "BK";
            }
        }

    }
</script>
<script>
    var table2 = document.getElementById('table2');
    var arr2 = [];

    var cel2 = "";
    var tableRows2 = table2.rows.length;
    for (var z = 1; z < tableRows2; z++) {
        table2.rows[z].onkeyup = function() {
            cel2 = this.cells[5];
        };

        var nilai4 = document.getElementById('nilai2-' + z);
        nilai4.onkeyup = function(d) {
            var nilai2 = (this.value)
            var astaga2 = d.target.getAttribute('data-id2');
            var woilah2 = document.querySelector('.kompoten2-' + astaga2);

            if (nilai2 > 79) {
                woilah2.innerHTML = "K";
            } else {
                woilah2.innerHTML = "BK";
            }
        }

    }
</script>

<script>
    function persen() {
        var seluruh = "<?= $seluruh ?>";
        var nilai_a = "<?= $nilai_a ?>";
        var nilai_b = "<?= $nilai_b ?>";

        var hasil1 = (nilai_a / seluruh) * (100);
        var hasil2 = (nilai_b / seluruh) * (100);

        return hasil2;
    }
    var pie = document.getElementById("pienilai");
    var myPieChart = new Chart(pie, {
        type: 'pie',
        data: {
            labels: ["Kompeten", "Tidak Kompeten"],
            datasets: [{
                data: [
                    <?=
                        $nilai_a
                    ?>,
                    <?=
                        $nilai_b
                    ?>
                ],
                backgroundColor: ['#4e73df', '#EA2027'],
                hoverBackgroundColor: ['#2e59d9', '#EA2027'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
                callbacks: {
                    label: function() {
                        return persen();
                    }
                }
            },
        },
    })
</script>

<script>
    $("#jurusan").on("change", function() {
        var jurusan = this.value;
        let a = "";
        let b = "";

        $.ajax({
            url: "<?= base_url('admin/cari_jurusan') ?>",
            type: "POST",
            dataType: "html",
            data: {
                jurusan: jurusan
            },
            success: function(data) {
                $("#tampil").html(data);

                a = document.getElementById("nilai_k").value;
                b = document.getElementById("nilai_bk").value;
                new Morris.Bar({
                    // ID of the element in which to draw the chart.
                    element: "myfirstchart",
                    // Chart data records -- each entry in this array corresponds to a point on
                    // the chart.
                    data: [{
                            nilai: "BK",
                            value: b
                        },
                        {
                            nilai: "K",
                            value: a
                        }
                    ],
                    // The name of the data record attribute that contains x-values.
                    xkey: "nilai",
                    // A list of names of data record attributes that contain y-values.
                    ykeys: ["value"],
                    // Labels for the ykeys -- will be displayed when you hover over the
                    // chart.
                    labels: ["Value"]
                });
            }
        });
    });

    let woilah_k = document.getElementById("woilah_k").value;
    let woilah_bk = document.getElementById("woilah_bk").value;

    $(document).ready(function() {
        new Morris.Donut({
            // ID of the element in which to draw the chart.
            element: "pienilai",
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: [{
                    label: "BK",
                    value: woilah_bk
                },
                {
                    label: "K",
                    value: woilah_k
                }
            ]
            // The name of the data record attribute that contains x-values.
            // chart.
        });
    });
</script>

</body>

</html>