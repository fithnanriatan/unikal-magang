<script>
    $(document).ready(function() {

        const base_url = $('#page-top #base-url').data('url')

        var table;

        table = $('#tabel-pembimbing-sekolah').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('data/pembimbing_sekolah/getData/'); ?>",
                "type": "POST",
            },
            "columnDefs": [{
                "targets": [0, 6],
                "orderable": false
            }],
        });

        //---->||  Set Modal Tambah Data  ||<----//
        $('#tombol-tambah').on('click', function() {

            $('#form_pembimbing_sekolah').trigger("reset");
            $('.input-validation .form-control').removeClass('is-invalid')

            $('#modalLabel').html('Tambah Data Pembimbing Sekolah')
            $('.modal-footer Button[type=submit]').html('Tambahkan')
            $('#form_pembimbing_sekolah input[name="jenis-form"]').val('tambahData');
        })

        //---->||  Set Modal Ubah Data  ||<----//
        $('#tabel-pembimbing-sekolah').on('click', '#tombol-ubah', function() {

            $('#form_pembimbing_sekolah').trigger("reset");
            $('.input-validation .form-control').removeClass('is-invalid')

            $('#modalLabel').html('Ubah Data Pembimbing Sekolah')
            $('.modal-footer Button[type=submit]').html('Ubah Data')
            $('#form_pembimbing_sekolah input[name="jenis-form"]').val('ubahData');

            const idpemuk = $(this).data('id')

            $.ajax({
                url: base_url + 'data/pembimbing_sekolah/dataPembimbing_json',
                data: {
                    id: idpemuk
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#id').val(data.id_pembimbing_sekolah)
                    $('#nama').val(data.nama_pembimbing)
                    $('#telp').val(data.no_telp)
                    $('#email').val(data.email)
                    $('#alamat').val(data.alamat)
                    $('div.option_asal select').val(data.id_sekolah);
                }
            })
        })

        //---->||  Exsekutor Action Form Sekolah  ||<----//
        $('#form_pembimbing_sekolah').validate({
            rules: {
                nama: 'required',
                telp: {
                    required: true,
                    digits: true
                },
                email: 'email',
                alamat: {
                    minlength: 6
                },
                asalsekolah: 'required'
            },
            messages: {
                nama: "Nama Pembimbing harus diisi",
                telp: {
                    required: 'No Telephone harus diisi',
                    digits: 'No telepon hanya dapat berisi angka'
                },
                email: "Masukkan Email yang valid",
                alamat: "Minimal Alamat berisi 6 karakter",
                asalsekolah: "Harap pilih Asal Sekolah terlebih dahulu"
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
                const href = $('#form_pembimbing_sekolah').data('url');
                const jenis = $('#form_pembimbing_sekolah #jenis-form').val();
                const link = href + jenis;
                $.ajax({
                    type: 'POST',
                    url: link,
                    data: $('#form_pembimbing_sekolah').serialize(),
                    dataType: 'json',
                    success: function(output) {
                        if (output.success) {
                            Toast.fire({
                                icon: 'success',
                                title: output.message,
                                width: 370
                            })

                            $('#modal-pembimbing-sekolah').modal('hide');
                            table.ajax.reload();
                        }
                        
                    }
                });
            }
        });

        //---->||  Delete Sintaks  ||<----//\\
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