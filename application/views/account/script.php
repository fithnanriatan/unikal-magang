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

            $('#modalLabel').html('Tambah Data User')
            $('.modal-footer Button[type=submit]').html('Tambahkan')
            $('.modal-content form').attr('action', urluser + 'addDataUser')
            $('#user_form input[name="jns_form"]').val('add');

            $('#id').val(null)
            $('#nama').val(null)
            $('#username').val(null)
            $('#password').val(null)
            $('#password2').val(null)
        })

        //---->||  Set Modal Ubah Data  ||<----//
        $('#tabel-user').on('click', '.tombolUbahUser', function() {

            $('#modalLabel').html('Ubah Data User')
            $('.modal-footer Button[type=submit]').html('Ubah Data')
            $('.modal-content form').attr('action', urluser + 'editDataUser');
            $('#user_form input[name="jns_form"]').val('edit');

            const iduser = $(this).data('id')

            $.ajax({
                url: urluser + 'editDataUser_json',
                data: {
                    id: iduser
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#id').val(data.id_user)
                    $('#nama').val(data.nama_lengkap)
                    $('#username').val(data.nama_user)
                    $('#password').val('')
                    $('#password2').val('')
                }
            })
        })

        $('#form-user').validate({
            rules: {
                username: {
                    required: true
                },
                password: {
                    required: true,
                    minlength: 5
                },
                password2: {
                    required: true,
                    minlength: 5
                }
            },
            messages: {
                username: {
                    required: "Username harus diisi"
                },
                password: {
                    required: "Password harus diisi",
                    minlength: "Password minimal berisi 5 karakter"
                },
                password2: {
                    required: "Konfirmasi Password harus diisi",
                    minlength: "Password minimal berisi 5 karakter"
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
                const href = $('#form-user').data('url');
                $.ajax({
                    type: 'POST',
                    url: href,
                    data: $('#form-user').serialize(),
                    dataType: 'json',
                    success: function(output) {
                        if (output.success) {
                            Toast.fire({
                                icon: 'success',
                                title: output.message,
                                width: 370
                            })

                            $('#modal-user').modal('hide');
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