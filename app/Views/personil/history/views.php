<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php
$ClassHome = new App\Controllers\Home;


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
							<h3 class="card-title" style="margin-left: 10px;">Data History Tindakan</h3>
						</div>
						<div>
							<a onclick="window.localtion.reload()" class="btn btn-outline-dark">
								<i class="fa fa-sync"></i>
							</a>
						</div>
					</div>
					<div class="card-body">

						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-body">
										Anda telah menindaklanjuti <strong><?= $jumlah_laporan_tl_personil; ?></strong> dari <strong><?= $jumlah_seluruh_laporan; ?></strong> laporan masuk
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

						<div class="row mt-3" id="data-history-tindakan">

							<div class="col-12">
								<div class="alert alert-info py-4">
									Memuat data history tindakan anda !
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
	function tampilkan_history_laporan_dengan_tindakan(jenis_data) {

		var list_data_tindakan_personel = "";
		$.ajax({
			type: "POST",
			url: "<?= base_url() ?>/Personil/Laporan/getHistoryTindakan",
			dataType: "JSON",
			data: {
				jenis_data: jenis_data
			},
			beforeSend: function() {
				$("#loader").show();
				console.log('Memuat data laporan !');
			},
			success: function(data) {
				var arrayDataLaporanLength = data.length;

				$('#jumlah-tindakan').html(`
					Anda telah menindaklanjuti ${arrayDataLaporanLength} laporan
				`);

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

						list_data_tindakan_personel += `
												<div class="col-lg-4 mb-3">
													<a href="<?= base_url(); ?>/personil/laporan/detail/${item.token}" class="text-decoration-none">
														<div class="card border-0 ${class_kategori_laporan}" style="border-radius: 20px;">
															<div class="card-body">
																<div class="d-flex justify-content-between">
																	<span class="badge badge-pill">
																		Kategori ${item.kategori_laporan}
																	</span>

																	<span class="badge badge-pill">
																		${item.verifikasi_text}
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
																<div class="mt-2">
																	<small style="font-size: 10px;">
																		Lokasi : ${item.alamat}
																	</small>
																</div>
																<div class="mt-2">
																	<small style="font-size: 10px; font-style: italic;">
																		${item.text_jumlah_personil_tindak_lanjut}
																	</small>
																</div>

															</div>
														</div>
													</a>
												</div>						
											`;
					});

				} else {
					list_data_tindakan_personel += `
							<div class="col-lg-12">
								<div class="card bg-azure border-0 rounded-3">
									<div class="card-body text-white">
										Anda belum pernah menindaklanjuti laporan !
									</div>
								</div>
							</div>
						`;
				}

				$('#data-history-tindakan').html(list_data_tindakan_personel);

			},
			complete: function(data) {
				$("#loader").hide();
			}
		});

	}

	tampilkan_history_laporan_dengan_tindakan('all');
</script>

<?= $this->endSection('content'); ?>