<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php
$ClassHome = new App\Controllers\Home;
?>

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

			<div class="col-12">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<div class="d-flex align-items-center">
							<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
								<path stroke="none" d="M0 0h24v24H0z" fill="none" />
								<circle cx="17" cy="17" r="4" />
								<path d="M17 13v4h4" />
								<path d="M12 3v4a1 1 0 0 0 1 1h4" />
								<path d="M11.5 21h-6.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v2m0 3v4" />
							</svg>
							<h3 class="card-title" style="margin-left: 10px;">Data Laporan Masuk</h3>
						</div>
						<div>
							<a onclick="window.location.reload()" class="btn btn-outline-dark">
								<i class="fa fa-sync"></i>
							</a>
						</div>
					</div>
					<div class="card-body">

						<div class="row mb-1">
							<div class="col-12">
								<span>
									Laporan masuk disekitar lokasi saya hari ini
								</span>
							</div>
						</div>

						<div class="alert alert-info">
							<table class="table-sm" style="font-size: 12px;">
								<tr>
									<td>Lokasi saya</td>
									<td>:</td>
									<td>
										<span id="outputAlamat"></span>
									</td>
								</tr>
								<tr>
									<td>Koordinat</td>
									<td>:</td>
									<td>
										<span id="outputKoordinat"></span>
									</td>
								</tr>
								<tr>
									<td>Tingkat Akurasi</td>
									<td>:</td>
									<td>
										<span id="outputAkurasi"></span>
									</td>
								</tr>
							</table>
						</div>

						<div class="row" id="laporan-masuk">
							<div class="col-12">
								<div class="alert alert-info py-4">
									Memuat data laporan hari ini !
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<script>
	let geocoder, marker;
	let outputAlamat = document.getElementById("outputAlamat");
	let outputKoordinat = document.getElementById("outputKoordinat");
	let outputAkurasi = document.getElementById("outputAkurasi");

	function initMap() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				if (position.coords.accuracy < 100) {
					accuracyStatus = `
							<strong style="color: green;">
								<span class="fa fa-checked"></span>` + position.coords.accuracy.toFixed(2) + ` m (Baik)
							</strong>
							`;
				} else {
					accuracyStatus = `
							<strong style="color: red;">
								` + position.coords.accuracy.toFixed(2) + ` m (Lemah)
							</strong>`;
				}

				var pos = {
					lat: position.coords.latitude,
					lng: position.coords.longitude,
				};

				geocoder = new google.maps.Geocoder();
				geocoder.geocode({
					'latLng': pos
				}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						outputAlamat.innerHTML = results[0].formatted_address;
						outputKoordinat.innerHTML = `(` + pos.lat + `, ` + pos.lng + `)`;
						outputAkurasi.innerHTML = accuracyStatus;

						$.ajax({
							type: "POST",
							url: "<?= base_url() ?>/Personil/Dashboard/update_posisi",
							dataType: "JSON",
							data: {
								latitude: pos.lat,
								longitude: pos.lng
							},
							success: function(data) {
								console.log('Berhasil update posisi personil !');
							}
						});

						setInterval(function() {
							tampilkan_laporan('today', pos.lat, pos.lng);
						}, 1000);

					}
				});
			});
		}
	}
</script>

<script>
	function tampilkan_laporan(jenis_data, latitude, longitude) {

		var list_data_laporan = "";
		$.ajax({
			type: "POST",
			url: "<?= base_url() ?>/Personil/Laporan/getLaporanMasuk",
			dataType: "JSON",
			data: {
				jenis_data: jenis_data,
				user_latitude: latitude,
				user_longitude: longitude
			},
			beforeSend: function() {
				// $("#loader").show();
				console.log('Memuat data laporan !');
			},
			success: function(data) {
				var arrayDataLaporanLength = data.length;

				if (arrayDataLaporanLength > 0) {

					data.forEach(function(item, index) {
						if (item.id_kategori_laporan == "1") {
							class_kategori_laporan = "bg-warning text-white";
						} else if (item.id_kategori_laporan == "2") {
							class_kategori_laporan = "bg-danger text-white";
						} else if (item.id_kategori_laporan == "3") {
							class_kategori_laporan = "bg-dark text-white";
						}

						if (item.status == "0") {
							class_status = "btn btn-sm btn-secondary";
						} else if (item.status == "1") {
							class_status = "btn btn-sm btn-success";
						} else if (item.status == "2") {
							class_status = "btn btn-sm btn-danger";
						}

						list_data_laporan += `
												<div class="col-lg-4 mb-3">
													<a href="<?= base_url(); ?>/personil/laporan/detail/${item.token}" class="text-decoration-none">
														<div class="card border-0 ${class_kategori_laporan}" style="border-radius: 20px;">
															<div class="card-body">
																<div class="d-flex">
																	<span class="badge badge-pill">
																		Kategori ${item.kategori_laporan}
																	</span>
																</div>
																<div class="d-flex mt-2 justify-content-between">
																	<small class="fst-italic text-white">
																		${item.waktu}
																	</small>
																</div>
																<div class="mt-2 d-flex align-items-center">
																	<span style="font-size: 8px;" class="me-2">
																		dilaporkan oleh
																	</span>
																	<div class="d-flex align-items-center">
																		<img src="${item.foto_pelapor}" style="width: 30px; height: 30px; border-radius: 50%;">
																		<div class="ms-2">
																			<span class="d-block" style="margin-bottom: -8px;">
																				${item.nama_pelapor}
																			</span>
																			<span class="fst-italic" style="font-size: 10px;">
																				${item.email_pelapor}
																			</span>
																		</div>
																	</div>
																</div>
																<div class="mt-3">
																	<small style="font-size: 10px;">
																		Lokasi : ${item.alamat}
																	</small>
																</div>
																<div class="mt-3 d-flex justify-content-between align-items-center">
																	<small style="font-size: 10px;">
																		${item.jarak} dari lokasi anda
																	</small>
																	<small style="font-size: 10px;">
																		Waktu tempuh sekitar ${item.waktu_tempuh}
																	</small>
																</div>

															</div>
														</div>
													</a>
												</div>						
											`;
					});

				} else {
					list_data_laporan += `
							<div class="col-lg-12">
								<div class="card bg-azure border-0 rounded-3">
									<div class="card-body text-white">
										Belum ada laporan masuk hari ini !
									</div>
								</div>
							</div>
						`;
				}

				$('#laporan-masuk').html(list_data_laporan);

			},
			// complete: function(data) {
			// 	$("#loader").hide();
			// }
		});

	}
</script>

<?= $this->endSection('content'); ?>