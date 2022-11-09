<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container-xl">
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
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

			<?php if ($user_nik == "" or $user_alamat == "" or $user_tanggal_lahir == "") : ?>
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<h3 class="">Anda belum melengkapi data akun</h3>
							<p>
								Mohon lengkapi data akun anda untuk dapat mulai menggunakan aplikasi
							</p>
							<a href="<?= base_url(); ?>/pelapor/pengaturan" class="btn btn-outline-primary shadow mt-3 mb-2">
								<i class="fa fa-arrow-right me-2"></i> Lengkapi Data
							</a>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
							<path stroke="none" d="M0 0h24v24H0z" fill="none" />
							<path d="M4 8v-2a2 2 0 0 1 2 -2h2" />
							<path d="M4 16v2a2 2 0 0 0 2 2h2" />
							<path d="M16 4h2a2 2 0 0 1 2 2v2" />
							<path d="M16 20h2a2 2 0 0 0 2 -2v-2" />
							<line x1="9" y1="10" x2="9.01" y2="10" />
							<line x1="15" y1="10" x2="15.01" y2="10" />
							<path d="M9.5 15a3.5 3.5 0 0 0 5 0" />
						</svg>
						<h3 class="card-title" style="margin-left: 10px;">Profil</h3>
					</div>
					<div class="card-body">
						<div class="row justify-content-between align-items-center">
							<div class="col-lg-2 text-center">
								<div class="card rounded-3">
									<div class="card-body p-1 rounded-3">
										<img src="<?= $user_foto; ?>" class="img-fluid" style="width: 150px; height: 150px; object-fit: cover; object-position: center; border-radius: 10px;">
									</div>
								</div>
							</div>

							<div class="col-lg-10 mt-3 mt-lg-0">
								<table class="table-sm table-responsive table-borderless" style="font-size: 12px;">
									<tr>
										<td>Nama Lengkap</td>
										<td>:</td>
										<td><?= $user_nama_lengkap; ?></td>
									</tr>
									<tr>
										<td>NIK</td>
										<td>:</td>
										<td><?= $user_nik; ?></td>
									</tr>
									<tr>
										<td>Email</td>
										<td>:</td>
										<td><?= $user_email; ?></td>
									</tr>
									<tr>
										<td>Alamat</td>
										<td>:</td>
										<td><?= $user_alamat; ?></td>
									</tr>
									<tr>
										<td>No. Handphone</td>
										<td>:</td>
										<td><?= $user_no_hp; ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h3 class="">Anda melihat kecelakaan lalu lintas ?</h3>
						<a href="<?= base_url(); ?>/pelapor/laporan" class="btn btn-outline-warning shadow mt-3 mb-2">
							<i class="fa fa-arrow-right me-2"></i> Laporkan sekarang
						</a>
					</div>
				</div>
			</div>

			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
							<path stroke="none" d="M0 0h24v24H0z" fill="none" />
							<circle cx="12" cy="12" r="3" />
							<circle cx="12" cy="12" r="8" />
							<line x1="12" y1="2" x2="12" y2="4" />
							<line x1="12" y1="20" x2="12" y2="22" />
							<line x1="20" y1="12" x2="22" y2="12" />
							<line x1="2" y1="12" x2="4" y2="12" />
						</svg>
						<h3 class="card-title" style="margin-left: 10px;">Lokasi anda</h3>
					</div>
					<div class="card-body">
						<div id="map" style="height: 68vh; width: 100%; border-radius: 10px;"></div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<script>
	let map, infoWindow, geocoder, marker, accuracyStatus;

	function initMap() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				if (position.coords.accuracy < 100) {
					accuracyStatus = `
							<strong style="color: green;">
								<span class="fa fa-check"></span>
								` + position.coords.accuracy.toFixed(2) + ` m (Baik)
							</strong>`;
				} else {
					accuracyStatus = `
							<strong style="color: red;">
								` + position.coords.accuracy.toFixed(2) + ` m (Lemah)
							</strong>`;
				}

				infowindow = new google.maps.InfoWindow();
				geocoder = new google.maps.Geocoder();

				var pos = {
					lat: position.coords.latitude,
					lng: position.coords.longitude,
				};

				map = new google.maps.Map(document.getElementById('map'), {
					zoom: 20,
					center: pos
				});

				geocoder.geocode({
					'latLng': pos
				}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						const image_marker = {
							url: "<?= $user_foto ?>", // url
							scaledSize: new google.maps.Size(50, 50), // scaled size
							origin: new google.maps.Point(0, 0), // origin
							anchor: new google.maps.Point(0, 0) // anchor
						};

						marker = new google.maps.Marker({
							position: pos,
							map: map,
							icon: image_marker,
						});

						var infowindowText = `
							<div class='text-center'>
								<strong>Posisi anda saat ini</strong>
								<br>` +
							results[3].formatted_address +
							`<br>(` + pos.lat.toFixed(5) + `, ` + pos.lng.toFixed(5) + `)<br> Akurasi : ` + accuracyStatus + `
								</strong>
							</div>`;
						infowindow.setContent(infowindowText);
						infowindow.open(map, marker);
						marker.addListener('click', function() {
							infowindow.open(map, marker);
						});

						$.ajax({
							type: "POST",
							url: "<?= base_url() ?>/Pelapor/Dashboard/update_posisi",
							dataType: "JSON",
							data: {
								latitude: pos.lat,
								longitude: pos.lng
							},
							success: function(data) {
								console.log('OK');
							}
						});
					}

				});
			}, function() {
				handleLocationError(true, infoWindow, map.getCenter());
			});
		} else {
			handleLocationError(false, infoWindow, map.getCenter());
		}
	}

	function handleLocationError(browserHasGeolocation, infoWindow, pos) {
		infoWindow.setPosition(pos);
		infoWindow.setContent(browserHasGeolocation ?
			`<span class="alert alert-danger"> Error: The Geolocation service failed. </span>` :
			`<span class="alert alert-danger">Error: Your browser doesnt support geolocation. </span>`);
		infoWindow.open(map);
	}
</script>

<?= $this->endSection('content'); ?>