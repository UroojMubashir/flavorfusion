<?php
session_start();
include 'pages/function.php';
include 'include/config.php';
if (!isset($_SESSION['usersid'])) {
    header('location: login.php');
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Profile - FlavorFusion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
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
    <!-- Jquery JS -->
    <script src="assets/js/jquery-3.7.1.min.js"></script>


    <style>
        .profile {
            padding: 100px 0
        }
    </style>
</head>

<body>
    <?php
    // header
    include 'include/header.php';
    // profile
    ?>
    <div class="profile">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card card-body shadow border-0 address-box">
                        <div class="img-rounded text-center">
                            <img src="images/<?php if (isset($_SESSION['usersid'])) {
                                echo $fetch_user['profile'];
                            } else {
                                echo '';
                            } ?>" width="150" alt="" class="img-fluid">
                            <div class="mt-2">
                                <h3 class="card-title">
                                    <?= $_SESSION['name'] ?>
                                </h3>
                            </div>
                        </div>
                        <div class="content mt-3">
                            <div class="list mb-3">
                                <label for="" class="form-label d-block mb-1">Username:</label>
                                <strong>
                                    <?= $_SESSION['username'] ?>
                                </strong>
                            </div>
                            <div class="list mb-3">
                                <label for="" class="form-label d-block">Email:</label>
                                <strong>
                                    <?= $_SESSION['email'] ?>
                                </strong>
                            </div>
                            <div class="list mb-3">
                                <a href="logout.php" class="common-btn border-radius-0 bg-danger">Logout</a>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="alert alert-dismissible fade show" style="display: none;" role="alert">
                        <strong id="alert-title"></strong> <span id="alert-text"></span>
                    </div>
                    <div class="card shadow border-0">
                        <div class="card-header">
                            <h4 class="card-title">Update Profile</h4>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data" id="update-profile"
                                class="contact-submit-wrap">
                                <div class="row g-4">
                                    <div class="col-12 col-md-6">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" name="username" required readonly
                                            value="<?= $_SESSION['username'] ?>" id="username">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" name="email" id="email" value="<?= $_SESSION['email'] ?>"
                                            required placeholder="Enter Email">
                                    </div>
                                    <div class="col-12">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input type="text" name="name" id="name" required
                                            value="<?= $_SESSION['name'] ?>">
                                    </div>
                                    <div class="col-12">
                                        <label for="profilepic" class="form-label">Profile Image</label>
                                        <input type="file" name="profileimage" id="profilepic">
                                        <input type="hidden" name="old-image" value="<?php if (isset($_SESSION['usersid'])) {
                                            echo $fetch_user['profile'];
                                        } else {
                                            echo '';
                                        } ?>" readonly>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="password" class="form-label">Old Password</label>
                                        <input type="password" name="oldpassword" id="oldpassword"
                                            placeholder="Enter Old Password (Leave it blank if you don't to change Password)">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="newpassword" class="form-label">New Password</label>
                                        <input type="password" name="newpassword" id="newpassword"
                                            placeholder="Enter New Password">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="cpassword" class="form-label">Confirm New Password</label>
                                        <input type="password" name="cpassword" id="cpassword"
                                            placeholder="Confirm New Password">
                                    </div>
                                    <div class="col-12 text-center">
                                        <button class="common-btn border-0 mt-3 border-radius-0" name="update">
                                            <span>Update Profile</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php

    // footer
    include 'include/footer.php';

    ?>

    <script>
        $(document).ready(function () {
            // updating profile using ajax
            $('#update-profile').submit(function (event) {
                event.preventDefault();

                // Get the form data
                var formData = new FormData($(this)[0]);

                // Add action for login as value login
                formData.append('profile-update', 'update');


                if ($('#oldpassword').val() === '') {
                    // Send the form data to ajax.php using AJAX
                    $.ajax({
                        type: 'POST',
                        url: 'pages/ajax.php',
                        data: formData,
                        dataType: 'json', // Expect JSON response
                        success: function (response) {
                            // console.log(response)
                            // Handle the response
                            if (response.status === 'success') {
                                alert("Profile has been updated successfully");
                                // showAlert('alert-success bg-success text-white', response.title, 'alert-success bg-success text-white', response.message);
                                window.location.href = 'profile.php';
                            } else {
                                showAlert('alert-success bg-success text-white', response.title, 'alert-danger bg-danger text-white', response.message);
                                // console.error('Form submission failed:', response.message);
                                // Optionally, handle failed response
                            }
                        },
                        error: function (xhr, status, error) {
                            // Handle errors
                            console.error('Error occurred:', error);
                        }
                    });
                } else {
                    if ($('#newpassword').val() === '' || $('#cpassword').val() === '') {
                        alert("New Password or Confirm Password is null please fill all the fields");
                    } else {
                        // Send the form data to ajax.php using AJAX
                        $.ajax({
                            type: 'POST',
                            url: 'pages/ajax.php',
                            data: formData,
                            processData: false, // Prevent jQuery from processing data
                            contentType: false, // Prevent jQuery from setting content type
                            dataType: 'json', // Expect JSON response
                            success: function (response) {
                                console.log(response)
                                // Handle the response
                                if (response.status === 'success') {
                                    alert("Profile has been updated successfully");
                                    // showAlert('alert-success bg-success text-white', response.title, 'alert-success bg-success text-white', response.message);
                                    window.location.href = 'profile.php';
                                } else {
                                    showAlert('alert-success bg-success text-white', response.title, 'alert-danger bg-danger text-white', response.message);
                                    // console.error('Form submission failed:', response.message);
                                    // Optionally, handle failed response
                                }
                            },
                            error: function (xhr, status, error) {
                                // Handle errors
                                console.error('Error occurred:', error);
                            }
                        });
                    }
                }


                // console.log(formData);

            });
        });

        function showAlert(removeClasses, alertTitles, alertbg, alertText) {
            var alerts = $('.alert');

            alerts.removeClass(removeClasses);

            var alerttitle = $('#alert-title');
            var alerttext = $('#alert-text');

            alerts.css('display', 'block');
            alerttitle.html(alertTitles);
            alerts.addClass(alertbg);
            alerttext.html(alertText);

        }
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

</html>