<!doctype html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
   <title>Recipes - FlavorFusion</title>
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
                  <h1 class="text-white">Our Recipes</h1>
                  <p class="text-white mt-3"><a href='index.php'>Home</a><i
                        class="bi bi-chevron-right ms-2 me-2"></i>Recipes</p>
               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Breadcrumb End -->



   <!-- Menu -->

   <div class="manu-page-wrap pt-60 pb-60">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="section-title text-center">
                  <span>Recipes Book</span>
                  <h2 class="mt-2">Latest Recipes</h2>
               </div>
            </div>
         </div>
         <div class="row pt-60">
            <div class="col-lg-12">
               <div class="menu-book-box-wrap">

                  <?php
                  $select_recipes = mysqli_query($con, "SELECT * FROM `recipes` WHERE `status`='active' ORDER BY `id` DESC") or die('query failed! ' . mysqli_error($con));

                  if (mysqli_num_rows($select_recipes) > 0) {
                     while ($fetch_recipes = mysqli_fetch_assoc($select_recipes)) {
                        ?>
                        <div class="menu-book-box d-flex justify-content-between align-items-center">
                           <div class="menu-book-info-wrap d-flex flex-column flex-xl-row align-items-xl-center">
                              <div class="menu-book-img flex-shrink-0">
                                 <img class="w-100" src="images/<?= $fetch_recipes['image'] ?>" alt=""
                                    style="height: 100%; object-fit: cover; border-radius: 50%;">
                              </div>
                              <div class="menu-book-info">
                                 <h2 class="h2 mb-1"><a href="read-recipes.php?slug=<?= $fetch_recipes['slug'] ?>">
                                       <?= $fetch_recipes['title'] ?>
                                    </a></h2>
                                 <p>
                                    <?= $fetch_recipes['short_desc'] ?>
                                 </p>
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
      </div>
   </div>

   <!-- Menu End -->



   <?php
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

<!-- Mirrored from epicurean.netlify.app/epicurean/food-menu-01 by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Mar 2024 13:05:34 GMT -->

</html>