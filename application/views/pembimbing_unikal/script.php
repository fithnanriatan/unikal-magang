<script>
    $(function() {

        const base_url = $('#page-top #base-url').data('url')
        const urlpemuk = base_url + 'data/pembimbing_unikal/'

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

        table = $('#tabel-pemUnikal').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('data/pembimbing_unikal/getData'); ?>",
                "type": "POST",
            },
            "columnDefs": [{
                "targets": [0, 5],
                "orderable": false
            }, ],
        });


        //---->||  Set Model Tambah Data  ||<----//
        $('.btnAddData').on('click', function() {

            $('#modalLabel').html('Tambah Data Pembimbing Unikal')
            $('.modal-footer Button[type=submit]').html('Tambahkan')
            // $('.modal-content form').attr('action', urlpemuk + 'TambahData')
            // $('#sekolah_form input[name="jns_form"]').val('add');

            $('#id').val(null)
            $('#nama').val(null)
            $('#telp').val(null)
            $('#email').val(null)
            $('#alamat').val(null)

            $('#nama_error').html('')
            $('#telp_error').html('')
            $('#email_error').html('')
            $('#alamat_error').html('')
        })

        $('#form-pembimbing-unikal').validate({
            rules: {
                nama: {
                    required: true
                },
                telp: {
                    required: true
                },
                email: {
                    required: true
                },
                alamat: {
                    required: true,
                    minlength: 6
                },
            },
            messages: {
                nama: {
                    required: "Nama Pembimbing harus diisi"
                },
                telp: {
                    required: "No Telephone harus diisi"
                },
                email: {
                    required: "Email harus diisi"
                },
                alamat: {
                    required: "Alamat harus diisi",
                    minlength: "Minimal Alamat 6 karakter"
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.col-sm-8').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {
                const href = $('#form-pembimbing-unikal').data('url');
                $.ajax({
                    type: 'POST',
                    url: href,
                    data: $('#form-pembimbing-unikal').serialize(),
                    dataType: 'json',
                    success: function(output) {
                        if (output.success) {
                            Toast.fire({
                                icon: 'success',
                                title: output.message,
                                width: 370
                            })

                            $('#modal-pembimbing-unikal').modal('hide');
                            table.ajax.reload();

                        }
                    }
                });
            }
        });

        //---->||  Delete Sintaks  ||<----//
        $('.table').on('click', '.btn-delete', function(e) {

            e.preventDefault()
            const href = $(this).attr('href')
            const id = $(this).data('id')

            Swal.fire({
                icon: 'warning',
                title: 'Apakah anda yakin?',
                text: "Data Pembimbing tersebut akan dihapus",
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

                            if (data.status == "success") {
                                Toast.fire({
                                    icon: 'success',
                                    title: data.message,
                                    width: 370
                                })

                                table.ajax.reload();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: data.message,
                                    footer: "<a href='" + base_url + "data/siswa'>Hapus atau Ubah Data Siswa</a>"
                                })

                                table.ajax.reload();
                            }

                        }
                    })

                }
            })

        })

    });
</script>