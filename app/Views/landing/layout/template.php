<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-title" content="Brew">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="theme-color" content="black">
	<link rel="apple-touch-icon" sizes="152x152" href="<?= base_url(); ?>/img/logo.png" type="image/png">
	<link rel="apple-touch-icon" sizes="167x167" href="<?= base_url(); ?>/img/logo.png" type="image/png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url(); ?>/img/logo.png" type="image/png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url(); ?>/img/logo.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>/img/logo.png">
	<link rel="shortcut icon" type="image/x-icon" href="<?= base_url(); ?>/img/logo.png">

	<link rel="manifest" href="<?= base_url(); ?>/manifest.json">

	<title><?= $title; ?> -- LAPOR LAKA LANTAS APP</title>

	<!-- Font Icon -->
	<link rel="stylesheet" href="<?= base_url(); ?>/landing-temp/fonts/material-icon/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>/landing-temp/css/style.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>

	<script src="<?= base_url(); ?>/landing-temp/js/main.js"></script>

	<style>
		div#loader {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-color: rgba(255, 255, 255, 0.8);
			z-index: 1;
		}
	</style>
</head>

<body>
	<div id="loader" style="display: none;">
		<div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
			<img src="<?= base_url(); ?>/img/loader.gif" style="width: 350px; height: 350px; object-fit: cover; object-position: center;">
		</div>
	</div>

	<div class="main">
		<?= $this->renderSection('content-landing'); ?>
	</div>

</body>

</html>