<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php
// Data grafik laporan masuk berdasarkan kategori laporan
for ($i = 1; $i <= 12; $i++) {
	for ($id_kategori_laporan = 1; $id_kategori_laporan <= 3; $id_kategori_laporan++) {
		$data_laporan_perbulan = $db->query("SELECT * FROM tb_laporan WHERE id_kategori_laporan='$id_kategori_laporan' AND MONTH(waktu) = '$i'")->getNumRows();
		$jumlah_laporan_perbulan_kategori[$i][$id_kategori_laporan] = $data_laporan_perbulan;
	}
}

// Data grafik laporan masuk berdasarkan status laporan
for ($i = 1; $i <= 12; $i++) {
	for ($status = 0; $status <= 2; $status++) {
		$data_laporan_perbulan = $db->query("SELECT * FROM tb_laporan WHERE status='$status' AND MONTH(waktu) = '$i'")->getNumRows();
		$jumlah_laporan_perbulan_status[$i][$status] = $data_laporan_perbulan;
	}
}

// Data grafik laporan masuk berdasarkan verifikasi laporan
for ($i = 1; $i <= 12; $i++) {
	for ($verifikasi = 0; $verifikasi <= 2; $verifikasi++) {
		$data_laporan_perbulan = $db->query("SELECT * FROM tb_laporan WHERE verifikasi='$verifikasi' AND MONTH(waktu) = '$i'")->getNumRows();
		$jumlah_laporan_perbulan_verifikasi[$i][$verifikasi] = $data_laporan_perbulan;
	}
}

$jumlah_seluruh_laporan = $db->query("SELECT * FROM tb_laporan ")->getNumRows();
$jumlah_laporan_proses = $db->query("SELECT * FROM tb_laporan WHERE status='0'")->getNumRows();
$jumlah_laporan_selesai = $db->query("SELECT * FROM tb_laporan WHERE status='1' ")->getNumRows();
$jumlah_laporan_tidak_selesai = $db->query("SELECT * FROM tb_laporan WHERE status='2' ")->getNumRows();

$jumlah_personil = $db->query("SELECT * FROM tb_personil ")->getNumRows();
$jumlah_personil_aktif = $db->query("SELECT * FROM tb_personil WHERE aktif='1' ")->getNumRows();

$jumlah_pelapor = $db->query("SELECT * FROM tb_pelapor ")->getNumRows();
$jumlah_pelapor_aktif = $db->query("SELECT * FROM tb_pelapor WHERE status='1' ")->getNumRows();
?>

<div class="container-xl">
	<!-- Page title -->
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
			<div class="col-sm-6 col-lg-4">
				<div class="card">
					<div class="card-body">

						<div class="d-flex align-items-center">
							<div class="subheader">Laporan Masuk</div>
						</div>
						<div class="h1 mb-3">
							<?= $jumlah_seluruh_laporan; ?>
						</div>

						<div class="d-flex mb-2">
							<small>Laporan ditindaklanjuti</small>
							<div class="ms-auto">
								<span class="text-green d-inline-flex align-items-center lh-1">
									<?= $jumlah_laporan_selesai; ?>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-lg-4">
				<div class="card">
					<div class="card-body">

						<div class="d-flex align-items-center">
							<div class="subheader">PELAPOR</div>
						</div>
						<div class="h1 mb-3">
							<?= $jumlah_pelapor; ?>
						</div>

						<div class="d-flex mb-2">
							<small>Akun pelapor aktif</small>
							<div class="ms-auto">
								<span class="text-green d-inline-flex align-items-center lh-1">
									<?= $jumlah_pelapor_aktif; ?>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-lg-4">
				<div class="card">
					<div class="card-body">

						<div class="d-flex align-items-center">
							<div class="subheader">PERSONIL</div>
						</div>
						<div class="h1 mb-3">
							<?= $jumlah_personil; ?>
						</div>

						<div class="d-flex mb-2">
							<small>Akun personil aktif</small>
							<div class="ms-auto">
								<span class="text-green d-inline-flex align-items-center lh-1">
									<?= $jumlah_personil_aktif; ?>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-12">
				<div class="row row-cards">
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">
									Grafik laporan masuk perbulan tahun <?= date('Y'); ?>
								</h5>

								<div class="row">
									<div class="col-lg-4">
										<div class="row row-cards">
											<div class="col-12">
												<div class="card">
													<div class="card-body">
														<h5 class="card-title">
															Berdasarkan kategori laporan
														</h5>
														<div id="grafik-laporan-masuk-berdasarkan-kategori-laporan" class="chart-lg"></div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-lg-4">
										<div class="row row-cards">
											<div class="col-12">
												<div class="card">
													<div class="card-body">
														<h5 class="card-title">
															Berdasarkan status laporan
														</h5>
														<div id="grafik-laporan-masuk-berdasarkan-status-laporan" class="chart-lg"></div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="col-lg-4">
										<div class="row row-cards">
											<div class="col-12">
												<div class="card">
													<div class="card-body">
														<h5 class="card-title">
															Berdasarkan verifikasi laporan
														</h5>
														<div id="grafik-laporan-masuk-berdasarkan-verifikasi-laporan" class="chart-lg"></div>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>

							</div>
						</div>
					</div>

				</div>
			</div>


		</div>
	</div>
</div>

<!-- Grafik Berdasarkan kategori Laporan -->
<script>
	// @formatter:off
	document.addEventListener("DOMContentLoaded", function() {
		window.ApexCharts && (new ApexCharts(document.getElementById('grafik-laporan-masuk-berdasarkan-kategori-laporan'), {
			chart: {
				type: "bar",
				fontFamily: 'inherit',
				height: 300,
				parentHeightOffset: 0,
				toolbar: {
					show: false,
				},
				animations: {
					enabled: false
				},
				stacked: true,
			},
			plotOptions: {
				bar: {
					columnWidth: '50%',
				}
			},
			dataLabels: {
				enabled: false,
			},
			fill: {
				opacity: 1,
			},
			series: [{
					name: "Kategori Ringan",
					data: [
						<?php
						for ($i = 1; $i <= 12; $i++) {
							echo $jumlah_laporan_perbulan_kategori[$i][1] . ",";
						}
						?>
					]
				}, {
					name: "Kategori Sedang",
					data: [
						<?php
						for ($i = 1; $i <= 12; $i++) {
							echo $jumlah_laporan_perbulan_kategori[$i][2] . ",";
						}
						?>
					]
				},
				{
					name: "Kategori Berat",
					data: [
						<?php
						for ($i = 1; $i <= 12; $i++) {
							echo $jumlah_laporan_perbulan_kategori[$i][3] . ",";
						}
						?>
					]
				}
			],
			grid: {
				padding: {
					top: -20,
					right: 0,
					left: -4,
					bottom: -4
				},
				strokeDashArray: 4,
				xaxis: {
					lines: {
						show: true
					}
				},
			},
			xaxis: {
				labels: {
					padding: 0,
				},
				tooltip: {
					enabled: false
				},
				axisBorder: {
					show: false,
				},
			},
			yaxis: {
				labels: {
					padding: 4
				},
			},
			labels: [
				<?php
				for ($i = 1; $i <= 12; $i++) {
					echo $i . ",";
				} ?>
			],
			colors: ["#F76707", "#C13333", "#1E293B"],
			legend: {
				show: false,
			},
		})).render();
	});
	// @formatter:on
</script>
<!-- End Grafik Berdasarkan kategori Laporan -->


<!-- Grafik Berdasarkan Status Laporan -->
<script>
	// @formatter:off
	document.addEventListener("DOMContentLoaded", function() {
		window.ApexCharts && (new ApexCharts(document.getElementById('grafik-laporan-masuk-berdasarkan-status-laporan'), {
			chart: {
				type: "bar",
				fontFamily: 'inherit',
				height: 300,
				parentHeightOffset: 0,
				toolbar: {
					show: false,
				},
				animations: {
					enabled: false
				},
				stacked: true,
			},
			plotOptions: {
				bar: {
					columnWidth: '50%',
				}
			},
			dataLabels: {
				enabled: false,
			},
			fill: {
				opacity: 1,
			},
			series: [{
					name: "Tidak Selesai",
					data: [
						<?php
						for ($i = 1; $i <= 12; $i++) {
							echo $jumlah_laporan_perbulan_status[$i][2] . ",";
						}
						?>
					]
				}, {
					name: "Selesai",
					data: [
						<?php
						for ($i = 1; $i <= 12; $i++) {
							echo $jumlah_laporan_perbulan_status[$i][1] . ",";
						}
						?>
					]
				},
				{
					name: "Menunggu Respon",
					data: [
						<?php
						for ($i = 1; $i <= 12; $i++) {
							echo $jumlah_laporan_perbulan_status[$i][0] . ",";
						}
						?>
					]
				}
			],
			grid: {
				padding: {
					top: -20,
					right: 0,
					left: -4,
					bottom: -4
				},
				strokeDashArray: 4,
				xaxis: {
					lines: {
						show: true
					}
				},
			},
			xaxis: {
				labels: {
					padding: 0,
				},
				tooltip: {
					enabled: false
				},
				axisBorder: {
					show: false,
				},
			},
			yaxis: {
				labels: {
					padding: 4
				},
			},
			labels: [
				<?php
				for ($i = 1; $i <= 12; $i++) {
					echo $i . ",";
				} ?>
			],
			colors: ["#ff9900", "#00e516", "#f40000"],
			legend: {
				show: false,
			},
		})).render();
	});
	// @formatter:on
</script>
<!-- End Grafik Berdasarkan Status Laporan -->


<!-- Grafik Berdasarkan verifikasi Laporan -->
<script>
	// @formatter:off
	document.addEventListener("DOMContentLoaded", function() {
		window.ApexCharts && (new ApexCharts(document.getElementById('grafik-laporan-masuk-berdasarkan-verifikasi-laporan'), {
			chart: {
				type: "bar",
				fontFamily: 'inherit',
				height: 300,
				parentHeightOffset: 0,
				toolbar: {
					show: false,
				},
				animations: {
					enabled: false
				},
				stacked: true,
			},
			plotOptions: {
				bar: {
					columnWidth: '50%',
				}
			},
			dataLabels: {
				enabled: false,
			},
			fill: {
				opacity: 1,
			},
			series: [{
					name: "Tidak Terverifikasi",
					data: [
						<?php
						for ($i = 1; $i <= 12; $i++) {
							echo $jumlah_laporan_perbulan_verifikasi[$i][2] . ",";
						}
						?>
					]
				}, {
					name: "Terverifikasi",
					data: [
						<?php
						for ($i = 1; $i <= 12; $i++) {
							echo $jumlah_laporan_perbulan_verifikasi[$i][1] . ",";
						}
						?>
					]
				},
				{
					name: "Belum diverifikasi",
					data: [
						<?php
						for ($i = 1; $i <= 12; $i++) {
							echo $jumlah_laporan_perbulan_verifikasi[$i][0] . ",";
						}
						?>
					]
				}
			],
			grid: {
				padding: {
					top: -20,
					right: 0,
					left: -4,
					bottom: -4
				},
				strokeDashArray: 4,
				xaxis: {
					lines: {
						show: true
					}
				},
			},
			xaxis: {
				labels: {
					padding: 0,
				},
				tooltip: {
					enabled: false
				},
				axisBorder: {
					show: false,
				},
			},
			yaxis: {
				labels: {
					padding: 4
				},
			},
			labels: [
				<?php
				for ($i = 1; $i <= 12; $i++) {
					echo $i . ",";
				} ?>
			],
			colors: ["#ff9900", "#00e516", "#f40000"],
			legend: {
				show: false,
			},
		})).render();
	});
	// @formatter:on
</script>
<!-- End Grafik Berdasarkan verifikasi Laporan -->

<?= $this->endSection('content'); ?>