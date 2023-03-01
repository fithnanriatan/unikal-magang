<script>
    $(document).ready(function() {

        const base_url = $('#page-top #base-url').data('url')

        var table;

        table = $('#tabel-pemSekolah').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('data/pembimbingsekolah/getData/'); ?>",
                "type": "POST",
            },
            "columnDefs": [{
                "targets": [0, 6],
                "orderable": false
            }, ],
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