<?= $this->extend('landing/layout/template'); ?>

<?= $this->section('content-landing'); ?>

<section class="sign-in d-flex justify-content-center align-items-center" style="min-height: 100vh;">
	<div class="container">
		<div class="row signin-content mt-0">

			<div class="col-lg-12 px-5 py-5">
				<h3 class="text-success">
					Selamat Datang di
				</h3>
				<h3 class="text-warning">
					LAPOR LAKA LANTAS APP
				</h3>
				<hr>
				<p style="font-weight: 500; color: #444;">
					Mari bergabung dan laporkan ! <br>
					Saat anda menemukan kecelakaan lalu lintas disekitar anda.
				</p>
				<a href="<?= base_url(); ?>/choose-user" class="mt-5 btn btn-primary shadow" style="width: 200px;">
					<i class="fa fa-arrow-right"></i> Mulai
				</a>
			</div>

		</div>
	</div>
</section>

<?= $this->endSection('content-landing'); ?>