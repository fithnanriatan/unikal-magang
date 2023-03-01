<!-- Begin Page Content -->
<div class="container-fluid mb-5">

    <!-- Content Row -->
    <div class="row">

        <div class="col-md-6 mx-auto border bg-white rounded-lg p-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-2">
                <h4 class="mb-0 text-gray-800 font-weight-bolder m-auto"><?= $label; ?></h5>
            </div>
            <?php echo form_open_multipart('data/siswa/ubahDataAction'); ?>
            <input type="hidden" name="id_siswa" value="<?= $siswa['id_siswa']; ?>">
            <div class="form-group d-flex mt-3">
                <label for="foto">
                    <img src="<?= base_url('assets/db_foto/' . $siswa['foto']); ?>" class="img-thumbnail" style="max-height: 240px;" alt="...">
                </label>
                <div class="custom-file ml-2">
                    <input type="file" id="foto" name="foto" class="custom-file-input">
                    <label class="custom-file-label" for="foto">Ganti Foto</label>
                    <small class="form-text text-danger ml-1"><?= $this->session->flashdata('foto_validation'); ?></small>
                </div>
            </div>
            <div class="form-group">
                <label for="nama">
                    Nama Siswa
                </label>
                <input name="nama" id="nama" type="text" class="form-control bg-white" value="<?= $siswa['nama_siswa']; ?>">
                <?= form_error('nama', '<small class="form-text text-danger ml-1">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="nisn">
                    NISN (Nomor Induk Siswa Nasional)
                </label>
                <input name="nisn" id="nisn" type="text" class="form-control bg-white" value="<?= $siswa['nisn']; ?>">
                <?= form_error('nisn', '<small class="form-text text-danger ml-1">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="telp">
                    No Telephone
                </label>
                <input name="telp" id="telp" type="text" class="form-control bg-white" value="<?= $siswa['no_telp']; ?>">
                <?= form_error('telp', '<small class="form-text text-danger ml-1">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="email">
                    E-Mail
                </label>
                <input name="email" id="email" type="text" class="form-control bg-white" value="<?= $siswa['email']; ?>">
                <?= form_error('email', '<small class="form-text text-danger ml-1">', '</small>'); ?>
            </div>
            <div class="form-group d-flex justify-content-between">
                <div class="w-100 mr-3">
                    <label for="tempat" class="text-truncate">
                        Tempat Lahir (kota)
                    </label>
                    <input name="tempat" id="tempat" type="text" class="form-control bg-white" value="<?= $siswa['tempat_lahir']; ?>">
                    <?= form_error('tempat', '<small class="form-text text-danger ml-1">', '</small>'); ?>
                </div>
                <div>
                    <label for="tanggal" class="text-truncate">
                        Tanggal Lahir
                    </label>
                    <input name="tanggal" id="tanggal" type="date" class="form-control bg-white" value="<?= $siswa['tanggal_lahir']; ?>">
                    <?= form_error('tanggal', '<small class="form-text text-danger ml-1">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="alamat">
                    Alamat
                </label>
                <textarea name="alamat" id="alamat" class="form-control bg-white" rows="3"><?= $siswa['alamat']; ?></textarea>
                <?= form_error('alamat', '<small class="form-text text-danger ml-1">', '</small>'); ?>
            </div>
            <div class="form-group d-flex justify-content-between">
                <div class="w-50 mr-2">
                    <label for="tgl-masuk">
                        Tanggal Masuk
                    </label>
                    <input name="tgl-masuk" id="tgl-masuk" type="date" class="form-control bg-white" value="<?= $siswa['tgl_masuk']; ?>">
                    <?= form_error('tgl-masuk', '<small class="form-text text-danger ml-1">', '</small>'); ?>
                </div>
                <div class="w-50 ml-2">
                    <label for="tgl-keluar">
                        Tanggal Keluar
                    </label>
                    <input name="tgl-keluar" id="tgl-keluar" type="date" class="form-control bg-white" value="<?= $siswa['tgl_keluar']; ?>">
                    <?= form_error('tgl-keluar', '<small class="form-text text-danger ml-1">', '</small>'); ?>
                    <small class="form-text text-danger ml-1"><?= $this->session->flashdata('tgl_validation'); ?></small>
                </div>
            </div>
            <div class="form-group">
                <label for="asalsekolah">
                    Asal Sekolah
                </label>
                <select class="form-control" name="asalsekolah" id="asalsekolah">
                    <?php foreach ($sekolah as $s) : ?>
                        <?php if ($siswa['id_sekolah'] == $s['id_sekolah']) : ?>
                            <option value="<?= $s['id_sekolah']; ?>" selected><?= $s['nama_sekolah'] ?></option>
                        <?php else : ?>
                            <option value="<?= $s['id_sekolah']; ?>"><?= $s['nama_sekolah']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <?= form_error('asalsekolah', '<small class="form-text text-danger ml-1">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="pem-sekolah">
                    Pembimbing Sekolah
                </label>
                <select class="form-control" name="pem-sekolah" id="pem-sekolah">
                    <?php foreach ($pem_sekolah as $ps) : ?>
                        <?php if ($siswa['id_pembimbing_sekolah'] == $ps['id_pembimbing_sekolah']) : ?>
                            <option value="<?= $ps['id_pembimbing_sekolah']; ?>" selected><?= $ps['nama_pembimbing'] ?></option>
                        <?php else : ?>
                            <option value="<?= $ps['id_pembimbing_sekolah']; ?>"><?= $ps['nama_pembimbing']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <?= form_error('pem-sekolah', '<small class="form-text text-danger ml-1">', '</small>'); ?>
            </div>
            <div class="form-group">
                <label for="pem-unikal">
                    Pembimbing Unikal
                </label>
                <select class="form-control" name="pem-unikal" id="pem-unikal">
                    <?php foreach ($pem_unikal as $pu) : ?>
                        <?php if ($siswa['id_pembimbing_unikal'] == $pu['id_pembimbing_unikal']) : ?>
                            <option value="<?= $pu['id_pembimbing_unikal']; ?>" selected><?= $pu['nama_pembimbing'] ?></option>
                        <?php else : ?>
                            <option value="<?= $pu['id_pembimbing_unikal']; ?>"><?= $pu['nama_pembimbing']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <?= form_error('pem-unikal', '<small class="form-text text-danger ml-1">', '</small>'); ?>
            </div>
            <div class="mt-4">
                <a href="<?= base_url('data/siswa'); ?>" class="btn btn-danger">Batal</a>
                <button type="submit" class="btn btn-primary">Ubah Data</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<!-- End of Main Content -->