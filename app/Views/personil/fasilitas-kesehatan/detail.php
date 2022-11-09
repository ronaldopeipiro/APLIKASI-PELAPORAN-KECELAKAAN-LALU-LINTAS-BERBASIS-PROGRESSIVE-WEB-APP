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
							<a href="<?= base_url(); ?>/personil/fasilitas-kesehatan" class="btn btn-outline-dark">
								<i class="fa fa-arrow-left"></i>
							</a>
						</div>
					</div>

					<div class="card-body border-bottom py-3">
						<div class="row">

							<div class="col-lg-6">
								<div id="outputDetailFaskes"></div>
							</div>

							<div class="col-lg-6">
								<h4>Peta Lokasi</h4>
								<div id="maps" style="width: 100%; height: 400px; border-radius: 10px;"></div>
								<div class="alert alert-info mt-3">
									<div id="text-direction-guide"></div>
									<div id="floating-panel"></div>
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
	var map,
		markerUser,
		markerUserTag;
	var userLocation;
	var marker, i;
	var directionsDisplay;

	function initMap() {
		var mapCenter = new google.maps.LatLng({
			lat: -0.0263303,
			lng: 109.3425039
		});
		var directionsService = new google.maps.DirectionsService;
		var infoWindow = new google.maps.InfoWindow;
		var bounds = new google.maps.LatLngBounds();

		var myStyle = [{
			featureType: "administrative",
			elementType: "labels",
			stylers: [{
				visibility: "on"
			}]
		}, {
			featureType: "poi",
			elementType: "labels",
			stylers: [{
				visibility: "off"
			}]
		}, {
			featureType: "water",
			elementType: "labels",
			stylers: [{
				visibility: "on"
			}]
		}, {
			featureType: "road",
			elementType: "labels",
			stylers: [{
				visibility: "on"
			}]
		}];

		var mapOptions = {
			center: mapCenter,
			zoom: 15,
			mapTypeControlOptions: {
				mapTypeIds: ['mystyle', google.maps.MapTypeId.SATELLITE]
			},
			mapTypeId: 'mystyle',
			location_type: google.maps.GeocoderLocationType.ROOFTOP
		};

		map = new google.maps.Map(document.getElementById('maps'), mapOptions);
		map.mapTypes.set('mystyle', new google.maps.StyledMapType(myStyle, {
			name: 'Peta'
		}));
	}

	function locError(error) {
		alert("The current position could not be found!");
	}

	// current position of the user
	function setCurrentPosition(pos) {
		userLat = pos.coords.latitude;
		userLng = pos.coords.longitude;

		userLocation = new google.maps.LatLng(userLat, userLng);

		$.ajax({
			type: "POST",
			url: "<?= base_url() ?>/Personil/Dashboard/update_posisi",
			dataType: "JSON",
			data: {
				latitude: userLat,
				longitude: userLng
			},
			success: function(data) {
				console.log('Posisi personil terupdate !');
			}
		});

		function getDetailFaskes(place_id) {
			$.ajax({
				type: "POST",
				url: "<?= base_url() ?>/Personil/FasilitasKesehatan/getDetailFaskes",
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

					var faskesLocation = new google.maps.LatLng(item['lat'], item['lng']);
					var foto_lokasi,
						text_open_now,
						class_badge;
					var weekdayText = '';

					if (item['photo'] != "") {
						foto_lokasi = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=" + item['photo'] + "&key=<?= $keyAPI ?>";
					} else {
						foto_lokasi = base_url + "/img/bgnoimg.jpg";
					}

					if (item['open_now'] != "") {
						if (item['open_now'] === true) {
							text_open_now = "Sedang Buka";
							class_badge = "badge badge-info";
						} else if (item['open_now'] === false) {
							text_open_now = "Sedang Tutup";
							class_badge = "badge badge-dark";
						}
					}

					var weekdayTextData = item['weekday_text'];
					if (weekdayTextData != "") {
						var arrayWeekdayText = weekdayTextData.split(",");

						for (let index = 0; index < arrayWeekdayText.length; index++) {
							weekdayText += '<span class="badge badge-secondary">' + arrayWeekdayText[index] + '</span>';
						}
					}

					outputDetailFaskes.innerHTML += `
								<div class="row">
									<div class="col-lg-12">
										<img src="` + foto_lokasi + `" style="border-radius: 10px; width: 100%; object-fit: cover;" />
									</div>
									<div class="col-lg-12 mt-3">
										<div class="alert alert-info">
											<h2 class="mr-4">
												` + item['name'] + `
											</h2>
											<span class="${class_badge}">${text_open_now}</span> 
											<br>
											<table class="table table-sm table-responsive table-borderless">
												<tr>
													<td>Lokasi</td>
													<td>:</td>
													<td>
														<span style="font-weight: 100;">` + item['weekday_text'] + `</span>
													</td>
												</tr>
												<tr>
													<td>Jadwal Buka</td>
													<td>:</td>
													<td>
														${weekdayText}
													</td>
												</tr>
												<tr>
													<td>Jarak</td>
													<td>:</td>
													<td>
														<span class="text-muted">` + item['distance'] + ` dari lokasi anda</span>
													</td>
												</tr>
												<tr>
													<td>Estimasi waktu</td>
													<td>:</td>
													<td>
														<span class="text-muted">sekitar ` + item['duration'] + `</span>
													</td>
												</tr>
											</table>
											<br>
										</div>	
									</div>	
								</div>
							`;

					showRoute(userLocation, faskesLocation);
					showMarkerFaskes(faskesLocation, item['name'], item['address'], foto_lokasi);
					showMarkerUser(userLocation);
				}
			});
		}

		getDetailFaskes("<?= $place_id ?>");

		directionsDisplay = new google.maps.DirectionsRenderer({
			polylineOptions: {
				strokeColor: "blue"
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
			suppressMarkers: true
		});
		directionsRenderer.setMap(map);

		google.maps.event.addListener(directionsDisplay, 'directions_changed', function() {
			if (directionsDisplay.directions === null) {
				return;
			}
		});

		function showRoute(start, end) {
			var request = {
				origin: start,
				destination: end,
				travelMode: 'DRIVING'
			};
			directionsService.route(request, function(result, status) {
				if (status == 'OK') {
					directionsRenderer.setDirections(result);
				}
			});
		}

		directionsRenderer.setPanel(document.getElementById("text-direction-guide"));
		const control = document.getElementById("floating-panel");

		map.controls[google.maps.ControlPosition.TOP_CENTER].push(control);
		const onChangeHandler = function() {
			calculateAndDisplayRoute(directionsService, directionsRenderer);
		};

		var trafficLayer = new google.maps.TrafficLayer();
		trafficLayer.setMap(map);

		function showMarkerUser(userLocationData) {
			var iconUser = {
				url: base_url + "/img/marker-anggota-lantas.png", // url
				scaledSize: new google.maps.Size(40, 40), // scaled size
				origin: new google.maps.Point(0, 0), // origin
				anchor: new google.maps.Point(20, 20) // anchor
			};
			var markerUser = new google.maps.Marker({
				position: userLocationData,
				map: map,
				icon: iconUser
			});

			google.maps.event.addListener(markerUser, 'click', (function(markerUser) {
				return function() {
					infoWindow.setContent(`
							<div style="width: 100%; text-align: center;">
								<img src="<?= $user_foto ?>" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; object-position: top;"/>
								<br>
								<h5>
									<?= $user_nama_lengkap ?>
								</h5>
								<span>NRP. <?= $user_nrp ?></span>
							</div>
							`);
					infoWindow.open(map, markerUser);
				}
			})(markerUser));
		}

		// Marker Faskes
		function showMarkerFaskes(faskesLocationData, nama_lokasi, alamat, foto_lokasi_faskes) {
			var iconFaskes = {
				url: base_url + "/img/marker-faskes.png", // url
				scaledSize: new google.maps.Size(40, 40), // scaled size
				origin: new google.maps.Point(0, 0), // origin
				anchor: new google.maps.Point(20, 20) // anchor
			};
			var markerFaskes = new google.maps.Marker({
				position: faskesLocationData,
				map: map,
				icon: iconFaskes
			});

			google.maps.event.addListener(markerFaskes, 'click', (function(markerFaskes) {
				return function() {
					infoWindow.setContent(`
						<div style="width: 100%; text-align: center;">
							<img src="${foto_lokasi_faskes}" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; object-position: top;"/>
							<h5>
								${nama_lokasi}
							</h5>
							<br>
							<span>${alamat}</span>
						</div>
					`);
					infoWindow.open(map, markerFaskes);
				}
			})(markerFaskes));
		}

		map.panTo(userLocation);
		// writeAddressName(userLocation);
	}

	function calculateDistances(start, end) {
		var stuDistances = {};
		stuDistances.metres = google.maps.geometry.spherical.computeDistanceBetween(start, end); // distance in metres
		stuDistances.km = Math.round(stuDistances.metres / 2000 * 10) / 10; // distance in km rounded to 1dp
		stuDistances.miles = Math.round(stuDistances.metres / 2000 * 0.6214 * 10) / 10; // distance in miles rounded to 1dp
		return stuDistances;
	}

	function displayAndWatch(position) {
		setCurrentPosition(position);
		watchCurrentPosition();
	}

	function watchCurrentPosition() {
		var positionTimer = navigator.geolocation.watchPosition(
			function(position) {
				setMarkerPosition(
					markerUser,
					position
				);
			});
	}

	function setMarkerPosition(markerUserTag, position) {
		markerUserTag.setPosition(
			new google.maps.LatLng(
				position.coords.latitude,
				position.coords.longitude)
		);
	}

	function initLocationProcedure() {
		initMap();
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(displayAndWatch, locError);
		} else {
			alert("Your browser does not support the Geolocation API!");
		}
	}

	function calculateAndDisplayRoute(directionsService, directionsDisplay, distinationOrigin, destinationMarker, infoWindow, id_pengantaran) {
		directionsService.route({
			origin: distinationOrigin,
			destination: destinationMarker,
			travelMode: google.maps.TravelMode.DRIVING
		}, function(response, status) {
			if (status === google.maps.DirectionsStatus.OK) {
				directionsDisplay.setDirections(response);
			} else {
				window.alert('Directions request failed due to ' + status);
			}
		});
	}

	$(document).ready(function() {
		initLocationProcedure();
	});
</script>

<?= $this->endSection('content'); ?>