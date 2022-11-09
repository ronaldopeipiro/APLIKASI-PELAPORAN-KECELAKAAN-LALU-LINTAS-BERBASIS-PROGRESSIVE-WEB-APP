<?= $this->extend('landing/layout/template'); ?>

<?= $this->section('content-landing'); ?>

<section class="sign-in d-flex justify-content-center align-items-center" style="min-height: 100vh;">
	<div class="container">
		<a href="<?= base_url(); ?>" class="btn btn-dark shadow" style="position: fixed; left: 15px; top: 15px; margin-bottom: 100px;">
			<i class="fa fa-arrow-left"></i>
		</a>

		<div class="text-center mt-3">
			<h4 class="text-warning">
				LAPOR LAKA LANTAS APP
			</h4>
		</div>
		<hr>
		<div class="signin-content">
			<div class="text-center d-flex align-items-end">
				<div>
					<img src="<?= base_url(); ?>/img/laka-1.png" alt="sing up image">
				</div>
			</div>

			<div class="signin-form mt-5 mt-lg-0">
				<h5 class="form-title">
					Login Administrator
				</h5>
				<form class="register-form mt-3" id="formLogin">
					<div class="form-group">
						<label for="username"><i class="zmdi zmdi-account material-icons-name"></i></label>
						<input type="text" name="username" id="username" placeholder="Username" autofocus autocomplete="off" />
					</div>
					<div class="form-group">
						<label for="password"><i class="zmdi zmdi-lock"></i></label>
						<input type="password" name="password" id="password" placeholder="Password" autocomplete="off" />
					</div>
					<div class="form-group">
						<input type="checkbox" name="remember" id="remember" class="agree-term" />
						<label for="remember" class="label-agree-term">
							<span></span> Ingat Saya
						</label>
					</div>
					<div class="form-group form-button">
						<button type="submit" id="btnLogin" class="btn btn-success" style="width: 100%;">
							<i class="fa fa-arrow-right"></i> Masuk
						</button>
					</div>
				</form>

			</div>
		</div>
	</div>
</section>

<script>
	$(document).ready(function() {
		$(function() {
			$("#formLogin").submit(function(e) {
				e.preventDefault();

				var username = $('#username').val();
				var password = $('#password').val();

				$.ajax({
					type: "POST",
					url: "<?= base_url() ?>/admin/auth-login-admin",
					dataType: "JSON",
					data: {
						username: username,
						password: password
					},
					beforeSend: function() {
						$("#loader").show();
					},
					success: function(data) {
						if (data.success == "1") {
							Swal.fire(
								'Berhasil',
								data.pesan,
								'success'
							).then(function() {
								window.location = "<?= base_url() ?>/admin";
							});
						} else if (data.success == "0") {
							Swal.fire(
								'Gagal',
								data.pesan,
								'error'
							)
						}
					},
					complete: function(data) {
						$("#loader").hide();
					}
				});

			});

		});
	});
</script>

<?= $this->endSection('content-landing'); ?>