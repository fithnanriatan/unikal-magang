<div class="container min-vh-100">
	<div class="row">
		<div class="col">
			<div class="d-flex justify-content-between mb-3">
				<div>
					<a href="<?= base_url('data/siswa/tambahdata'); ?>" class="btn btn-primary btn-sm">
						+ Tambah Siswa</a>
				</div>
				<form action="<?= base_url('data/siswa/laporan_pdf'); ?>" target="_blank" method="post">
					<div>
						<button type="submit" class="btn btn-warning btn-sm">
							# Cetak Data</button>
					</div>
			</div>
		</div>
	</div>
	<div class="card shadow mb-2">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Filter Tabel Siswa</h6>
		</div>
		<div class="card-body px-3 py-2 pt-3">
		<div class="row mb-2">
			<div class="col-md-4">
				<label for="bln_awal">
					Bulan Awal
				</label>
				<input name="bln_awal" id="bln_awal" type="month" class="form-control bg-white">
			</div>
			<div class="col-md-4">
				<label for="bln_akhir">
					Bulan Akhir
				</label>
				<input name="bln_akhir" id="bln_akhir" type="month" class="form-control bg-white">
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="angkatan">
						Angkatan
					</label>
					<select class="form-control" name="angkatan" id="angkatan">
						<?php $tahun = date('Y');
						for ($i = 2020; $i < $tahun + 3; $i++) : ?>
							<?php if ($i == date('Y')) : ?>
								<option value="<?= $i; ?>" selected><?= $i; ?>/<?= $i + 1; ?></option>
							<?php else : ?>
								<option value="<?= $i; ?>"><?= $i; ?>/<?= $i + 1; ?></option>
							<?php endif; ?>
						<?php endfor; ?>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="flt_sekolah">
						Asal Sekolah
					</label>
					<select class="form-control" name="flt_sekolah" id="flt_sekolah">
						<option value="">-- Pilih Sekolah --</option>
						<?php foreach ($sekolah as $s) : ?>
							<option value="<?= $s['id_sekolah']; ?>"><?= $s['nama_sekolah']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="flt_pembimbing">
						Pembimbing Unikal
					</label>
					<select class="form-control" name="flt_pembimbing" id="flt_pembimbing">
						<option value="" selected>-- Pilih Pembimbing Unikal --</option>
						<?php foreach ($pem_unikal as $pu) : ?>
							<option value="<?= $pu['id_pembimbing_unikal']; ?>"><?= $pu['nama_pembimbing']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form_group">
					<label for="status">
						Status
					</label>
					<select name="flt_status" id="flt_status" class="form-control">
						<option value="">-- Pilih Status --</option>
						<option value="pending">Pending</option>
						<option value="active">Active</option>
						<option value="alumni">Alumni</option>
					</select>
				</div>
			</div>
		</div>
		</div>
	</div>
	</form>
	<div class="row">
		<div class="col">
			<div class="card shadow table-responsive p-3">
				<table class="table table-hover" id="tabel-siswa">
					<thead class="thead-light">
						<tr>
							<th scope="col" class="text-truncate">#</th>
							<th scope="col" class="text-truncate">Nama</th>
							<th scope="col" class="text-truncate">Asal Sekolah</th>
							<th scope="col" class="text-truncate">Pembimbing</th>
							<th scope="col" class="text-truncate">Tgl Masuk</th>
							<th scope="col" class="text-truncate">Tgl Keluar</th>
							<th scope="col" class="text-truncate">Status</th>
							<th scope="col" class="text-truncate">Aksi</th>
						</tr>
					</thead>
					<tbody class="text-truncate">

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>