<script>
    $(function() {

        const base_url = $('#page-top #base-url').data('url')
        const urlsekolah = base_url + 'data/sekolah/'

        // Default Alert
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        var table;

        table = $('.card #tabel-sekolah').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('data/sekolah/getData/'); ?>",
                "type": "POST"
            },
            "columnDefs": [{
                "targets": [0, 3],
                "orderable": false
            }]
        });

        //---->||  Set Model Tambah Data  ||<----//
        $('.tombolTambahSekolah').on('click', function() {

            $('#modalLabel').html('Tambah Data Sekolah')
            $('.modal-footer Button[type=submit]').html('Tambahkan')
            $('.modal-content form').attr('action', urlsekolah + 'addDataSekolah')
            $('#sekolah_form input[name="jns_form"]').val('add');

            $('#id').val(null)
            $('#nama').val(null)
            $('#kota').val(null)
            $('#alamat').val(null)

            $('#nama_error').html('')
            $('#kota_error').html('')
            $('#alamat_error').html('')
        })

        //---->||  Set Modal Ubah Data  ||<----//
        $('#tabel-sekolah').on('click', '.tombolUbahSekolah', function() {

            $('#modalLabel').html('Ubah Data Sekolah')
            $('.modal-footer Button[type=submit]').html('Ubah Data')
            $('.modal-content form').attr('action', urlsekolah + 'editDataSekolah');
            $('#sekolah_form input[name="jns_form"]').val('edit');

            $('#nama_error').html('')
            $('#kota_error').html('')
            $('#alamat_error').html('')

            const idsekolah = $(this).data('id')

            $.ajax({
                url: urlsekolah + 'editDataSekolah_json',
                data: {
                    id: idsekolah
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#id').val(data.id_sekolah)
                    $('#nama').val(data.nama_sekolah)
                    $('#kota').val(data.kota)
                    $('#alamat').val(data.alamat)
                }
            })
        })

        //---->||  Delete Sintaks  ||<----//
        $('.table').on('click', '.btn-delete', function(e) {

            e.preventDefault()
            const href = $(this).attr('href')
            const id = $(this).data('id')

            Swal.fire({
                icon: 'warning',
                title: 'Apakah anda yakin?',
                text: "Data Sekolah tersebut akan dihapus",
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus'
            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: href,
                        data: {
                            id: id
                        },
                        method: 'POST',
                        dataType: 'json',
                        success: function(data) {

                            if (data.status == "success") 
                            {
                                Toast.fire({
                                    icon: 'success',
                                    title: data.message,
                                    width: 370
                                })

                                table.ajax.reload();
                            } 
                            else 
                            {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: data.message,
                                    footer: "<a href='" + base_url + "'>Hapus atau Ubah Data Pembimbing atau Siswa</a>"
                                })

                                table.ajax.reload();
                            }

                        }
                    })

                }
            })

        })

        //---->||  Output Action (insert & update) Data Sekolah  ||<----//
        $('#sekolah_form').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('data/sekolah/validation'); ?>",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('#aksi').attr('disabled', 'disabled')
                },
                success: function(data) {
                    if (data.error) {
                        if (data.nama_erorr != '') {
                            $('#nama_error').html(data.nama_error)
                        } else {
                            $('#nama_error').html('')
                        }
                        if (data.kota_erorr != '') {
                            $('#kota_error').html(data.kota_error)
                        } else {
                            $('#kota_error').html('')
                        }
                        if (data.alamat_erorr != '') {
                            $('#alamat_error').html(data.alamat_error)
                        } else {
                            $('#alamat_error').html('')
                        }
                    }
                    if (data.success) {

                        Toast.fire({
                            icon: 'success',
                            title: data.message,
                            width: 390
                        })

                        $('#modal-sekolah').modal('hide');
                        table.ajax.reload();

                    }

                    $('#aksi').attr('disabled', false)

                }
            })
        })

    });
</script>