<?= $this->extend('landing/layout/template'); ?>

<?= $this->section('content-landing'); ?>

<section class="sign-in d-flex justify-content-center align-items-center" style="min-height: 100vh;">
	<div class="container">
		<a href="<?= base_url(); ?>/personil/sign-in" class="btn btn-dark shadow" style="position: fixed; left: 15px; top: 15px; margin-bottom: 100px;">
			<i class="fa fa-arrow-left"></i>
		</a>

		<div class="row justify-content-center mt-4">
			<div class="col-12">
				<h4 class="text-center text-warning">
					LAPOR LAKA LANTAS APP
				</h4>
				<hr>
			</div>

			<div class="col-lg-10 mt-5 mt-lg-0 pt-3 pb-5">
				<h5 class="form-title">
					Lupa Password Akun Personil
				</h5>
				<form class="register-form mt-3" id="formLogin">
					<div class="form-group">
						<label for="username"><i class="zmdi zmdi-account material-icons-name"></i></label>
						<input type="text" name="username" id="username" placeholder="Masukkan NRP/Email ..." autofocus autocomplete="off" />
					</div>

					<div class="form-group form-button mt-5">
						<button type="submit" id="btnLogin" class="btn btn-success" style="width: 100%;">
							<i class="zmdi zmdi-arrow-right"></i> Submit
						</button>
					</div>
				</form>

				<div class="text-center mt-4">
					<div class="d-flex justify-content-center">
						<span>
							<a href="<?= base_url(); ?>/personil/sign-in" class="signup-image-link ml-2">
								<i class="fa fa-arrow-circle-right"></i> Masuk
							</a>
						</span>
					</div>
				</div>

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

				$.ajax({
					type: "POST",
					url: "<?= base_url() ?>/Personil/Login/submit_lupa_password",
					dataType: "JSON",
					data: {
						username: username
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
								window.location = "<?= base_url() ?>/personil/sign-in";
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