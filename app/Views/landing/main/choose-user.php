<?= $this->extend('landing/layout/template'); ?>

<?= $this->section('content-landing'); ?>

<section class="sign-in d-flex justify-content-end justify-content-lg-center align-items-center" style="min-height: 100vh;">
	<div class="container">
		<a href="<?= base_url(); ?>" class="btn btn-dark shadow" style="position: fixed; left: 15px; top: 15px; margin-bottom: 100px;">
			<i class="fa fa-arrow-left"></i>
		</a>
		<div class="row signin-content mt-0">
			<div class="col-lg-12 px-5 py-5">
				<h3 class="text-warning">
					LAPOR LAKA LANTAS APP
				</h3>
				<hr>
				<h5 class="text-dark mt-5">
					Masuk sebagai ?
				</h5>
				<div class="d-flex mt-5">
					<a href="<?= base_url(); ?>/pelapor" class="btn btn-lg btn-outline-primary shadow" style="width: 188px; margin-right: 10px;">
						<i class="fa fa-users"></i> Pelapor
					</a>
					<a href="<?= base_url(); ?>/personil" class="btn btn-lg btn-outline-dark shadow" style="width: 188px;">
						<i class="fa fa-users"></i> Personil
					</a>
				</div>
			</div>

		</div>
	</div>
</section>

<?= $this->endSection('content-landing'); ?>