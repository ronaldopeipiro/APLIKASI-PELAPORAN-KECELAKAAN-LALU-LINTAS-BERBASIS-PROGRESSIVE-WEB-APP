<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

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

			<div class="col-lg-12">
				<div class="row row-cards">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
									<path stroke="none" d="M0 0h24v24H0z" fill="none" />
									<rect x="4" y="4" width="16" height="16" rx="2" />
									<line x1="4" y1="10" x2="20" y2="10" />
									<line x1="10" y1="4" x2="10" y2="20" />
								</svg>
								<span>Data Laporan</span>
							</div>

							<div class="card-body">

								<div class="row mb-3">

									<div class="col-lg-4 mb-3 mb-lg-0">
										<label for="pelaporSelect">Pelapor</label>
										<div id="pelaporSelect"></div>
									</div>

									<div class="col-lg-2 mb-3 mb-lg-0">
										<label for="kategoriLaporanSelect">Kategori Laporan</label>
										<div id="kategoriLaporanSelect"></div>
									</div>

									<div class="col-lg-2 mb-3 mb-lg-0">
										<label for="kategoriKecelakaanSelect">Kategori Kecelakaan</label>
										<div id="kategoriKecelakaanSelect"></div>
									</div>

									<div class="col-lg-2 mb-3 mb-lg-0">
										<label for="statusSelect">Status</label>
										<div id="statusSelect"></div>
									</div>

									<div class="col-lg-2 mb-3 mb-lg-0">
										<label for="verifikasiSelect">Verifikasi</label>
										<div id="verifikasiSelect"></div>
									</div>

								</div>

								<div class="">
									<table class="table table-responsive table-bordered table-hover table-transparent table-vcenter" id="data-table-custom" style="width: 100%; font-size: 12px;">
										<thead>
											<tr class="text-center">
												<th>No.</th>
												<th>Tanggal</th>
												<th>Waktu</th>
												<th>Pelapor</th>
												<th>Kategori Laporan</th>
												<th>Kategori Kecelakaan</th>
												<th>Status</th>
												<th>Verifikasi</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1; ?>
											<?php foreach ($laporan as $row) : ?>
												<?php
												$id_laporan = $row['id_laporan'];
												$id_kategori_laporan = $row['id_kategori_laporan'];
												$kategori_laporan = ($db->query("SELECT * FROM tb_kategori_laporan WHERE id_kategori_laporan='$id_kategori_laporan' "))->getRow();

												$id_pelapor = $row['id_pelapor'];
												$pelapor = ($db->query("SELECT * FROM tb_pelapor WHERE id_pelapor='$id_pelapor' "))->getRow();

												$kategori_kecelakaan = "";
												$id_kategori_kecelakaan = $row['id_kategori_kecelakaan'];
												if ($id_kategori_kecelakaan != "") {
													$data_kategori_kecelakaan = $db->query("SELECT * FROM tb_kategori_kecelakaan WHERE id_kategori_kecelakaan='$id_kategori_kecelakaan'");
													if ($row = $data_kategori_kecelakaan->getRow()) {
														$kategori_kecelakaan =  $dkk['kategori_kecelakaan'];
													}
												}

												if ($row['status'] == "0") {
													$text_status = "Menunggu Respon";
												} elseif ($row['status'] == "1") {
													$text_status = "Telah ditindaklanjuti";
												} elseif ($row['status'] == "2") {
													$text_status = "Tidak ditindaklanjuti";
												}

												if ($row['verifikasi'] == "0") {
													$text_verif = "Belum diverifikasi";
												} elseif ($row['verifikasi'] == "1") {
													$text_verif = "Terverifikasi";
												} elseif ($row['verifikasi'] == "2") {
													$text_verif = "Tidak Terverifikasi";
												}
												?>

												<tr>
													<td style="vertical-align: middle;" class="text-center"><?= $no++; ?></td>
													<td style="vertical-align: middle;" class="text-center">
														<?= strftime('%d/%m/%Y', strtotime($row['waktu'])); ?>
													</td>
													<td style="vertical-align: middle;" class="text-left">
														<?= strftime('%H:%M:%S WIB', strtotime($row['waktu'])); ?>
													</td>
													<td style="vertical-align: middle;" class="text-left">
														<?= $pelapor->nama_lengkap; ?>
													</td>
													<td style="vertical-align: middle;" class="text-center">
														<?= $kategori_laporan->kategori_laporan; ?>
													</td>
													<td style="vertical-align: middle;">
														<?= $kategori_kecelakaan; ?>
													</td>
													<td style="vertical-align: middle;">
														<?= $text_status; ?>
													</td>
													<td style="vertical-align: middle;">
														<?= $text_verif; ?>
													</td>
													<td style="vertical-align: middle;">
														<div class="list-unstyled d-flex">
															<li style="margin-right: 5px;">
																<button type="button" class="btn btn-info" data-bs-toggle="modal" data-filesurat="" title="Detail Surat">
																	<i class="fa fa-list"></i>
																</button>
															</li>
														</div>
													</td>
												</tr>
											<?php endforeach; ?>

										</tbody>
									</table>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<div id="modal-detail-surat" class="modal fade" tabindex="-1">
	<div class="modal-lg modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Detail Surat</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<table class="table table-borderless table-responsive">
					<tr>
						<td>Waktu Data</td>
						<td>:</td>
						<td>
							<span class="waktudata"></span>
						</td>
					</tr>
					<tr>
						<td>Tanggal Surat</td>
						<td>:</td>
						<td>
							<span class="tanggalsurat"></span>
						</td>
					</tr>
					<tr>
						<td>No. Surat</td>
						<td>:</td>
						<td>
							<span class="nosurat"></span>
						</td>
					</tr>
					<tr>
						<td>No. Agenda</td>
						<td>:</td>
						<td>
							<span class="noagenda"></span>
						</td>
					</tr>
					<tr>
						<td>Kode Hal</td>
						<td>:</td>
						<td>
							<span class="kodehal"></span>
						</td>
					</tr>
					<tr>
						<td>Perihal</td>
						<td>:</td>
						<td>
							<span class="perihal"></span>
						</td>
					</tr>
					<tr>
						<td>Nama/Instansi Pengirim</td>
						<td>:</td>
						<td>
							<span class="pengirim"></span>
						</td>
					</tr>
					<tr>
						<td>Ditujukan Kepada</td>
						<td>:</td>
						<td>
							<span class="penerima"></span>
						</td>
					</tr>
					<tr>
						<td>Unit Kerja</td>
						<td>:</td>
						<td>
							<span class="unitkerja"></span>
						</td>
					</tr>
					<tr>
						<td>Tembusan</td>
						<td>:</td>
						<td>
							<div class="tembusan"></div>
						</td>
					</tr>
					<tr>
						<td>File Surat</td>
						<td>:</td>
						<td>
							<a href="#" class="linkfile" target="_blank" download="">
								<span class="namafile"></span>
							</a>
						</td>
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$("#modal-detail-surat").on("show.bs.modal", function(event) {
			var button = $(event.relatedTarget);

			var waktudata = button.data("waktudata");
			var tanggalsurat = button.data("tanggalsurat");
			var nosurat = button.data("nosurat");
			var noagenda = button.data("noagenda");
			var kodehal = button.data("kodehal");
			var perihal = button.data("perihal");
			var pengirim = button.data("pengirim");
			var penerima = button.data("penerima");
			var tembusan = button.data("tembusan");
			var unitkerja = button.data("unitkerja");
			var filesurat = button.data("filesurat");

			$(this).find(".waktudata").text(waktudata);
			$(this).find(".tanggalsurat").text(tanggalsurat);
			$(this).find(".nosurat").text(nosurat);
			$(this).find(".noagenda").text(noagenda);
			$(this).find(".kodehal").text(kodehal);
			$(this).find(".perihal").text(perihal);
			$(this).find(".pengirim").text(pengirim);
			$(this).find(".penerima").text(penerima);
			$(this).find(".tembusan").html(tembusan);
			$(this).find(".unitkerja").text(unitkerja);
			$(this).find(".linkfile").attr("href", "<?= base_url() ?>/assets/surat/" + filesurat);
			$(this).find(".linkfile").attr("download", filesurat);
			$(this).find(".namafile").text(filesurat);
		});

	});
</script>

<script>
	$(document).ready(function() {
		var datetime = new Date();
		var tanggalHariIni = datetime.getDate() + '-' + datetime.getMonth() + '-' + datetime.getFullYear();

		var tabel_user = $('#data-table-custom').DataTable({
			"paging": true,
			"responsive": true,
			"searching": true,
			"deferRender": true,
			"initComplete": function() {
				var pelapor = this.api().column(3);
				var pelaporSelect = $('<select class="filter form-control js-select-2"><option value="">Semua</option></select>')
					.appendTo('#pelaporSelect')
					.on('change', function() {
						var val = $(this).val();
						pelapor.search(val ? '^' + $(this).val() + '$' : val, true, false).draw();
					});
				pelapor.data().unique().sort().each(function(d, j) {
					pelaporSelect.append('<option value="' + d + '">' + d + '</option>');
				});

				var kategoriLaporan = this.api().column(4);
				var kategoriLaporanSelect = $('<select class="filter form-control js-select-2"><option value="">Semua</option></select>')
					.appendTo('#kategoriLaporanSelect')
					.on('change', function() {
						var val = $(this).val();
						kategoriLaporan.search(val ? '^' + $(this).val() + '$' : val, true, false).draw();
					});
				kategoriLaporanSelect.append(`
						<option value="Ringan">Ringan</option>
						<option value="Sedang">Sedang</option>
						<option value="Berat">Berat</option>
					`);

				var kategoriKecelakaan = this.api().column(5);
				var kategoriKecelakaanSelect = $('<select class="filter form-control js-select-2"><option value="">Semua</option></select>')
					.appendTo('#kategoriKecelakaanSelect')
					.on('change', function() {
						var val = $(this).val();
						kategoriKecelakaan.search(val ? '^' + $(this).val() + '$' : val, true, false).draw();
					});
				kategoriKecelakaan.data().unique().sort().each(function(d, j) {
					kategoriKecelakaanSelect.append('<option value="' + d + '">' + d + '</option>');
				});

				var status = this.api().column(6);
				var statusSelect = $('<select class="filter form-control js-select-2"><option value="">Semua</option></select>')
					.appendTo('#statusSelect')
					.on('change', function() {
						var val = $(this).val();
						status.search(val ? '^' + $(this).val() + '$' : val, true, false).draw();
					});
				statusSelect.append(`
						<option value="Menunggu Respon">Menunggu Respon</option>
						<option value="Selesai">Selesai</option>
						<option value="Tidak Selesai">Tidak Selesai</option>
					`);

				var verifikasi = this.api().column(7);
				var verifikasiSelect = $('<select class="filter form-control js-select-2"><option value="">Semua</option></select>')
					.appendTo('#verifikasiSelect')
					.on('change', function() {
						var val = $(this).val();
						verifikasi.search(val ? '^' + $(this).val() + '$' : val, true, false).draw();
					});
				verifikasiSelect.append(`
						<option value="Belum diverifikasi">Belum diverifikasi</option>
						<option value="Terverifikasi">Terverifikasi</option>
						<option value="Tidak Terverifikasi">Tidak Terverifikasi</option>
					`);
			},
			"lengthMenu": [
				[10, 25, 50, 100, 500, -1],
				['10', '25', '50', '100', '500', 'Semua']
			],
		});

	});
</script>
<?= $this->endSection('content'); ?>