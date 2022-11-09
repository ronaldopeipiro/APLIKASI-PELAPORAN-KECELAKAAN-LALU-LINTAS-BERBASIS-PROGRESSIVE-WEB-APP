<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container-xl">
	<!-- Page title -->
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
				<!-- Page pre-title -->
				<div class="page-pretitle">
					Home
				</div>
				<h2 class="page-title">
					<?= $title; ?>
				</h2>
			</div>

		</div>
	</div>
</div>

<div class="page-body">
	<div class="container-xl">
		<div class="row row-deck row-cards">

			<div class="col-lg-9 mb-2">
				<div class="card shadow">

					<div class="card-header">
						<h3 class="card-title">
							<i class="fa fa-edit"></i>
							Ubah Data Akun
						</h3>
					</div>

					<div class="card-body border-bottom py-2">

						<form id="formUpdateDataAkun">
							<?= csrf_field(); ?>

							<input type="hidden" name="id_pelapor" id="id_pelapor" value="<?= $user_id_pelapor; ?>">

							<div class="form-group row mt-3">
								<label for="nama_lengkap" class="col-sm-3 col-form-label">
									Nama Lengkap
								</label>
								<div class="col-sm-9">
									<input type="text" class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap ..." value="<?= (old('nama_lengkap')) ? old('nama_lengkap') : $user_nama_lengkap; ?>">
									<div class="invalid-feedback">
										<?= $validation->getError('nama_lengkap'); ?>
									</div>
								</div>
							</div>

							<div class="form-group row mt-3">
								<label for="nik" class="col-sm-3 col-form-label">
									NIK
								</label>
								<div class="col-sm-9">
									<input type="text" class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" id="nik" name="nik" value="<?= (old('nik')) ? old('nik') : $user_nik; ?>" placeholder="Masukkan NIK . . . ." oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" minlength="16" maxlength="16">
									<div class="invalid-feedback">
										<?= $validation->getError('nik'); ?>
									</div>
								</div>
							</div>

							<div class="form-group row mt-3">
								<label for="tanggal_lahir" class="col-sm-3 col-form-label">
									Tanggal Lahir
								</label>
								<div class="col-sm-4">
									<input type="date" class="form-control <?= ($validation->hasError('tanggal_lahir')) ? 'is-invalid' : ''; ?>" id="tanggal_lahir" name="tanggal_lahir" placeholder="" value="<?= (old('tanggal_lahir')) ? old('tanggal_lahir') : $user_tanggal_lahir; ?>">
									<div class="invalid-feedback">
										<?= $validation->getError('tanggal_lahir'); ?>
									</div>
								</div>
							</div>

							<div class="form-group row mt-3">
								<label for="email" class="col-sm-3 col-form-label">
									Email
								</label>
								<div class="col-sm-9">
									<input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Masukkan email ..." value="<?= (old('email')) ? old('email') : $user_email; ?>" readonly>
									<div class="invalid-feedback">
										<?= $validation->getError('email'); ?>
									</div>
								</div>
							</div>

							<div class="form-group row mt-3">
								<label for="no_hp" class="col-sm-3 col-form-label">
									No. Handphone
								</label>
								<div class="col-sm-4">
									<input type="text" class="form-control <?= ($validation->hasError('no_hp')) ? 'is-invalid' : ''; ?>" id="no_hp" name="no_hp" placeholder="08XX XXXX . . . ." value="<?= (old('no_hp')) ? old('no_hp') : $user_no_hp; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" minlength="11" maxlength="13">
									<div class="invalid-feedback">
										<?= $validation->getError('no_hp'); ?>
									</div>
								</div>
							</div>

							<div class="form-group row mt-3">
								<label for="alamat" class="col-sm-3 col-form-label">
									Alamat
								</label>
								<div class="col-sm-9">
									<textarea name="alamat" id="alamat" rows="4" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" placeholder="Masukkan Alamat ..."><?= (old('alamat')) ? old('alamat') : $user_alamat; ?></textarea>
									<div class="invalid-feedback">
										<?= $validation->getError('alamat'); ?>
									</div>
								</div>
							</div>

							<div class="form-group row mt-4 mb-2">
								<div class="col-12">
									<button type="submit" class="btn btn-outline-success shadow" style="width: 180px;">
										<span class="fa fa-save" style="margin-right: 10px;"></span> SIMPAN
									</button>
								</div>
							</div>

						</form>

					</div>

				</div>
			</div>

			<div class="col-lg-3 mb-2">
				<div class="card shadow">
					<div class="card-header">
						<h3 class="card-title">
							<span class="fa fa-image"></span>
							Ubah Foto Profil
						</h3>
					</div>
					<div class="card-body border-bottom py-0">

						<form id="formUbahFotoProfil">

							<div class="form-group row mt-3">
								<div class="col-lg-12 text-center">
									<img id="fotobaru" src="<?= $user_foto; ?>" style="width: 180px; height: 180px; border-radius: 10px; object-fit: cover; object-position: center;">
								</div>
								<div class="col-sm-12 mt-3">
									<input type="file" class="form-control <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto" required onchange="readURL(this)">
									<div class="invalid-feedback">
										<?= $validation->getError('foto'); ?>
									</div>
								</div>
							</div>

							<div class="form-group row mt-4 mb-2">
								<div class="col-sm-12">
									<button type="submit" class="btn btn-outline-success shadow" style="width: 180px;">
										<span class="fa fa-save" style="margin-right: 10px;"></span> SIMPAN
									</button>
								</div>
							</div>
						</form>

					</div>

				</div>
			</div>

			<div class="col-lg-12 mb-2">
				<div class="card shadow">
					<div class="card-body border-bottom py-4">

						<a href="<?= base_url(); ?>/pelapor/logout" class="btn btn-outline-dark btn-logout shadow" style="width: 220px;">
							<i class="fa fa-sign-out-alt" style="margin-right: 10px;"></i> Keluar dari Aplikasi
						</a>

					</div>

				</div>
			</div>

		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$(function() {

			$("#formUpdateDataAkun").submit(function(e) {
				e.preventDefault();

				var id_pelapor = $('#id_pelapor').val();
				var nama_lengkap = $('#nama_lengkap').val();
				var nik = $('#nik').val();
				var tanggal_lahir = $('#tanggal_lahir').val();
				var no_hp = $('#no_hp').val();
				var alamat = $('#alamat').val();

				$.ajax({
					type: "POST",
					url: "<?= base_url() ?>/Pelapor/Pengaturan/ubah_data_akun",
					dataType: "JSON",
					data: {
						id_pelapor: id_pelapor,
						nama_lengkap: nama_lengkap,
						nik: nik,
						tanggal_lahir: tanggal_lahir,
						no_hp: no_hp,
						alamat: alamat
					},
					success: function(data) {
						if (data.success == "1") {
							toastr.success(data.pesan);
							// location.reload();
						} else if (data.success == "0") {
							toastr.error(data.pesan);
						}
					}
				});

			});

			$("#formUbahFotoProfil").submit(function(e) {
				e.preventDefault();

				const foto = $('#foto').prop('files')[0];

				let formData = new FormData();
				formData.append('foto', foto);

				$.ajax({
					type: "POST",
					url: "<?= base_url() ?>/Pelapor/Pengaturan/ubah_foto_profil",
					dataType: "JSON",
					data: formData,
					cache: false,
					processData: false,
					contentType: false,
					success: function(data) {
						if (data.success == "1") {
							toastr.success(data.pesan);
							// location.reload();
						} else if (data.success == "0") {
							toastr.error(data.pesan);
						}
					}
				});

			});

		});
	});

	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#fotobaru')
					.attr('src', e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
</script>


<?= $this->endSection('content'); ?>