<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container-xl">
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

			<div class="col-lg-8">
				<div class="card">

					<div class="card-header">
						<h3 class="card-title">Profil</h3>
					</div>

					<div class="card-body border-bottom py-3">

						<form id="formUpdateDataAkun">
							<?= csrf_field(); ?>

							<div class="form-group row mt-3">
								<label for="nama_lengkap" class="col-sm-3 col-form-label">
									Nama Lengkap
								</label>
								<div class="col-sm-9">
									<input type="text" class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap ..." value="<?= (old('nama_lengkap')) ? old('nama_lengkap') : $user_nama_lengkap_np; ?>">
									<div class="invalid-feedback">
										<?= $validation->getError('nama_lengkap'); ?>
									</div>
								</div>
							</div>

							<div class="form-group row mt-3">
								<label for="nrp" class="col-sm-3 col-form-label">
									NRP
								</label>
								<div class="col-sm-9">
									<input type="text" class="form-control <?= ($validation->hasError('nrp')) ? 'is-invalid' : ''; ?>" id="nrp" name="nrp" value="<?= (old('nrp')) ? old('nrp') : $user_nrp; ?>" minlength="8" maxlength="8" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
									<div class="invalid-feedback">
										<?= $validation->getError('nrp'); ?>
									</div>
								</div>
							</div>

							<div class="form-group row mt-3">
								<label for="id_pangkat" class="col-sm-3 col-form-label">
									Pangkat
								</label>
								<div class="col-sm-9">
									<select name="id_pangkat" id="id_pangkat" class="form-control js-select-2" style="width: 100%;">
										<option value="">-- Pilih Pangkat --</option>
										<?php foreach ($pangkat_personil as $row) : ?>
											<option value="<?= $row['id_pangkat']; ?>" <?= ($row['id_pangkat'] == $user_id_pangkat) ? 'selected' : ''; ?>>
												<?= $row['singkatan']; ?> (<?= $row['pangkat']; ?>)
											</option>
										<?php endforeach; ?>
									</select>
									<div class="invalid-feedback">
										<?= $validation->getError('id_pangkat'); ?>
									</div>
								</div>
							</div>

							<div class="form-group row mt-3">
								<label for="id_satker" class="col-sm-3 col-form-label">
									Satuan Kerja
								</label>
								<div class="col-sm-9">
									<select name="id_satker" id="id_satker" class="form-control js-select-2" style="width: 100%;">
										<option value="">-- Pilih Satuan Kerja --</option>
										<?php foreach ($satuan_kerja as $row) : ?>
											<option value="<?= $row['id_satker']; ?>" <?= ($row['id_satker'] == $user_id_satker) ? 'selected' : ''; ?>>
												<?= $row['nama_satker']; ?>
											</option>
										<?php endforeach; ?>
									</select>
									<div class="invalid-feedback">
										<?= $validation->getError('id_satker'); ?>
									</div>
								</div>
							</div>

							<div class="form-group row mt-3">
								<label for="email" class="col-sm-3 col-form-label">
									Email
								</label>
								<div class="col-sm-9">
									<input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Masukkan email ..." value="<?= (old('email')) ? old('email') : $user_email; ?>">
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
									<input type="text" class="form-control <?= ($validation->hasError('no_hp')) ? 'is-invalid' : ''; ?>" id="no_hp" name="no_hp" placeholder="Masukkan No. Handphone ..." value="<?= (old('no_hp')) ? old('no_hp') : $user_no_hp; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" minlength="11">
									<div class="invalid-feedback">
										<?= $validation->getError('no_hp'); ?>
									</div>
								</div>
							</div>

							<div class="form-group row mt-4">
								<div class="col-sm-9 offset-3">
									<button type="submit" class="shadow btn btn-outline-success pl-4 pr-4" style="width: 180px;">
										<i class="fa fa-save" style="margin-right: 10px;"></i> SIMPAN
									</button>
								</div>
							</div>

						</form>

					</div>

				</div>
			</div>

			<div class="col-lg-4">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							<i class="fa fa-edit"></i>
							Ubah Foto Profil
						</h3>
					</div>
					<div class="card-body border-bottom py-3">

						<form id="formUbahFotoProfil">

							<div class="form-group row mt-3">
								<div class="col-lg-12 text-center">
									<img id="fotobaru" src="<?= $user_foto; ?>" style="width: 180px; height: 180px; border-radius: 10px; object-fit: cover; object-position: center; border: solid 2px #ccc; padding: 5px;">
								</div>
								<div class="col-sm-12 mt-3">
									<input type="file" class="form-control <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto" required onchange="readURL(this)" accept="image/*">
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

			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">
							<i class="fa fa-edit"></i>
							Ubah Password
						</h3>
					</div>
					<div class="card-body border-bottom py-3">

						<form id="formUpdatePassword">
							<?= csrf_field(); ?>

							<div class="form-group row mt-3">
								<label for="password_lama" class="col-sm-3 col-form-label">
									Password lama
								</label>
								<div class="col-sm-9">
									<input type="password" class="form-control <?= ($validation->hasError('password_lama')) ? 'is-invalid' : ''; ?>" id="password_lama" name="password_lama" placeholder="Masukkan password lama ..." value="<?= old('password_lama') ?>">
									<div class="invalid-feedback">
										<?= $validation->getError('password_lama'); ?>
									</div>
								</div>
							</div>

							<div class="form-group row mt-3">
								<label for="password_baru" class="col-sm-3 col-form-label">
									Password Baru
								</label>
								<div class="col-sm-9">
									<input type="password" class="form-control <?= ($validation->hasError('password_baru')) ? 'is-invalid' : ''; ?>" id="password_baru" name="password_baru" placeholder="Masukkan password baru ..." value="<?= old('password_baru') ?>">
									<div class="invalid-feedback">
										<?= $validation->getError('password_baru'); ?>
									</div>
								</div>
							</div>

							<div class="form-group row mt-3">
								<label for="konfirmasi_password" class="col-sm-3 col-form-label">
									Konfirmasi Password Baru
								</label>
								<div class="col-sm-9">
									<input type="password" class="form-control <?= ($validation->hasError('konfirmasi_password')) ? 'is-invalid' : ''; ?>" id="konfirmasi_password" name="konfirmasi_password" placeholder="Masukkan konfirmasi password  ..." value="<?= old('konfirmasi_password') ?>">
									<div class="invalid-feedback">
										<?= $validation->getError('konfirmasi_password'); ?>
									</div>
								</div>
							</div>

							<div class="form-group row mt-4 mb-2">
								<div class="col-sm-3"></div>
								<div class="col-sm-9 text-right">
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
						<a href="<?= base_url(); ?>/personil/logout" class="btn btn-outline-dark btn-logout shadow" style="width: 220px;">
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

				var nama_lengkap = $('#nama_lengkap').val();
				var nrp = $('#nrp').val();
				var id_pangkat = $('#id_pangkat').val();
				var id_satker = $('#id_satker').val();
				var email = $('#email').val();
				var no_hp = $('#no_hp').val();

				$.ajax({
					type: "POST",
					url: "<?= base_url() ?>/Personil/Pengaturan/ubah_data_akun",
					dataType: "JSON",
					data: {
						nama_lengkap: nama_lengkap,
						nrp: nrp,
						id_pangkat: id_pangkat,
						id_satker: id_satker,
						email: email,
						no_hp: no_hp
					},
					beforeSend: function() {
						$("#loader").show();
					},
					success: function(data) {
						if (data.success == "1") {
							toastr.success(data.pesan);
							location.reload();
						} else if (data.success == "0") {
							toastr.error(data.pesan);
						}
					},
					complete: function(data) {
						$("#loader").hide();
					}
				});

			});

			$("#formUpdatePassword").submit(function(e) {
				e.preventDefault();

				var password_lama = $('#password_lama').val();
				var password_baru = $('#password_baru').val();
				var konfirmasi_password = $('#konfirmasi_password').val();

				$.ajax({
					type: "POST",
					url: "<?= base_url() ?>/Personil/Pengaturan/ubah_password",
					dataType: "JSON",
					data: {
						password_lama: password_lama,
						password_baru: password_baru,
						konfirmasi_password: konfirmasi_password,
					},
					beforeSend: function() {
						$("#loader").show();
					},
					success: function(data) {
						if (data.success == "1") {
							toastr.success(data.pesan);
							// location.reload();
						} else if (data.success == "0") {
							toastr.error(data.pesan);
						}
					},
					complete: function(data) {
						$("#loader").hide();
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
					url: "<?= base_url() ?>/Personil/Pengaturan/ubah_foto_profil",
					dataType: "JSON",
					data: formData,
					cache: false,
					processData: false,
					contentType: false,
					beforeSend: function() {
						$("#loader").show();
					},
					success: function(data) {
						if (data.success == "1") {
							toastr.success(data.pesan);
							// location.reload();
						} else if (data.success == "0") {
							toastr.error(data.pesan);
						}
					},
					complete: function(data) {
						$("#loader").hide();
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