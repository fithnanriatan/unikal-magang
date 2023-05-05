<!-- Begin Page Content -->
<div class="container-fluid">
	<div class="d-flex justify-content-between">
		<div>
			<button id="tombol-tambah" type="button" data-toggle="modal" data-target="#modal-pembimbing-unikal" class="btn btn-primary btn-sm mb-3">
				+ Tambah Pembimbing</button>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<div class="card table-responsive p-3">
				<table class="table table-hover" id="tabel-pembimbing-unikal">
					<thead class="thead-light">
						<tr class="text-truncate">
							<th scope="col">#</th>
							<th scope="col">Nama</th>
							<th scope="col">Alamat</th>
							<th scope="col">No. Telp</th>
							<th scope="col">E-Mail</th>
							<th scope="col">Aksi</th>
						</tr>
					</thead>
					<tbody class="text-truncate">

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- End of Main Content -->

<!-- Model Data Pembimbing Unikal -->
<div class="modal fade" id="modal-pembimbing-unikal" tabindex="-1">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalLabel">Action Data Pembimbing Unikal</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="form-pembimbing-unikal" action="javascript:void(0)" data-url="<?= base_url('data/pembimbing_unikal/'); ?>">
				<input type="hidden" name="id" id="id">
				<input type="hidden" name="jenis-form" id="jenis-form">
				<div class="modal-body">
					<div class="form-group">
						<label for="nama" class="col-form-label">Nama Pembimbing: (wajib)</label>
						<div class="input-validation">
							<input type="text" id="nama" name="nama" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="telp" class="col-form-label">No Telephone:</label>
						<div class="input-validation">
							<input type="text" id="telp" name="telp" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-form-label">E-Mail:</label>
						<div class="input-validation">
							<input type="text" id="email" name="email" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="alamat" class="col-form-label">Alamat:</label>
						<div class="input-validation">
							<textarea type="text" id="alamat" name="alamat" class="form-control" rows="3"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					<button type="submit" id="aksi" name="aksi" class="btn btn-primary">Action</button>
				</div>
			</form>
		</div>
	</div>
</div>