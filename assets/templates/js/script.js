//sweat alert
const flashdata = $('.flash-data').data('flashdata');

if (flashdata) {
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: 'Data telah di ' + flashdata
    });
}

$('.tombol-hapus').on('click', function (e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Apakah anda yakin',
        text: "Data Ini akan di Hapus",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })

});

$('.tombol-nilai').on('click', function (e) {

    e.preventDefault();
    var ini = $(this).parents('form');

    Swal.fire({
        title: 'Apakah anda yakin',
        text: "Sudah mengisi semua nilai ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            ini.submit();
        }
    })

});