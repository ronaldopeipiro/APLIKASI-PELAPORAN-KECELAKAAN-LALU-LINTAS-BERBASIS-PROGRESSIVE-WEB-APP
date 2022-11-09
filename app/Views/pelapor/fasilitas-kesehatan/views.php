<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<style>
	.checked_stars {
		color: orange;
	}
</style>

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
								<h3 class="card-title" style="margin-left: 10px;">Lokasi anda</h3>
							</div>
							<div class="card-body">
								<table class="table-sm mb-3" style="font-size: 12px;">
									<tr>
										<td>Alamat</td>
										<td>:</td>
										<td>
											<span id="outputAlamat"></span>
										</td>
									</tr>
									<tr>
										<td>Koordinat</td>
										<td>:</td>
										<td>
											<span id="outputKoordinat"></span>
										</td>
									</tr>
									<tr>
										<td>Tingkat Akurasi</td>
										<td>:</td>
										<td>
											<span id="outputAkurasi"></span>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>

				</div>
			</div>

			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
							<path stroke="none" d="M0 0h24v24H0z" fill="none" />
							<path d="M10.828 9.828a4 4 0 1 0 -5.656 0l2.828 2.829l2.828 -2.829z" />
							<line x1="8" y1="7" x2="8" y2="7.01" />
							<path d="M18.828 17.828a4 4 0 1 0 -5.656 0l2.828 2.829l2.828 -2.829z" />
							<line x1="16" y1="15" x2="16" y2="15.01" />
						</svg>
						<h3 class="card-title" style="margin-left: 10px;">
							Fasilitas Kesehatan di sekitar anda
						</h3>
					</div>
					<div class="card-body border-bottom py-3">
						<div class="row justify-content-end mb-3">
							<div class="col-lg-3">
								<div class="form-group">
									<label for="radiusSelect">Radius</label>
									<select id="radiusSelect" class="form-control">
										<option value="1000" selected>1 Km</option>
										<option value="2000">2 Km</option>
										<option value="3000">3 Km</option>
										<option value="4000">4 Km</option>
										<option value="5000">5 Km</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row align-items-center" id="outputNearbyLocation"></div>
					</div>

				</div>

			</div>

		</div>
	</div>
</div>

<script>
	let map, infoWindow, geocoder, marker, accuracyStatus;
	let outputAlamat = document.getElementById("outputAlamat");
	let outputKoordinat = document.getElementById("outputKoordinat");
	let outputAkurasi = document.getElementById("outputAkurasi");
	let outputNearbyLocation = document.getElementById("outputNearbyLocation");
	var radiusSelect = 1000;
	getFaskesTerdekat(radiusSelect);

	$("#radiusSelect").change(function() {
		radiusSelect = $(this).val();
		getFaskesTerdekat(radiusSelect);
	});

	function getFaskesTerdekat(radius) {
		$.ajax({
			type: "POST",
			url: "<?= base_url() ?>/Pelapor/FasilitasKesehatan/getNearbyLocationFaskes",
			dataType: "JSON",
			data: {
				poi: 'hospital',
				koordinat: <?= $user_latitude; ?> + ',' + <?= $user_longitude; ?>,
				radius: radius
			},
			beforeSend: function() {
				$("#loader").show();
			},
			success: function(data) {
				$("#loader").hide();

				var arrayDataFaskes = data;
				var arrayDataFaskesLength = arrayDataFaskes.length;
				outputNearbyLocation.innerHTML = ``;
				var foto_lokasi;

				arrayDataFaskes.forEach(function(item, index) {
					if (item['photo'] != "") {
						foto_lokasi = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=" + item['photo'] + "&key=<?= $keyAPI ?>";
					} else {
						foto_lokasi = base_url + "/img/bgnoimg.jpg";
					}

					outputNearbyLocation.innerHTML += `
					<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-3">
						<a href="` + base_url + `/pelapor/fasilitas-kesehatan/detail/` + item['place_id'] + `" style="text-decoration: none; color : #000;">
							<div class="card shadow">
								<div class="card-body">
									<div class="row">
										<div class="col-12">
											<img src="` + foto_lokasi + `" style="border-radius: 10px; width: 100%; height: 200px; object-fit: cover;" />
										</div>
										<div class="col-12 py-2">
											<h4 class="text-truncate mr-4">
												` + item['name'] + ` <br>
												<small style="font-weight: 100;">` + item['address'] + `</small>
											</h4>
											<small class="text-success">` + item['distance'] + ` dari lokasi anda</small><br>
											<small class="text-dark">Estimasi : ` + item['duration'] + `</small><br>
										
										</div>
									</div>
								</div>
							</div>
						</a>
					</div>
					`;

					var class_rating = $(".rating");

					class_rating.innerHTML = ``;
					class_rating.innerHTML += `<div class="stars"></div>`;

					var rating = item['rating'];
					var star_rating = Math.round(rating);

					for (let index = 1; index <= 5; index++) {
						if (star_rating == index) {}
					}

				});
			}
		});
	}

	function initMap() {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				if (position.coords.accuracy < 100) {
					accuracyStatus = `
							<strong style="color: green;">
								<span class="fa fa-checked"></span>
								` + position.coords.accuracy.toFixed(2) + ` m (Baik)
							</strong>`;
				} else {
					accuracyStatus = `
							<strong style="color: red;">
								` + position.coords.accuracy.toFixed(2) + ` m (Lemah)
							</strong>`;
				}

				let pos = {
					lat: position.coords.latitude,
					lng: position.coords.longitude,
				};

				geocoder = new google.maps.Geocoder();
				geocoder.geocode({
					'latLng': pos
				}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						outputAlamat.innerHTML = results[0].formatted_address;
						outputKoordinat.innerHTML = `(` + pos.lat + `, ` + pos.lng + `)`;
						outputAkurasi.innerHTML = accuracyStatus;

						$.ajax({
							type: "POST",
							url: "<?= base_url() ?>/Pelapor/Dashboard/update_posisi",
							dataType: "JSON",
							data: {
								latitude: pos.lat,
								longitude: pos.lng
							},
							success: function(data) {
								console.log('OK');
							}
						});
					}
				});
			}, function() {
				handleLocationError(true, infoWindow, map.getCenter());
			});
		} else {
			handleLocationError(false, infoWindow, map.getCenter());
		}
	}

	function handleLocationError(browserHasGeolocation, infoWindow, pos) {
		infoWindow.setPosition(pos);
		infoWindow.setContent(browserHasGeolocation ? `<span class="alert alert-danger"> Error: The Geolocation service failed. </span>` : `<span class="alert alert-danger">Error: Your browser doesnt support geolocation. </span>`);
		infoWindow.open(map);
	}
</script>

<?= $this->endSection('content'); ?>