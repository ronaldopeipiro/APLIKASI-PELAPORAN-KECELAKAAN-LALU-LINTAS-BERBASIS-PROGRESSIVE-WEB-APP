<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php
// Hari Ini
$jumlah_seluruh_laporan_hari_ini = $db->query("SELECT * FROM tb_laporan WHERE DATE(waktu) = CURDATE() ")->getNumRows();
$jumlah_laporan_proses_hari_ini = $db->query("SELECT * FROM tb_laporan WHERE DATE(waktu) = CURDATE() AND status='0'")->getNumRows();
$jumlah_laporan_selesai_hari_ini = $db->query("SELECT * FROM tb_laporan WHERE DATE(waktu) = CURDATE() AND status='1' ")->getNumRows();
$jumlah_laporan_tidak_selesai_hari_ini = $db->query("SELECT * FROM tb_laporan WHERE DATE(waktu) = CURDATE() AND status='2' ")->getNumRows();

$jumlah_laporan_tl_personil_hari_ini = $db->query("SELECT DISTINCT id_laporan FROM tb_tindakan_personil WHERE id_laporan IN (SELECT id_laporan FROM tb_laporan WHERE DATE(waktu) = CURDATE() AND status > 0) AND id_personil = '$user_id' ")->getNumRows();

$jumlah_laporan_tl_personil_lain_hari_ini = $db->query("SELECT DISTINCT id_laporan FROM tb_tindakan_personil WHERE id_laporan IN (SELECT id_laporan FROM tb_laporan WHERE DATE(waktu) = CURDATE() AND status > 0) AND id_personil != '$user_id' ")->getNumRows();

$jumlah_laporan_belum_tindak_lanjut_hari_ini = $jumlah_seluruh_laporan_hari_ini - ($jumlah_laporan_tl_personil_hari_ini + $jumlah_laporan_tl_personil_lain_hari_ini);

if ($jumlah_seluruh_laporan_hari_ini != 0) {
	$jumlah_persentase_laporan_proses_hari_ini =  ($jumlah_laporan_belum_tindak_lanjut_hari_ini / $jumlah_seluruh_laporan_hari_ini) * 100;
	$persentase_laporan_proses_hari_ini = number_format((float)$jumlah_persentase_laporan_proses_hari_ini, 2, '.', '');

	$jumlah_persentase_laporan_tl_personil_hari_ini = ($jumlah_laporan_tl_personil_hari_ini / $jumlah_seluruh_laporan_hari_ini) * 100;
	$persentase_laporan_tl_personil_hari_ini = number_format((float)$jumlah_persentase_laporan_tl_personil_hari_ini, 2, '.', '');

	$jumlah_persentase_laporan_tl_personil_lain_hari_ini = ($jumlah_laporan_tl_personil_lain_hari_ini / $jumlah_seluruh_laporan_hari_ini) * 100;
	$persentase_laporan_tl_personil_lain_hari_ini = number_format((float)$jumlah_persentase_laporan_tl_personil_lain_hari_ini, 2, '.', '');
} else {
	$persentase_laporan_proses_hari_ini = 0;
	$persentase_laporan_tl_personil_hari_ini = 0;
	$persentase_laporan_tl_personil_lain_hari_ini = 0;
}

// Total
$jumlah_seluruh_laporan = $db->query("SELECT * FROM tb_laporan")->getNumRows();
$jumlah_laporan_proses = $db->query("SELECT * FROM tb_laporan WHERE status='0' ")->getNumRows();
$jumlah_laporan_selesai = $db->query("SELECT * FROM tb_laporan WHERE status='1' ")->getNumRows();
$jumlah_laporan_tidak_selesai = $db->query("SELECT * FROM tb_laporan WHERE status='2' ")->getNumRows();

$jumlah_laporan_tl_personil = $db->query("SELECT DISTINCT id_laporan FROM tb_tindakan_personil WHERE id_personil = '$user_id'")->getNumRows();
$jumlah_laporan_tl_personil_lain = $db->query("SELECT DISTINCT id_laporan FROM tb_tindakan_personil WHERE id_personil != '$user_id'")->getNumRows();

$jumlah_laporan_belum_tindak_lanjut = $jumlah_seluruh_laporan - ($jumlah_laporan_tl_personil + $jumlah_laporan_tl_personil_lain);

if ($jumlah_seluruh_laporan != 0) {
	$jumlah_persentase_laporan_proses =  ($jumlah_laporan_belum_tindak_lanjut / $jumlah_seluruh_laporan) * 100;
	$persentase_laporan_proses = number_format((float)$jumlah_persentase_laporan_proses, 2, '.', '');

	$jumlah_persentase_laporan_tl_personil = ($jumlah_laporan_tl_personil / $jumlah_seluruh_laporan) * 100;
	$persentase_laporan_tl_personil = number_format((float)$jumlah_persentase_laporan_tl_personil, 2, '.', '');

	$jumlah_persentase_laporan_tl_personil_lain = ($jumlah_laporan_tl_personil_lain / $jumlah_seluruh_laporan) * 100;
	$persentase_laporan_tl_personil_lain = number_format((float)$jumlah_persentase_laporan_tl_personil_lain, 2, '.', '');
} else {
	$persentase_laporan_proses = 0;
	$persentase_laporan_tl_personil = 0;
	$persentase_laporan_tl_personil_lain = 0;
}
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

			<div class="col-lg-12">
				<div class="row row-cards">

					<div class="col-12 col-lg-12">
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
												<td>NRP</td>
												<td>:</td>
												<td><?= $user_nrp; ?></td>
											</tr>
											<tr>
												<td>Satuan Kerja</td>
												<td>:</td>
												<td><?= $user_satker; ?></td>
											</tr>
											<tr>
												<td>Email</td>
												<td>:</td>
												<td><?= $user_email; ?></td>
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

					<div class="col-12 col-lg-6">
						<div class="card">
							<div class="card-header">
								<h3 class="card-title" style="margin-left: 10px;">
									Tindak lanjut laporan hari ini <strong><?= $jumlah_laporan_tl_personil_hari_ini; ?></strong> dari <strong><?= $jumlah_seluruh_laporan_hari_ini; ?></strong>
								</h3>
							</div>

							<div class="card-body">
								<div class="progress progress-separated mb-3">
									<div class="progress-bar bg-warning" role="progressbar" style="width: <?= $persentase_laporan_proses_hari_ini ?>%"></div>
									<div class="progress-bar bg-primary" role="progressbar" style="width: <?= $persentase_laporan_tl_personil_hari_ini ?>%"></div>
									<div class="progress-bar bg-success" role="progressbar" style="width: <?= $persentase_laporan_tl_personil_lain_hari_ini ?>%"></div>
								</div>
								<div class="row justify-content-between">
									<div class="col-auto d-flex align-items-center pe-2">
										<span class="legend me-2 bg-warning"></span>
										<small>Belum tindaklanjut</small>
										<span class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">: <?= $jumlah_laporan_belum_tindak_lanjut_hari_ini; ?> <small>laporan</small> / <?= $persentase_laporan_proses_hari_ini; ?>%</span>
									</div>
									<div class="col-auto d-flex align-items-center px-2">
										<span class="legend me-2 bg-primary"></span>
										<small>Tindaklanjut oleh personil lain</small>
										<span class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">: <?= $jumlah_laporan_tl_personil_lain_hari_ini; ?> <small>laporan</small> / <?= $persentase_laporan_tl_personil_lain_hari_ini; ?>%</span>
									</div>
									<div class="col-auto d-flex align-items-center px-2">
										<span class="legend me-2 bg-success"></span>
										<small>Tindaklanjut oleh saya</small>
										<span class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">: <?= $jumlah_laporan_tl_personil_hari_ini; ?> <small>laporan</small> / <?= $persentase_laporan_tl_personil_hari_ini; ?>%</span>
									</div>
								</div>
							</div>

						</div>
					</div>

					<div class="col-12 col-lg-6">
						<div class="card">
							<div class="card-body">
								Tindaklanjut Laporan Masuk <strong><?= $jumlah_laporan_tl_personil; ?></strong> dari <strong><?= $jumlah_seluruh_laporan; ?></strong>
							</div>
							<div class="card-body">
								<div class="progress progress-separated mb-3">
									<div class="progress-bar bg-warning" role="progressbar" style="width: <?= $persentase_laporan_proses ?>%"></div>
									<div class="progress-bar bg-primary" role="progressbar" style="width: <?= $persentase_laporan_tl_personil ?>%"></div>
									<div class="progress-bar bg-success" role="progressbar" style="width: <?= $persentase_laporan_tl_personil_lain ?>%"></div>
								</div>
								<div class="row justify-content-between">
									<div class="col-auto d-flex align-items-center pe-2">
										<span class="legend me-2 bg-warning"></span>
										<small>Belum tindaklanjut</small>
										<span class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">: <?= $jumlah_laporan_belum_tindak_lanjut; ?> <small>laporan</small> / <?= $persentase_laporan_proses; ?>%</span>
									</div>
									<div class="col-auto d-flex align-items-center px-2">
										<span class="legend me-2 bg-primary"></span>
										<small>Tindaklanjut oleh personil lain</small>
										<span class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">: <?= $jumlah_laporan_tl_personil_lain; ?> <small>laporan</small> / <?= $persentase_laporan_tl_personil_lain; ?>%</span>
									</div>
									<div class="col-auto d-flex align-items-center px-2">
										<span class="legend me-2 bg-success"></span>
										<small>Tindaklanjut oleh saya</small>
										<span class="d-none d-md-inline d-lg-none d-xxl-inline ms-2 text-muted">: <?= $jumlah_laporan_tl_personil; ?> <small>laporan</small> / <?= $persentase_laporan_tl_personil; ?>%</span>
									</div>
								</div>
							</div>
						</div>
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
						<small class="text-muted mb-2" id="textposisisaya"></small>
						<div id="map" style="height: 68vh; width: 100%; border-radius: 20px;"></div>
					</div>

				</div>
			</div>

		</div>
	</div>
</div>

<script>
	let map,
		class_kategori_laporan,
		marker,
		accuracyStatus;
	let gmarkers = [];

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

				var infowindow = new google.maps.InfoWindow();
				var bounds = new google.maps.LatLngBounds();
				var geocoder = new google.maps.Geocoder();

				var pos = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};
				var styleMaps = [{
					featureType: "administrative",
					elementType: "labels",
					stylers: [{
						visibility: "on"
					}]
				}, {
					featureType: "poi",
					elementType: "labels",
					stylers: [{
						visibility: "on"
					}]
				}, {
					featureType: "water",
					elementType: "labels",
					stylers: [{
						visibility: "on"
					}]
				}, {
					featureType: "road",
					elementType: "labels",
					stylers: [{
						visibility: "on"
					}]
				}];

				map = new google.maps.Map(document.getElementById('map'), {
					zoom: 14,
					center: pos,
					mapTypeControlOptions: {
						mapTypeIds: ['mystyle', google.maps.MapTypeId.SATELLITE]
					},
					mapTypeId: 'mystyle',
					location_type: google.maps.GeocoderLocationType.ROOFTOP
				});

				map.mapTypes.set('mystyle', new google.maps.StyledMapType(styleMaps, {
					name: 'Maps'
				}));

				map.panTo(pos);

				geocoder.geocode({
					'latLng': pos
				}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {

						var icon_personil = {
							url: "<?= base_url() ?>/img/marker-anggota-lantas.png", // url
							scaledSize: new google.maps.Size(50, 50), // scaled size
							origin: new google.maps.Point(0, 0), // origin
							// anchor: new google.maps.Point(0, 0) // anchor
						};

						marker = new google.maps.Marker({
							position: pos,
							map: map,
							icon: icon_personil
							// animation: google.maps.Animation.DROP,
						});

						var infowindowText = `
							<div class='text-center'>
								<strong>Posisi Saya</strong>
							</div>`;

						$('#textposisisaya').html(`` + results[3].formatted_address + ` (` + pos.lat.toFixed(5) + `, ` + pos.lng.toFixed(5) + `) - Akurasi : ` + accuracyStatus + `
						`);

						infowindow.setContent(infowindowText);
						infowindow.open(map, marker);
						marker.addListener('click', function() {
							infowindow.open(map, marker);
						});

						function tampilTitikLaporanMasuk() {
							var infowindow = new google.maps.InfoWindow();
							// hapus marker
							for (i = 0; i < gmarkers.length; i++) {
								if (gmarkers[i].getMap() != null) gmarkers[i].setMap(null);
							}
							// Akhir hapus marker
							setInterval(function() {

								$.ajax({
									type: "POST",
									url: "<?= base_url() ?>/Personil/Laporan/getLaporanMasuk",
									dataType: "JSON",
									data: {
										jenis_data: 'today',
										user_latitude: pos.lat,
										user_longitude: pos.lng
									},
									beforeSend: function() {
										// $('#textLoading').html(`Memuat titik laporan ...`);
										// $("#loading_text_animation").show();
										console.log('Memuat titik laporan !');
									},
									success: function(data) {
										var arrayDataLaporanLength = data.length;

										data.forEach(function(item, index) {
											let posisiMarkerLaporan = new google.maps.LatLng(item.latitude, item.longitude);

											if (item.id_kategori_laporan == "1") {
												var link_img_marker_laporan = "<?= base_url() ?>/img/marker-low.png";
											} else if (item.id_kategori_laporan == "2") {
												var link_img_marker_laporan = "<?= base_url() ?>/img/marker-medium.png";
											} else if (item.id_kategori_laporan == "3") {
												var link_img_marker_laporan = "<?= base_url() ?>/img/marker-high.png";
											}

											var icon_marker_laporan = {
												url: link_img_marker_laporan, // url
												scaledSize: new google.maps.Size(36, 36), // scaled size
												origin: new google.maps.Point(0, 0), // origin
												anchor: new google.maps.Point(14, 18) // anchor
											};

											var markerLaporan = new google.maps.Marker({
												position: posisiMarkerLaporan,
												map: map,
												icon: icon_marker_laporan,
											});

											google.maps.event.addListener(markerLaporan, 'click', (function(markerLaporan, i) {
												return function() {
													if (item.id_kategori_laporan == "1") {
														class_kategori_laporan = "badge badge-warning";
													} else if (item.id_kategori_laporan == "2") {
														class_kategori_laporan = "badge badge-danger";
													} else if (item.id_kategori_laporan == "3") {
														class_kategori_laporan = "badge badge-dark";
													}

													if (item.status == "0") {
														class_status = "badge badge-secondary";
													} else if (item.status == "1") {
														class_status = "badge badge-success";
													} else if (item.status == "2") {
														class_status = "badge badge-danger";
													}

													infowindow.setContent(`
														<div>
															<div class="d-flex justify-content-between">
																<span class="${class_kategori_laporan}">
																	Kategori ${item.kategori_laporan}
																</span>
																<span class="${class_status}">
																	${item.status_text}
																</span>
															</div>
															<br>
															
															<div class="d-flex align-items-center my-2">
																dilaporkan oleh
																<div style="margin-left: 8px;">
																	<img style="border-radius: 50%; height: 40px; width: 40px; object-fit: cover; object-position: top;" src="${item.foto_pelapor}">
																</div>
																<div class="d-block" style="line-height: 10px; margin-left: 10px;">
																	<small>
																		${item.nama_pelapor}
																	</small> <br>
																	<small>
																		${item.email_pelapor}
																	</small>
																</div>
															</div>
															<br>
															<a href="${base_url}/personil/laporan/detail/${item.token}" class="btn btn-sm btn-primary">
																<i class="fa fa-arrow-right me-2"></i> Detail Laporan
															</a>
															<br>
															<table class="table-sm table-borderless" style="font-size: 10px;">
																<tr style="text-align: left;">
																	<td>Lokasi</td>
																	<td>:</td>
																	<td>${item.alamat}</td>
																</tr>
																<tr style="text-align: left;">
																	<td>Koordinat</td>
																	<td>:</td>
																	<td style="width: 50%;">
																		${item.latitude}, ${item.longitude}
																	</td>
																</tr> 
																<tr style="text-align: left;">
																	<td>Jarak dari lokasi anda</td>
																	<td>:</td>
																	<td>																	${item.jarak}
																	</td>
																</tr>
																<tr style="text-align: left;">
																	<td>Waktu tempuh</td>
																	<td>:</td>
																	<td>																	Sekitar ${item.waktu_tempuh}
																	</td>
																</tr>
																<tr style="text-align: left;">
																	<td>Waktu Laporan</td>
																	<td>:</td>
																	<td>${item.waktu}</td>
																</tr>
																<tr style="text-align: left;">
																	<td>Status Verifikasi</td>
																	<td>:</td>
																	<td>
																		<span class="badge badge-pill">
																			${item.verifikasi_text}
																		</span>
																	</td>
																</tr>
															</table>
														
														</div>
													`);
													infowindow.open(map, markerLaporan);
												}
											})(markerLaporan, i));
											gmarkers.push(markerLaporan);

										});

									},
									complete: function(data) {
										// $("#loading_text_animation").hide();
										console.log('Titik laporan berhasil diupdate !');
									}
								});

							}, 1000);

						}

						tampilTitikLaporanMasuk();

						$.ajax({
							type: "POST",
							url: "<?= base_url() ?>/Personil/Dashboard/update_posisi",
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
				handleLocationError(true, infowindow, map.getCenter());
			});
		} else {
			handleLocationError(false, infowindow, map.getCenter());
		}
	}

	function handleLocationError(browserHasGeolocation, infowindow, pos) {
		infowindow.setPosition(pos);
		infowindow.setContent(browserHasGeolocation ?
			`<span class="alert alert-danger"> Error: The Geolocation service failed. </span>` :
			`<span class="alert alert-danger">Error: Your browser doesnt support geolocation. </span>`);
		infowindow.open(map);
	}
</script>

<?= $this->endSection('content'); ?>