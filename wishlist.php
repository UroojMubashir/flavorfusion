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
    <title>Favorites - FlavorFusion</title>
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
</head>

<body>
    <?php
    // header
    include 'include/header.php';
    ?>

    <div class="manu-page-wrap pt-120 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <span>Favorites</span>
                        <h2 class="mt-2">Favorites Posts</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="menu-book-box-wrap">
                        <div class="row g-4" id="favorites_recipes1"></div>
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
            $(document).on('click', '.delete-favorites', function (event) {
                event.preventDefault();

                var recipeId = $(this).data('recipe-id');
                var userId = $(this).data('user-id');

                var confirmation = confirm('Are you sure you want to delete this recipe from favorites?');

                if (confirmation) {
                    $.ajax({
                        url: 'pages/ajax.php',
                        type: 'POST',
                        data: {
                            action: 'delete_favorite',
                            recipe_id: recipeId,
                            user_id: userId
                        },
                        dataType: 'json',
                        success: function (data) {
                            if (data.status === "success") {
                                alert('Recipe deleted successfully!');

                                fetch_favorites_recipes();
                            } else {
                                alert('Failed to delete recipe. Please try again later.');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('Error occurred:', error);
                            alert('Failed to delete recipe. Please try again later.');
                        }
                    });
                }
            });


            function fetch_favorites_recipes() {
                var favorites_recipes1 = $('#favorites_recipes1');
                favorites_recipes1.empty();


                $.ajax({
                    url: 'pages/ajax.php?getfavorite-recipes=1&user-id=<?= $_SESSION['usersid'] ?>',
                    type: 'get',
                    dataType: 'json',
                    success: function (fetch_favorites) {
                        console.log(fetch_favorites);
                        if (fetch_favorites && fetch_favorites.length > 0) {
                            $.each(fetch_favorites, function (index, favorite_recipes) {
                                // Process each favorite recipe
                                var favorites_recipes1 = `
                                <div class="col-md-6">
                                    <div class="menu-book-box d-flex justify-content-between align-items-center">
                                        <div class="menu-book-info-wrap d-flex flex-column flex-xl-row align-items-xl-center">
                                            <div class="menu-book-img flex-shrink-0">
                                                <img class="w-100" src="images/${favorite_recipes.recipes_image}" alt=""
                                                    style="height: 100%; object-fit: cover; border-radius: 50%;">
                                            </div>
                                            <div class="menu-book-info">
                                                <h2 class="h2 mb-1"><a href="read-recipes.php?slug=${favorite_recipes.recipe_slug}">
                                                ${favorite_recipes.recipe_title}
                                                    </a></h2>
                                                <p>
                                                ${favorite_recipes.recipes_short_desc}
                                                </p>
                                                <div class="d-flex justify-content-end mt-2">
                                                    <button class="btn btn-danger shadow-none rounded-0 delete-favorites"
                                                    data-recipe-id="${favorite_recipes.recipes_ids}"
                                                     data-user-id="<?= $_SESSION['usersid'] ?>">Delete Recipe</button>
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>`;

                                $('#favorites_recipes1').append(favorites_recipes1);
                            });
                        } else {
                            console.log("No favorite recipes found.");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', status, error);
                    }
                });
            }

            // Fetch favorite recipes
            fetch_favorites_recipes();





            // add to favorites
            $('#addToFavorite').on("click", function () {
                let userId = "";
                let favoriteRecipeID = "";

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
                        dataType: 'json',
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
<!-- 
 -->