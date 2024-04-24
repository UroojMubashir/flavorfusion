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
    <title>Communities - FlavorFusion</title>
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
            padding: 50px 0
        }

        .recipes {
            padding: 50px 0
        }
    </style>
</head>

<body>
    <?php
    // header
    include 'include/header.php';
    // community
    ?>

    <div class="manu-page-wrap pt-120 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <span>Communities</span>
                        <h2 class="mt-2">Community Posts</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="menu-book-box-wrap">
                        <?php
                        if (isset($_GET['id'])) {
                            $community_id = mysqli_real_escape_string($con, $_GET['id']);

                            $select_community = mysqli_query($con, "SELECT Recipes.*, Recipes.id AS recipes_id, Recipes.image AS recipes_image, Recipes.short_desc AS recipes_short_desc,
                            Recipes.slug AS recipe_slug, Recipes.title AS recipes_title, joined_community.*, community.*, shared_community.*, categories.id AS categories_ids FROM `community_joined` AS joined_community,
                            `communities` AS community, `recipes` AS Recipes, `community_share` AS shared_community, `category` AS categories WHERE community.permalink='$community_id'
                            AND joined_community.`community_id`=community.id AND Recipes.id=shared_community.recipes_id AND categories.id=Recipes.category_id") or die('query failed! ' . mysqli_error($con));


                            if (mysqli_num_rows($select_community) > 0) {
                                while ($row = mysqli_fetch_assoc($select_community)) {
                                    $recipes_id = $row['recipes_id'];
                                    ?>
                                    <div class="menu-book-box d-flex justify-content-between align-items-center">
                                        <div class="menu-book-info-wrap d-flex flex-column flex-xl-row align-items-xl-center">
                                            <div class="menu-book-img flex-shrink-0">
                                                <img class="w-100" src="images/<?= $row['recipes_image'] ?>" alt=""
                                                    style="height: 100%; object-fit: cover; border-radius: 50%;">
                                            </div>
                                            <div class="menu-book-info">
                                                <h2 class="h2 mb-1"><a href="read-recipes.php?slug=<?= $row['recipe_slug'] ?>">
                                                        <?= $row['recipes_title'] ?>
                                                    </a></h2>
                                                <p>
                                                    <?= $row['recipes_short_desc'] ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php

    // footer
    include 'include/footer.php';

    ?>


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