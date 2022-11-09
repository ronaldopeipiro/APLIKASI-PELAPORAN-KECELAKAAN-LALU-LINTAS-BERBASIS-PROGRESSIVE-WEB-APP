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

			<div class="col-12">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<div class="d-flex align-items-center">
							<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
								<path stroke="none" d="M0 0h24v24H0z" fill="none" />
								<line x1="3" y1="21" x2="21" y2="21" />
								<path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16" />
								<path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4" />
								<line x1="10" y1="9" x2="14" y2="9" />
								<line x1="12" y1="7" x2="12" y2="11" />
							</svg>
							<h3 class="card-title" style="margin-left: 10px;">Detail Fasilitas Kesehatan</h3>
						</div>
						<div>
							<a href="<?= base_url(); ?>/pelapor/fasilitas-kesehatan" class="btn btn-outline-dark">
								<i class="fa fa-arrow-left"></i>
							</a>
						</div>
					</div>
					<div class="card-body border-bottom py-3">
						<div id="outputDetailFaskes"></div>
					</div>

				</div>

			</div>

		</div>
	</div>
</div>

<script>
	getDetailFaskes("<?= $place_id ?>");

	function getDetailFaskes(place_id) {
		$.ajax({
			type: "POST",
			url: "<?= base_url() ?>/Pelapor/FasilitasKesehatan/getDetailFaskes",
			dataType: "JSON",
			data: {
				place_id: place_id
			},
			beforeSend: function() {
				$("#loader").show();
			},
			success: function(item) {
				$("#loader").hide();
				outputDetailFaskes.innerHTML = ``;
				var foto_lokasi;
				if (item['photo'] != "") {
					foto_lokasi = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=" + item['photo'] + "&key=<?= $keyAPI ?>";
				} else {
					foto_lokasi = base_url + "/img/bgnoimg.jpg";
				}

				outputDetailFaskes.innerHTML += `
					<div class="row">
						<div class="col-lg-6">
							<img src="` + foto_lokasi + `" style="border-radius: 10px; width: 100%; object-fit: cover;" />
						</div>
						<div class="col-lg-6 mt-4 mt-lg-0">
							<h2 class="mr-4">
								` + item['name'] + `
							</h2>
							<span style="font-weight: 100;">` + item['address'] + `</sp>
							<br>
							<br>
							<span class="text-success">` + item['distance'] + ` dari lokasi anda</span>
							<span class="text-success">, waktu tempuh sekitar ` + item['duration'] + `</span>
							<br>
							<br>
							<span class="text-info">Rating : ` + item['rating'] + `</span><br>
							<div id="rating"></div>
						</div>
					</div>
					`;

				var class_rating = $("#rating");

				class_rating.innerHTML = ``;
				class_rating.innerHTML += `<span style="font-size: 20px;" class="fa fa-star checked_stars"></span>`;

				var rating = item['rating'];
				var star_rating = Math.round(rating);

				for (let index = 1; index <= 5; index++) {
					if (star_rating == index) {}
				}

			}
		});
	}
</script>

<script>
	let map, infoWindow, geocoder, marker, accuracyStatus;

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
								<span class="fa fa-times"></span>
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
					if (status == google.maps.GeocoderStatus.OK) {}
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