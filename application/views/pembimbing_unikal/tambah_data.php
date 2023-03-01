<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h3 class="mb-0 text-gray-800 m-auto">--- <?= $label; ?> ---</h2>
    </div>

    <!-- Content Row -->
    <div class="row" style="min-height: 65vh;">

        <div class="container w-50  mx-5 mt-2 mb-5 p-5 mx-auto border bg-white rounded-lg">
            <form action="" method="post">
                <div class="form-group">
                    <label for="nama">
                        Nama Pembimbing
                    </label>
                    <input name="nama" id="nama" type="text" class="form-control bg-white" value="<?= set_value('nama'); ?>">
                    <?= form_error('nama', '<small class="form-text text-danger ml-1">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="telp">
                        No Telephone
                    </label>
                    <input name="telp" id="telp" type="text" class="form-control bg-white" value="<?= set_value('telp'); ?>">
                    <?= form_error('telp', '<small class="form-text text-danger ml-1">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="email">
                        E-Mail
                    </label>
                    <input name="email" id="email" type="text" class="form-control bg-white" value="<?= set_value('email'); ?>">
                    <?= form_error('email', '<small class="form-text text-danger ml-1">', '</small>'); ?>
                </div> 
                <div class="form-group">
                    <label for="alamat">
                        Alamat
                    </label>
                    <textarea name="alamat" id="alamat" class="form-control bg-white" rows="3"><?= set_value('alamat'); ?></textarea>
                    <?= form_error('alamat', '<small class="form-text text-danger ml-1">', '</small>'); ?>
                </div>
                <div class="mt-4">
                    <a href="<?= base_url('data/pembimbingunikal'); ?>" class="btn btn-danger">Batal</a>
                    <input type="submit" class="btn btn-primary">
                </div>
            </form>
        </div>


    </div>
    <!-- End of Main Content -->