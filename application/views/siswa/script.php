<script>
    $(function() {

        // Default Alert
        const Alert = Swal.mixin({
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

        table = $('.card #tabel-siswa').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('data/siswa/getData'); ?>",
                "type": "POST",
                "data": function(data) {
                    data.bln_awal   = $('#bln_awal').val()
                    data.bln_akhir  = $('#bln_akhir').val()
                    data.sekolah    = $('#flt_sekolah').val()
                    data.pembimbing = $('#flt_pembimbing').val()
                }
            },
            "columnDefs": [{
                "targets": [0, 6, 7],
                "orderable": false
            }]
        });

        // Filter Asal Sekolah
        $('#flt_sekolah').on('change', function() {
            table.ajax.reload()
        })
        // Filter Pembimbing Unikal
        $('#flt_pembimbing').on('change', function() {
            table.ajax.reload()
        })
        // Filter Bulan Masuk
        $('#bln_awal').on('change', function() {
            table.ajax.reload()
            console.log($('#bln_awal').val());
        })
        // Filter Bulan Masuk
        $('#bln_akhir').on('change', function() {
            table.ajax.reload()
            console.log($('#bln_akhir').val());
        })

        //---->||  Input File Foto  ||<----//
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        //---->||  Delete Validaton  ||<----//
        $('.table').on('click', '.btn-hapus', function(e) {

            e.preventDefault()
            const href = $(this).attr('href')
            const id = $(this).data('id');

            Swal.fire({
                icon: 'warning',
                title: 'Apakah anda yakin?',
                text: "Data Siswa akan dihapus",
                confirmButtonText: 'Hapus',
                showCancelButton: true,
                cancelButtonColor: '#3085d6',
                confirmButtonColor: '#d33'
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

                            Alert.fire({
                                icon: 'success',
                                title: data.message,
                                width: 370
                            })

                            table.ajax.reload()

                        }
                    })

                }
            })

        })

    })
</script>