<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php
$ClassHome = new App\Controllers\Home;

$id_laporan = $laporan['id_laporan'];
$latitude = $laporan['latitude'];
$longitude = $laporan['longitude'];
?>

<div class="container-xl">
	<!-- Page title -->
	<div class="page-header d-print-none">
		<div class="laporan align-items-center">
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
				<div class="card pb-0">
					<div class="card-header d-flex justify-content-between">
						<div class="d-flex align-items-center">
							<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
								<path stroke="none" d="M0 0h24v24H0z" fill="none" />
								<circle cx="17" cy="17" r="4" />
								<path d="M17 13v4h4" />
								<path d="M12 3v4a1 1 0 0 0 1 1h4" />
								<path d="M11.5 21h-6.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v2m0 3v4" />
							</svg>
							<h3 class="card-title" style="margin-left: 10px;">Detail Laporan</h3>
						</div>
						<div>
							<a onclick="window.location.reload()" class="btn btn-outline-primary">
								<i class="fas fa-sync"></i>
							</a>
							<a href="<?= base_url(); ?>/pelapor/laporan" class="btn btn-outline-dark">
								<i class="fa fa-arrow-left"></i>
							</a>
						</div>
					</div>
					<div class="card-body p-0">
						<div class="laporan" id="laporan-saya">
							<?php
							$id_kategori_laporan = $laporan['id_kategori_laporan'];
							$kategori_laporan = ($db->query("SELECT * FROM tb_kategori_laporan WHERE id_kategori_laporan='$id_kategori_laporan' "))->getRow();

							if ($id_kategori_laporan == "1") {
								$class_bg_by_kategori_laporan = "bg-warning text-white";
								$link_icon_marker = base_url() . "/img/marker-low.png";
							} elseif ($id_kategori_laporan == "2") {
								$class_bg_by_kategori_laporan = "bg-danger text-white";
								$link_icon_marker = base_url() . "/img/marker-medium.png";
							} elseif ($id_kategori_laporan == "3") {
								$class_bg_by_kategori_laporan = "bg-dark text-white";
								$link_icon_marker = base_url() . "/img/marker-high.png";
							}

							if ($laporan['status'] == "0") {
								$text_status = "Menunggu Respon";
							} elseif ($laporan['status'] == "1") {
								$text_status = "Telah diitindaklanjut";
							} elseif ($laporan['status'] == "2") {
								$text_status = "Tidak ditindaklanjut";
							}

							if ($laporan['verifikasi'] == "0") {
								$text_verif = "Belum diverifikasi";
							} elseif ($laporan['verifikasi'] == "1") {
								$text_verif = "Terverifikasi";
							} elseif ($laporan['verifikasi'] == "2") {
								$text_verif = "Tidak Terverifikasi";
							}
							$cek_tindakan = $db->query("SELECT * FROM tb_tindakan_personil WHERE id_laporan='$id_laporan' ")->getNumRows();
							?>

							<div class="col-lg-12 mb-3">
								<div class="card border-0 <?= $class_bg_by_kategori_laporan; ?>">
									<div class="card-body">
										<div class="d-flex justify-content-start">
											<small class="fst-italic text-white me-2">
												<?= date('d/m/Y', strtotime($laporan['waktu'])); ?>
											</small>
											<small class="fst-italic text-white">
												<?= date('H:i:s', strtotime($laporan['waktu'])); ?> WIB
											</small>
										</div>
										<div class="d-flex mt-3">
											<span>
												Kategori <?= $kategori_laporan->kategori_laporan; ?>
											</span>
										</div>
										<div class="d-flex mt-3 justify-content-between">
											<span class="badge">
												Status : <?= $text_status; ?>
											</span>
											<span class="badge">
												<?= $text_verif; ?>
											</span>
										</div>
										<div class="my-3">
											<table class="table-sm table-responsive" style="font-size: 12px;">
												<tr>
													<td>Alamat</td>
													<td>:</td>
													<td>
														<span id="address">
															<?= $ClassHome->getAddress($laporan['latitude'], $laporan['longitude']); ?>
														</span>
													</td>
												</tr>
												<tr>
													<td>Koordinat</td>
													<td>:</td>
													<td class="d-flex">
														<span id="lat">
															<?= $laporan['latitude'] ?>
														</span>,
														<span class="ms-1" id="lng">
															<?= $laporan['longitude']; ?>
														</span>
													</td>
												</tr>
											</table>
										</div>

										<div class="row justify-content-lg-start justify-content-between mb-3">
											<div class="col-xl-4 col-lg-4 col-sm-4 col-xs-4 col-4 mb-3 mb-lg-0">
												<a class="shadow btn btn-primary ms-0 me-lg-2 btn-block w-100" data-bs-toggle="modal" data-bs-target="#modalFormTambahFoto">
													<i class="fa fa-plus me-2"></i> Foto
												</a>
											</div>
											<div class="col-xl-4 col-lg-4 col-sm-4 col-xs-4 col-4 mb-3 mb-lg-0">
												<a class="shadow btn btn-secondary ms-0 me-lg-2 btn-block w-100" data-bs-toggle="modal" data-bs-target="#modalFormLaporanKorban" data-action="tambah">
													<i class="fa fa-plus me-2"></i> Korban
												</a>
											</div>
											<?php if (!($cek_tindakan > 0)) : ?>
												<div class="col-xl-4 col-lg-4 col-sm-4 col-xs-4 col-4 mb-lg-0">
													<button onclick="cancel_laporan(<?= $id_laporan ?>)" class="shadow btn btn-white btn-block w-100">
														<i class="fa fa-times me-2"></i> Batal
													</button>
												</div>
											<?php endif; ?>
										</div>

										<div>
											<h4>Peta Lokasi Laporan</h4>
											<?php if (!($cek_tindakan > 0)) : ?>
												<small class="fst-italic">
													Silahkan geser marker untuk mengubah koordinat lokasi laporan !
												</small>
											<?php endif; ?>
											<div id="map" style="height: 68vh; width: 100%; border-radius: 10px;"></div>
										</div>
										<hr>

										<div class="my-1">
											<h4>Foto Laporan</h4>
											<div id="list-foto-laporan" class="row">
												<?php
												$data_foto_laporan = $db->query("SELECT * FROM tb_foto_laporan WHERE id_laporan='$id_laporan' ORDER BY id_foto DESC");
												?>
												<?php if ($data_foto_laporan->getNumRows() > 0) : ?>

													<?php foreach ($data_foto_laporan->getResult('array') as $fl) : ?>

														<div class="col-6 col-xl-2 col-lg-2 col-md-4 col-xs-12 col-sm-6  mb-4 position-relative">
															<a data-fancybox="gallery" href="<?= base_url(); ?>/img/laporan/kejadian/<?= $fl['foto']; ?>" style="width: 100%; height: 200px;" data-caption="<?= $fl['deskripsi']; ?>">
																<img src="<?= base_url(); ?>/img/laporan/kejadian/<?= $fl['foto']; ?>" alt="image" style="width: 100%; height: 180px; object-fit: cover; object-position: center; border-radius: 5px;">
															</a>

															<?php if (($fl['upload_by'] == "pelapor") and ($fl['id_user_upload'] == $user_id_pelapor)) : ?>
																<div style="position: absolute; top: 0; left: 8px; margin: 0; padding: 0; z-index: 2;">
																	<div class="d-inline">
																		<a class="shadow btn btn-success" data-bs-toggle="modal" data-bs-target="#modalFormUbahFoto" data-idfoto="<?= $fl['id_foto']; ?>" data-deskripsi="<?= $fl['deskripsi']; ?>" style="width: 45px;">
																			<i class="fa fa-edit"></i>
																		</a>
																		<button onclick="delete_foto_laporan('<?= $fl['id_foto'] ?>', '<?= $fl['foto'] ?>')" class="shadow btn btn-danger">
																			<i class="fa fa-times"></i>
																		</button>
																	</div>
																</div>
															<?php endif; ?>
														</div>

													<?php endforeach; ?>

												<?php else : ?>

													<div class="col-12">
														<div class="alert alert-dismissible alert-info">
															<span class="text-dark">
																Belum ada foto laporan !
															</span>
														</div>
													</div>

												<?php endif; ?>

											</div>
										</div>

										<hr>

										<div class="my-4">
											<h4>Laporan Korban</h4>
											<div id="list-laporan-korban" class="row">
												<?php
												$data_laporan_korban = $db->query("SELECT * FROM tb_laporan_korban WHERE id_laporan='$id_laporan' ORDER BY id_laporan_korban DESC");
												?>
												<?php if ($data_laporan_korban->getNumRows() > 0) : ?>
													<?php foreach ($data_laporan_korban->getResult('array') as $data_korban) : ?>
														<?php
														$id_user_input = $data_korban['id_user_input'];

														$id_kategori_korban = $data_korban['id_kategori_korban'];
														$kategori_korban = $db->query("SELECT * FROM tb_kategori_korban WHERE id_kategori_korban='$id_kategori_korban' ")->getRow();

														if ($data_korban['input_by'] == "pelapor") {
															$user_input = $db->query("SELECT * FROM tb_pelapor WHERE id_pelapor='$id_user_input' ")->getRow();

															$nama_user_input = $user_input->nama_lengkap;
															$detail_user_input = $user_input->email;

															$foto_user = explode(':', $user_input->foto);
															if ($foto_user[0] == 'https') {
																$foto_user_input =	$user_input->foto;
															} else {
																$foto_user_input = base_url() . "/img/pelapor/" . $user_input->foto;
															}

															$jenis_alert_laporan_korban = "alert-info";
															$laporan_korban_input_by_detail = "oleh Pelapor";
														} elseif ($data_korban['input_by'] == "personil") {
															$user_input = $db->query("SELECT * FROM tb_personil WHERE id_personil='$id_user_input' ")->getRow();

															$id_pangkat = $user_input->id_pangkat;
															if ($id_pangkat != "") {
																$data_pangkat = $db->query("SELECT * FROM tb_pangkat_personil WHERE id_pangkat='$id_pangkat' ")->getRow();
																$pangkat = $data_pangkat->singkatan;
															} else {
																$pangkat = "";
															}

															$nama_user_input = $pangkat . " " . $user_input->nama_lengkap;
															$detail_user_input = "NRP. " . $user_input->nrp;

															if ($user_input->foto != "") {
																$foto_user_input = base_url() . "/img/personil/" .	$user_input->foto;
															} else {
																$foto_user_input = base_url() . "/img/noimg.png";
															}

															$laporan_korban_input_by_detail = "oleh Personel";
															$jenis_alert_laporan_korban = "alert-success";
														}
														?>

														<div class="col-lg-4 mb-3">
															<div class="h-100 alert <?= $jenis_alert_laporan_korban; ?>">
																<div class="d-flex align-items-center">
																	<div class="d-block">
																		<div class="text-center mb-4">
																			<img src="<?= $foto_user_input; ?>" style="border: solid 2px #eee; padding: 3px; width: 70px; height: 70px; border-radius: 50%;">
																		</div>
																		<div class="d-inline">
																			<a class="shadow btn btn-success" data-bs-toggle="modal" data-bs-target="#modalFormLaporanKorban" data-action="ubah" data-idlaporankorban="<?= $data_korban['id_laporan_korban']; ?>" data-idkategorikorban="<?= $data_korban['id_kategori_korban']; ?>" data-jumlahkorban="<?= $data_korban['jumlah_korban']; ?>" data-deskripsi="<?= $data_korban['deskripsi']; ?>" style="width: 45px;">
																				<i class="fa fa-edit"></i>
																			</a>
																			<button onclick="hapus_laporan_korban('<?= $data_korban['id_laporan_korban'] ?>')" class="shadow btn btn-danger">
																				<i class="fa fa-times"></i>
																			</button>
																		</div>
																	</div>
																	<div class="ms-3">
																		<div class="d-block">
																			<small class="text-muted fst-italic d-flex align-items-center">
																				<?= $laporan_korban_input_by_detail; ?> pada
																				<div class="d-flex ms-1">
																					<small class="fst-italic text-dark me-2">
																						<?= date('d/m/Y', strtotime($data_korban['create_datetime'])); ?>
																					</small>
																					<small class="fst-italic text-dark">
																						<?= date('H:i:s', strtotime($data_korban['create_datetime'])); ?> WIB
																					</small>
																				</div>
																			</small>
																			<span class="text-dark font-weight-bold d-block">
																				<?= $nama_user_input; ?>
																			</span>
																			<small class="text-dark d-block">
																				<?= $detail_user_input; ?>
																			</small>
																		</div>
																		<div class="d-flex align-items-center border-top mt-3">
																			<h1 class="text-dark me-3">
																				<?= $data_korban['jumlah_korban']; ?>
																			</h1>
																			<span class="text-dark me-1">Korban</span> <span class="font-weight-bold text-dark"><?= $kategori_korban->kategori_korban; ?></span>
																		</div>
																		<small class="text-dark">
																			<?= $data_korban['deskripsi']; ?>
																		</small>
																	</div>
																</div>
															</div>
														</div>


													<?php endforeach; ?>

												<?php else : ?>

													<div class="col-12">
														<div class="alert alert-dismissible alert-info">
															<span class="text-dark">
																Belum ada data laporan korban !
															</span>
														</div>
													</div>
												<?php endif; ?>
											</div>
										</div>

										<hr>

										<div class="my-4">
											<h4>Tindakan oleh Personel</h4>
											<div id="list-tindakan-personil" class="row">
												<?php if ($cek_tindakan > 0) : ?>
													<?php
													$data_personil_tindakan = $db->query("SELECT DISTINCT id_personil FROM tb_tindakan_personil WHERE id_laporan='$id_laporan'");
													?>
													<?php foreach ($data_personil_tindakan->getResult('array') as $row) : ?>
														<?php
														$id_personil = $row['id_personil'];
														$personil = $db->query("SELECT * FROM tb_personil WHERE id_personil='$id_personil' ")->getRow();

														$id_pangkat = $personil->id_pangkat;
														$pangkat_personil = $db->query("SELECT * FROM tb_pangkat_personil WHERE id_pangkat='$id_pangkat' ")->getRow();
														?>

														<div class="col-12">
															<div class="alert alert-info">
																<div class="d-flex align-items-center">
																	<div>
																		<img src="<?= (empty($personil->foto)) ? base_url() . 	'/img/noimage.png' : base_url() . '/img/personil/' . $personil->foto; ?>" style="border: solid 2px #eee; padding: 3px; width: 70px; height: 70px; border-radius: 50%;">
																	</div>
																	<div class="ms-3">
																		<span class="text-dark font-weight-bold d-block">
																			<?= $pangkat_personil->singkatan; ?> <?= $personil->nama_lengkap; ?>
																		</span>
																		<small class="text-dark d-block">
																			<?= $personil->nrp; ?>
																		</small>
																	</div>
																</div>
																<table class="table table-responsive ms-1 table-hover">
																	<?php
																	$data_tindakan = $db->query("SELECT * FROM tb_tindakan_personil WHERE id_laporan='$id_laporan' AND id_personil='$id_personil' ORDER BY id_tindakan ASC ");
																	?>
																	<?php foreach ($data_tindakan->getResult('array') as $row) : ?>
																		<?php
																		$id_tindakan = $row['id_tindakan'];
																		$id_jenis_tindakan = $row['id_jenis_tindakan'];
																		$jenis_tindakan = $db->query("SELECT * FROM tb_jenis_tindakan_personil WHERE id_jenis_tindakan='$id_jenis_tindakan' ")->getRow();
																		?>
																		<tr>
																			<td style="width: 80%; vertical-align: middle;">
																				<div class="d-block">
																					<small class="fst-italic text-dark me-2">
																						<?= date('d/m/Y', strtotime($row['waktu'])); ?>
																					</small>
																					<small class="fst-italic text-dark">
																						<?= date('H:i:s', strtotime($row['waktu'])); ?> WIB
																					</small>
																				</div>
																				<div class="d-flex align-items-center">
																					<span class="font-weight-bold text-dark">
																						=> <?= $jenis_tindakan->jenis_tindakan; ?>
																					</span>
																				</div>
																				<?php
																				$data_foto_tindakan = $db->query("SELECT * FROM tb_foto_tindakan_personil WHERE id_tindakan='$id_tindakan' ORDER BY id_foto DESC ");
																				?>
																				<?php if ($data_foto_tindakan->getNumRows() > 0) : ?>
																					<div class="row">
																						<?php foreach ($data_foto_tindakan->getResult('array') as $fotoTindakan) : ?>
																							<?php
																							$id_foto = $fotoTindakan['id_foto'];
																							$nama_foto = $fotoTindakan['foto'];
																							?>
																							<div class="col-xl-1 col-lg-2 col-md-2 col-sm-3 col-xs-6 col-6">
																								<div class="position-relative">
																									<a data-fancybox="gallery" href="<?= base_url(); ?>/img/laporan/tindakan/<?= $fotoTindakan['foto']; ?>" style="width: 100%; height: 100%; object-fit: cover;" data-caption="<?= $fotoTindakan['deskripsi']; ?>">
																										<img src="<?= base_url(); ?>/img/laporan/tindakan/<?= $fotoTindakan['foto']; ?>" alt="image" style="width: 100%; height: 100px; object-fit: cover; object-position: center; border-radius: 5px;">
																									</a>
																								</div>
																							</div>
																						<?php endforeach; ?>
																					</div>
																				<?php endif; ?>
																			</td>
																		</tr>
																	<?php endforeach; ?>
																</table>
															</div>
														</div>

													<?php endforeach; ?>

												<?php else : ?>

													<div class="col-12">
														<div class="alert alert-dismissible alert-info">
															<span class="text-dark">
																Belum ada tindakan personel !
															</span>
														</div>
													</div>

												<?php endif; ?>

											</div>
										</div>

										<hr>


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

<div id="modalFormTambahFoto" class="modal fade">
	<div class="modal-lg modal-dialog modal-dialog-centered modal-dialog-scrollable scrollable">

		<div class="modal-content">

			<form id="formTambahFoto" enctype="multipart/form-data">
				<?= csrf_field(); ?>
				<div class="modal-header">
					<h5 class="modal-title">
						<i class="fa fa-camera"></i> Tambah Foto Laporan
					</h5>
					<button type="button" class="btn-close btnClosemodalTambahFoto" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">

					<input type="hidden" id="lat_pelapor" value="">
					<input type="hidden" id="lng_pelapor" value="">

					<div class="form-group mb-3">
						<div class="form-group row">
							<label for="foto" class="col-sm-12 col-form-label">
								Pilih / Ambil Foto <small class="text-danger">(*Wajib diisi !)</small> <br>
								<small class="text-muted">(Maks Ukuran file : 8MB)</small> <br>
								<small class="text-muted">(Tipe file : .jpeg, jpg, .png)</small>
							</label>
							<div class="col-sm-12">
								<input type="file" name="foto" id="foto" class="dropify" accept="image/*" data-height="250" data-max-file-size="8M" data-allowed-file-extensions="png jpg jpeg" style="font-size: 12px;" required>
							</div>
						</div>
					</div>

					<div class="form-group mb-3">
						<div class="col-sm-12">
							<textarea name="deskripsi" rows="4" class="form-control deskripsi" placeholder="Deskripsi ..."></textarea>
						</div>
					</div>

				</div>

				<div class="card-footer">
					<button type="submit" class="btn btn-success btn-block shadow">
						<i class="fa fa-save me-2"></i> SIMPAN
					</button>
				</div>

			</form>
		</div>

	</div>
</div>

<div id="modalFormUbahFoto" class="modal fade">
	<div class="modal-lg modal-dialog modal-dialog-centered modal-dialog-scrollable scrollable">

		<div class="modal-content">
			<form id="formUbahFoto" enctype="multipart/form-data">
				<?= csrf_field(); ?>
				<div class="modal-header">
					<h5 class="modal-title">
						<i class="fa fa-camera"></i> Ubah Deskripsi Foto
					</h5>
					<button type="button" class="btn-close btnClosemodalUbahFoto" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">

					<input type="hidden" name="id_foto" class="id_foto">

					<div class="form-group mb-3">
						<div class="col-sm-12">
							<textarea name="deskripsi" rows="4" class="form-control deskripsiubah" placeholder="Deskripsi ..."></textarea>
						</div>
					</div>

				</div>

				<div class="card-footer">
					<button type="submit" class="btn btn-success btn-block shadow">
						<i class="fa fa-save me-2"></i> SIMPAN
					</button>
				</div>
			</form>
		</div>

	</div>
</div>

<div id="modalFormLaporanKorban" class="modal fade">
	<div class="modal-lg modal-dialog modal-dialog-centered modal-dialog-scrollable scrollable">

		<div class="modal-content">
			<form id="formLaporanKorban" enctype="multipart/form-data">
				<?= csrf_field(); ?>
				<div class="modal-header">
					<h5 class="modal-title" id="judul-form-laporan-korban">
						<i class="fa fa-plus"></i> Buat Laporan Korban
					</h5>
					<button type="button" class="btn-close btnCloseModalLaporanKorban" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">

					<input type="hidden" name="action" value="tambah">
					<input type="hidden" name="id_laporan_korban">

					<div class="form-group mb-3">
						<label class="col-form-label col-sm-12" for="">Kategori Korban</label>
						<div class="col-sm-12">
							<select name="id_kategori_korban" class="form-control" required>
								<option value=""></option>
								<?php foreach ($data_kategori_korban as $row) : ?>
									<option value="<?= $row['id_kategori_korban']; ?>"><?= $row['kategori_korban']; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>

					<div class="form-group mb-3">
						<label class="col-form-label col-sm-12" for="">Jumlah Korban</label>
						<div class="col-sm-12">
							<input type="number" name="jumlah_korban" style="width: 100px;" class="form-control text-center" placeholder="0" value="1" min="1" minlength="1" required>
						</div>
					</div>

					<div class="form-group mb-3">
						<div class="col-sm-12">
							<textarea name="deskripsi" rows="4" class="form-control" placeholder="Deskripsi laporan ..."></textarea>
						</div>
					</div>

				</div>

				<div class="card-footer">
					<button type="submit" class="btn btn-success btn-block shadow">
						<i class="fa fa-save me-2"></i> SIMPAN
					</button>
				</div>
			</form>
		</div>

	</div>
</div>

<script>
	let map, infowindow, geocoder, marker, accuracyStatus;

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
								<span class="fa fa-times"></span>
								` + position.coords.accuracy.toFixed(2) + ` m (Lemah)
							</strong>`;
				}

				$('#lat_pelapor').val(position.coords.latitude);
				$('#lng_pelapor').val(position.coords.longitude);
			});
		}

		var pos = {
			lat: <?= $latitude ?>,
			lng: <?= $longitude ?>,
		};

		<?php if (!($cek_tindakan > 0)) : ?>
			var draggable = true;
		<?php else : ?>
			var draggable = false;
		<?php endif; ?>

		map = new google.maps.Map(document.getElementById('map'), {
			zoom: 18,
			center: pos
		});

		infowindow = new google.maps.InfoWindow();
		var latlngbounds = new google.maps.LatLngBounds();

		const markerLaporan = {
			url: "<?= $link_icon_marker ?>", // url
			scaledSize: new google.maps.Size(50, 50), // scaled size
			origin: new google.maps.Point(0, 0), // origin
			anchor: new google.maps.Point(25, 25) // anchor
		};

		marker = new google.maps.Marker({
			position: pos,
			map: map,
			icon: markerLaporan,
			draggable: draggable,
		});

		google.maps.event.addListener(marker, 'drag', function() {
			var positionStartLat = this.position.lat();
			var positionStartLng = this.position.lng();
			document.getElementById('lat').innerHTML = positionStartLat;
			document.getElementById('lng').innerHTML = positionStartLng;
		});

		google.maps.event.addListener(marker, 'dragend', function() {
			var positionStartLatNew = this.position.lat();
			var positionStartLngNew = this.position.lng();

			var newPosition = {
				lat: positionStartLatNew,
				lng: positionStartLngNew
			};

			geocoder = new google.maps.Geocoder();
			geocoder.geocode({
				'latLng': newPosition
			}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					var newAddress = results[3].formatted_address;
					document.getElementById('address').innerHTML = newAddress;
				}
			});

			ubahKoordinatLaporan(<?= $laporan['id_laporan'] ?>, positionStartLatNew, positionStartLngNew);
		});
	}
</script>

<script>
	$(document).ready(function() {
		$('.dropify').dropify({
			messages: {
				default: '',
				replace: 'Ganti',
				remove: 'Hapus',
			},
			error: {
				'fileSize': 'Ukuran file maksimal ({{ value }}).',
				'imageFormat': 'Ekstensi file tidak diizinkan, ekstensi yang diizinkan hanya ({{ value }}).'
			}
		});

		// Form Tambah Foto
		var modalTambahFoto = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalFormTambahFoto'));
		$(".btnClosemodalTambahFoto").on("click", function(event) {
			modalTambahFoto.hide();
		});

		$("#modalFormTambahFoto").on("show.bs.modal", function(event) {
			$("#formTambahFoto").trigger("reset");
		});
		// End form tambah foto

		// Form Ubah Foto
		var modalUbahFoto = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalFormUbahFoto'));
		$(".btnClosemodalUbahFoto").on("click", function(event) {
			modalUbahFoto.hide();
		});

		$("#modalFormUbahFoto").on("show.bs.modal", function(event) {
			$("#formUbahFoto").trigger("reset");

			var button = $(event.relatedTarget);
			var id_foto = button.data("idfoto");
			var deskripsi = button.data("deskripsi");

			$(this).find(".id_foto").val(id_foto);
			$(this).find(".deskripsiubah").val(deskripsi);
		});
		// End form ubah foto

		// Form laporan korban
		var modalLaporanKorban = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalFormLaporanKorban'));
		$(".btnCloseModalLaporanKorban").on("click", function(event) {
			modalLaporanKorban.hide();
		});

		$("#modalFormLaporanKorban").on("show.bs.modal", function(event) {
			$("#formLaporanKorban").trigger("reset");

			var button = $(event.relatedTarget);

			var action = button.data("action");

			if (action == 'ubah') {
				$("#judul-form-laporan-korban").html(`
					<i class="fa fa-edit"></i> Ubah Laporan Korban
				`);
				var idlaporankorban = button.data("idlaporankorban");
				var idkategorikorban = button.data("idkategorikorban");
				var jumlahkorban = button.data("jumlahkorban");
				var deskripsi = button.data("deskripsi");

				$(this).find("input[name=action]").val(action);
				$(this).find("input[name=id_laporan_korban]").val(idlaporankorban);
				$(this).find("select[name=id_kategori_korban]").val(idkategorikorban).change();;
				$(this).find("input[name=jumlah_korban]").val(jumlahkorban);
				$(this).find("textarea[name=deskripsi]").val(deskripsi);
			}
		});
		// End form laporan korban

	});

	function ubahKoordinatLaporan(id_laporan, latitude, longitude) {
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "<?= base_url() ?>/Pelapor/Laporan/ubah_koordinat_laporan",
			dataType: "JSON",
			data: {
				id_laporan: id_laporan,
				latitude: latitude,
				longitude: longitude
			},
			beforeSend: function() {
				$("#loader").show();
			},
			success: function(data) {
				if (data.success == "1") {
					toastr.success(data.pesan);
				} else if (data.success == "0") {
					toastr.error(data.pesan);
				}
			},
			complete: function(data) {
				$("#loader").hide();
			}
		});
	}

	$("#formTambahFoto").submit(function(e) {
		e.preventDefault();

		var modalTambahFoto = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalFormTambahFoto'));

		const foto = $('#foto').prop('files')[0];
		const id_laporan = "<?= $id_laporan ?>";
		const deskripsi = $('.deskripsi').val();
		const latitude = $('#lat_pelapor').val();
		const longitude = $('#lng_pelapor').val();

		if (latitude == "" && longitude == "") {
			toastr.error('Gagal mendapatkan koordinat posisi anda !');
		} else {
			let formData = new FormData();
			formData.append('foto', foto);
			formData.append('id_laporan', id_laporan);
			formData.append('deskripsi', deskripsi);
			formData.append('latitude', latitude);
			formData.append('longitude', longitude);

			$.ajax({
				type: "POST",
				url: "<?= base_url() ?>/Pelapor/Laporan/tambah_foto_laporan",
				dataType: "JSON",
				data: formData,
				cache: false,
				processData: false,
				contentType: false,
				beforeSend: function() {
					$("#loader").show();
				},
				success: function(data) {
					if (data.success == "1") {
						$("#list-foto-laporan").load(location.href + " #list-foto-laporan > *");
						$("#formTambahFoto").trigger("reset");
						modalTambahFoto.hide();
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

	$("#formUbahFoto").submit(function(e) {
		e.preventDefault();

		var modalUbahFoto = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalFormUbahFoto'));

		const id_laporan = "<?= $id_laporan ?>";
		const id_foto = $('.id_foto').val();
		const deskripsi = $('.deskripsiubah').val();

		let formData = new FormData();
		formData.append('id_foto', id_foto);
		formData.append('id_laporan', id_laporan);
		formData.append('deskripsi', deskripsi);

		$.ajax({
			type: "POST",
			url: "<?= base_url() ?>/Pelapor/Laporan/ubah_deskripsi_foto_laporan",
			dataType: "JSON",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			beforeSend: function() {
				$("#loader").show();
			},
			success: function(data) {
				if (data.success == "1") {
					$("#list-foto-laporan").load(location.href + " #list-foto-laporan > *");
					$("#formUbahFoto").trigger("reset");
					modalUbahFoto.hide();
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

	function delete_foto_laporan(id_foto, nama_file) {
		event.preventDefault();
		Swal.fire({
			title: "Hapus Foto ?",
			text: "Pilih ya jika anda yakin ingin menghapus foto ini !",
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
					url: "<?= base_url() ?>/Pelapor/Laporan/hapus_foto_laporan",
					dataType: "JSON",
					data: {
						id_foto: id_foto,
						nama_file: nama_file
					},
					beforeSend: function() {
						$("#loader").show();
					},
					success: function(data) {
						if (data.success == "1") {
							$("#list-foto-laporan").load(location.href + " #list-foto-laporan > *");
							toastr.success(data.pesan);
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
							window.location = base_url + '/pelapor/laporan';
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


	$("#formLaporanKorban").submit(function(e) {
		e.preventDefault();

		var modalLaporanKorban = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalFormLaporanKorban'));

		const action = $('#formLaporanKorban input[name=action]').val();

		const id_laporan = "<?= $id_laporan ?>";
		const id_laporan_korban = $('#formLaporanKorban input[name=id_laporan_korban]').val();
		const id_kategori_korban = $('#formLaporanKorban select[name=id_kategori_korban]').val();
		const jumlah_korban = $('#formLaporanKorban input[name=jumlah_korban]').val();
		const deskripsi = $('#formLaporanKorban textarea[name=deskripsi]').val();

		let formData = new FormData();

		formData.append('id_laporan', id_laporan);
		formData.append('id_kategori_korban', id_kategori_korban);
		formData.append('jumlah_korban', jumlah_korban);
		formData.append('deskripsi', deskripsi);

		if (action == "tambah") {
			var urlAjax = base_url + "/Pelapor/Laporan/tambah_laporan_korban";
		} else if (action == "ubah") {

			formData.append('id_laporan_korban', id_laporan_korban);
			var urlAjax = base_url + "/Pelapor/Laporan/ubah_laporan_korban";
		}

		$.ajax({
			type: "POST",
			url: urlAjax,
			dataType: "JSON",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			beforeSend: function() {
				$("#loader").show();
			},
			success: function(data) {
				if (data.success == "1") {
					$("#list-laporan-korban").load(location.href + " #list-laporan-korban > *");
					$("#formLaporanKorban").trigger("reset");
					modalLaporanKorban.hide();

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

	function hapus_laporan_korban(id_laporan_korban) {
		event.preventDefault();
		Swal.fire({
			title: "Hapus Laporan Korban ?",
			text: "Pilih ya jika anda ingin menghapus laporan korban berikut !",
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
					url: "<?= base_url() ?>/Pelapor/Laporan/hapus_laporan_korban",
					dataType: "JSON",
					data: {
						id_laporan_korban: id_laporan_korban
					},
					beforeSend: function() {
						$("#loader").show();
					},
					success: function(data) {
						if (data.success == "1") {
							$("#list-laporan-korban").load(location.href + " #list-laporan-korban > *");
							toastr.success(data.pesan);
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
</script>
<?= $this->endSection('content'); ?>