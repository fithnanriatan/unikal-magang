<div class="container min-vh-100">
    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-between h text-truncate mb-3">
                <div>
                    <button type="button" class="btn btn-primary btn-sm tombolTambahSekolah" data-toggle="modal" data-target="#modal-sekolah">+ Tambah Sekolah</button>
                </div>
            </div>
            <div class="card table-responsive p-3">
                <table class="table table-hover" id="tabel-sekolah">
                    <thead class="thead-light">
                        <tr class="text-truncate">
                            <th scope="col">#</th>
                            <th scope="col">Nama Sekolah</th>
                            <th scope="col">Kota Asal</th>
                            <th scope="col">Alamat&emsp;&emsp;&emsp;</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Model Data Sekolah -->
<div class="modal fade" id="modal-sekolah" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Tambah Data Sekolah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="sekolah_form" action="addDataSekolah">
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="jns_form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Nama Sekolah:</label>
                        <input type="text" id="nama" name="nama" class="form-control">
                        <small id="nama_error" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="kota" class="col-form-label">Kota Asal:</label>
                        <input type="text" id="kota" name="kota" class="form-control">
                        <small id="kota_error" class="text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="col-form-label">Alamat:</label>
                        <textarea type="text" id="alamat" name="alamat" class="form-control" rows="3"></textarea>
                        <small id="alamat_error" class="text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="aksi" name="aksi" class="btn btn-primary"></button>
                </div>
            </form>
        </div>
    </div>
</div>