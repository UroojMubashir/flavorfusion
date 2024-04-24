<?php
session_start();
include 'pages/function.php';
include 'include/config.php';
$redirect_urls = '';
if (isset($_GET['redirect-urls'])) {
    $redirect_urls = input_validate(mysqli_real_escape_string($con, $_GET['redirect-urls']));
}

if (isset($_SESSION['usersid'])) {
    // updating the cookies
    setcookie('rememberme', $_SESSION['usersid'], time() + (7 * 24 * 60 * 60), '/');

    if (isset($_GET['return_url'])) {
        $return_url = urldecode($_GET['return_url']);
        if ($return_url === '') {
            header('Location: index.php');
        } else {
            header('location:' . $return_url);
        }
    } else {
        header('location: index.php');
    }
    exit();
}

// checking cookies if its available then  login the user automatically
if (isset($_COOKIE['rememberme'])) {
    // Retrieve the user information based on the remember_me cookie
    $user_id = $_COOKIE['rememberme'];

    $select_users = mysqli_query($con, "SELECT * FROM `user` WHERE `id`='$user_id' AND `status`='active' AND `role`='user'") or die('query failed! ' . mysqli_error($con));
    if (mysqli_num_rows($select_users) > 0) {
        $fetch_user = mysqli_fetch_assoc($select_users);

        $_SESSION['usersid'] = $fetch_user['id'];
        $_SESSION['name'] = $fetch_user['name'];
        $_SESSION['username'] = $fetch_user['username'];
        $_SESSION['email'] = $fetch_user['email'];
        $_SESSION['user_status'] = $fetch_user['status'];

        // Optionally, you may want to update the remember_me cookie for another 7 days
        setcookie('remember_me', $fetch_user['id'], time() + (7 * 24 * 60 * 60), '/');

        header('location: index.php');
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Signup - FlavorFusion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />

    <link rel="icon" href="assets/images/fav.png" type="image/gif" sizes="20x20">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/bootstrap-icons.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Jquery JS -->
    <script src="assets/js/jquery-3.7.1.min.js"></script>

    <style>
        .login {
            padding: 60px 0;
            position: relative;

        }

        .login .card-header .card-title {
            font-size: 35px;
            color: var(--black-color);
        }

        .form-input {
            box-shadow: none !important;
            padding: 10px 8px;
        }

        .form-input:focus {
            border-color: var(--main-color);
        }

        .form-btn {
            padding: 11px !important;
            background-color: var(--main-color);
            border-color: var(--main-color);
            color: var(--black-color);
            font-size: 17px;
            font-weight: 500;
            box-shadow: none !important;
        }

        .form-btn:hover,
        .form-btn:focus,
        .form-btn:active {
            color: var(--black-color) !important;
            background-color: var(--dark-pink) !important;
            border-color: var(--dark-pink) !important;
        }
    </style>
</head>

<body>


    <div class="login">
        <div class="container">
            <div class="row g-3 justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card border-0 shadow">
                        <div class="card-header">
                            <h3 class="card-title text-center">Create Account</h3>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-dismissible fade show" style="display: none;" role="alert">
                                <strong id="alert-title"></strong> <span id="alert-text"></span>
                            </div>
                            <form action="" method="post" id="signup-form">
                                <div class="row g-3 jusify-content-center">
                                    <div class="col-12 mb-1">
                                        <label for="auth-username" class="form-label">Username</label>
                                        <input type="text" name="auth-username" id="auth-username" required
                                            class="form-control form-input">
                                    </div>
                                    <div class="col-12 mb-1">
                                        <label for="auth-email" class="form-label">Email</label>
                                        <input type="text" name="auth-email" id="auth-email" placeholder="Enter Email"
                                            required class="form-control form-input">
                                    </div>
                                    <div class="col-12 mb-1">
                                        <label for="auth-name" class="form-label">Full Name</label>
                                        <input type="text" name="auth-name" id="auth-name" required
                                            placeholder="Enter Full Name" class="form-control form-input">
                                    </div>
                                    <div class="col-12 mb-1">
                                        <label for="authpassword" class="form-label">Password</label>
                                        <input type="password" name="password" id="auth-password" required
                                            class="form-control form-input" placeholder="Password">
                                    </div>
                                    <div class="col-12 mb-1">
                                        <label for="authpassword" class="form-label">Password</label>
                                        <input type="password" name="cpassword" id="auth-cpassword" required
                                            class="form-control form-input" placeholder="Confirm Password">
                                    </div>
                                    <div class="col-12 mb-3 mt-2">
                                        <button class="btn btn-primary form-control form-btn p-2" name="signup">
                                            Signup
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

    <script>
        $(document).ready(function () {

            $('#auth-username').on('input', function () {
                var sanitized = $(this).val().replace(/[^\w]/g, ''); // Replace any character that is not a word character or underscore
                $(this).val(sanitized);
            });

            $('#signup-form').submit(function (event) {
                event.preventDefault();

                // Get the form data
                var formData = $(this).serializeArray();

                // Add action for login as value login
                formData.push({ name: 'action-signup', value: 'signup' });

                // console.log(formData);

                // Send the form data to ajax.php using AJAX
                $.ajax({
                    type: 'POST',
                    url: 'pages/ajax.php',
                    data: formData,
                    dataType: 'json', // Expect JSON response
                    success: function (response) {
                        console.log(response)
                        // Handle the response
                        if (response.status === 'success') {
                            showAlert('alert-success bg-success text-white', response.title, 'alert-success bg-success text-white', response.message);
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