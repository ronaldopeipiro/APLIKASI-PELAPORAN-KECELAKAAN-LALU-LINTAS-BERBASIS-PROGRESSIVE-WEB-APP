<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<?php
$ClassHome = new App\Controllers\Home;

$id_pelapor = $laporan['id_pelapor'];
$id_laporan = $laporan['id_laporan'];
$latitude = $laporan['latitude'];
$longitude = $laporan['longitude'];

$pelapor = $db->query("SELECT * FROM tb_pelapor WHERE id_pelapor = '$id_pelapor' ")->getRow();

$data_foto_pelapor = explode(':', $pelapor->foto);
if ($data_foto_pelapor[0] == 'https') {
	$foto_pelapor =	$pelapor->foto;
} else {
	$foto_pelapor = base_url() . "/img/pelapor/" . $pelapor->foto;
}
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
							<h3 class="card-title" style="margin-left: 10px;">
								Detail Laporan
							</h3>
						</div>

						<div>
							<a onclick="window.location.reload()" class="btn btn-outline-primary">
								<i class="fas fa-sync"></i>
							</a>
							<a href="<?= base_url(); ?>/personil/laporan" class="btn btn-outline-dark">
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
								$text_status = "Telah ditindaklanjuti";
							} elseif ($laporan['status'] == "2") {
								$text_status = "Tidak ditindaklanjuti";
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
													<td colspan="3">
														<div class="d-flex align-items-center">
															dilaporkan oleh
															<div class="ms-2">
																<img src="<?= $foto_pelapor ?>" style="height: 40px; width: 40px; object-fit: cover; object-position: top; border: solid 2px #eee; border-radius: 50%; padding: 1px;" alt="<?= $pelapor->nama_lengkap; ?> - <?= $pelapor->email; ?>">
															</div>
															<div class="ms-2">
																<span class="font-weight-bold d-block">
																	<?= $pelapor->nama_lengkap; ?>
																</span>
																<small class="fst-italic d-block">
																	<?= $pelapor->email; ?>
																</small>
															</div>
														</div>
													</td>
												</tr>
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
												<tr>
													<td>Waktu Laporan</td>
													<td>:</td>
													<td>
														<div class="d-flex justify-content-start">
															<small class="fst-italic text-white me-2">
																<?= strftime('%d/%m/%Y', strtotime($laporan['waktu'])); ?>
															</small>
															<small class="fst-italic text-white">
																<?= strftime('%H:%M:%S WIB', strtotime($laporan['waktu'])); ?>
															</small>
														</div>
													</td>
												</tr>
											</table>

										</div>

										<div class="row justify-content-lg-start justify-content-between mb-3" id="aksi-tindakan-personil">
											<h4 class="mb-3">
												Tindakan yang dapat anda lakukan :
											</h4>
											<?php if ($cek_tindakan > 0) : ?>
												<?php
												$list_tindakan = $db->query("SELECT * FROM tb_jenis_tindakan_personil WHERE id_jenis_tindakan != '1' and aktif='Y' ORDER BY id_jenis_tindakan ASC");
												?>
												<?php foreach ($list_tindakan->getResult('array') as $list) : ?>
													<?php
													$id_jenis_tindakan = $list['id_jenis_tindakan'];
													$jenis_tindakan = $list['jenis_tindakan'];

													$cek_ambil_tindakan = $db->query("SELECT * FROM tb_tindakan_personil WHERE id_laporan = '$id_laporan' AND id_jenis_tindakan = '$id_jenis_tindakan' AND id_personil = '$user_id' ");
													?>
													<?php if ($cek_ambil_tindakan->getNumRows() == 0) : ?>
														<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
															<a class="shadow btn btn-success ms-0 me-lg-2 btn-block w-100" onclick="tambah_tindakan('<?= $id_jenis_tindakan ?>', '<?= $jenis_tindakan ?>', '<?= $id_laporan ?>', '<?= $id_pelapor ?>', '<?= $latitude ?>', '<?= $longitude ?>')">
																<i class="fa fa-arrow-right me-2"></i> <?= $list['jenis_tindakan']; ?>
															</a>
														</div>
													<?php endif; ?>
												<?php endforeach; ?>
											<?php else : ?>
												<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12 mb-2">
													<a class="shadow btn btn-success ms-0 me-lg-2 btn-block w-100" onclick="tambah_tindakan('1', 'Mendatangi TKP', '<?= $id_laporan ?>', '<?= $id_pelapor ?>', '<?= $latitude ?>', '<?= $longitude ?>')">
														<i class="fa fa-motorcycle me-2"></i> Mendatangi TKP
													</a>
												</div>
											<?php endif; ?>

										</div>

										<div>
											<div class="d-flex justify-content-between mb-2">
												<div class="d-flex align-items-center">
													<a id="btn-show-maps" class="btn btn-secondary">
														<i class="fa fa-map"></i>
													</a>
													<h4 class="mt-2 ms-2">Peta Lokasi</h4>
												</div>
												<a id="btn-show-petunjuk-arah" class="btn btn-sm btn-info btn-block">
													<i class="fa fa-share me-2"></i> Petunjuk Arah
												</a>
											</div>

											<div id="map" style="height: 65vh; width: 100%; border-radius: 10px;"></div>
											<div class="mt-3 alert alert-info" id="petunjuk-arah" style="display: none;">
												<h4 class="text-dark">Petunjuk Arah</h4>
												<div id="sidebar" style="height: 300px; overflow-y: scroll;"></div>
											</div>
										</div>

										<hr>

										<div class="my-1">
											<div class="d-flex align-items-center mb-2">
												<a class="btn btn-info me-2" id="btn-toggle-panel-foto-laporan">
													<i class="fa fa-caret-down"></i>
												</a>
												<h4 class="mt-2">Foto Laporan</h4>
											</div>

											<div id="list-foto-laporan" class="row">

												<?php
												$data_foto_laporan = $db->query("SELECT * FROM tb_foto_laporan WHERE id_laporan='$id_laporan' ORDER BY id_foto DESC");
												?>

												<?php if ($data_foto_laporan->getNumRows() > 0) : ?>

													<?php foreach ($data_foto_laporan->getResult('array') as $fl) : ?>

														<div class="col-6 col-lg-3 mb-4 position-relative">
															<a data-fancybox="gallery" href="<?= base_url(); ?>/img/laporan/kejadian/<?= $fl['foto']; ?>" style="width: 100%; height: 200px;" data-caption="<?= $fl['deskripsi']; ?>">
																<img src="<?= base_url(); ?>/img/laporan/kejadian/<?= $fl['foto']; ?>" alt="image" style="width: 100%; height: 180px; object-fit: cover; object-position: center; border-radius: 5px;">
															</a>

															<?php if (($fl['upload_by'] == "personil") and ($fl['id_user_upload'] == $user_id)) : ?>
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
											<div class="d-flex align-items-center mb-2">
												<a class="btn btn-info me-2" id="btn-toggle-panel-tindakan-personil">
													<i class="fa fa-caret-down"></i>
												</a>
												<h4 class="mt-2">Tindakan oleh Personel</h4>
											</div>
											<div id="list-tindakan-personil" class="row">
												<?php if ($cek_tindakan > 0) : ?>
													<?php
													$data_personil_tindakan = $db->query("SELECT DISTINCT id_personil FROM tb_tindakan_personil WHERE id_laporan='$id_laporan'");
													?>
													<?php foreach ($data_personil_tindakan->getResult('array') as $row) : ?>
														<?php
														$id_personil = $row['id_personil'];
														$personil = $db->query("SELECT * FROM tb_personil WHERE id_personil='$id_personil' ")->getRow();

														if ($id_personil == $user_id) {
															$tindakan_saya = true;
														}

														$id_pangkat = $personil->id_pangkat;
														$pangkat_personil = $db->query("SELECT * FROM tb_pangkat_personil WHERE id_pangkat='$id_pangkat' ")->getRow();
														?>

														<div class="col-12">
															<div class="alert alert-info">
																<div class="d-flex align-items-center">
																	<div>
																		<img src="<?= (empty($personil->foto)) ? base_url() . 	'/img/noimage.png' : base_url() . '/img/personil/' . $personil->foto; ?>" style="border: solid 2px #eee; padding: 3px; width: 70px; height: 70px; border-radius: 50%;">
																	</div>
																	<div class="ms-2">
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
																			<td>
																				<a data-bs-toggle="modal" data-bs-target="#modalFormTambahFoto" data-idtindakan="<?= $id_tindakan; ?>" data-latitude="<?= $latitude; ?>" data-longitude="<?= $longitude; ?>" class="btn btn-outline-info">
																					<i class="fa fa-camera"></i>
																				</a>
																			</td>
																			<td style="width: 95%; vertical-align: middle;">
																				<a onclick="batalkan_tindakan('<?= $id_tindakan ?>', '<?= $id_jenis_tindakan ?>', '<?= $jenis_tindakan->jenis_tindakan; ?>', '<?= $id_laporan ?>', '<?= $id_pelapor ?>')" class="btn btn-sm btn-danger mb-1">
																					<i class="fa fa-times me-2"></i> Batalkan
																				</a>
																				<div class="d-block">
																					<small class="fst-italic text-dark me-2">
																						<?= strftime('%d/%m/%Y', strtotime($row['waktu'])); ?>
																					</small>
																					<small class="fst-italic text-dark">
																						<?= strftime('%H:%M:%S WIB', strtotime($row['waktu'])); ?>
																					</small>
																				</div>
																				<div class="d-flex align-items-center mb-2">
																					<span class="font-weight-bold text-dark">
																						<?= $jenis_tindakan->jenis_tindakan; ?>
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
																									<a data-fancybox="gallery" href="<?= base_url() ?>/img/laporan/tindakan/<?= $fotoTindakan['foto']; ?>" style="width: 100%; height: 100%; object-fit: cover;" data-caption="<?= $fotoTindakan['deskripsi']; ?>">
																										<img src="<?= base_url(); ?>/img/laporan/tindakan/<?= $fotoTindakan['foto']; ?>" alt="image" style="width: 100%; height: 100px; object-fit: cover; object-position: center; border-radius: 5px;">
																									</a>
																									<?php if (isset($tindakan_saya)) : ?>
																										<a onclick="delete_foto_tindakan('<?= $id_foto ?>', '<?= $nama_foto ?>')" class="btn btn-sm btn-danger" style="position: absolute; z-index: 1000; bottom: 0; right: 0;">
																											<i class="fa fa-times me-1"></i> Hapus
																										</a>
																										<a data-bs-toggle="modal" data-bs-target="#modalFormUbahFoto" data-idfoto="<?= $id_foto; ?>" data-deskripsi="<?= $fotoTindakan['deskripsi']; ?>" class="btn btn-sm btn-success" style="position: absolute; z-index: 1000; bottom: 0; left: 0;">
																											<i class="fa fa-edit me-1"></i> Ubah
																										</a>
																									<?php endif; ?>
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

										<div class="my-4">
											<div class="d-flex align-items-center mb-2">
												<a class="btn btn-info me-2" id="btn-toggle-panel-laporan-korban">
													<i class="fa fa-caret-down"></i>
												</a>
												<h4 class="mt-2">Laporan Korban</h4>
											</div>
											<div id="list-laporan-korban" class="row">
												<?php
												$data_laporan_korban = $db->query("SELECT * FROM tb_laporan_korban WHERE id_laporan='$id_laporan' ORDER BY id_laporan_korban DESC");
												?>
												<?php if ($data_laporan_korban->getNumRows() > 0) : ?>
													<?php foreach ($data_laporan_korban->getResult('array') as $data_korban) : ?>
														<?php
														$id_kategori_korban = $data_korban['id_kategori_korban'];
														$kategori_korban = $db->query("SELECT * FROM tb_kategori_korban WHERE id_kategori_korban='$id_kategori_korban' ")->getRow();

														if ($data_korban['input_by'] == "Pelapor") {
															$user_input = $db->query("SELECT * FROM tb_pelapor WHERE id_pelapor='$id_pelapor' ")->getRow();
														} elseif ($data_korban['input_by'] == "Personil") {
															$user_input = $db->query("SELECT * FROM tb_personil WHERE id_personil='$id_personil' ")->getRow();
														}
														?>

														<div class="col-6 col-lg-3">
															<div class="card">
																<div class="card-body p-0 shadow">
																	<span class="text-dark">
																		<?= $data_korban['jumlah_korban']; ?> <?= $kategori_korban['kategori_korban']; ?>
																	</span>
																	<span>
																		<?= $data_korban['deskripsi']; ?>
																	</span>
																	<div class="d-flex justify-content-between">
																		<a class="shadow btn btn-success ms-0 me-lg-2" data-bs-toggle="modal" data-bs-target="#modalFormDataKorban">
																			<i class="fa fa-edit"></i>
																		</a>
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
						<i class="fa fa-camera"></i> Tambah Foto Tindakan
					</h5>
					<button type="button" class="btn-close btnClosemodalTambahFoto" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">

					<input type="hidden" class="inputlatitude" value="">
					<input type="hidden" class="inputlongitude" value="">
					<input type="hidden" class="idtindakan" value="">

					<div class="form-group mb-3">
						<div class="form-group row">
							<label for="foto" class="col-sm-12 col-form-label">
								Pilih / Ambil Foto <small class="text-danger">(*Wajib diisi !)</small> <br>
								<small class="text-muted">(Maks Ukuran file : 8 MB)</small> <br>
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

<!-- Modal Form Tambah Data Korban -->
<div id="modalFormDataKorban" class="modal fade">
	<div class="modal-lg modal-dialog modal-dialog-centered modal-dialog-scrollable scrollable">

		<div class="modal-content">
			<form id="formDataKorban" enctype="multipart/form-data">
				<?= csrf_field(); ?>
				<div class="modal-header">
					<h5 class="modal-title">
						<i class="fa fa-users"></i> Data Korban
					</h5>
					<button type="button" class="btn-close btnClosemodalUbahFoto" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">
					<input type="hidden" name="id_laporan" class="id_laporan">

					<div class="form-group mb-3">
						<div class="col-sm-12">
							<label for="jumlah_korban">
								Jumlah Korban
							</label>
							<input type="number" name="jumlah_korban" min="1" value="1" placeholder="0" class="form-control jumlah_korban" style="width: 100px;">
						</div>
					</div>

					<div class="form-group mb-3">
						<div class="col-sm-12">
							<label for="kategori_korban">
								Kategori Korban
							</label>
							<select name="kategori_korban" id="kategori_korban" class="form-control" required>
								<?php
								$data_kategori_korban = $db->query("SELECT * FROM tb_kategori_korban WHERE aktif = 'Y' ORDER BY id_kategori_korban DESC");
								?>
								<?php foreach ($data_kategori_korban->getResult('array') as $row) : ?>
									<option value="<?= $row['id_kategori_korban']; ?>">
										<?= $row['kategori_korban']; ?> <br>
										<small>
											<?= $row['deskripsi']; ?>
										</small>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>

					<div class="form-group mb-3">
						<div class="col-sm-12">
							<label for="deskripsi_korban">
								Deskripsi
							</label>
							<textarea name="deskripsi" rows="4" class="form-control deskripsi_korban" placeholder="Deskripsi ..."></textarea>
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
	$(document).ready(function() {
		$("#btn-show-maps").click(function() {
			$("#map").toggle();
		});

		$("#btn-show-petunjuk-arah").click(function() {
			$("#petunjuk-arah").toggle();
		});

		$("#btn-toggle-panel-foto-laporan").click(function() {
			$("#list-foto-laporan").toggle();
		});

		$("#btn-toggle-panel-tindakan-personil").click(function() {
			$("#list-tindakan-personil").toggle();
		});

		$("#btn-toggle-panel-laporan-korban").click(function() {
			$("#list-laporan-korban").toggle();
		});

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
			// $('#foto').attr("data-default-file", "");

			var button = $(event.relatedTarget);
			var idtindakan = button.data("idtindakan");
			var latitude = button.data("latitude");
			var longitude = button.data("longitude");

			$(this).find(".idtindakan").val(idtindakan);
			$(this).find(".inputlatitude").val(latitude);
			$(this).find(".inputlongitude").val(longitude);
		});

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
			$(this).find(".deskripsiubah").text(deskripsi);
		});
	});

	$("#formTambahFoto").submit(function(e) {
		e.preventDefault();

		var modalTambahFoto = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalFormTambahFoto'));

		const foto = $('#foto').prop('files')[0];
		const idtindakan = $('.idtindakan').val();
		const deskripsi = $('.deskripsi').val();
		const latitude = $('.inputlatitude').val();
		const longitude = $('.inputlongitude').val();

		if (latitude == "" && longitude == "") {
			toastr.error('Gagal mendapatkan koordinat posisi anda !');
		} else {
			let formData = new FormData();
			formData.append('foto', foto);
			formData.append('id_tindakan', idtindakan);
			formData.append('deskripsi', deskripsi);
			formData.append('latitude', latitude);
			formData.append('longitude', longitude);

			$.ajax({
				type: "POST",
				url: "<?= base_url() ?>/Personil/Laporan/tambah_foto_tindakan",
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
						$("#formTambahFoto").trigger("reset");
						$("#list-tindakan-personil").load(location.href + " #list-tindakan-personil > *");
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

		const id_foto = $('.id_foto').val();
		const deskripsi = $('.deskripsiubah').val();

		let formData = new FormData();
		formData.append('id_foto', id_foto);
		formData.append('deskripsi', deskripsi);

		$.ajax({
			type: "POST",
			url: "<?= base_url() ?>/Personil/Laporan/ubah_deskripsi_foto_tindakan",
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
					$("#list-tindakan-personil").load(location.href + " #list-tindakan-personil > *");
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

	function delete_foto_tindakan(id_foto, nama_file) {
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
					url: "<?= base_url() ?>/Personil/Laporan/hapus_foto_tindakan",
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
							$("#list-tindakan-personil").load(location.href + " #list-tindakan-personil > *");
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

	function tambah_tindakan(id_jenis_tindakan, jenis_tindakan, id_laporan, id_pelapor, latitude, longitude) {
		event.preventDefault();

		var text_notif_personil,
			text_notif_pelapor;

		text_notif_personil = '';
		text_notif_pelapor = 'Tindak lanjut laporan anda : (Personil sedang ' + jenis_tindakan + ')';

		Swal.fire({
			title: "Ambil Tindakan ?",
			text: "Pilih ya jika anda ingin mengambil tindakan ini !",
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
					url: "<?= base_url() ?>/Personil/Laporan/tambah_tindakan",
					dataType: "JSON",
					data: {
						id_jenis_tindakan: id_jenis_tindakan,
						id_laporan: id_laporan,
						latitude: latitude,
						longitude: longitude
					},
					beforeSend: function() {
						$("#loader").show();
					},
					success: function(data) {
						if (data.success == "1") {
							send_notif(id_pelapor, 'pelapor', text_notif_pelapor);

							$("#aksi-tindakan-personil").load(location.href + " #aksi-tindakan-personil > *");
							$("#list-tindakan-personil").load(location.href + " #list-tindakan-personil > *");

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

	function batalkan_tindakan(id_tindakan, id_jenis_tindakan, jenis_tindakan, id_laporan, id_pelapor) {
		event.preventDefault();

		var text_notif_personil,
			text_notif_pelapor;

		text_notif_personil = '';
		text_notif_pelapor = 'Personil membatalkan tindakan : (' + jenis_tindakan + ')';

		Swal.fire({
			title: "Batalkan Tindakan ?",
			text: "Pilih ya jika anda ingin membatalkan tindakan ini !",
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
					url: "<?= base_url() ?>/Personil/Laporan/batalkan_tindakan",
					dataType: "JSON",
					data: {
						id_tindakan: id_tindakan,
						id_jenis_tindakan: id_jenis_tindakan,
						id_laporan: id_laporan
					},
					beforeSend: function() {
						$("#loader").show();
					},
					success: function(data) {
						if (data.success == "1") {
							send_notif(id_pelapor, 'pelapor', text_notif_pelapor);

							$("#aksi-tindakan-personil").load(location.href + " #aksi-tindakan-personil > *");
							$("#list-tindakan-personil").load(location.href + " #list-tindakan-personil > *");

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

				var posisiPersonil = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};

				const iconPersonil = {
					url: base_url + '/img/marker-anggota-lantas.png', // url
					scaledSize: new google.maps.Size(50, 50), // scaled size
					origin: new google.maps.Point(0, 0), // origin
					anchor: new google.maps.Point(25, 25) // anchor
				};

				markerPersonil = new google.maps.Marker({
					position: posisiPersonil,
					map: map,
					icon: iconPersonil,
				});

				var posisiLaporan = {
					lat: <?= $latitude ?>,
					lng: <?= $longitude ?>,
				};

				map = new google.maps.Map(document.getElementById('map'), {
					zoom: 18,
					center: posisiLaporan
				});

				infowindow = new google.maps.InfoWindow();
				var bounds = new google.maps.LatLngBounds();

				const markerLaporan = {
					url: "<?= $link_icon_marker ?>", // url
					scaledSize: new google.maps.Size(50, 50), // scaled size
					origin: new google.maps.Point(0, 0), // origin
					anchor: new google.maps.Point(25, 25) // anchor
				};

				marker = new google.maps.Marker({
					position: posisiLaporan,
					map: map,
					icon: markerLaporan,
				});

				directionsDisplay = new google.maps.DirectionsRenderer({
					polylineOptions: {
						strokeColor: "red"
					},
					suppressMarkers: true
				});

				var directionsService = new google.maps.DirectionsService();
				var directionsRenderer = new google.maps.DirectionsRenderer({
					// draggable: true,
					map
				});

				directionsDisplay.setMap(map);
				directionsDisplay.setOptions({
					polylineOptions: {
						strokeColor: "red"
					},
					suppressMarkers: true
				});
				directionsRenderer.setMap(map);

				google.maps.event.addListener(directionsDisplay, 'directions_changed', function() {
					if (directionsDisplay.directions === null) {
						return;
					}
				});

				function showRoute() {
					var request = {
						origin: posisiPersonil,
						destination: posisiLaporan,
						travelMode: 'DRIVING'
					};
					directionsService.route(request, function(result, status) {
						if (status == 'OK') {
							directionsRenderer.setDirections(result);
						}
					});
				}

				directionsRenderer.setPanel(document.getElementById("sidebar"));

				showRoute();

				var trafficLayer = new google.maps.TrafficLayer();
				trafficLayer.setMap(map);

				bounds.extend(posisiLaporan);
				bounds.extend(posisiPersonil);
				map.fitBounds(bounds);
			});
		}

	}
</script>

<?= $this->endSection('content'); ?>