<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row" style="min-height: 65vh;">

        <div class="ml-2">
            <a href="<?= base_url('data/siswa'); ?>"><i class="fas fa-arrow-left fa-lg"></i></a>
        </div>

        <div class="col">
            <div class="container d-flex justify-content-center">
                <div class="card mb-5" style="max-width: 640px;">
                
                    <h5 class="card-header bg-primary text-white"><?= $label; ?></h5>
                    <div class="row no-gutters px-3 py-3 border">

                        <div class="card col-md-4 overflow-hidden" style="max-height: 240px;">
                            <img src="<?= base_url('assets/db_foto/' . $siswa['foto']); ?>" class="card-img" alt="..,<?= $siswa['foto']; ?>">
                        </div>
                        
                        <div class="col-md-8">
                            <div class="card-body pt-3">
                                <span class="badge badge-<?= $color; ?> badge-sm mb-2 float-right"><?= $status; ?></span>
                                <h5 class="card-title font-weight-bold mb-2"><?= $siswa['nama_siswa']; ?></h5>
                                <div class="overflow-auto">
                                    <table>
                                        <tbody class="align-top">
                                            <tr>
                                                <td>NISN</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><?= $siswa['nisn']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>TTL</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><?= $siswa['tempat_lahir']; ?>, <span><?= $siswa['tanggal_lahir']; ?></span></td>
                                            </tr>
                                            <tr>
                                                <td>Telephone</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><?= $siswa['no_telp']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>E-Mail</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><?= $siswa['email']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td>&nbsp;:&nbsp;</td>
                                                <td><?= $siswa['alamat']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row no-gutters p-3 pt-0">
                        <div class="col">
                            <div class="card-body">
                                <div class="text-center mb-3 ">
                                    <h6 class="card-subtitle mb-1 text-primary">Durasi Magang</h6>
                                    <p class="card-text my-0 text-primary"><?= $siswa['tgl_masuk']; ?>&ensp;<i class="fas fa-long-arrow-alt-right"></i>&ensp;<?= $siswa['tgl_keluar']; ?></p>
                                </div>
                                <div class="overflow-auto">
                                    <table>
                                        <tbody class="align-top text-truncate">
                                            <tr>
                                                <td>
                                                    <li>Asal Sekolah</li>
                                                </td>
                                                <td>&emsp;&ensp;:&ensp;</td>
                                                <td><?= $siswa['nama_sekolah']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <li>Pembimbing Sekolah</li>
                                                </td>
                                                <td>&emsp;&ensp;:&ensp;</td>
                                                <td><?= $siswa['nama_pemsek']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <li>Pembimbing Unikal</li>
                                                </td>
                                                <td>&emsp;&ensp;:&ensp;</td>
                                                <td><?= $siswa['nama_pemuk']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End of Main Content -->