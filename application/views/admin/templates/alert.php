<?php if ($this->session->flashdata('flash') == 'Delete') : ?>
    <script>
        Swal.fire(
            'Berhasil',
            'Data berhasil di hapus',
            'success'
        )
    </script>
<?php endif ?>

<?php if ($this->session->flashdata('flash') == 'Insert') : ?>
    <script>
        Swal.fire(
            'Berhasil',
            'Data berhasil di tambah',
            'success'
        )
    </script>
<?php endif ?>

<?php if ($this->session->flashdata('flash') == 'Error') : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Gagal',
        })
    </script>
<?php endif ?>

<?php if ($this->session->flashdata('flash') == 'Edit') : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'Data berhasil di Edit',
        })
    </script>
<?php endif ?>