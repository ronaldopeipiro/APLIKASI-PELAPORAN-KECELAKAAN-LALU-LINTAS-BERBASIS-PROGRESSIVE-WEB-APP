<?= $this->extend('landing/layout/template'); ?>

<?= $this->section('content-landing'); ?>

<section class="sign-in d-flex justify-content-center align-items-center" style="min-height: 100vh;">
	<div class="container">
		<a href="<?= base_url(); ?>/choose-user" class="btn btn-dark shadow" style="position: fixed; left: 15px; top: 15px; margin-bottom: 100px;">
			<i class="fa fa-arrow-left"></i>
		</a>
		<div class="row mt-4">
			<div class="col-12">
				<h4 class="text-center text-warning">
					LAPOR LAKA LANTAS APP
				</h4>
				<hr>
			</div>
		</div>

		<div class="signin-content">

			<div class="text-center d-flex align-items-end">
				<div>
					<img src="<?= base_url(); ?>/img/laka-1.png" alt="sing up image">
				</div>
			</div>

			<div class="signin-form mt-5 mt-lg-0 row justify-content-center align-items-center">
				<div>
					<h5 class="form-title">
						Masuk sebagai Pelapor
					</h5>

					<p class="mb-3">
						Silahkan masuk dengan
					</p>
					<a href="<?= $tombol_login; ?>" class="btn btn-block btn-outline-info shadow text-left" style="width: 250px;">
						<img src="<?= base_url(); ?>/img/google.png" style="width: 40px; margin-right: 10px;">
						Akun Google
					</a>
				</div>

			</div>
		</div>
	</div>
</section>

<?= $this->endSection('content-landing'); ?>