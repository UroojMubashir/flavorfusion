<?php
include 'include/config.php';
include 'pages/function.php';

$added_by_name = '';
$created_date = '';

$title = '';
if (isset($_GET['slug'])) {
	$slug = mysqli_real_escape_string($con, $_GET['slug']);

	$select_recipe = mysqli_query($con, "SELECT * FROM `recipes` WHERE `slug`='$slug' AND `status`='active' LIMIT 1") or die('query failed! ' . mysqli_error($con));

	if (mysqli_num_rows($select_recipe) > 0) {
		$fetch_recipe = mysqli_fetch_assoc($select_recipe);
		$added_by = $fetch_recipe['added_by'];

		$select_users = mysqli_query($con, "SELECT * FROM `user` WHERE `id`='$added_by'") or die('query failed! ' . mysqli_error($con));

		if (mysqli_num_rows($select_users) > 0) {
			$fetch_user = mysqli_fetch_assoc($select_users);
			$added_by_name = $fetch_user['name'];
		}

		$title = $fetch_recipe['title'];

		$created_date = formatDate($fetch_recipe['created_time']);

		$recipe_id = $fetch_recipe['id'];
		$description = $fetch_recipe['description'];
		$descriptionText = strip_tags($description);

		$views = (int) $fetch_recipe['views'] + 1;
		mysqli_query($con, "UPDATE `recipes` SET `views`='$views' WHERE `id`='$recipe_id'");
	}
}
?>
<!doctype html>
<html lang="en">

<!-- Mirrored from epicurean.netlify.app/epicurean/blog-details by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Mar 2024 13:05:23 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>
		<?= $title ?> - FlavorFusion
	</title>

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

	<!-- jquery -->
	<script src="assets/js/jquery-3.7.1.min.js"></script>

	<style>
		#favoriteRecipeID.active {
			background-color: var(--main-color) !important;
			/* color; */
		}

		.recipes-read.recipes-bottom {
			margin-top: 20px;
			margin-bottom: 20px;
		}

		.recipes-read.recipes-bottom .card {
			display: flex;
			/* justify-content: ; */
			align-items: center;

		}

		.recipes-read.recipes-bottom .card .bi {
			font-size: 30px;
			color: var(--main-color);
		}

		.recipes-read.recipes-bottom .card span {
			display: block;
		}

		.toast {
			position: fixed;
			bottom: 20px;
			left: 50%;
			transform: translateX(-50%);
			/* background-color: rgba(0, 0, 0, 0.8); */
			color: #fff;
			padding: 10px 20px;
			border-radius: 5px;
			z-index: 99999999;
			transition: opacity 1s ease;
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
						<h1 class="text-white">Recipes Details</h1>
						<p class="text-white mt-3"><a href='index.php'>Home</a><i
								class="bi bi-chevron-right ms-2 me-2"></i>Recipes Details</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Breadcrumb End -->

	<!-- Blog -->
	<?php

	if (mysqli_num_rows($select_recipe) > 0) {
		?>
		<section class="blog-section pt-120 pb-120">
			<div class="container">
				<div class="row gy-5">
					<div class="col-lg-8">
						<div class="blog-details-wrap">
							<div class="blog-box">
								<div class="blog-box-img overflow-hidden">
									<img class="w-100" src="images/<?= $fetch_recipe['image'] ?>" alt="">
								</div>
								<ul class="blog-box-meta custom-ul d-flex mt-3 flex-wrap">
									<li>
										<i class="bi bi-person-circle"></i>
										<a>
											<?= $added_by_name ?>
										</a>
									</li>
									<li>
										<i class="bi bi-calendar2"></i>
										<a>
											<?= $created_date ?>
										</a>
									</li>
									<li>
										<i class="bi bi-eye"></i>
										<a>
											<?= $views ?>
										</a>
									</li>
								</ul>
								<div class="recipes-read recipes-bottom">
									<div class="row g-2">
										<div class="col-12 col-sm-6 col-md-4">
											<div class="card card-body border-0 shadow">
												<i class="bi bi-clock-fill"></i>
												<span>
													Duration:
													<?= $fetch_recipe['duration'] ?>
												</span>
											</div>
										</div>
										<div class="col-12 col-sm-6 col-md-4">
											<div class="card card-body border-0 shadow">
												<div class="bi bi-eye-fill"></div>
												<span>
													Views:
													<?= $views ?>
												</span>
											</div>
										</div>
										<?php
										if (isset($_SESSION['usersid'])) {
											$users_id = $_SESSION['usersid'];
											$select_favorites = mysqli_query($con, "SELECT * FROM `favorites` WHERE `added_by`='$users_id' AND `recipes_id`='$recipe_id'") or die('query failed! ' . mysqli_error($con));

											if (mysqli_num_rows($select_favorites) > 0) {
												?>
												<div class="col-12 col-sm-6 col-md-4">
													<div class="card card-body border-0 shadow bg-danger text-white"
														data-recipes-id="<?= $fetch_recipe['id'] ?>"
														data-user-id="<?= $_SESSION['usersid'] ?>" id="addToFavorite"
														style="cursor: pointer;">
														<i class="bi bi-heart-fill"></i>
														<span id="favorites_text">Remove From Favorites</span>
													</div>
												</div>
												<?php
											} else {
												?>
												<div class="col-12 col-sm-6 col-md-4">
													<div class="card card-body border-0 shadow bg-white" id="addToFavorite"
														data-recipes-id="<?= $fetch_recipe['id'] ?>"
														data-user-id="<?= $_SESSION['usersid'] ?>" style="cursor: pointer;">
														<i class="bi bi-heart-fill"></i>
														<span id="favorites_text">Add to Favorites</span>
													</div>
												</div>
												<?php
											}

										}
										?>
									</div>
								</div>
								<h2 class="h2 mt-3 mb-3">
									<?= $fetch_recipe['title'] ?>
								</h2>
								<div class="recipes-speech-btn mt-3">
									<textarea name="" id="inputText" cols="30" rows="10"
										style="display: none;"><?= $descriptionText ?></textarea>
									<button id="speakButton" class="btn btn-success">Speak</button>
									<button id="pauseButton" class="btn btn-warning">Pause</button>
									<button id="resumeButton" class="btn btn-primary">Resume</button>
									<button id="stopButton" class="btn btn-danger">Stop</button>
								</div>

							</div>
							<div class="details-img-wrap pt-3 pb-3">
								<?= $fetch_recipe['description'] ?>
							</div>
							<div class="share-buttons">
								<span class="shadow common-btn mt-4" style="cursor:pointer;"
									data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal"
									data-recipe-id="<?= $fetch_recipes['recipes_slug'] ?>">
									<i class="bi bi-arrow-repeat"></i>
									Community Share
								</span>
								<span class="shadow common-btn mt-4" style="cursor:pointer;" id="shareButton">
									<i class="bi bi-share-fill"></i>
									Share
								</span>
							</div>
							<?php
							$select_comment = mysqli_query($con, "SELECT * FROM `comment` WHERE `recipes_id`='$recipe_id'") or die('query failed! ' . mysqli_error($con));

							$total_comments = mysqli_num_rows($select_comment);

							if (mysqli_num_rows($select_comment) > 0) {
								?>
								<div class="comments-section mt-5" id="comments-section">
									<h2 class="h2 mb-5">
										<?= $total_comments ?> Comment’s
									</h2>
									<div class="comments-wrap">
										<?php
										while ($fetch_comments = mysqli_fetch_assoc($select_comment)) {
											$comment_id = $fetch_comments['comment_by'];
											$select_user = mysqli_query($con, "SELECT * FROM `user` WHERE `id`='$comment_id' AND `status`='active'") or die('query failed! ' . mysqli_error($con));

											if (mysqli_num_rows($select_user) > 0) {
												$fetch_user = mysqli_fetch_assoc($select_user);
												?>
												<div class="single-comments-box">
													<div class="comments-img flex-shrink-0">
														<img src="images/<?= $fetch_user['profile'] ?>" alt="">
													</div>
													<div class="comments-info">
														<h3>
															<?= $fetch_user['name'] ?> - <span>
																<?= formatDate($fetch_comments['created_time']) ?>
															</span>
														</h3>
														<p>
															<?= $fetch_comments['comment'] ?>
														</p>
													</div>
												</div>
												<?php
											}
										}
										?>
									</div>
								</div>
								<?php
							}
							?>
							<div class="reply-form mt-5">
								<h2 class="h2 mb-4">Leave A Comment</h2>
								<form class="contact-submit-wrap" action="#" id="commentForm">
									<div class="row gy-3">
										<?php
										if (isset($_SESSION['usersid'])) {
											?>
											<div class="col-lg-12">
												<label class="d-inline-block">Write comment</label>
												<textarea cols="30" name="comment" rows="5"
													placeholder="Type your comment"></textarea>
											</div>
											<div class="col-12">
												<input type="hidden" name="added-by" value="<?= $fetch_user['id'] ?>">
												<input type="hidden" name="recipe-id" value="<?= $recipe_id ?>" id="recipe_id">
											</div>
											<div class="col-lg-12">
												<button type="submit" class="common-btn border-0 mt-3 border-radius-0">
													<span>Submitted
														Now</span></button>
											</div>
											<?php
										} else {
											?>
											<div class="col-12">
												<div class="bg-danger p-1 text-white">
													Please Login to comment!
												</div>
											</div>
											<div class="col-lg-12">
												<label class="d-inline-block">Write comment</label>
												<textarea cols="30" rows="5" disabled
													placeholder="Please Login to your account for the comment"></textarea>
											</div>
											<div class="col-lg-12">
												<button type="submit" class="common-btn border-0 mt-3 border-radius-0">
													<span>Submitted
														Now</span></button>
											</div>
											<?php
										}
										?>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="sidebar-wrap">
							<div class="sidebar-item">
								<h2 class="sidebar-title">Search</h2>
								<form class="sidebar-form position-relative overflow-hidden">
									<input type="email" placeholder="Search Here">
									<button
										class="position-absolute end-0 top-50 translate-middle-y h-100 border-0 common-btn"
										type="submit"><i class="bi bi-search search"></i><span>Search</span></button>
								</form>
							</div>
							<div class="sidebar-item">
								<h2 class="sidebar-title">About Me</h2>
								<div class="sidebar-about-wrap text-center">
									<?php
									$select_admin_user = mysqli_query($con, "SELECT * FROM `user` WHERE `id`='$added_by' AND `role`='admin' AND `status`='active' ORDER BY `id` DESC LIMIT 1") or die('query failed! ' . mysqli_error($con));
									if (mysqli_num_rows($select_admin_user) > 0) {
										$fetch_user_admin = mysqli_fetch_assoc($select_admin_user);
										if ($fetch_user_admin['profile'] == '') {
											$profile_image = 'assets/images/blog/sidebar.png';
										} else {
											$profile_image = 'images/' . $fetch_user_admin['profile'];

										}
										?>
										<div class="sidebar-about-img overflow-hidden">
											<img src="<?= $profile_image ?>" alt="">
										</div>
										<h2 class="h2 mt-3 mb-2">
											<?= $fetch_user_admin['name'] ?>
										</h2>
										<!-- <p>I create simple, delicious recipes that require 10 ingredients or less, one bowl, or
											30 minutes or less to prepare.</p> -->
										<?php
									}
									?>
								</div>
							</div>
							<div class="sidebar-item">
								<h2 class="sidebar-title">Recent Post</h2>
								<div class="recent-post-wrap d-flex flex-column">
									<?php
									$select_recent_recipes = mysqli_query($con, "SELECT * FROM `recipes` WHERE `status`='active' ORDER BY `id` DESC LIMIT 3");
									if (mysqli_num_rows($select_recent_recipes) > 0) {
										while ($fetch_recent = mysqli_fetch_assoc($select_recent_recipes)) {
											$added_by1 = $fetch_recent['added_by'];

											$select_users = mysqli_query($con, "SELECT * FROM `user` WHERE `id`='$added_by1'") or die('query failed! ' . mysqli_error($con));

											if (mysqli_num_rows($select_users) > 0) {
												$fetch_user1 = mysqli_fetch_assoc($select_users);
												$added_by_name1 = $fetch_user1['name'];
											}
											?>
											<div class="blog-box">
												<div class="blog-box-img overflow-hidden">
													<a href='read-recipes.php?slug=<?= $fetch_recent['slug'] ?>'>
														<img class="w-100" src="images/<?= $fetch_recent['image'] ?>" alt=""></a>
												</div>
												<ul class="blog-box-meta custom-ul d-flex mt-3 flex-wrap">
													<li>
														<i class="bi bi-person-circle"></i>
														<a href='read-recipes.php?slug=<?= $fetch_recent['slug'] ?>'>
															<?= $added_by_name1 ?>
														</a>
													</li>
													<li>
														<i class="bi bi-calendar2"></i>
														<a href='read-recipes.php?slug=<?= $fetch_recent['slug'] ?>'>
															<?= formatDate($fetch_recent['created_time']) ?>
														</a>
													</li>
												</ul>
												<h2 class="h2 mt-3">
													<a href='read-recipes.php?slug=<?= $fetch_recent['slug'] ?>'>
														<?= $fetch_recent['title'] ?>
													</a>
												</h2>
											</div>
											<?php
										}
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Blog End -->
		<?php
	}
	?>
	<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
		tabindex="-1">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalToggleLabel">Communities</h5>
					<button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
						aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<table class="table">
						<tbody>
							<?php
							if (isset($_SESSION['usersid'])) {
								$select_community = mysqli_query($con, "SELECT community.*, joined_community.*,
                                 joined_community.community_id AS joined_community_id FROM `communities` AS community,
                                `community_joined` AS joined_community WHERE community.`status`='active'
                                AND community.id=joined_community.community_id AND joined_community.user_id='" . $fetch_user['id'] . "'")
									or die('query failed! ' . mysqli_error($con));



								if (mysqli_num_rows($select_community) > 0) {
									while ($fetch_community = mysqli_fetch_assoc($select_community)) {
										?>
										<tr class="text-center">
											<td>
												<strong>
													<?= $fetch_community['title'] ?>
												</strong>
											</td>
											<td>
												<button class="btn btn-danger shadow-none share-community"
													data-user-id="<?= $fetch_user['id'] ?>"
													data-community-id="<?= $fetch_community['joined_community_id'] ?>"
													data-recipe-id="<?= $recipe_id ?>">Share</button>
											</td>
										</tr>
										<?php
									}
								}


							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<?php
	include 'include/footer.php';
	?>
	<script>

		// Function to show toast notification
		function showNotification(message) {
			var toast = document.createElement('div');
			toast.classList.add('toast', 'bg-dark');
			toast.textContent = message;

			// Set initial opacity to make the toast visible
			toast.style.opacity = '1';

			document.body.appendChild(toast);

			// Automatically remove the toast after a few seconds
			setTimeout(function () {
				toast.style.opacity = '0'; // Fade out the toast
				setTimeout(function () {
					toast.remove(); // Remove the toast from the DOM after it fades out
				}, 1000); // Adjust the duration as needed (should match CSS transition duration)
			}, 3000); // Adjust the duration as needed
		}

		$(document).ready(function () {
			$(document).on('click', '.share-community', function (event) {
				event.preventDefault();

				var community_id = $(this).data('community-id');
				var user_id = $(this).data('user-id');
				var recipe_id = $(this).data('recipe-id');

				$.ajax({
					url: 'pages/ajax.php',
					type: 'POST',
					data: {
						community_id: community_id,
						user_id: user_id,
						recipe_id: recipe_id,
						'action': 'share_community'
					},
					dataType: 'json',
					success: function (data) {
						// console.log(data);
						if (data.status === "success") {
							// alert(data.message);
							showNotification(data.message);
						} else {
							// alert(data.message);
							showNotification(data.message);
						}
					},
					error: function (xhr, status, error) {
						// Handle errors
						console.error('Error occurred:', error);
					}
				});
			});

			$('#commentForm').on('submit', function (event) {
				event.preventDefault();

				var added_by = $("#added-by").val();

				if (added_by === '') {
					alert('Please login to your account!');
				} else {
					var formData = $(this).serializeArray();
					formData.push({
						name: 'add-comment',
						value: 'comment'
					});

					$.ajax({
						url: 'pages/ajax.php',
						type: 'POST',
						data: formData,
						dataType: 'json',
						success: function (data) {
							// console.log(data);
							// console.log("Your Comment Posted successfully!");
							if (data.status === "success") {
								alert('Your Comment Posted successfully! ');
								// reloading the comments section only
								$('#comments-section').load(location.href + ' #comments-section');
							} else {
								alert('Comment was not added please try again!');
							}
						},
						error: function (xhr, status, error) {
							// Handle errors
							console.error('Error occurred:', error);
						}
					});
				}
			});

			// add to favorites
			$('#addToFavorite').on("click", function () {
				let userId = $('#addToFavorite').attr('data-user-id');
				let favoriteRecipeID = $('#addToFavorite').attr('data-recipes-id');

				if (userId == '') {
					alert('Please Login First');
					return false;
				} else {
					$.ajax({
						url: 'pages/ajax.php',
						method: 'post',
						data: {
							users_id: userId,
							favoriteRecipeID: favoriteRecipeID
						},
						// dataType: 'json',
						success: function (response) {
							// console.log(response)
							if (!$.isEmptyObject(response)) {
								if (response.status == 'success' && response.message ===
									'Added to your Favorites successfully...') {
									$('#addToFavorite').removeClass('bg-white');
									$('#addToFavorite').addClass('bg-danger text-white');
									$('#favorites_text').html('Remove from Favorites')
								} else if (response.status === 'success' && response.message ===
									'Removed from your Favorites successfully...') {
									$('#addToFavorite').removeClass('bg-danger text-white');
									$('#addToFavorite').addClass('bg-white');
									$('#favorites_text').html('Add to Favorites')
								} else {
									alert('There was an error please try again later!');
								}
							} else {
								console.log(response)
								// alertify.warning("You Must Login First")
							}
						},
						error: function (xhr, status, error) {
							// Handle errors
							console.error('Error occurred:', error);
						}
					});
				}
			});
		});

		// share button copy url
		document.addEventListener('DOMContentLoaded', function () {
			var shareButton = document.getElementById('shareButton');

			shareButton.addEventListener('click', function () {
				// Get the URL to copy
				var urlToCopy = window.location.href;

				// Copy URL to clipboard
				navigator.clipboard.writeText(urlToCopy).then(function () {
					// Trigger toast notification
					showNotification('URL copied successfully!');
				}, function (err) {
					console.error('Could not copy text: ', err);
				});
			});



		});

		document.addEventListener('DOMContentLoaded', function () {
			const inputText = document.getElementById('inputText');
			const speakButton = document.getElementById('speakButton');
			const pauseButton = document.getElementById('pauseButton');
			const resumeButton = document.getElementById('resumeButton');
			const stopButton = document.getElementById('stopButton');

			let speechSynthesis = window.speechSynthesis;
			let utterance = new SpeechSynthesisUtterance();

			window.addEventListener('beforeunload', function (event) {
				stopSpeechSynthesis();
			});

			// Function to stop ongoing speech synthesis
			function stopSpeechSynthesis() {
				if (speechSynthesis.speaking) {
					speechSynthesis.cancel();
				}
			}

			speakButton.addEventListener('click', () => {
				utterance.text = inputText.value;
				stopSpeechSynthesis();
				speechSynthesis.speak(utterance);
				// console.log("Speak button clicked");
			});

			pauseButton.addEventListener('click', () => {
				speechSynthesis.pause();
				// console.log("Pause button clicked");
			});

			resumeButton.addEventListener('click', () => {
				speechSynthesis.resume();
				// console.log("Resume button clicked");
			});

			stopButton.addEventListener('click', () => {
				stopSpeechSynthesis();
			});

			speechSynthesis.onstart = () => {
				pauseButton.disabled = false;
				resumeButton.disabled = true;
				stopButton.disabled = false;
				// console.log("Speech synthesis started");
			};

			speechSynthesis.onpause = () => {
				resumeButton.disabled = false;
				pauseButton.disabled = true;
				// console.log("Speech synthesis paused");
			};

			speechSynthesis.onresume = () => {
				resumeButton.disabled = true;
				pauseButton.disabled = false;
				// console.log("Speech synthesis resumed");
			};

			speechSynthesis.onend = () => {
				pauseButton.disabled = true;
				resumeButton.disabled = true;
				stopButton.disabled = true;
				// console.log("Speech synthesis ended");
			};

			if (!('speechSynthesis' in window)) {
				alert("Your browser does not support speech synthesis.");
			}
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

<!-- Mirrored from epicurean.netlify.app/epicurean/blog-details by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Mar 2024 13:05:28 GMT -->

</html>