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
									<circle cx="12" cy="12" r="3" />
									<circle cx="12" cy="12" r="8" />
									<line x1="12" y1="2" x2="12" y2="4" />
									<line x1="12" y1="20" x2="12" y2="22" />
									<line x1="20" y1="12" x2="22" y2="12" />
									<line x1="2" y1="12" x2="4" y2="12" />
								</svg>
								<h3 class="card-title" style="margin-left: 10px;">Peta Kawasan Rawan Kecelakaan</h3>
							</div>
							<div class="card-body">
								<div id="map" style="height: 500px; width: 100%; border-radius: 10px;"></div>
							</div>

						</div>
					</div>

				</div>
			</div>

		</div>
	</div>
</div>

<script>
	let map, geocoder, marker, marker_daerah_rawan, accuracyStatus;
	let gmarkers = [];

	function initMap() {
		var bounds = new google.maps.LatLngBounds();
		var infowindow = new google.maps.InfoWindow();

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
								` + position.coords.accuracy.toFixed(2) + ` m (Lemah)
							</strong>`;
					}

					var pos = {
						lat: position.coords.latitude,
						lng: position.coords.longitude,
					};

					map = new google.maps.Map(document.getElementById('map'), {
						// zoom: 7,
						center: pos
					});

					geocoder = new google.maps.Geocoder();
					geocoder.geocode({
						'latLng': pos
					}, function(results, status) {
						if (status == google.maps.GeocoderStatus.OK) {
							map.setZoom(13);
							map.setCenter(pos);

							const image_marker = {
								url: "<?= $user_foto ?>", // url
								scaledSize: new google.maps.Size(40, 40), // scaled size
								origin: new google.maps.Point(0, 0), // origin
								anchor: new google.maps.Point(20, 20) // anchor
							};

							marker = new google.maps.Marker({
								position: pos,
								map: map,
								animation: google.maps.Animation.DROP,
								icon: image_marker
							});

							var infowindowText = `
							<div class='text-center'>
								<strong>Posisi anda saat ini <br>
									${results[3].formatted_address}<br>
									(${pos.lat.toFixed(5)},${pos.lng.toFixed(5)})<br>
									Akurasi : ${accuracyStatus}
								</strong>
							</div>`;

							infowindow.setContent(infowindowText);
							infowindow.open(map, marker);

							tampilTitikRawanKecelakaan();

							$.ajax({
								type: "POST",
								url: base_url + "/Pelapor/Dashboard/update_posisi",
								dataType: "JSON",
								data: {
									latitude: pos.lat,
									longitude: pos.lng
								},
								success: function(data) {
									console.log('Berhasil update posisi pelapor !');
								}
							});

						}

					});
				},
				function() {
					handleLocationError(true, infoWindow, map.getCenter());
				});
		} else {
			handleLocationError(false, infoWindow, map.getCenter());
		}
	}

	function tampilTitikRawanKecelakaan() {
		var infowindow = new google.maps.InfoWindow();
		// hapus marker
		for (i = 0; i < gmarkers.length; i++) {
			if (gmarkers[i].getMap() != null) gmarkers[i].setMap(null);
		}
		// Akhir hapus marker

		$.ajax({
			type: "POST",
			url: base_url + "/Pelapor/DaerahRawan/getDaerahRawan",
			dataType: "JSON",
			beforeSend: function() {
				console.log('Memuat titik laporan !');
			},
			success: function(data) {
				var arrayDataDaerahRawanLength = data.length;

				data.forEach(function(item, index) {
					let posisiMarkerLaporan = new google.maps.LatLng(item.latitude, item.longitude);

					if (item.id_kategori_laporan == "1") {
						var link_img_marker_laporan = base_url + "/img/marker-low.png";
					} else if (item.id_kategori_laporan == "2") {
						var link_img_marker_laporan = base_url + "/img/marker-medium.png";
					} else if (item.id_kategori_laporan == "3") {
						var link_img_marker_laporan = base_url + "/img/marker-high.png";
					}

					var icon_marker_laporan = {
						url: link_img_marker_laporan, // url
						scaledSize: new google.maps.Size(36, 36), // scaled size
						origin: new google.maps.Point(0, 0), // origin
						anchor: new google.maps.Point(14, 18) // anchor
					};

					var markerLaporan = new google.maps.Marker({
						position: posisiMarkerLaporan,
						map: map,
						icon: icon_marker_laporan,
					});

					google.maps.event.addListener(markerLaporan, 'click', (function(markerLaporan, i) {
						return function() {
							if (item.id_kategori_laporan == "1") {
								class_kategori_laporan = "badge badge-warning";
							} else if (item.id_kategori_laporan == "2") {
								class_kategori_laporan = "badge badge-danger";
							} else if (item.id_kategori_laporan == "3") {
								class_kategori_laporan = "badge badge-dark";
							}

							if (item.status == "0") {
								class_status = "badge badge-secondary";
							} else if (item.status == "1") {
								class_status = "badge badge-success";
							} else if (item.status == "2") {
								class_status = "badge badge-danger";
							}

							infowindow.setContent(`
														<div>
															<div class="d-flex justify-content-between">
																<span class="${class_kategori_laporan}">
																	Kategori ${item.kategori_laporan}
																</span>
																<span class="${class_status}">
																	${item.status_text}
																</span>
															</div>
															<br>
															
															<div class="d-flex align-items-center my-2">
																dilaporkan oleh
																<div style="margin-left: 8px;">
																	<img style="border-radius: 50%; height: 40px; width: 40px; object-fit: cover; object-position: top;" src="${item.foto_pelapor}">
																</div>
																<div class="d-block" style="line-height: 10px; margin-left: 10px;">
																	<small>
																		${item.nama_pelapor}
																	</small> <br>
																	<small>
																		${item.email_pelapor}
																	</small>
																</div>
															</div>
															<br>
															<table class="table-sm table-borderless" style="font-size: 10px;">
																<tr style="text-align: left;">
																	<td>Lokasi</td>
																	<td>:</td>
																	<td>${item.alamat}</td>
																</tr>
																<tr style="text-align: left;">
																	<td>Koordinat</td>
																	<td>:</td>
																	<td style="width: 50%;">
																		${item.latitude}, ${item.longitude}
																	</td>
																</tr> 
																<tr style="text-align: left;">
																	<td>Waktu Laporan</td>
																	<td>:</td>
																	<td>${item.waktu}</td>
																</tr>
																<tr style="text-align: left;">
																	<td>Status Verifikasi</td>
																	<td>:</td>
																	<td>
																		<span class="badge badge-pill">
																			${item.verifikasi_text}
																		</span>
																	</td>
																</tr>
															</table>
														
														</div>
													`);
							infowindow.open(map, markerLaporan);
						}
					})(markerLaporan, i));
					gmarkers.push(markerLaporan);

				});

				var mcOptions = {
					styles: [{
							height: 53,
							url: "https://raw.githubusercontent.com/googlemaps/js-marker-clusterer/gh-pages/images/m1.png",
							width: 53
						},
						{
							height: 56,
							url: "https://raw.githubusercontent.com/googlemaps/js-marker-clusterer/gh-pages/images/m2.png",
							width: 56
						},
						{
							height: 66,
							url: "https://raw.githubusercontent.com/googlemaps/js-marker-clusterer/gh-pages/images/m3.png",
							width: 66
						},
						{
							height: 78,
							url: "https://raw.githubusercontent.com/googlemaps/js-marker-clusterer/gh-pages/images/m4.png",
							width: 78
						},
						{
							height: 90,
							url: "https://raw.githubusercontent.com/googlemaps/js-marker-clusterer/gh-pages/images/m5.png",
							width: 90
						}
					]
				}
				var markerCluster = new MarkerClusterer(map, gmarkers, mcOptions);
			},
			complete: function(data) {
				console.log('Titik laporan berhasil diupdate !');
			}
		});
	}

	function handleLocationError(browserHasGeolocation, infoWindow, pos) {
		infoWindow.setPosition(pos);
		infoWindow.setContent(browserHasGeolocation ?
			`<span class="alert alert-danger"> Error: The Geolocation service failed. </span>` :
			`<span class="alert alert-danger"> Error: Your browser doesnt support geolocation. </span>`);
		infoWindow.open(map);
	}
</script>

<?= $this->endSection('content'); ?>