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
									<input type="text" class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap ..." value="<?= (old('nama_lengkap')) ? old('nama_lengkap') : $user_nama_lengkap; ?>">
									<div class="invalid-feedback">
										<?= $validation->getError('nama_lengkap'); ?>
									</div>
								</div>
							</div>

							<div class="form-group row mt-3">
								<label for="username" class="col-sm-3 col-form-label">
									Username
								</label>
								<div class="col-sm-9">
									<input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" value="<?= (old('username')) ? old('username') : $user_username; ?>">
									<div class="invalid-feedback">
										<?= $validation->getError('username'); ?>
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
								<div class="col-sm-9">
									<input type="text" class="form-control <?= ($validation->hasError('no_hp')) ? 'is-invalid' : ''; ?>" id="no_hp" name="no_hp" placeholder="Masukkan No. Handphone ..." value="<?= (old('no_hp')) ? old('no_hp') : $user_no_hp; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
									<div class="invalid-feedback">
										<?= $validation->getError('no_hp'); ?>
									</div>
								</div>
							</div>

							<div class="form-group row mt-3 mt-5">
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
									<img id="fotobaru" src="<?= $user_foto; ?>" style="width: 180px; height: 180px; border-radius: 10px; object-fit: cover; object-position: center;">
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

						<a href="<?= base_url(); ?>/admin/logout" class="btn btn-outline-dark btn-logout shadow" style="width: 220px;">
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
				var username = $('#username').val();
				var email = $('#email').val();
				var no_hp = $('#no_hp').val();

				$.ajax({
					type: "POST",
					url: "<?= base_url() ?>/admin/pengaturan/ubah-data-akun",
					dataType: "JSON",
					data: {
						nama_lengkap: nama_lengkap,
						username: username,
						email: email,
						no_hp: no_hp
					},
					beforeSend: function() {
						$("#loader").show();
					},
					success: function(data) {
						if (data.success == "1") {
							toastr.success(data.pesan);
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
					url: "<?= base_url('admin/pengaturan/ubah-password') ?>",
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
					url: "<?= base_url() ?>/Admin/Pengaturan/ubah_foto_profil",
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