<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php
$ClassHome = new App\Controllers\Home;
?>

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
							<h3 class="card-title" style="margin-left: 10px;">History Laporan</h3>
						</div>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-12">
								<h5>Filter tanggal :</h5>
							</div>
							<div class="col-lg-3 my-3">
								<div class="form-group">
									<input type="date" id="tgl_mulai" class="form-control" placeholder="<?= date('Y-m-d'); ?>">
								</div>
							</div>
							<div class="col-lg-3 my-3">
								<div class="form-group">
									<input type="date" id="tgl_selesai" class="form-control" placeholder="<?= date('Y-m-d'); ?>">
								</div>
							</div>
						</div>
						<div class="row" id="laporan-saya">
							<div class="col-12">
								<div class="alert alert-info">
									Memuat data history laporan !
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
	function tampilkan_laporan(jenis_data) {

		var list_data_laporan = "";
		$.ajax({
			type: "POST",
			url: "<?= base_url() ?>/Pelapor/Laporan/getLaporanMasuk",
			dataType: "JSON",
			data: {
				jenis_data: jenis_data
			},
			beforeSend: function() {
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
												<a href="<?= base_url(); ?>/pelapor/laporan/detail/${item.token}" class="text-decoration-none">
													<div class="card border-0 ${class_kategori_laporan}" style="border-radius: 20px;">
														<div class="card-body">
															<div class="d-block">
																<span class="mb-2 badge badge-pill">
																	Kategori ${item.kategori_laporan}
																</span>
																<span class="mb-2 badge badge-pill">
																	${item.status_text}
																</span>
																<span class="mb-2 badge badge-pill">
																	${item.verifikasi_text}
																</span>
															</div>
															<div class="d-flex mt-2 justify-content-between">
																<small class="fst-italic text-white">
																	${item.waktu}
																</small>
															</div>
															<div class="mt-3">
																<small style="font-size: 10px;">
																	Lokasi : ${item.alamat}
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

				$('#laporan-saya').html(list_data_laporan);

			},
			complete: function(data) {
				$("#loader").hide();
			}
		});

	}
</script>

<script>
	$(document).ready(function() {
		$("#btn-refresh-laporan-saya").click(function(e) {
			e.preventDefault();
			$("#loader").show();
			tampilkan_laporan('all');
			$("#loader").hide();
		});
	});

	tampilkan_laporan('all');
</script>

<?= $this->endSection('content'); ?>