<?php
include 'include/config.php';
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>About us - FlavorFusion</title>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />


	<!-- Box Icon CSS -->
	<link rel="stylesheet" href="assets/css/boxicons.min.css">
	<!-- Bootstrap Icon CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap-icons.css">
	<!-- Swiper Carousel CSS -->
	<link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
	<!-- Wow CSS -->
	<link rel="stylesheet" href="assets/css/animate.css">
	<!-- Magnific Popup CSS -->
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<!-- Odometer CSS -->
	<link rel="stylesheet" href="assets/css/odometer.css">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<!-- Meanmenu CSS -->
	<link rel="stylesheet" href="assets/css/meanmenu.min.css">
	<!-- Meanmenu CSS -->
	<link rel="stylesheet" href="assets/css/YouTubePopUp.css">
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="assets/css/select2.css">
	<!-- Datepicker CSS -->
	<link rel="stylesheet" href="assets/css/datepicker.css">
	<!-- Jquery UI CSS -->
	<link rel="stylesheet" href="assets/css/jquery-ui.css">


	<!-- Main CSS -->
	<link rel="stylesheet" href="assets/css/style.css">


</head>

<body>

	<?php
	include 'include/header.php';
	?>

	<!-- Breadcrumb -->

	<div class="breadcrumb-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="breadcrumb-info text-center">
						<h1 class="text-white">About Us</h1>
						<p class="text-white mt-3"><a href='index.html'>Home</a><i
								class="bi bi-chevron-right ms-2 me-2"></i>About Us</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Breadcrumb End -->


	<!-- About -->

	<div class="about-area pt-120 pb-120 position-relative z-index-one">
		<div class="container">
			<?php
			$select_about = mysqli_query($con, "SELECT * FROM `about_us` ORDER BY `id` DESC LIMIT 1") or die('query failed! ' . mysqli_error($con));

			if (mysqli_num_rows($select_about) > 0) {
				$fetch_about = mysqli_fetch_assoc($select_about);
				?>
				<div class="row justify-content-between align-items-center gy-4">
					<div class="col-lg-5">
						<div class="about-img-wrap position-relative">
							<div class="about-img-main-wrap"
								style="background-image:url(images/<?= $fetch_about['image'] ?>);">
							</div>
						</div>
					</div>
					<div class="col-lg-7">
						<div class="section-title">
							<span>About Us</span>
							<h2 class="mt-2">
								<?= $fetch_about['title'] ?>
							</h2>
						</div>
						<div class="about-content mt-lg-4 mt-3">
							<p>
								<?= $fetch_about['short_desc'] ?>
							</p>
							<div
								class="about-content-info-wrap align-items-center mt-4 d-flex justify-content-between position-relative">
								<ul class="custom-ul check-list flex-shrink-0 flex-grow-1 w-50 pe-3">
									<li><i class="bi bi-check-circle"></i><b>Cozy Ambiance and Savor</b></li>
									<li><i class="bi bi-check-circle"></i><b>Tasty Culinary For Food Lovers</b></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-12 m-0 mt-4">
						<div class="row g-5 justify-content-center">
							<div class="col-12 col-lg-8">
								<?= htmlspecialchars_decode($fetch_about['description']) ?>
							</div>
							<div class="col-12 col-lg-4  mt-60 g-0">
								<div class="row justify-content-center">
									<div class="col-12 col-md-6 col-lg-12">
										<div class="about-img-wrap text-center w-100 p-0 m-3">
											<img class="img-fluid w-100" src="assets/images/food-menu/slider-bg-1.png"
												alt="">
										</div>
									</div>
									<div class="col-12 col-md-6 col-lg-12">
										<div class="about-img-wrap text-center w-100 p-0 m-3">
											<img class="img-fluid w-100" src="assets/images/food-menu/slider-bg-2.png"
												alt="">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			?>
			<img class="position-absolute z-index-minus-one bottom-0 end-0" src="assets/images/shape/sp-bag.svg" alt="">
			<img class="position-absolute z-index-minus-one top-50 start-0" src="assets/images/shape/sp-veg.svg" alt="">
		</div>
	</div>

	<!-- About End -->


	<?php
	// chefs team
	include 'pages/chefs-team.php';


	// about experience and achievments
	include 'pages/about-experience.php';

	// reviews testimonial 
	include 'pages/reviews-testimonial.php';


	// footer
	include 'include/footer.php';
	?>


	</div>

	<!-- Jquery JS -->
	<script src="assets/js/jquery-3.7.1.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<!-- Swiper Carousel JS -->
	<script src="assets/js/swiper-bundle.min.js"></script>
	<!-- Magnific Popup JS -->
	<script src="assets/js/jquery.magnific-popup.min.js"></script>
	<!-- Wow JS -->
	<script src="assets/js/wow.min.js"></script>
	<!-- Odometer JS -->
	<script src="assets/js/odometer.min.js"></script>
	<script src="assets/js/viewport.jquery.js"></script>
	<!-- Mean menu JS -->
	<script src="assets/js/jquery.meanmenu.min.js"></script>
	<!-- YouTubePopUp JS -->
	<script src="assets/js/YouTubePopUp.js"></script>
	<!-- Datepicker JS -->
	<script src="assets/js/datepicker.js"></script>
	<!-- Select2 JS -->
	<script src="assets/js/select2.js"></script>
	<!-- Jquery UI JS -->
	<script src="assets/js/jquery-ui.min.js"></script>
	<!-- Main JS -->
	<script src="assets/js/main.js"></script>
</body>

</html>