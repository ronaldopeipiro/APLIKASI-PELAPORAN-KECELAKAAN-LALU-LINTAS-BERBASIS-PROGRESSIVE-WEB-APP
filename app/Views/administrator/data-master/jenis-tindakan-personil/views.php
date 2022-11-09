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
											<span>Data Jenis Tindakan Personil</span>
										</div>
									</div>

									<div class="float-end">
										<a title="Tambah Data" data-title="Tambah Data" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalFormTambahUbah">
											<i class="fa fa-plus"></i> Tambah
										</a>
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
												<th>Create at</th>
												<th>Update at</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1; ?>
											<?php foreach ($jenis_tindakan as $row) : ?>
												<tr>
													<td style="vertical-align: middle;" class="text-center"><?= $no; ?></td>
													<td style="vertical-align: middle; width: 60%;" class="text-left">
														<?= $row['jenis_tindakan']; ?>
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
																<a title="Ubah Data" data-title="Ubah Data" data-idjenistindakan="<?= $row['id_jenis_tindakan']; ?>" data-jenistindakan="<?= $row['jenis_tindakan']; ?>" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalFormTambahUbah">
																	<i class="fa fa-edit"></i>
																</a>
															</li>
															<li>
																<form id="formHapusData-<?= $no ?>">
																	<?= csrf_field(); ?>
																	<input type="hidden" name="id_jenis_tindakan" value="<?= $row['id_jenis_tindakan']; ?>">
																	<input type="hidden" name="_method" value="DELETE">
																	<button type="submit" style="width: 50px;" class="btn-hapus btn btn-danger">
																		<i class="fa fa-trash-alt"></i>
																	</button>
																</form>

																<script>
																	$("#formHapusData-<?= $no ?>").submit(function(e) {
																		e.preventDefault();

																		var id_jenis_tindakan = $(this).find("input[name='id_jenis_tindakan']").val();

																		$.ajax({
																			type: "POST",
																			url: "<?= base_url() ?>/Admin/DataMaster/hapus_jenis_tindakan",
																			dataType: "JSON",
																			data: {
																				id_jenis_tindakan: id_jenis_tindakan,
																			},
																			beforeSend: function() {
																				$("#loader").show();
																			},
																			success: function(data) {
																				if (data.success == "1") {
																					$("#data-table-custom").load(location.href + " #data-table-custom > *");
																					toastr.success(data.pesan);
																				} else if (data.success == "0") {
																					toastr.error(data.pesan);
																				}
																			},
																			complete: function() {
																				$("#loader").hide();
																			}
																		});

																	});
																</script>
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

					<input type="hidden" name="action" id="action">
					<input type="hidden" name="id_jenis_tindakan" id="id_jenis_tindakan">

					<div class="form-group mb-3">
						<label for="jenis_tindakan" class="col-form-label col-sm-12">
							Jenis Tindakan
						</label>
						<div class="col-sm-12">
							<input type="text" name="jenis_tindakan" id="jenis_tindakan" class="form-control" placeholder="Masukkan jenis tindakan ...">
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
				var idjenistindakan = button.data("idjenistindakan");
				var jenistindakan = button.data("jenistindakan");

				$(this).find("#action").val("ubah");
				$(this).find("#id_jenis_tindakan").val(idjenistindakan);
				$(this).find("#jenis_tindakan").val(jenistindakan);
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
					var jenis_tindakan = $('#jenis_tindakan').val();
					var deskripsi = $('#deskripsi').val();

					$.ajax({
						type: "POST",
						url: "<?= base_url() ?>/Admin/DataMaster/tambah_jenis_tindakan",
						dataType: "JSON",
						data: {
							jenis_tindakan: jenis_tindakan,
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
					var id_jenis_tindakan = $('#id_jenis_tindakan').val();
					var jenis_tindakan = $('#jenis_tindakan').val();
					var deskripsi = $('#deskripsi').val();

					$.ajax({
						type: "POST",
						url: "<?= base_url() ?>/Admin/DataMaster/ubah_jenis_tindakan",
						dataType: "JSON",
						data: {
							id_jenis_tindakan: id_jenis_tindakan,
							jenis_tindakan: jenis_tindakan,
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