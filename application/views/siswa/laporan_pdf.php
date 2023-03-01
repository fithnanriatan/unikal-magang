<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        div {
            display: flex;
        }

        h2 {
            text-align: center;
        }

        .table-header {
            background-color: gray;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
</head>

<body>
    <div>
        <h2>Laporan Anak Magang</h1>
            <br>
            <hr>
            <hr>
    </div>
    <div>
        <p>Jangka Waktu <?= $filter['bln_awal']; ?> <?= $filter['bln_akhir']; ?></p>
    </div>
    <div>
        <table border="1" cellpadding="4" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col" class="table-header">#</th>
                    <th scope="col" class="table-header">Nama</th>
                    <th scope="col" class="table-header">Asal Sekolah</th>
                    <th scope="col" class="table-header">Pembimbing</th>
                    <th scope="col" class="table-header">Tanggal Masuk</th>
                    <th scope="col" class="table-header">Tanggal Keluar</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($siswa as $s) : ?>
                    <tr>
                        <th><?= $i++; ?></th>
                        <th><?= $s['nama_siswa']; ?></th>
                        <th><?= $s['nama_sekolah']; ?></th>
                        <th><?= $s['nama_pemuk']; ?></th>
                        <th><?= $s['tgl_masuk']; ?></th>
                        <th><?= $s['tgl_keluar']; ?></th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>