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

        table = $('#tabel-pembimbing-unikal').DataTable({
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
        $('#tombol-tambah').on('click', function() {

            $('#modalLabel').html('Tambah Data Pembimbing Unikal')
            $('.modal-footer Button[type=submit]').html('Tambahkan')
            $('#form-pembimbing-unikal input[name="jenis-form"]').val('tambahData');

            $('#id').val(null)
            $('#nama').val(null)
            $('#telp').val(null)
            $('#email').val(null)
            $('#alamat').val(null)

            $('.input-validation .form-control').removeClass('is-invalid')
        })

        //---->||  Set Model Ubah Data  ||<----//
        $('#tabel-pembimbing-unikal').on('click', '#tombol-ubah', function() {
 
            $('#modalLabel').html('Ubah Data Pembimbing Unikal')
            $('.modal-footer Button[type=submit]').html('Ubah Data')
            $('#form-pembimbing-unikal input[name="jenis-form"]').val('ubahData');

            const idpemuk = $(this).data('id');

            $.ajax({
                url: urlpemuk + 'editDataPemuk_json',
                data: {
                    id: idpemuk
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {

                    $('#id').val(data.id_pembimbing_unikal);
                    $('#nama').val(data.nama_pembimbing)
                    $('#telp').val(data.no_telp)
                    $('#email').val(data.email)
                    $('#alamat').val(data.alamat)
                }
            })

            $('.input-validation .form-control').removeClass('is-invalid')
        })

        //---->||  Exsekutor Form Pembimbing Unikal Action  ||<----//
        $('#form-pembimbing-unikal').validate({
            rules: {
                nama: 'required',
                telp: 'digits',
                email: 'email',
                alamat: {
                    minlength: 6
                }
            },
            messages: {
                nama: "Nama Pembimbing harus diisi",
                telp: "No telepon hanya dapat berisi angka",
                email: "Masukkan Email yang valid",
                alamat: {
                    minlength: "Minimal Alamat berisi 6 karakter"
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
                const href = $('#form-pembimbing-unikal').data('url');
                const jenis = $('#form-pembimbing-unikal #jenis-form').val();
                const link = href + jenis;
                $.ajax({
                    type: 'POST',
                    url: link,
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