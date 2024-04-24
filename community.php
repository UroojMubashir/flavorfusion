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
    <title>Community - FlavorFusion</title>
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
        .community {
            padding: 100px 0
        }
    </style>
</head>

<body>
    <?php
    // header
    include 'include/header.php';
    // community
    ?>
    <div class="community">
        <div class="container">
            <div class="row justify-content-center">
                <?php
                $select_community = mysqli_query($con, "SELECT * FROM `communities` WHERE `status`='active'") or die('query failed! ' . mysqli_error($con));

                if (mysqli_num_rows($select_community) > 0) {
                    while ($fetch_community = mysqli_fetch_assoc($select_community)) {
                        $community_id = $fetch_community['id'];

                        if (isset($_SESSION['usersid'])) {
                            $usersid = $_SESSION['usersid'];
                            $select_joined_community = mysqli_query($con, "SELECT * FROM `community_joined` WHERE `user_id`='$usersid'
                             AND `community_id`='$community_id'") or die('query failed! ' . mysqli_error($con));

                            if (mysqli_num_rows($select_joined_community) > 0) {

                            }
                        }

                        ?>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card shadow">
                                <img src="images/<?= $fetch_community['image'] ?>" alt="" class="img-fluid">
                                <div class="card-body">
                                    <a href="communities.php?id=<?= $fetch_community['permalink'] ?>" class="link">
                                        <?= $fetch_community['title'] ?>
                                    </a>
                                    <?php
                                    if (isset($_SESSION['usersid'])) {

                                        if (mysqli_num_rows($select_joined_community) > 0) {
                                            ?>
                                            <button class="btn btn-danger shadow form-control mt-2 community-join"
                                                data-community-id="<?= $fetch_community['id'] ?>" data-user-id="<?php if (isset($_SESSION['usersid'])) {
                                                      echo $_SESSION['usersid'];
                                                  } else {
                                                      echo '';
                                                  } ?>">Unsubscribe Community</button>
                                            <?php
                                        } else {
                                            ?>
                                            <button class="btn btn-success shadow form-control mt-2 community-join"
                                                data-community-id="<?= $fetch_community['id'] ?>" data-user-id="<?php if (isset($_SESSION['usersid'])) {
                                                      echo $_SESSION['usersid'];
                                                  } else {
                                                      echo '';
                                                  } ?>">Join
                                                Now</button>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <a href="login.php" class="btn btn-success shadow form-control mt-2">Login Now</a>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>


    <?php

    // footer
    include 'include/footer.php';

    ?>

    <script>
        $(document).ready(function () {
            $(document).on('click', '.community-join', function (event) {
                event.preventDefault();

                // Get the community ID from the data-community-id attribute
                var community_id = $(this).data('community-id');
                var user_id = $(this).data('user-id');


                if (user_id !== '') {
                    // AJAX request
                    $.ajax({
                        url: 'pages/ajax.php',
                        method: 'POST',
                        data: {
                            community_id: community_id,
                            community_join: 'join',
                            user_id: user_id
                            // Add any other data you need to send to the server
                        },
                        success: function (response) {
                            // Handle success response from the server
                            if (response === 'joined') {
                                alert('Community Joined Successfully...');
                                window.location.href = 'community.php';
                            } else if (response === 'already joined') {
                                alert("You are already a member of this Community");
                                window.location.href = 'community.php';
                            } else if (response === 'not joined') {
                                alert('An error occurred while trying to join the community. Please try again later.');
                                window.location.href = 'community.php';
                            } else if (response === 'community not found') {
                                alert('Community was not found please try again later!');
                                window.location.href = 'community.php';
                            } else if (response === 'deleted') {
                                alert('You successfully unsubscribed from the community...');
                                window.location.href = 'community.php';
                            } else if (response === 'not deleted') {
                                alert('An error occurred while trying to unsubscribe the community. please try again!');
                                window.location.href = 'community.php';
                            } else {
                                alert('An error occurred while trying to join the community. Please try again later.');
                                window.location.href = 'community.php';
                            }
                            // console.log('AJAX request successful');
                            // console.log('Response:', response);
                            // You can perform further actions based on the response from the server
                        },
                        error: function (xhr, status, error) {
                            // Handle errors
                            console.error('AJAX request error:', error);
                        }
                    });
                } else {
                    alert('please login first to join this community');
                }

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

</html>