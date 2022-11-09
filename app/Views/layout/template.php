<?php
header('Access-Control-Allow-Origin: *');
?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />

	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-title" content="Brew">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">

	<meta name="theme-color" content="black">

	<link rel="apple-touch-icon" sizes="152x152" href="<?= base_url(); ?>/img/logo.png" type="image/png">
	<link rel="apple-touch-icon" sizes="167x167" href="<?= base_url(); ?>/img/logo.png" type="image/png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url(); ?>/img/logo.png" type="image/png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url(); ?>/img/logo.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>/img/logo.png">
	<link rel="shortcut icon" type="image/x-icon" href="<?= base_url(); ?>/img/logo.png">

	<link rel="manifest" href="<?= base_url(); ?>/manifest.json">

	<title><?= $title; ?> -- LAPOR LAKA LANTAS APP</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">
	<!-- CSS files -->
	<link href="<?= base_url(); ?>/main-temp/dist/css/tabler.min.css" rel="stylesheet" />
	<link href="<?= base_url(); ?>/main-temp/dist/css/tabler-flags.min.css" rel="stylesheet" />
	<link href="<?= base_url(); ?>/main-temp/dist/css/tabler-payments.min.css" rel="stylesheet" />
	<link href="<?= base_url(); ?>/main-temp/dist/css/tabler-vendors.min.css" rel="stylesheet" />

	<link rel="stylesheet" href="<?= base_url(); ?>/main-temp/dist/libs/select2/css/select2.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/main-temp/dist/libs/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/main-temp/dist/libs/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/main-temp/dist/libs/datatables-responsive/css/responsive.bootstrap4.min.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link rel="stylesheet" href="<?= base_url(); ?>/assets-custom/dropify/dist/css/dropify.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/assets-custom/fancybox/jquery.fancybox.min.css">

	<link href="<?= base_url(); ?>/main-temp/dist/css/demo.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="<?= base_url(); ?>/assets-custom/css/main.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/js/fontawesome.min.js" integrity="sha512-xs1el+uLI2T4QTvRIv3kFBWvjQiPVAvKQM4kzZrJoLVZ1tSz1E0fkZch0cjd1f+sTk2MtBCHbP3PiVTdoFKAJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<script src="<?= base_url(); ?>/main-temp/dist/libs/select2/js/select2.min.js"></script>
	<script src="<?= base_url(); ?>/main-temp/dist/libs/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url(); ?>/main-temp/dist/libs/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url(); ?>/main-temp/dist/libs/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="<?= base_url(); ?>/main-temp/dist/libs/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

	<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>

	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

	<script src="<?= base_url(); ?>/assets-custom/fancybox/jquery.fancybox.min.js"></script>
	<script src="<?= base_url(); ?>/assets-custom/dropify/dist/js/dropify.min.js"></script>

	<script>
		const base_url = "<?= base_url() ?>";
	</script>

	<script>
		document.addEventListener('DOMContentLoaded', () => {
			const applicationServerKey =
				'BMBlr6YznhYMX3NgcWIDRxZXs0sh7tCv7_YCsWcww0ZCv9WGg-tRCXfMEHTiBPCksSqeve1twlbmVAZFv7GSuj0';

			if (!('serviceWorker' in navigator)) {
				console.warn('Service workers are not supported by this browser');
				return;
			}

			if (!('PushManager' in window)) {
				console.warn('Push notifications are not supported by this browser');
				return;
			}

			if (!('showNotification' in ServiceWorkerRegistration.prototype)) {
				console.warn('Notifications are not supported by this browser');
				return;
			}

			if (Notification.permission === 'denied') {
				console.warn('Notifications are denied by the user');
				return;
			}

			push_subscribe();

			navigator.serviceWorker.register(base_url + '/service-worker-notif.js').then(
				() => {
					console.log('[SW] Service worker has been registered');
					push_updateSubscription();
				},
				e => {
					console.error('[SW] Service worker registration failed', e);
				}
			);

			function urlBase64ToUint8Array(base64String) {
				const padding = '='.repeat((4 - (base64String.length % 4)) % 4);
				const base64 = (base64String + padding).replace(/\-/g, '+').replace(/_/g, '/');

				const rawData = window.atob(base64);
				const outputArray = new Uint8Array(rawData.length);

				for (let i = 0; i < rawData.length; ++i) {
					outputArray[i] = rawData.charCodeAt(i);
				}
				return outputArray;
			}

			function checkNotificationPermission() {
				return new Promise((resolve, reject) => {
					if (Notification.permission === 'denied') {
						return reject(new Error('Push messages are blocked.'));
					}

					if (Notification.permission === 'granted') {
						return resolve();
					}

					if (Notification.permission === 'default') {
						return Notification.requestPermission().then(result => {
							if (result !== 'granted') {
								reject(new Error('Bad permission result'));
							} else {
								resolve();
							}
						});
					}
					return reject(new Error('Unknown permission'));
				});
			}

			function push_subscribe() {
				return checkNotificationPermission()
					.then(() => navigator.serviceWorker.ready)
					.then(serviceWorkerRegistration =>
						serviceWorkerRegistration.pushManager.subscribe({
							userVisibleOnly: true,
							applicationServerKey: urlBase64ToUint8Array(applicationServerKey),
						})
					)
					.then(subscription => {
						return subscribe_user(subscription);
					})
					.then(subscription => subscription) // update your UI
					.catch(e => {
						if (Notification.permission === 'denied') {
							console.warn('Notifications are denied by the user.');
						} else {
							console.error('Impossible to subscribe to push notifications', e);
						}
					});
			}

			function push_updateSubscription() {
				navigator.serviceWorker.ready
					.then(serviceWorkerRegistration => serviceWorkerRegistration.pushManager.getSubscription())
					.then(subscription => {
						if (!subscription) {
							return;
						}
						return subscribe_user(subscription);
					})
					.then(subscription => subscription)
					.catch(e => {
						console.error('Error when updating the subscription', e);
					});
			}

			function push_unsubscribe() {
				navigator.serviceWorker.ready
					.then(serviceWorkerRegistration => serviceWorkerRegistration.pushManager.getSubscription())
					.then(subscription => {
						if (!subscription) {
							return;
						}
						// return subscribe_user(subscription);
					})
					.then(subscription => subscription.unsubscribe())
					.catch(e => {
						console.error('Error when unsubscribing the user', e);
					});
			}

			function subscribe_user(subscription) {
				const key = subscription.getKey('p256dh');
				const token = subscription.getKey('auth');
				const contentEncoding = (PushManager.supportedContentEncodings || ['aesgcm'])[0];

				var endpoint = getEndpoint(subscription);
				var p256dh = key ? btoa(String.fromCharCode.apply(null, new Uint8Array(key))) : null;
				var auth = token ? btoa(String.fromCharCode.apply(null, new Uint8Array(token))) : null;

				console.log(endpoint);
				console.log(p256dh);
				console.log(auth);
				console.log(contentEncoding);

				<?php
				if ($user_level !== "admin") {
					if ($user_level == "pelapor") {
						$id_user_login = $user_id_pelapor;
					} elseif ($user_level == "personil") {
						$id_user_login = $user_id;
					}
				?>

					var id_user = '<?= $id_user_login ?>';
					var tipe_user = '<?= $user_level ?>';

					$.ajax({
						type: "POST",
						url: base_url + "/Home/push_subscription",
						dataType: "JSON",
						enctype: 'multipart/form-data',
						data: {
							id_user: id_user,
							tipe_user: tipe_user,
							endpoint: endpoint,
							p256dh: p256dh,
							auth: auth,
							ce: contentEncoding
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
						complete: function() {
							$("#loader").hide();
						}
					});

				<?php } ?>
			}
		});

		function getEndpoint(pushSubscription) {
			var endpoint = pushSubscription.endpoint;
			var subscriptionId = pushSubscription.subscriptionId;

			// fix Chrome < 45
			if (subscriptionId && endpoint.indexOf(subscriptionId) === -1) {
				endpoint += '/' + subscriptionId;
			}

			return endpoint;
		}

		function send_notif(id_user, tipe_user, text_pesan) {
			const contentEncoding = (PushManager.supportedContentEncodings || ['aesgcm'])[0];
			$.ajax({
				type: "POST",
				url: base_url + "/Home/send_push_notif",
				dataType: "JSON",
				data: {
					id_user: id_user,
					tipe_user: tipe_user,
					text_pesan: text_pesan,
					ce: contentEncoding
				},
				beforeSend: function() {
					$("#loader").show();
				},
				success: function(data) {
					console.log(data.pesan);
				},
				complete: function() {
					$("#loader").hide();
				}
			});
		}
	</script>

</head>

<body class="antialiased">

	<div id="loading_text_bg" style="display: none;">
		<div id="loading_text_animation">
			<div id="textLoading">Mohon tunggu ...</div>
			<span><i></i><i></i></span>
		</div>
	</div>

	<div id="loader" style="display: none;">
		<div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
			<img src="<?= base_url(); ?>/img/loader.gif" style="width: 350px; height: 350px; object-fit: cover; object-position: center;">
		</div>
	</div>

	<?php if (session()->getFlashdata('pesan_berhasil')) : ?>
		<script>
			Swal.fire(
				'Berhasil !',
				'<?= session()->getFlashdata('pesan_berhasil'); ?>',
				'success'
			)
		</script>
	<?php elseif (session()->getFlashdata('pesan_gagal')) : ?>
		<script>
			Swal.fire(
				'Gagal !',
				'<?= session()->getFlashdata('pesan_gagal'); ?>',
				'error'
			)
		</script>
	<?php endif; ?>

	<script>
		<?php if (session()->getFlashdata('toastr_success')) : ?>
			toastr.success("<?= session()->getFlashdata('toastr_success'); ?>");
		<?php elseif (session()->getFlashdata('toastr_error')) :  ?>
			toastr.error("<?= session()->getFlashdata('toastr_error'); ?>");
		<?php elseif (session()->getFlashdata('toastr_warning')) :  ?>
			toastr.warning("<?= session()->getFlashdata('toastr_warning'); ?>");
		<?php elseif (session()->getFlashdata('toastr_info')) :  ?>
			toastr.info("<?= session()->getFlashdata('toastr_info'); ?>");
		<?php endif; ?>
	</script>

	<div class="wrapper">
		<div class="sticky-top">
			<header class="navbar navbar-expand-md navbar-dark sticky-top d-print-none">
				<div class="container-xl">
					<button class="navbar-toggler <?= ($user_level != 'admin') ? 'd-none' : ''; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
						<span class="navbar-toggler-icon"></span>
					</button>

					<h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
						<?php if ($user_level == "personil") : ?>
							<a href="<?= base_url(); ?>/personil" style="text-decoration: none;">
								LAPOR LAKA LANTAS APP
							</a>
						<?php elseif ($user_level == "pelapor") : ?>
							<a href="<?= base_url(); ?>/pelapor" style="text-decoration: none;">
								LAPOR LAKA LANTAS APP
							</a>
						<?php elseif ($user_level == "admin") : ?>
							<a href="<?= base_url(); ?>/admin" style="text-decoration: none;">
								LAPOR LAKA LANTAS APP
							</a>
						<?php endif; ?>
					</h1>

					<div class="navbar-nav flex-row order-md-last">
						<!-- <div class="nav-item dropdown me-3">
							<a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
								<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="35" height="35" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
									<path stroke="none" d="M0 0h24v24H0z" fill="none" />
									<path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
									<path d="M9 17v1a3 3 0 0 0 6 0v-1" />
								</svg>
								<span class="badge bg-red"></span>
							</a>
							<div class="dropdown-menu dropdown-menu-end dropdown-menu-card">
								<div class="card">
									<div class="card-body">
										<h4>
											Notifikasi
										</h4>
										<p>
											Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, explicabo?
										</p>
									</div>
								</div>
							</div>
						</div> -->
						<div class="nav-item dropdown">
							<a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
								<span class="avatar avatar-sm" style="background-image: url('<?= $user_foto; ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;"></span>
								<div class="d-none d-xl-block ps-2 pt-3">
									<div>
										<?= $user_nama_lengkap; ?>
									</div>
									<p class="mt-1 text-muted" style="font-size: 10px;">
										<?= $user_username; ?>
									</p>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
								<div class="text-center px-3">
									<img src="<?= $user_foto; ?>" style="width: 100px; height: 100px; background: #fff; border-radius: 10px; object-fit: cover; object-position: center;">
									<div class="mt-3">
										<span>
											<?= $user_nama_lengkap; ?>
										</span>
										<p class="mt-1" style="font-size: 10px;">
											<?= $user_username; ?>
										</p>
									</div>
								</div>
								<?php if ($user_level == "personil") : ?>
									<a href="<?= base_url(); ?>/personil/pengaturan" class="dropdown-item">
										Pengaturan
									</a>
									<a href="<?= base_url(); ?>/personil/logout" class="dropdown-item btn-logout">
										Keluar
									</a>
								<?php elseif ($user_level == "pelapor") : ?>
									<a href="<?= base_url(); ?>/pelapor/pengaturan" class="dropdown-item">
										Pengaturan
									</a>
									<a href="<?= base_url(); ?>/pelapor/logout" class="dropdown-item btn-logout">
										Keluar
									</a>
								<?php elseif ($user_level == "admin") : ?>
									<a href="<?= base_url(); ?>/admin/pengaturan" class="dropdown-item">
										Pengaturan
									</a>
									<a href="<?= base_url(); ?>/admin/logout" class="dropdown-item btn-logout">
										Keluar
									</a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</header>

			<div class="navbar-expand-md d-xl-block d-lg-block <?= ($user_level != 'admin') ? 'd-md-none d-sm-none d-xs-none' : ''; ?>">
				<div class="collapse navbar-collapse" id="navbar-menu">

					<div class="navbar navbar-light ">

						<div class="container-xl">

							<?php if ($user_level == "personil") : ?>

								<ul class="navbar-nav">
									<li class="nav-item <?= $request->uri->getSegment(2) == '' ? 'active' : ''; ?>">
										<a class="nav-link" href="<?= base_url(); ?>/personil">
											<span class="nav-link-icon d-md-none d-lg-inline-block">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<polyline points="5 12 3 12 12 3 21 12 19 12" />
													<path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
													<path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
												</svg>
											</span>
											<span class="nav-link-title">
												Dashboard
											</span>
										</a>
									</li>

									<li class="nav-item <?= $request->uri->getSegment(2) == 'laporan' ? 'active' : ''; ?>">
										<a class="nav-link" href="<?= base_url(); ?>/personil/laporan">
											<span class="nav-link-icon d-md-none d-lg-inline-block">
												<!-- Download SVG icon from http://tabler-icons.io/i/file-report -->
												<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<circle cx="17" cy="17" r="4" />
													<path d="M17 13v4h4" />
													<path d="M12 3v4a1 1 0 0 0 1 1h4" />
													<path d="M11.5 21h-6.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v2m0 3v4" />
												</svg>
											</span>
											<span class="nav-link-title">
												Laporan
											</span>
										</a>
									</li>

									<li class="nav-item <?= $request->uri->getSegment(2) == 'history' ? 'active' : ''; ?>">
										<a class="nav-link" href="<?= base_url(); ?>/personil/history">
											<span class="nav-link-icon d-md-none d-lg-inline-block">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<polyline points="12 8 12 12 14 14" />
													<path d="M3.05 11a9 9 0 1 1 .5 4m-.5 5v-5h5" />
												</svg>
											</span>
											<span class="nav-link-title">
												History
											</span>
										</a>
									</li>

									<li class="nav-item <?= $request->uri->getSegment(2) == 'fasilitas-kesehatan' ? 'active' : ''; ?>">
										<a class="nav-link" href="<?= base_url(); ?>/personil/fasilitas-kesehatan">
											<span class="nav-link-icon d-md-none d-lg-inline-block">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<line x1="3" y1="21" x2="21" y2="21" />
													<path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16" />
													<path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4" />
													<line x1="10" y1="9" x2="14" y2="9" />
													<line x1="12" y1="7" x2="12" y2="11" />
												</svg>
											</span>
											<span class="nav-link-title">
												Fasilitas Kesehatan
											</span>
										</a>
									</li>

									<li class="nav-item <?= $request->uri->getSegment(2) == 'daerah-rawan' ? 'active' : ''; ?>">
										<a class="nav-link" href="<?= base_url(); ?>/personil/daerah-rawan">
											<span class="nav-link-icon d-md-none d-lg-inline-block">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<path d="M12 9v2m0 4v.01" />
													<path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
												</svg>
											</span>
											<span class="nav-link-title">
												Daerah Rawan
											</span>
										</a>
									</li>

								</ul>

							<?php elseif ($user_level == "pelapor") : ?>

								<ul class="navbar-nav">

									<li class="nav-item <?= $request->uri->getSegment(2) == '' ? 'active' : ''; ?>">

										<a class="nav-link" href="<?= base_url(); ?>/pelapor">
											<span class="nav-link-icon d-md-none d-lg-inline-block">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<polyline points="5 12 3 12 12 3 21 12 19 12" />
													<path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
													<path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
												</svg>
											</span>
											<span class="nav-link-title">
												Dashboard
											</span>
										</a>
									</li>

									<li class="nav-item <?= $request->uri->getSegment(2) == 'fasilitas-kesehatan' ? 'active' : ''; ?>">
										<a class="nav-link" href="<?= base_url(); ?>/pelapor/fasilitas-kesehatan">
											<span class="nav-link-icon d-md-none d-lg-inline-block">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<line x1="3" y1="21" x2="21" y2="21" />
													<path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16" />
													<path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4" />
													<line x1="10" y1="9" x2="14" y2="9" />
													<line x1="12" y1="7" x2="12" y2="11" />
												</svg>
											</span>
											<span class="nav-link-title">
												Fasilitas Kesehatan
											</span>
										</a>
									</li>

									<li class="nav-item <?= $request->uri->getSegment(2) == 'laporan' ? 'active' : ''; ?>">
										<a class="nav-link" href="<?= base_url(); ?>/pelapor/laporan">
											<span class="nav-link-icon d-md-none d-lg-inline-block">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<circle cx="17" cy="17" r="4" />
													<path d="M17 13v4h4" />
													<path d="M12 3v4a1 1 0 0 0 1 1h4" />
													<path d="M11.5 21h-6.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v2m0 3v4" />
												</svg>
											</span>

											<span class="nav-link-title">
												Laporan
											</span>
										</a>
									</li>

									<li class="nav-item <?= $request->uri->getSegment(2) == 'history' ? 'active' : ''; ?>">
										<a class="nav-link" href="<?= base_url(); ?>/pelapor/history">
											<span class="nav-link-icon d-md-none d-lg-inline-block">
												<!-- Download SVG icon from http://tabler-icons.io/i/history -->
												<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<polyline points="12 8 12 12 14 14" />
													<path d="M3.05 11a9 9 0 1 1 .5 4m-.5 5v-5h5" />
												</svg>
											</span>
											<span class="nav-link-title">
												History
											</span>
										</a>
									</li>


									<li class="nav-item <?= $request->uri->getSegment(2) == 'daerah-rawan' ? 'active' : ''; ?>">
										<a class="nav-link" href="<?= base_url(); ?>/pelapor/daerah-rawan">
											<span class="nav-link-icon d-md-none d-lg-inline-block">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<path d="M12 9v2m0 4v.01" />
													<path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
												</svg>
											</span>
											<span class="nav-link-title">
												Daerah Rawan
											</span>
										</a>
									</li>

								</ul>

							<?php elseif ($user_level == "admin") : ?>

								<ul class="navbar-nav">
									<li class="nav-item <?= $request->uri->getSegment(2) == '' ? 'active' : ''; ?>">
										<a class="nav-link" href="<?= base_url(); ?>/admin">
											<span class="nav-link-icon d-md-none d-lg-inline-block">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<polyline points="5 12 3 12 12 3 21 12 19 12" />
													<path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
													<path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
												</svg>
											</span>
											<span class="nav-link-title">
												Dashboard
											</span>
										</a>
									</li>

									<li class="nav-item <?= $request->uri->getSegment(2) == 'laporan' ? 'active' : ''; ?>">
										<a class="nav-link" href="<?= base_url(); ?>/admin/laporan">
											<span class="nav-link-icon d-md-none d-lg-inline-block">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<circle cx="17" cy="17" r="4" />
													<path d="M17 13v4h4" />
													<path d="M12 3v4a1 1 0 0 0 1 1h4" />
													<path d="M11.5 21h-6.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v2m0 3v4" />
												</svg>
											</span>
											<span class="nav-link-title">
												Laporan
											</span>
										</a>
									</li>

									<li class="nav-item <?= $request->uri->getSegment(2) == 'pelapor' ? 'active' : ''; ?>">
										<a class="nav-link" href="<?= base_url(); ?>/admin/pelapor">
											<span class="nav-link-icon d-md-none d-lg-inline-block">
												<!-- Download SVG icon from http://tabler-icons.io/i/users -->
												<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<circle cx="9" cy="7" r="4" />
													<path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
													<path d="M16 3.13a4 4 0 0 1 0 7.75" />
													<path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
												</svg>
											</span>
											<span class="nav-link-title">
												Pelapor
											</span>
										</a>
									</li>

									<li class="nav-item <?= $request->uri->getSegment(2) == 'personil' ? 'active' : ''; ?>">
										<a class="nav-link" href="<?= base_url(); ?>/admin/personil">
											<span class="nav-link-icon d-md-none d-lg-inline-block">
												<!-- Download SVG icon from http://tabler-icons.io/i/users -->
												<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<circle cx="9" cy="7" r="4" />
													<path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
													<path d="M16 3.13a4 4 0 0 1 0 7.75" />
													<path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
												</svg>
											</span>
											<span class="nav-link-title">
												Personil
											</span>
										</a>
									</li>

									<li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
											<span class="nav-link-icon d-md-none d-lg-inline-block">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<polyline points="12 3 20 7.5 20 16.5 12 21 4 16.5 4 7.5 12 3" />
													<line x1="12" y1="12" x2="20" y2="7.5" />
													<line x1="12" y1="12" x2="12" y2="21" />
													<line x1="12" y1="12" x2="4" y2="7.5" />
													<line x1="16" y1="5.25" x2="8" y2="9.75" />
												</svg>
											</span>
											<span class="nav-link-title">
												Data Master
											</span>
										</a>
										<div class="dropdown-menu">
											<div class="dropdown-menu-columns">
												<div class="dropdown-menu-column">
													<a class="dropdown-item" href="<?= base_url(); ?>/admin/data-master/kategori-korban">
														Kategori Korban
													</a>
													<a class="dropdown-item" href="<?= base_url(); ?>/admin/data-master/kategori-kecelakaan">
														Kategori Kecelakaan
													</a>
													<a class="dropdown-item" href="<?= base_url(); ?>/admin/data-master/kategori-laporan">
														Kategori Laporan
													</a>
													<a class="dropdown-item" href="<?= base_url(); ?>/admin/data-master/jenis-tindakan-personil">
														Jenis Tindakan Personil
													</a>
													<a class="dropdown-item" href="<?= base_url(); ?>/admin/data-master/satuan-kerja-personil">
														Satuan Kerja Personil
													</a>
													<a class="dropdown-item" href="<?= base_url(); ?>/admin/data-master/pangkat-personil">
														Pangkat Personil
													</a>
												</div>
											</div>
										</div>
									</li>

									<li class="nav-item <?= $request->uri->getSegment(2) == 'pengaturan' ? 'active' : ''; ?>">
										<a class="nav-link" href="<?= base_url(); ?>/admin/pengaturan">
											<span class="nav-link-icon d-md-none d-lg-inline-block">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<circle cx="12" cy="7" r="4" />
													<path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
												</svg>
											</span>
											<span class="nav-link-title">
												Pengaturan
											</span>
										</a>
									</li>

								</ul>

							<?php endif; ?>

						</div>
					</div>
				</div>
			</div>

		</div>

		<?php if ($user_level != "admin") : ?>
			<div class="container-fluid">
				<div class="navbar-expand-md fixed-bottom navbar-expand d-lg-none d-xl-none" id="navbar-mobile">
					<div class="row p-0 navbar navbar-dark">
						<div class="col-lg-12">

							<?php if ($user_level == "personil") : ?>

								<ul class="navbar-nav nav-justified w-100">
									<li class="nav-item <?= $request->uri->getSegment(2) == '' ? 'active' : ''; ?>">
										<a class="nav-link py-3 d-block text-center" href="<?= base_url(); ?>/personil">
											<div class="nav-link-icon w-100 d-flex justify-content-center">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<polyline points="5 12 3 12 12 3 21 12 19 12" />
													<path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
													<path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
												</svg>
											</div>
											<small style="font-size: 8px;">
												Dashboard
											</small>
										</a>
									</li>

									<li class="nav-item <?= $request->uri->getSegment(2) == 'fasilitas-kesehatan' ? 'active' : ''; ?>">
										<a class="nav-link py-3 d-block text-center" href="<?= base_url(); ?>/personil/fasilitas-kesehatan">
											<div class="nav-link-icon w-100 d-flex justify-content-center">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<line x1="3" y1="21" x2="21" y2="21" />
													<path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16" />
													<path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4" />
													<line x1="10" y1="9" x2="14" y2="9" />
													<line x1="12" y1="7" x2="12" y2="11" />
												</svg>
											</div>
											<small style="font-size: 8px;">
												FasKes
											</small>
										</a>
									</li>

									<li class="nav-item <?= $request->uri->getSegment(2) == 'laporan' ? 'active' : ''; ?>">
										<a class="nav-link px-0 py-3 d-block text-center" href="<?= base_url(); ?>/personil/laporan">
											<div class="nav-link-icon w-100 d-flex justify-content-center">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<circle cx="17" cy="17" r="4" />
													<path d="M17 13v4h4" />
													<path d="M12 3v4a1 1 0 0 0 1 1h4" />
													<path d="M11.5 21h-6.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v2m0 3v4" />
												</svg>
											</div>
											<small style="font-size: 8px;">
												Laporan
											</small>
										</a>
									</li>

									<li class="nav-item <?= $request->uri->getSegment(2) == 'history' ? 'active' : ''; ?>">
										<a class="nav-link px-0 py-3 d-block text-center" href="<?= base_url(); ?>/personil/history">
											<div class="nav-link-icon w-100 d-flex justify-content-center">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<polyline points="12 8 12 12 14 14" />
													<path d="M3.05 11a9 9 0 1 1 .5 4m-.5 5v-5h5" />
												</svg>
											</div>
											<small style="font-size: 8px;">
												History
											</small>
										</a>
									</li>

									<li class="nav-item <?= $request->uri->getSegment(2) == 'daerah-rawan' ? 'active' : ''; ?>">
										<a class="nav-link px-0 py-3 d-block" href="<?= base_url(); ?>/personil/daerah-rawan">
											<div class="nav-link-icon w-100 d-flex justify-content-center justify-content-center">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<path d="M12 9v2m0 4v.01" />
													<path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
												</svg>
											</div>
											<small style="font-size: 8px;">
												Daerah Rawan
											</small>
										</a>
									</li>
								</ul>

							<?php elseif ($user_level == "pelapor") : ?>

								<ul class="navbar-nav nav-justified w-100">
									<li class="nav-item <?= $request->uri->getSegment(2) == '' ? 'active' : ''; ?>">
										<a class="nav-link py-3 d-block text-center" href="<?= base_url(); ?>/pelapor">
											<div class="nav-link-icon w-100 d-flex justify-content-center">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<polyline points="5 12 3 12 12 3 21 12 19 12" />
													<path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
													<path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
												</svg>
											</div>
											<small style="font-size: 8px;">
												Dashboard
											</small>
										</a>
									</li>


									<li class="nav-item <?= $request->uri->getSegment(2) == 'fasilitas-kesehatan' ? 'active' : ''; ?>">
										<a class="nav-link py-3 d-block text-center" href="<?= base_url(); ?>/pelapor/fasilitas-kesehatan">
											<div class="nav-link-icon w-100 d-flex justify-content-center">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<line x1="3" y1="21" x2="21" y2="21" />
													<path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16" />
													<path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4" />
													<line x1="10" y1="9" x2="14" y2="9" />
													<line x1="12" y1="7" x2="12" y2="11" />
												</svg>
											</div>
											<small style="font-size: 8px;">
												FasKes
											</small>
										</a>
									</li>

									<li class="nav-item <?= $request->uri->getSegment(2) == 'laporan' ? 'active' : ''; ?>">
										<a class="nav-link px-0 py-3 d-block text-center" href="<?= base_url(); ?>/pelapor/laporan">
											<div class="nav-link-icon w-100 d-flex justify-content-center">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<circle cx="17" cy="17" r="4" />
													<path d="M17 13v4h4" />
													<path d="M12 3v4a1 1 0 0 0 1 1h4" />
													<path d="M11.5 21h-6.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v2m0 3v4" />
												</svg>
											</div>
											<small style="font-size: 8px;">
												Lapor
											</small>
										</a>
									</li>

									<li class="nav-item <?= $request->uri->getSegment(2) == 'history' ? 'active' : ''; ?>">
										<a class="nav-link px-0 py-3 d-block text-center" href="<?= base_url(); ?>/pelapor/history">
											<div class="nav-link-icon w-100 d-flex justify-content-center">
												<!-- Download SVG icon from http://tabler-icons.io/i/history -->
												<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<polyline points="12 8 12 12 14 14" />
													<path d="M3.05 11a9 9 0 1 1 .5 4m-.5 5v-5h5" />
												</svg>
											</div>
											<small style="font-size: 8px;">
												History
											</small>
										</a>
									</li>

									<li class="nav-item <?= $request->uri->getSegment(2) == 'daerah-rawan' ? 'active' : ''; ?>">
										<a class="nav-link px-0 py-3 d-block" href="<?= base_url(); ?>/pelapor/daerah-rawan">
											<div class="nav-link-icon w-100 d-flex justify-content-center justify-content-center">
												<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none" />
													<path d="M12 9v2m0 4v.01" />
													<path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
												</svg>
											</div>
											<small style="font-size: 8px;">
												Daerah Rawan
											</small>
										</a>
									</li>
								</ul>

							<?php endif; ?>

						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<div class="page-wrapper pb-5 pb-lg-2">
			<div class="content-min-height">
				<?= $this->renderSection('content'); ?>
			</div>
		</div>

	</div>

	<script src="<?= base_url(); ?>/main-temp/dist/libs/apexcharts/dist/apexcharts.min.js"></script>
	<script src="<?= base_url(); ?>/main-temp/dist/js/tabler.min.js"></script>

	<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>

	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&callback=initMap&language=id-ID"></script>

	<script src="<?= base_url(); ?>/assets-custom/js/main.js"></script>

	<!-- <script>
		function showNotificationTest() {
			if (!Notification) {
				$('body').append('<h4 style="color:red">*Browser does not support Web Notification</h4>');
				return;
			}
			if (Notification.permission !== "granted")
				Notification.requestPermission();
			else {
				var theurl = base_url + "/pelapor";
				var notifikasi = new Notification("Hay Ronald", {
					icon: base_url + '/img/logo.png',
					body: 'Lagi Test notifikasi baru ',
				});
				notifikasi.onclick = function() {
					window.open(theurl);
					notifikasi.close();
				};
				setTimeout(function() {
					notifikasi.close();
				}, 5000);
			}
		};
	</script> -->

</body>

</html>