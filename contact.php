<!doctype html>
<html lang="en">

<!-- Mirrored from epicurean.netlify.app/epicurean/contact-02 by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Mar 2024 13:05:34 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Contact Us - FlavorFusion</title>

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
	<!-- jquery -->
	<script src="assets/js/jquery-3.7.1.min.js"></script>


	<!-- Main CSS -->
	<link rel="stylesheet" href="assets/css/style.css">

	<style>
		.response-message {
			width: 100%;
			text-align: center;
			padding: 40px 0;
		}

		.response-message .success-icon {
			font-size: 75px;
			color: var(--main-color);
		}

		.response-message .card-title {
			font-weight: 700;
			font-size: 25px;
		}
	</style>

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
						<h1 class="text-white">Contact us</h1>
						<p class="text-white mt-3"><a href='index.php'>Home</a><i
								class="bi bi-chevron-right ms-2 me-2"></i>Conctact us</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Breadcrumb End -->


	<!-- Address -->

	<div class="address-area pt-120">
		<div class="container">
			<div class="row gy-4 justify-content-center">
				<div class="col-lg-4 col-md-6">
					<div class="address-box text-center">
						<div class="address-icon d-flex align-items-center justify-content-center">
							<i class="bi bi-envelope"></i>
						</div>
						<p>Email Us</p>
						<a class="address-link" href="mailto:support@epicurean.com">support@epicurean.com</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="address-box text-center">
						<div class="address-icon d-flex align-items-center justify-content-center">
							<i class="bi bi-telephone"></i>
						</div>
						<p>Call Us</p>
						<a class="address-link" href="tel:5550102">(684) 555-0102</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="address-box text-center">
						<div class="address-icon d-flex align-items-center justify-content-center">
							<i class="bi bi-geo-alt"></i>
						</div>
						<p>Location</p>
						<span class="address-link">1616 Broadway NY, New York</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Address End -->


	<!-- Contact -->

	<div class="contact-page-area pt-120">
		<div class="container">
			<div class="row justify-content-between  gy-4">
				<div class="col-lg-4">
					<div class="section-title">
						<span>Contact Us</span>
						<h2 class="mt-2">We Are Here to Listen From You.</h2>
					</div>
				</div>
				<div class="col-lg-7">
					<form class="contact-submit-wrap contact-submit-wrap-two bg_color_off_white d-block" action="#"
						id="sendmessage">
						<div class="row">
							<div class="col-lg-6">
								<input type="text" placeholder="Your Name" name="name">
							</div>
							<div class="col-lg-6">
								<input type="email" placeholder="Your Email" name="email">
							</div>
							<div class="col-lg-6">
								<input type="text" placeholder="Subject" name="subject">
							</div>
							<div class="col-lg-12">
								<textarea cols="30" rows="6" name="message" placeholder="Type your Message"></textarea>
							</div>
							<div class="col-lg-12">
								<button type="submit" class="common-btn border-0 border-radius-0"><span>Submitted
										Now</span></button>
							</div>
						</div>
					</form>
					<div class="response-message" style="display: none;">
						<div class="success-icon"><i class="bi bi-check-circle-fill"></i></div>
						<h2 class="card-title h2">Message Sent Successfully!</h2>
						<p class="card-text">
							Your message has been sent successfully. We will get back to you as soon as
							possible.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Contact End -->

	<!-- Map -->

	<div class="map-wrap mt-60 mb-120">
		<iframe
			src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d793.8818186262939!2d-73.98633379172698!3d40.76063618739511!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2s!5e1!3m2!1sen!2sbd!4v1702364760549!5m2!1sen!2sbd"
			width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
			referrerpolicy="no-referrer-when-downgrade"></iframe>
	</div>

	<!-- Map End -->



	<?php
	include 'include/footer.php';
	?>

	<script>
		$(document).ready(function () {
			$('#sendmessage').on('submit', function (event) {
				event.preventDefault();

				var formData = $(this).serializeArray();
				formData.push({ name: 'action', value: 'sendmessage' });

				// sending request using ajax json to send message
				$.ajax({
					url: "pages/ajax.php",
					type: "POST",
					// dataType: 'json',
					data: formData,
					success: function (data) {
						// console.log(data);
						if (data == 'message sent successfully') {
							$('#sendmessage').hide().removeClass('d-block');
							$('.response-message').css('display', 'block');
						} else {
							alert(data);
						}
					}
				});
			});
		});
	</script>
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

<!-- Mirrored from epicurean.netlify.app/epicurean/contact-02 by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Mar 2024 13:05:34 GMT -->

</html>