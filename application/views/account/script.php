<script>
    $(function() {

        const base_url = $('#page-top #base-url').data('url')
        const urluser = base_url + 'account/'

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

        table = $('.card #tabel-user').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('Account/getData/'); ?>",
                "type": "POST"
            },
            "columnDefs": [{
                "targets": [0, 3],
                "orderable": false
            }]
        });


        //---->||  Set Model Tambah Data  ||<----//
        $('.tombolTambahUser').on('click', function() {

            $('#id').val(null)
            $('#nama').val(null)
            $('#username').val(null)
            $('#password').val(null)
            $('#password2').val(null)

            $('.input-validation .form-control').removeClass('is-invalid')
        })

        //---->||  Tambah Account Validasi  ||<----//
        $('#form-tambah-user').validate({
            rules: {
                username: 'required',
                password: {
                    required: true,
                    minlength: 5
                },
                password2: {
                    required: true,
                    minlength: 5,
                    equalTo: '#password'
                }
            },
            messages: {
                username: "Username harus diisi",
                password: {
                    required: "Password harus diisi",
                    minlength: "Password minimal berisi 5 karakter"
                },
                password2: {
                    required: "Konfirmasi Password harus diisi",
                    minlength: "Password minimal berisi 5 karakter",
                    equalTo: "Password tidak sesuai"
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.input-validation').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {
                const href = $('#form-tambah-user').data('url');
                $.ajax({
                    type: 'POST',
                    url: href,
                    data: $('#form-tambah-user').serialize(),
                    dataType: 'json',
                    success: function(output) {
                        if (output.success) {
                            Toast.fire({
                                icon: 'success',
                                title: output.message,
                                width: 370
                            })

                            $('#modal-tambah-user').modal('hide');
                            table.ajax.reload();

                        }
                    }
                });
            }
        });

        //---->||  Set Modal Ubah Data  ||<----//
        $('#tabel-user').on('click', '.tombolUbahUser', function() {

            $('.input-validation .form-control').removeClass('is-invalid')

            const iduser = $(this).data('id')

            $.ajax({
                url: urluser + 'getUserById',
                data: {
                    id: iduser
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#ubah_id').val(data.id_user)
                    $('#ubah_nama').val(data.nama_lengkap)
                    $('#ubah_username').val(data.nama_user)
                }
            })
        })
        //---->||  Ubah Account Validasi  ||<----//
        $('#form-ubah-user').validate({
            rules: {
                ubah_username: 'required'
            },
            messages: {
                ubah_username: "Username harus diisi"
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.input-validation').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {
                const href = $('#form-ubah-user').data('url');
                $.ajax({
                    type: 'POST',
                    url: href,
                    data: $('#form-ubah-user').serialize(),
                    dataType: 'json',
                    success: function(output) {
                        if (output.success) {
                            Toast.fire({
                                icon: 'success',
                                title: output.message,
                                width: 370
                            })

                            $('#modal-ubah-user').modal('hide');
                            table.ajax.reload();

                        }
                    }
                });
            }
        });


        //---->||  Set Modal Ubah Password  ||<----//
        $('#tabel-user').on('click', '.tombolGantiPass', function() {

            $('.input-validation .form-control').removeClass('is-invalid')

            const iduser = $(this).data('id')

            $.ajax({
                url: urluser + 'getUserById',
                data: {
                    id: iduser
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#id-ganti-pass').val(data.id_user)
                }
            })
        })

        $.validator.addMethod('validPassLama',
            function(value) {
                var pass;
                $.ajax({
                    type: 'POST',
                    url: urluser + 'validasiPassLama',
                    data: $('#form-ganti-password').serialize(),
                    dataType: 'json',
                    success: function(output) {
                        if (output.success == true) {
                            pass = output.password
                        } else {
                            pass = false
                        }
                    }
                });
                return value == pass;
            },
            'Password Lama Salah'
        )
        $('#form-ganti-password').validate({
            rules: {
                password_lama: {
                    validPassLama: true,
                    required: true
                },
                ubah_password: 'required',
                ubah_password2: 'required'
            },
            message: {
                ubah_password: 'kolom Password harus diisi',
                ubah_password2: 'kolom Konfirm Password harus diisi',
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.input-validation').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {
                const href = $('#form-ganti-password').data('url');
                $.ajax({
                    type: 'POST',
                    url: href,
                    data: $('#form-ganti-password').serialize(),
                    dataType: 'json',
                    success: function(output) {
                        if (output.success) {
                            Toast.fire({
                                icon: 'success',
                                title: output.message,
                                width: 370
                            })

                            $('#modal-ganti-pass').modal('hide');
                            table.ajax.reload();

                        }
                    }
                });
            }

        })
        //---->||  Delete Sintaks  ||<----//
        $('.table').on('click', '.btn-delete', function(e) {

            e.preventDefault()
            const href = $(this).attr('href')
            const id = $(this).data('id')

            Swal.fire({
                icon: 'warning',
                title: 'Apakah anda yakin?',
                text: "Data Account tersebut akan dihapus",
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

                            Toast.fire({
                                icon: 'success',
                                title: data.message,
                                width: 370
                            })

                            table.ajax.reload();
                        }
                    })

                }
            })

        })
    })
</script>