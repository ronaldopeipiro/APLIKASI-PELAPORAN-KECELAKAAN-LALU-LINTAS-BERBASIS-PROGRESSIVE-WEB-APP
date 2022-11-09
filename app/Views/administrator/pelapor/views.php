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
								<span>Data Pelapor</span>
							</div>

							<div class="card-body">

								<div class="row justify-content-end mb-3">
									<div class="col-lg-2 mb-3 mb-lg-0">
										<label for="statusSelect">Status</label>
										<div id="statusSelect"></div>
									</div>
								</div>

								<div class="">
									<table class="table table-responsive table-hover table-transparent table-vcenter" id="data-table-custom">
										<thead>
											<tr class="text-center">
												<th>No.</th>
												<th>Foto</th>
												<th>Nama Lengkap</th>
												<th>Email</th>
												<th>NIK</th>
												<th>No. Handphone</th>
												<th>Status</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1; ?>
											<?php foreach ($pelapor as $row) : ?>
												<?php
												if ($row['status'] == "0") {
													$text_status = "Tidak Aktif";
												} elseif ($row['status'] == "1") {
													$text_status = "Aktif";
												}

												$foto_pelapor = explode(':', $row['foto']);
												if ($foto_pelapor[0] == 'https') {
													$foto =	$row['foto'];
												} else {
													$foto = base_url() . "/img/pelapor/" . $row['foto'];
												}

												if ($row['tanggal_lahir'] != "") {
													$tanggal_lahir = strftime('%d/%m/%Y', strtotime($row['tanggal_lahir']));
												} else {
													$tanggal_lahir = "";
												}

												$id_pelapor = $row['id_pelapor'];
												$jumlah_laporan = $db->query("SELECT * FROM tb_laporan WHERE id_pelapor='$id_pelapor' ")->getNumRows();
												$jumlah_laporan_terverifikasi = $db->query("SELECT * FROM tb_laporan WHERE id_pelapor='$id_pelapor' AND verifikasi='1' ")->getNumRows();
												$jumlah_laporan_tidak_terverifikasi = $jumlah_laporan - $jumlah_laporan_terverifikasi;
												?>

												<tr>
													<td style="vertical-align: middle;" class="text-center"><?= $no++; ?></td>
													<td style="vertical-align: middle;" class="text-center">
														<img src="<?= $foto; ?>" style="width: 57px; height: 57px; object-fit: cover; border-radius: 10px; border: solid 2px #ddd;">
													</td>
													<td style="vertical-align: middle;" class="text-left">
														<?= $row['nama_lengkap']; ?>
													</td>
													<td style="vertical-align: middle;" class="text-left">
														<?= $row['email']; ?>
													</td>
													<td style="vertical-align: middle;">
														<?= $row['nik']; ?>
													</td>
													<td style="vertical-align: middle;">
														<?= $row['no_hp']; ?>
													</td>
													<td style="vertical-align: middle;">
														<?= $text_status; ?>
													</td>
													<td style="vertical-align: middle;">
														<div class="list-unstyled d-flex">
															<li style="margin-right: 5px;">
																<button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modal-detail-pelapor" data-foto="<?= $foto; ?>" data-namalengkap="<?= $row['nama_lengkap']; ?>" data-nik="<?= $row['nik']; ?>" data-email="<?= $row['email']; ?>" data-nohp="<?= $row['no_hp']; ?>" data-alamat="<?= $row['alamat']; ?>" data-tanggallahir="<?= $tanggal_lahir; ?>" data-status="<?= $text_status; ?>" data-latitude="<?= $row['latitude']; ?>" data-longitude="<?= $row['longitude']; ?>" data-createdatetime="<?= strftime('%d/%m/%Y %H:%M:%S WIB', strtotime($row['create_datetime'])); ?>" data-updatedatetime="<?= strftime('%d/%m/%Y %H:%M:%S WIB', 	strtotime($row['update_datetime'])); ?>" data-lastlogin="<?= strftime('%d/%m/%Y %H:%M:%S WIB', strtotime($row['last_login'])); ?>" data-jumlahlaporan="<?= $jumlah_laporan; ?>" data-jumlahlaporanverif="<?= $jumlah_laporan_terverifikasi; ?>" data-jumlahlaporantidakverif="<?= $jumlah_laporan_tidak_terverifikasi; ?>" title="Detail">
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

<div id="modal-detail-pelapor" class="modal fade" tabindex="-1">
	<div class="modal-xl modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Detail Pelapor</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-6">
						<div class="text-center">
							<img src="" class="fotopelapor" style="width: 200px; height: 200px; object-fit: cover; object-position: center; border-radius: 20px; border: solid 3 px #ddd;">
						</div>
						<table class="table-sm table-borderless table-responsive mt-3">
							<tr>
								<td style="width: 130px;">Nama Lengkap</td>
								<td>:</td>
								<td>
									<span class="namalengkap"></span>
								</td>
							</tr>
							<tr>
								<td>NIK</td>
								<td>:</td>
								<td>
									<span class="nik"></span>
								</td>
							</tr>
							<tr>
								<td>Tanggal Lahir</td>
								<td>:</td>
								<td>
									<span class="tanggallahir"></span>
								</td>
							</tr>
							<tr>
								<td>Email</td>
								<td>:</td>
								<td>
									<span class="email"></span>
								</td>
							</tr>
							<tr>
								<td>No. Handphone</td>
								<td>:</td>
								<td>
									<span class="nohp"></span>
								</td>
							</tr>
							<tr>
								<td>Alamat</td>
								<td>:</td>
								<td>
									<span class="alamat"></span>
								</td>
							</tr>
							<tr>
								<td>Status Akun</td>
								<td>:</td>
								<td>
									<span class="status"></span>
								</td>
							</tr>
							<tr>
								<td>Last Login</td>
								<td>:</td>
								<td>
									<div class="lastlogin"></div>
								</td>
							</tr>
							<tr>
								<td>Create at</td>
								<td>:</td>
								<td>
									<div class="createdatetime"></div>
								</td>
							</tr>
							<tr>
								<td>Update at</td>
								<td>:</td>
								<td>
									<div class="updatedatetime"></div>
								</td>
							</tr>
						</table>
					</div>

					<div class="col-lg-6 mt-4 mt-lg-0">
						<div class="row">
							<div class="col-lg-12">
								<div class="row">
									<div class="col-12 border py-2">
										<h3>
											History Laporan
										</h3>
									</div>
									<div class="col-4 border rounded-3 py-3">
										<h1 class="text-center jumlahlaporan"></h1>
										<small class="text-center">
											Laporan dibuat
										</small>
									</div>
									<div class="col-4 border rounded-3 py-3">
										<h1 class="text-center jumlahlaporanverif"></h1>
										<small class="text-center">
											Laporan terverifikasi
										</small>
									</div>
									<div class="col-4 border rounded-3 py-3">
										<h1 class="text-center jumlahlaporantidakverif"></h1>
										<small class="text-center">
											Laporan tidak terverifikasi
										</small>
									</div>
								</div>
							</div>

							<div class="col-lg-12 mt-4">
								<h4>
									Peta Lokasi Pelapor <small class="text-muted fst-italic">update at</small>
								</h4>
								<div id="maps-lokasi-pelapor" style="width: 100%; height: 300px; border-radius: 10px;"></div>
							</div>
						</div>

					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$("#modal-detail-pelapor").on("show.bs.modal", function(event) {
			var button = $(event.relatedTarget);

			var namalengkap = button.data("namalengkap");
			var nik = button.data("nik");
			var tanggallahir = button.data("tanggallahir");
			var email = button.data("email");
			var nohp = button.data("nohp");
			var alamat = button.data("alamat");
			var status = button.data("status");
			var latitude = button.data("latitude");
			var longitude = button.data("longitude");
			var foto = button.data("foto");
			var createdatetime = button.data("createdatetime");
			var updatedatetime = button.data("updatedatetime");
			var lastlogin = button.data("lastlogin");
			var jumlahlaporan = button.data("jumlahlaporan");
			var jumlahlaporanverif = button.data("jumlahlaporanverif");
			var jumlahlaporantidakverif = button.data("jumlahlaporantidakverif");

			$(this).find(".namalengkap").text(namalengkap);
			$(this).find(".nik").text(nik);
			$(this).find(".tanggallahir").text(tanggallahir);
			$(this).find(".email").text(email);
			$(this).find(".nohp").text(nohp);
			$(this).find(".alamat").text(alamat);
			$(this).find(".status").text(status);
			$(this).find(".latitude").text(latitude);
			$(this).find(".longitude").text(longitude);
			$(this).find(".fotopelapor").attr("src", foto);
			$(this).find(".createdatetime").text(createdatetime);
			$(this).find(".updatedatetime").text(updatedatetime);
			$(this).find(".lastlogin").text(lastlogin);
			$(this).find(".jumlahlaporan").text(jumlahlaporan);
			$(this).find(".jumlahlaporanverif").text(jumlahlaporanverif);
			$(this).find(".jumlahlaporantidakverif").text(jumlahlaporantidakverif);
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
			// "dom": 'lBfrtipS',
			"initComplete": function() {
				var status = this.api().column(6);
				var statusSelect = $('<select class="filter form-control"><option value="">Semua</option></select>')
					.appendTo('#statusSelect')
					.on('change', function() {
						var val = $(this).val();
						status.search(val ? '^' + $(this).val() + '$' : val, true, false).draw();
					});
				statusSelect.append(`
						<option value="Aktif">Aktif</option>
						<option value="Tidak Aktif">Tidak Aktif</option>
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