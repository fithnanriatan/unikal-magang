<!-- Begin Page Content -->
<div class="container-fluid mb-5">

    <!-- Content Row -->
    <div class="row">

        <div class="col-md-6 mx-auto border bg-white rounded-lg p-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-2">
                <h4 class="mb-0 text-gray-800 font-weight-bolder m-auto"><?= $label; ?></h5>
            </div>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?= $pembimbing['id_pembimbing_sekolah']; ?>">
                <div class="form-group">
                    <label for="nama">
                        Nama Pembimbing
                    </label>
                    <input name="nama" id="nama" type="text" class="form-control bg-white" value="<?= $value['nama']; ?>">
                    <?= form_error('nama', '<small class="form-text text-danger ml-1">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="telp">
                        No Telephone
                    </label>
                    <input name="telp" id="telp" type="text" class="form-control bg-white" value="<?= $value['telp']; ?>">
                    <?= form_error('telp', '<small class="form-text text-danger ml-1">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="email">
                        E-Mail
                    </label>
                    <input name="email" id="email" type="text" class="form-control bg-white" value="<?= $value['email']; ?>">
                    <?= form_error('email', '<small class="form-text text-danger ml-1">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="alamat">
                        Alamat
                    </label>
                    <textarea name="alamat" id="alamat" class="form-control bg-white" rows="3"><?= $value['alamat']; ?></textarea>
                    <?= form_error('alamat', '<small class="form-text text-danger ml-1">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="asalsekolah">
                        Asal Sekolah
                    </label>
                    <select class="form-control" name="asalsekolah" id="asalsekolah">
                        <?php foreach ($sekolah as $s) : ?>
                            <?php if ($s['id_sekolah'] == $value['sekolah']) : ?>
                                <option value="<?= $value['sekolah']; ?>" selected><?= $s['nama_sekolah']; ?></option>
                            <?php else : ?>
                                <option value="<?= $s['id_sekolah']; ?>"><?= $s['nama_sekolah']; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mt-4">
                    <a href="<?= base_url('data/pembimbingsekolah'); ?>" class="btn btn-danger">Batal</a>
                    <button name="submit" type="submit" class="btn btn-primary" value="submit">Ubah Data</button>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- End of Main Content -->