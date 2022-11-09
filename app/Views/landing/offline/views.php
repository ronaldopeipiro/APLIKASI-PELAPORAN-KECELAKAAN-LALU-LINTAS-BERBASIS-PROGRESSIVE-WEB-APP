<?= $this->extend('landing/layout/template'); ?>

<?= $this->section('content-landing'); ?>

<section class="sign-in d-flex justify-content-center align-items-center" style="min-height: 100vh;">
	<div class="container">
		<div class="row signin-content mt-0">

			<div class="col-lg-12 px-4 py-2">
				<h3 class="text-warning">
					LAPOR LAKA LANTAS APP
				</h3>
				<hr>
				<div class="d-flex justify-content-center justify-content-lg-start">
					<img src="<?= base_url(); ?>/img/offline-logo.png" style="width: 200px;">
				</div>
				<p style="font-weight: 500; color: #444;">
					Maaf, sepertinya anda kehilangan koneksi internet !
				</p>
				<div class="d-flex justify-content-center justify-content-lg-start">
					<a href="<?= base_url(); ?>" class="mt-4	 btn btn-dark shadow" style="width: 200px;">
						<i class="fa fa-sync"></i> Muat Ulang
					</a>
				</div>
			</div>

		</div>
	</div>
</section>

<?= $this->endSection('content-landing'); ?>