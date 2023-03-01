<!-- Begin Page Content -->
<div class="container-fluid mb-5">

    <!-- Content Row -->
    <div class="row">

        <div class="col-md-6 mx-auto border bg-white rounded-lg p-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-2">
                <h4 class="mb-0 text-gray-800 font-weight-bolder m-auto"><?= $label; ?></h5>
            </div>
            <form action="" method="post">
                <input type="hidden" name="id" id="id" value="<?= $pembimbing['id_pembimbing_unikal']; ?>">
                <div class="form-group">
                    <label for="nama">
                        Nama Pembimbing
                    </label>
                    <input name="nama" id="nama" type="text" class="form-control bg-white" value="<?= $pembimbing['nama_pembimbing']; ?>">
                    <?= form_error('nama', '<small class="form-text text-danger ml-1">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="telp">
                        No Telephone
                    </label>
                    <input name="telp" id="telp" type="text" class="form-control bg-white" value="<?= $pembimbing['no_telp']; ?>">
                    <?= form_error('telp', '<small class="form-text text-danger ml-1">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="email">
                        E-Mail
                    </label>
                    <input name="email" id="email" type="text" class="form-control bg-white" value="<?= $pembimbing['email']; ?>">
                    <?= form_error('email', '<small class="form-text text-danger ml-1">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="alamat">
                        Alamat
                    </label>
                    <textarea name="alamat" id="alamat" class="form-control bg-white" rows="3"><?= $pembimbing['alamat']; ?></textarea>
                    <?= form_error('alamat', '<small class="form-text text-danger ml-1">', '</small>'); ?>
                </div>
                <div class="mt-4">
                    <a href="<?= base_url('data/pembimbingunikal'); ?>" class="btn btn-danger">Batal</a>
                    <button name="ubah" type="submit" class="btn btn-primary">Ubah Data</button>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- End of Main Content -->