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
								<circle cx="12" cy="12" r="3" />
								<circle cx="12" cy="12" r="8" />
								<line x1="12" y1="2" x2="12" y2="4" />
								<line x1="12" y1="20" x2="12" y2="22" />
								<line x1="20" y1="12" x2="22" y2="12" />
								<line x1="2" y1="12" x2="4" y2="12" />
							</svg>
							<h3 class="card-title" style="margin-left: 10px;">Lokasi anda</h3>
						</div>
						<div>
							<a onclick="initMap()" class="btn btn-outline-dark">
								<i class="fa fa-sync"></i>
							</a>
						</div>
					</div>

					<div class="card-body">
						<table class="table-sm" style="font-size: 12px;">
							<tr>
								<td>Alamat</td>
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
				</div>
			</div>

			<?php if ($user_nik == "" or $user_alamat == "" or $user_tanggal_lahir == "") : ?>

				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<h3 class="">
								Anda belum melengkapi data akun
							</h3>
							<p>
								Mohon lengkapi data akun anda untuk dapat mulai menggunakan aplikasi
							</p>
							<a href="<?= base_url(); ?>/pelapor/pengaturan" class="btn btn-outline-primary shadow mt-3 mb-2">
								<i class="fa fa-arrow-right me-2"></i> Lengkapi Data
							</a>
						</div>
					</div>
				</div>

			<?php else : ?>

				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
								<path stroke="none" d="M0 0h24v24H0z" fill="none" />
								<path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
								<rect x="9" y="3" width="6" height="4" rx="2" />
								<line x1="10" y1="14" x2="14" y2="14" />
								<line x1="12" y1="12" x2="12" y2="16" />
							</svg>
							<h3 class="card-title" style="margin-left: 10px;">
								Buat Laporan
							</h3>
						</div>
						<div class="card-body border-bottom py-3">

							<div class="row justify-content-between">
								<div class="col-12 mb-3">
									<h2 class="font-weight-light">
										Ada kecelakaan disekitarmu ? Laporkan sekarang !
									</h2>
									<p>
										Mohon pastikan alamat yang tertera diatas sesuai dengan lokasi anda saat ini. <br>
										Pilih tombol panic sesuai kategori kecelakaan yang anda amati ! untuk panduan silahkan lihat <a href="#" id="btn-view-pedoman" data-bs-toggle="modal" data-bs-target="#modal-view-pedoman"> panduan kategori laporan</a>
									</p>
								</div>

							</div>

							<div class="row" id="create-laporan-section">
								<div class="alert alert-warning">
									Menunggu data koordinat lokasi anda !
								</div>
							</div>

						</div>

					</div>
				</div>

			<?php endif; ?>

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
							<h3 class="card-title" style="margin-left: 10px;">Laporan saya hari ini (<?= date('d/m/Y'); ?>)</h3>
						</div>
					</div>
					<div class="card-body">
						<div class="row" id="laporan-saya">
							<?php
							$no_laporan = 1;
							$hari_ini = date('Y-m-d');
							$laporan_saya = $db->query("SELECT * FROM tb_laporan WHERE id_pelapor='$user_id_pelapor' AND waktu >= '$hari_ini' ORDER BY id_laporan DESC ");
							$jumlah_laporan_saya = $laporan_saya->getNumRows();
							?>
							<?php if ($jumlah_laporan_saya > 0) : ?>
								<?php foreach ($laporan_saya->getResult('array') as $row) : ?>
									<?php
									$id_laporan = $row['id_laporan'];
									$id_kategori_laporan = $row['id_kategori_laporan'];
									$kategori_laporan = ($db->query("SELECT * FROM tb_kategori_laporan WHERE id_kategori_laporan='$id_kategori_laporan' "))->getRow();

									if ($id_kategori_laporan == "1") {
										$class_bg_by_kategori_laporan = "bg-warning text-white";
									} elseif ($id_kategori_laporan == "2") {
										$class_bg_by_kategori_laporan = "bg-danger text-white";
									} elseif ($id_kategori_laporan == "3") {
										$class_bg_by_kategori_laporan = "bg-dark text-white";
									}

									if ($row['status'] == "0") {
										$text_status = "Menunggu Respon";
									} elseif ($row['status'] == "1") {
										$text_status = "Telah ditindaklanjut";
									} elseif ($row['status'] == "2") {
										$text_status = "Tidak ditindaklanjut";
									}

									if ($row['verifikasi'] == "0") {
										$text_verif = "Belum diverifikasi";
									} elseif ($row['verifikasi'] == "1") {
										$text_verif = "Terverifikasi";
									} elseif ($row['verifikasi'] == "2") {
										$text_verif = "Tidak Terverifikasi";
									}

									$cek_tindakan = $db->query("SELECT * FROM tb_tindakan_personil WHERE id_laporan='$id_laporan' ")->getNumRows();
									?>
									<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3 h-100">
										<a href="<?= base_url(); ?>/pelapor/laporan/detail/<?= $row['token']; ?>" class="text-decoration-none">
											<div class="card border-0 rounded-3 <?= $class_bg_by_kategori_laporan; ?>">
												<div class="card-body">
													<div class="d-flex justify-content-start">
														<small class="fst-italic text-white me-3">
															<?= strftime('%d/%m/%Y', strtotime($row['waktu'])); ?>
														</small>
														<small class="fst-italic text-white">
															<?= strftime('%H:%M:%S WIB', strtotime($row['waktu'])); ?>
														</small>
													</div>
													<div class="d-flex mt-2">
														<span>
															Kategori <?= $kategori_laporan->kategori_laporan; ?>
														</span>
													</div>
													<div class="mt-3">
														<small style="font-size: 10px;">
															Lokasi :
															<?= $ClassHome->getAddress($row['latitude'], $row['longitude']); ?>
														</small>
													</div>
													<div class="d-flex mt-3 justify-content-between">
														<span class="badge badge-sm">
															<small>
																Status : <?= $text_status; ?>
															</small>
														</span>
														<span class="badge badge-sm">
															<small>
																<?= $text_verif; ?>
															</small>
														</span>
													</div>

													<?php if (!($cek_tindakan > 0)) : ?>
														<div style="position: absolute; top: 0; right: 0;">
															<button onclick="cancel_laporan(<?= $row['id_laporan'] ?>)" class="btn btn-white rounded-3">
																<i class="fa fa-times"></i>
															</button>
														</div>
													<?php endif; ?>

												</div>
											</div>
										</a>
									</div>

									<?php $no_laporan++; ?>

								<?php endforeach; ?>

							<?php else : ?>

								<div class="col-lg-12">
									<div class="card bg-azure border-0 rounded-3">
										<div class="card-body text-white">

											Anda belum membuat laporan !

										</div>
									</div>
								</div>

							<?php endif; ?>

						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="modal fade" id="modal-view-pedoman" role="dialog" aria-labelledby="modalSK" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalSK" style="color: #000;">Panduan Kategori Laporan</h5>
				<button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<span>
					Kategori laporan kecelekaan terbagi menjadi beberapa kategori. <br>
					Silahkan laporkan kecelakaan yang anda amati berdasarkan deskripsi dari masing-masing kategori berikut.
				</span>
				<table class="table table-bordered table-striped mt-4">
					<thead>
						<tr>
							<th>No</th>
							<th>Kategori</th>
							<th>Deskripsi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no_kategori = 1;
						$kategori_laporan = $db->query("SELECT * FROM tb_kategori_laporan ORDER BY id_kategori_laporan ASC");
						?>
						<?php foreach ($kategori_laporan->getResult() as $row) : ?>
							<tr>
								<td style="vertical-align: middle; text-align: center;"><?= $no_kategori++; ?>.</td>
								<td style="vertical-align: middle; text-align: left;"><?= $row->kategori_laporan; ?></td>
								<td style="vertical-align: middle; text-align: left;"><?= $row->deskripsi; ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
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
								<span class="fa fa-checked"></span>
								` + position.coords.accuracy.toFixed(2) + ` m (Baik)
							</strong>
							`;
				} else {
					accuracyStatus = `
							<strong style="color: red;">
								<span class="glyphicon glyphicon-warning-sign"></span>
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

						$.ajax({
							type: "POST",
							url: "<?= base_url() ?>/Pelapor/Dashboard/update_posisi",
							dataType: "JSON",
							data: {
								latitude: pos.lat,
								longitude: pos.lng
							},
							success: function(data) {
								console.log('Berhasil update posisi pelapor');
							}
						});

						$('#create-laporan-section').html(`
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
								<button class="btn btn-warning shadow border-0 font-weight-bold d-block pt-3" style="width: 100%; border-radius: 30px;" onclick="create_laporan('${pos.lat}', '${pos.lng}', '<?= $user_id_pelapor ?>', '<?= $user_email ?>', '1')">
									<i class="fa fa-exclamation-triangle" style="font-size: 45px;"></i>
									<br>
									<br>
									<span style="font-size: 12px;">
										KATEGORI
									</span>
									<h1 style="font-size: 29px;">
										RINGAN
									</h1>
								</button>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
								<button class="btn btn-danger shadow border-0 font-weight-bold d-block pt-3" style="width: 100%; border-radius: 30px;" onclick="create_laporan('${pos.lat}', '${pos.lng}', '<?= $user_id_pelapor ?>', '<?= $user_email ?>', '2')">
									<i class="fa fa-exclamation-triangle" style="font-size: 45px;"></i>
									<br>
									<br>
									<span style="font-size: 12px;">
										KATEGORI
									</span>
									<h1 style="font-size: 29px;">
										SEDANG
									</h1>
								</button>
							</div>

							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
								<button class="btn btn-dark shadow border-0 font-weight-bold d-block pt-3" style="width: 100%; border-radius: 30px;" onclick="create_laporan('${pos.lat}', '${pos.lng}', '<?= $user_id_pelapor ?>', '<?= $user_email ?>', '3')">
									<i class="fa fa-exclamation-triangle" style="font-size: 45px;"></i>
									<br>
									<br>
									<span style="font-size: 12px;">
										KATEGORI
									</span>
									<h1 style="font-size: 29px;">
										BERAT
									</h1>
								</button>
							</div>
						`);

						outputAlamat.innerHTML = results[0].formatted_address;
						outputKoordinat.innerHTML = `(` + pos.lat + `, ` + pos.lng + `)`;
						outputAkurasi.innerHTML = accuracyStatus;

					}

				});
			});
		} else {
			$('#create-laporan-section').html(`
				<div class="alert alert-danger">
					Gagal mendapatkan data koordinat lokasi anda. <br>
					Mohon periksa izin penggunaan data lokasi anda pada perangkat ini atau periksa koneksi internet anda !   
				</div>
			`);
		}
	}
</script>

<script>
	$(document).ready(function() {
		$("#modal-view-pedoman").appendTo('body');
		$("#modal-view-pedoman").css("z-index", "1500");

		$("#btn-refresh-laporan-saya").click(function(e) {
			e.preventDefault();
			$("#laporan-saya").hide();
			$("#loading-image").show();
			$("#laporan-saya").load(location.href + " #laporan-saya > *");
			$("#laporan-saya").show();
		});
	});

	function arePointsNear(checkPoint, centerPoint, km) {
		var ky = 40000 / 360;
		var kx = Math.cos(Math.PI * centerPoint.lat / 180.0) * ky;
		var dx = Math.abs(centerPoint.lng - checkPoint.lng) * kx;
		var dy = Math.abs(centerPoint.lat - checkPoint.lat) * ky;
		return Math.sqrt(dx * dx + dy * dy) <= km;
	}

	function create_laporan(lat, lng, id_pelapor, email_pelapor, id_kategori_laporan) {
		var text_notif_personil,
			text_notif_pelapor;

		if (id_kategori_laporan == '1') {
			text_notif_personil = 'Laporan masuk kategori kecelakaan ringan dari ' + email_pelapor;
			text_notif_pelapor = 'Laporan berhasil dibuat, personil terdekat akan segera menuju lokasi anda !';
		} else if (id_kategori_laporan == '2') {
			text_notif_personil = 'Laporan masuk kategori kecelakaan sedang dari ' + email_pelapor;
			text_notif_pelapor = 'Laporan berhasil dibuat, personil terdekat akan segera menuju lokasi anda !';
		} else if (id_kategori_laporan == '3') {
			text_notif_personil = 'Laporan masuk kategori kecelakaan berat dari ' + email_pelapor;
			text_notif_pelapor = 'Laporan berhasil dibuat, personil terdekat akan segera menuju lokasi anda !';
		}

		$.ajax({
			type: "POST",
			url: "<?= base_url() ?>/Pelapor/Laporan/create_laporan",
			dataType: "JSON",
			data: {
				id_kategori_laporan: id_kategori_laporan
			},
			beforeSend: function() {
				$("#loader").show();
			},
			success: function(data) {
				if (data.success == "1") {
					toastr.success(data.pesan);
					$("#laporan-saya").load(location.href + " #laporan-saya > *");

					kirim_notif_personil_terdekat(lat, lng, text_notif_personil);
					// send_notif(id_personil, 'personil', text_notif_personil);
					send_notif(id_pelapor, 'pelapor', text_notif_pelapor);
				} else if (data.success == "0") {
					toastr.error(data.pesan);
				}
			},
			complete: function(data) {
				$("#loader").hide();
			}
		});

	}

	function cancel_laporan(id_laporan) {
		event.preventDefault();
		Swal.fire({
			title: "Batalkan Laporan",
			text: "Pilih ya jika anda ingin membatalkan laporan anda !",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Ya",
			cancelButtonText: "Tidak",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: "POST",
					url: "<?= base_url() ?>/Pelapor/Laporan/cancel_laporan",
					dataType: "JSON",
					data: {
						id_laporan: id_laporan,
					},
					beforeSend: function() {
						$("#loader").show();
					},
					success: function(data) {
						if (data.success == "1") {
							toastr.success(data.pesan);
							$("#laporan-saya").load(location.href + " #laporan-saya > *");
						} else if (data.success == "0") {
							toastr.error(data.pesan);
						}
					},
					complete: function(data) {
						$("#loader").hide();
					}
				});
			}
		});
	}

	function kirim_notif_personil_terdekat(latLaporan, lngLaporan, text_notif) {
		$.ajax({
			type: "POST",
			url: "<?= base_url() ?>/Home/getKoordinatPersonil",
			dataType: "JSON",
			// data: {
			// 	jenis_data: jenis_data,
			// 	user_latitude: latitude,
			// 	user_longitude: longitude
			// },
			beforeSend: function() {
				console.log('Mencoba mengirim notifikasi ke personil !');
			},
			success: function(data) {
				var arrayPersonilAktif = data.length;
				if (arrayPersonilAktif > 0) {
					data.forEach(function(item, index) {
						var posisiPersonil = {
							lat: item.latitude,
							lng: item.longitude
						}
						var posisiLaporan = {
							lat: latLaporan,
							lng: lngLaporan,
						}


						var cek_radius = arePointsNear(posisiPersonil, posisiLaporan, 5000);
						// console.log('Test : ' + cek_radius);
						if (cek_radius == true) {
							send_notif(item.id_personil, 'personil', text_notif);
						}
					});
				}
			},
			complete: function(data) {
				console.log('Selesai kirim notif ke personil');
			}
		});
	}


	// var i = 1000;
	// while (i <= 5000) {
	// 	console.log(i + ' - ');
	// 	// i += 1000;

	// 	if (i = 2000) {
	// 		i = 5000;
	// 	}
	// }
</script>

<?= $this->endSection('content'); ?>