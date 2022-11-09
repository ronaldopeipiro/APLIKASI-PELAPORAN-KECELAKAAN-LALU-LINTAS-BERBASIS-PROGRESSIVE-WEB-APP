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
								<div class="d-flex justify-content-between align-items-center w-100">
									<div class="">
										<div class="d-flex justify-content-between align-items-center">
											<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
												<path stroke="none" d="M0 0h24v24H0z" fill="none" />
												<rect x="4" y="4" width="16" height="16" rx="2" />
												<line x1="4" y1="10" x2="20" y2="10" />
												<line x1="10" y1="4" x2="10" y2="20" />
											</svg>
											<span>Data Kategori Laporan</span>
										</div>
									</div>

									<div class="float-end">
										<!-- <a title="Tambah Data" data-title="Tambah Data" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalFormTambahUbah">
											<i class="fa fa-plus"></i> Tambah
										</a> -->
									</div>
								</div>
							</div>

							<div class="card-body">

								<div id="table-content">
									<table class="table table-responsive table-mobile-lg table-hover table-bordered table-vcenter" id="data-table-custom" style="font-size: 12px;">
										<thead>
											<tr class="text-center">
												<th>No.</th>
												<th>Kategori</th>
												<th>Deskripsi</th>
												<th>Create at</th>
												<th>Update at</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1; ?>
											<?php foreach ($kategori_laporan as $row) : ?>
												<tr>
													<td style="vertical-align: middle;" class="text-center"><?= $no; ?></td>
													<td style="vertical-align: middle; width: 20%;" class="text-left">
														<?= $row['kategori_laporan']; ?>
													</td>
													<td style="vertical-align: middle; width: 40%;" class="text-left">
														<?= $row['deskripsi']; ?>
													</td>
													<td style="vertical-align: middle;" class="text-center">
														<?= strftime('%d/%m/%Y %H:%M:%S', strtotime($row['create_datetime'])); ?>
													</td>
													<td style="vertical-align: middle;" class="text-center">
														<?= ($row['update_datetime'] != "") ? strftime('%d/%m/%Y %H:%M:%S', strtotime($row['update_datetime'])) : ""; ?>
													</td>
													<td style="vertical-align: middle;" clas>
														<div class="list-unstyled d-flex justify-content-center">
															<li class="me-2">
																<a title="Ubah Data" data-title="Ubah Data" data-idkategorilaporan="<?= $row['id_kategori_laporan']; ?>" data-kategorilaporan="<?= $row['kategori_laporan']; ?>" data-deskripsi="<?= $row['deskripsi']; ?>" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalFormTambahUbah">
																	<i class="fa fa-edit"></i>
																</a>
															</li>
														</div>
													</td>
												</tr>
												<?php $no++; ?>
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

<div id="modalFormTambahUbah" class="modal fade">
	<div class="modal modal-dialog modal-dialog-centered modal-dialog-scrollable">

		<div class="modal-content">
			<form id="formTambahUbahData">
				<?= csrf_field(); ?>
				<div class="modal-header">
					<h5 class="modal-title">
					</h5>
					<button type="button" class="btn-close btnCloseModalTambahData" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">

					<input type="hidden" name="action" id="action" value="">
					<input type="hidden" name="id_kategori_laporan" id="id_kategori_laporan">

					<div class="form-group mb-3">
						<label for="kategori_laporan" class="col-form-label col-sm-12">
							Kategori
						</label>
						<div class="col-sm-12">
							<input type="text" name="kategori_laporan" id="kategori_laporan" class="form-control" placeholder="Masukkan kategori ...">
						</div>
					</div>

					<div class="form-group">
						<label for="deskripsi" class="col-form-label col-sm-12">
							Deskripsi
						</label>
						<div class="col-sm-12">
							<textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" placeholder="Masukkan deskripsi ..."></textarea>
						</div>
					</div>

				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-success shadow">
						<i class="fa fa-save me-2"></i> SIMPAN
					</button>
				</div>
			</form>
		</div>

	</div>
</div>

<script>
	function loadTable() {
		var datetime = new Date();
		var tanggalHariIni = datetime.getDate() + '-' + datetime.getMonth() + '-' + datetime.getFullYear();

		var dataTable = $('#data-table-custom').DataTable({
			"paging": true,
			"responsive": true,
			"searching": true,
			"deferRender": true,
			"lengthMenu": [
				[10, 25, 50, 100, 500, -1],
				['10', '25', '50', '100', '500', 'Semua']
			],
		});
	}
</script>

<script>
	$(document).ready(function() {
		loadTable();

		var modalTambahData = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalFormTambahUbah'));
		$(".btnCloseModalTambahData").on("click", function(event) {
			modalTambahData.hide();
		});

		$("#modalFormTambahUbah").on("show.bs.modal", function(event) {
			var button = $(event.relatedTarget);
			var title = button.data("title");
			$(this).find(".modal-title").text(title);

			if (title == "Tambah Data") {
				$(this).find("#action").val("tambah");
				$("form").trigger("reset");
			} else if (title == "Ubah Data") {
				var idkategorilaporan = button.data("idkategorilaporan");
				var kategorilaporan = button.data("kategorilaporan");
				var deskripsi = button.data("deskripsi");

				$(this).find("#action").val("ubah");
				$(this).find("#id_kategori_laporan").val(idkategorilaporan);
				$(this).find("#kategori_laporan").val(kategorilaporan);
				$(this).find("#deskripsi").val(deskripsi);
			}
		});
	});
</script>

<script>
	$(document).ready(function() {
		$(function() {

			$("#formTambahUbahData").submit(function(e) {
				e.preventDefault();

				var modalTambahData = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalFormTambahUbah'));

				var action = $('#action').val();

				if (action == "tambah") {
					var kategori_laporan = $('#kategori_laporan').val();
					var deskripsi = $('#deskripsi').val();

					$.ajax({
						type: "POST",
						url: "<?= base_url() ?>/Admin/DataMaster/tambah_kategori_laporan",
						dataType: "JSON",
						data: {
							kategori_laporan: kategori_laporan,
							deskripsi: deskripsi
						},
						beforeSend: function() {
							$("#loader").show();
						},
						success: function(data) {
							if (data.success == "1") {
								$("#data-table-custom").load(location.href + " #data-table-custom > *");
								$("form").trigger("reset");
								modalTambahData.hide();
								toastr.success(data.pesan);
							} else if (data.success == "0") {
								toastr.error(data.pesan);
							}
						},
						complete: function() {
							$("#loader").hide();
						}
					});
				} else if (action == "ubah") {
					var id_kategori_laporan = $('#id_kategori_laporan').val();
					var kategori_laporan = $('#kategori_laporan').val();
					var deskripsi = $('#deskripsi').val();

					$.ajax({
						type: "POST",
						url: "<?= base_url() ?>/Admin/DataMaster/ubah_kategori_laporan",
						dataType: "JSON",
						data: {
							id_kategori_laporan: id_kategori_laporan,
							kategori_laporan: kategori_laporan,
							deskripsi: deskripsi
						},
						beforeSend: function() {
							$("#loader").show();
						},
						success: function(data) {
							if (data.success == "1") {
								$("#data-table-custom").load(location.href + " #data-table-custom > *");
								$("form").trigger("reset");
								modalTambahData.hide();
								toastr.success(data.pesan);
							} else if (data.success == "0") {
								toastr.error(data.pesan);
							}
						},
						complete: function() {
							$("#loader").hide();
						}
					});
				}

			});

		});
	});
</script>

<?= $this->endSection('content'); ?>