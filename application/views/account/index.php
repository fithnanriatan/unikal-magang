<!-- Content Row -->
<div class="row" style="min-height: 65vh;">

    <div class="container min-vh-100">
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-header">
                        <p class="card-text text-primary font-weight-bold">Profil Saya</p>
                    </div>
                    <div class="px-4 pt-4 pb-1">
                        <img src="<?= base_url('assets/img/undraw_profile_2.svg'); ?>" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <p class="card-text">Nama Lengkap : <br> -<span><?= $user['nama_lengkap']; ?></span></p>
                        <p class="card-text">Username : <br> -<span><?= $user['nama_user']; ?></span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="d-flex justify-content-between h text-truncate mb-3">
                    <div>
                        <button type="button" class="btn btn-primary btn-sm tombolTambahUser" data-toggle="modal" data-target="#modal-tambah-user">+ Tambah User</button>
                    </div>
                </div>
                <div class="card table-responsive p-3">
                    <table class="table table-hover" id="tabel-user">
                        <thead class="thead-light">
                            <tr class="text-truncate">
                                <th scope="col">#</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Username</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- End of Main Content -->


<!-- Model Tambah Data Account -->
<div class="modal fade" id="modal-tambah-user" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Tambah Data Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="form-tambah-user" data-url="<?= base_url('account/tambahData'); ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Nama Lengkap:</label>
                        <input type="text" id="nama" name="nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-form-label">Username:</label>
                        <div class="input-validation">
                            <input type="text" id="username" name="username" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-6">
                            <label for="password" class="col-form-label">Password:</label>
                            <div class="input-validation">
                                <input type="password" id="password" name="password" class="form-control"></input>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="password2" class="col-form-label">Konfirm Password:</label>
                            <div class="input-validation">
                                <input type="password" id="password2" name="password2" class="form-control"></input>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Model Ubah Data Account -->
<div class="modal fade" id="modal-ubah-user" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Ubah Data Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="form-ubah-user" data-url="<?= base_url('account/ubahData'); ?>">
                <input type="hidden" name="id" id="ubah_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="ubah_nama" class="col-form-label">Nama Lengkap:</label>
                        <input type="text" id="ubah_nama" name="ubah_nama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="ubah_username" class="col-form-label">Username:</label>
                        <div class="input-validation">
                            <input type="text" id="ubah_username" name="ubah_username" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Ubah Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Model Ganti Password Account -->
<div class="modal fade" id="modal-ganti-pass" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Ganti Password Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="form-ganti-password" data-url="<?= base_url('account/gantiPassword'); ?>">
                <input type="hidden" name="id" id="id-ganti-pass">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="password-lama" class="col-form-label">Password Lama:</label>
                        <div class="input-validation">
                            <input type="password" id="password-lama" name="password_lama" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-6">
                            <label for="ubah-password" class="col-form-label">Password Baru:</label>
                            <div class="input-validation">
                                <input type="password" id="ubah-password" name="ubah_password" class="form-control"></input>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="ubah-password2" class="col-form-label">Konfirm Password:</label>
                            <div class="input-validation">
                                <input type="password" id="ubah-password2" name="ubah_password2" class="form-control"></input>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Ganti Password</button>
                </div>
            </form>
        </div>
    </div>
</div>