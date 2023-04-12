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
                "url": "<?= base_url('data/sekolah/getData'); ?>",
                "type": "POST"
            },
            "columnDefs": [{
                "targets": [0, 3],
                "orderable": false
            }]
        });

        //---->||  Set Modal Tambah Data  ||<----//
        $('.tombolTambahSekolah').on('click', function() {

            $('#modalLabel').html('Tambah Data Sekolah')
            $('.modal-footer Button[type=submit]').html('Tambahkan')
            $('#form-sekolah input[name="jns_form"]').val('tambahData');

            $('#id').val(null)
            $('#nama').val(null)
            $('#kota').val(null)
            $('#alamat').val(null)

            $('.input-validation .form-control').removeClass('is-invalid')
        })

        //---->||  Set Modal Ubah Data  ||<----//
        $('#tabel-sekolah').on('click', '.tombolUbahSekolah', function() {

            $('#modalLabel').html('Ubah Data Sekolah')
            $('.modal-footer Button[type=submit]').html('Ubah Data')
            $('#form-sekolah input[name="jns_form"]').val('ubahData');

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

        //---->||  Validasi Tabel Sekolah Action  ||<----//
        $('#form-sekolah').validate({
            rules: {
                nama: 'required',
                kota: 'required',
                alamat: 'required'
            },
            messages: {
                nama: "Nama Sekolah harus diisi",
                kota: "Asal Kota harus diisi",
                alamat: "Alamat harus diisi"
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
                const href = $('#form-sekolah').data('url');
                const jenis = $('#form-sekolah #jenis-form').val();
                const link = href + jenis;
                $.ajax({
                    type: 'POST',
                    url: link,
                    data: $('#form-sekolah').serialize(),
                    dataType: 'json',
                    success: function(output) {
                        if (output.success) {
                            Toast.fire({
                                icon: 'success',
                                title: output.message,
                                width: 370
                            })

                            $('#modal-sekolah').modal('hide');
                            table.ajax.reload();
                        }
                        
                    }
                });
            }
        });

        //---->||  Delete Sintaks  ||<----//
        $('#tabel-sekolah').on('click', '.btn-delete', function(e) {

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
                        data: {id: id},
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

    });
</script>