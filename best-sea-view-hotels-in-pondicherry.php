<?php
error_reporting(0);
include("store_db_con.php");
$conn = dbconnect();
?>
<!doctype html>
<html class="no-js" lang="zxx">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>Jolly Tourism – Pondicherry’s Ultimate Boating Adventure</title>
      <meta name="author" content="Jolly Tourism">
      <meta name="description" content="Jolly Tourism - Discover the essence of sea adventure with Jolly Tourism, Pondicherry’s leading tourism company. For over six years, we have been curating exceptional tour packages that combine adventure, exploration, and relaxation, ensuring each experience is both innovative and memorable. ">
      <meta name="keywords" content="Jolly Tourism, Pondicherry tourism, Pondicherry tour packages, sea adventure Pondicherry, water sports Pondicherry, eco-tourism Pondicherry, beach house stay Pondicherry, villa rental Pondicherry, hut stay Pondicherry, Pondicherry resorts, comfort stay Pondicherry, tourism in Pondicherry, adventure tours Pondicherry, best tour operator Pondicherry, nature tours Pondicherry, sustainable tourism India, travel agency Pondicherry">
      <meta name="robots" content="INDEX,FOLLOW">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
      <link rel="icon" type="image/png" sizes="192x192" href="assets/img/favicons/favicon.png">
      <meta name="theme-color" content="#ffffff">
      <link rel="preconnect" href="https://fonts.googleapis.com/">
      <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
      <link rel="preconnect" href="https://fonts.googleapis.com/">
      <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&amp;family=Manrope:wght@200..800&amp;family=Montez&amp;display=swap" rel="stylesheet">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/fontawesome.min.css">
      <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
      <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
      <link rel="stylesheet" href="assets/css/style.css">
   </head>
   <body>
    
      <!-- <div id="preloader" class="preloader">
         <button class="btn btn-primary  preloaderCls">Cancel Preloader</button>
         <div class="preloader-inner"><img src="assets/img/logo/logo.png" alt=""></div>
      </div> -->
      <?php include('header.php'); ?>

       <section class="tour-area position-relative bg-top-center overflow-hidden space" id="service-sec" data-bg-src="assets/img/bg/tour_bg_1.jpg">
         <div class="container">
            <div class="row">
               <div class="col-lg-6 offset-lg-3">
                  <div class="title-area text-center">
                     <span class="sub-title">Best Place For You</span>
                     <h2 class="sec-title">Comfort Stay</h2>
                     <p class="sec-text">Let Jolly Tourism be your gateway to extraordinary adventures and comfortable stays. Your journey starts here!</p>
                  </div>
               </div>
            </div>
            <div class="slider-area tour-slider">
               <div class="swiper">
                  <div class="row">
                     <?php
                     $stay_query = "SELECT * FROM tb_stay WHERE status != 1 ORDER BY stay_id ASC";
                     $stay_rec = mysqli_query($conn, $stay_query);
                     while($stay_row = mysqli_fetch_object($stay_rec))
                     {
                     $stay_id =$stay_row->stay_id;
                     $price =$stay_row->price;
                     $stay_image =$stay_row->stay_image;
                     $stay_name =ucwords(strtolower($stay_row->stay_name));
                     ?>
                     <div class="col-md-3 mb-5">
                        <div class="tour-box th-ani gsap-cursor">
                           <div class="tour-box_img global-img"><img src="dynamic-images/hotel/<?php echo $stay_image; ?>" alt="image"></div>
                           <div class="tour-content">
                              <h3 class="box-title"><a href="best-sea-view-hotels-in-pondicherry"><?php echo $stay_name; ?></a></h3>
                              <div class="tour-rating">
                                 <div class="star-rating" role="img" aria-label="Rated 5.00 out of 5"><span style="width:100%">Rated <strong class="rating">5.00</strong> out of 5 based on <span class="rating">4.8</span>(2,260 Reviews)</span></div>
                                 <a target="_blank" href="https://www.google.com/search?client=ms-android-oneplus-rvo3&sca_esv=d8cc6752d7fc5bba&sxsrf=AE3TifP5Hn8A3OHbpgorSqEFpd-1vd7XaQ:1748573713439&q=wills+boat+house+reviews&uds=AOm0WdGJjT-KYfyqzkpfr4Iv3im0ZUI_XdL0JagfbgHMJMVuuX2ULAerp5mbtAoqSlULQy8crZfsrUoDUzQZU09e_qY8MYvK0Hm-1IS_TiZiqCKNUxK1f5qt7u-IBtZ9ShqYhP1EVtMPMks5Fs8U8skHfbxCj59p2R0BeaBSln91I_bMbPrc21N4qlTnCsWuajZOPeF7Y58Qu-93qoYIq7ZNIhJAsFLTk9ZPvZ6nAFnMRvUYJhvcOiuF41Fk67jOwriXqmYc4Auh3tzSypcYcnYagp9zsErH2IxAZiWwxa-9fg0-X8G7bNISJ5gr8GpQZUX-_onnFSbEJuOKQvBczQYS3ScjDeaxqWjm5hE2Y85EtdG-LjLOU7AK_ctPZNBwwVBpGH8DpIMLB_qworqYjYnwNWSvQAMA8dxTpOlp8szvFBaXRvJxOR5aUNy_9ZhMLOwI0NYhApctUps81Bro5bCox5y2JQgVafhqdHAWzJI79iHlnJ02YnjlSBw28oXZdAkNbBmX9ozYeQEWDp2H2OkvdBavxRcQAA&si=AMgyJEtREmoPL4P1I5IDCfuA8gybfVI2d5Uj7QMwYCZHKDZ-E-UWZnSr5Jqy27Q3WXb5ESBuifuiJ0DnyryIamv1oTJxKMg4nd83OwW1Y8_f9Dl3RgemN7GGD0t4zOqvXKCejCL0CJdCBvGZaEeUk7RiTU-frrIUdA%3D%3D&sa=X&sqi=2&ved=2ahUKEwiU-rXYmMqNAxUA4DgGHWuXDAwQk8gLegQIJBAB&ictx=1&stq=1&cs=1&lei=ER45aNStGoDA4-EP666yYA#ebo=2">(<span class="count">4.8</span> Rating)</a>
                              </div>
                              <h4 class="tour-box_price"><span class="currency">₹<?php echo $price; ?></span>/onwards</h4>
                              <div class="tour-action"><span><i class="fa-light fa-clock"></i>1-Night</span> <a href="https://wa.me/8489796139/?text=I%20Need%20<?php echo $stay_name; ?>%20in%20Pondicherry%20" class="th-btn style4 th-icon">Book Now</a></div>
                           </div>
                        </div>
                     </div>
                     <?php
                     }
                     ?>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <?php include('footer.php'); ?>
      
      <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
      <script src="assets/js/swiper-bundle.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>
      <script src="assets/js/jquery.magnific-popup.min.js"></script>
      <script src="assets/js/jquery.counterup.min.js"></script>
      <script src="assets/js/jquery-ui.min.js"></script>
      <script src="assets/js/imagesloaded.pkgd.min.js"></script>
      <script src="assets/js/isotope.pkgd.min.js"></script>
      <script src="assets/js/gsap.min.js"></script>
      <script src="assets/js/circle-progress.js"></script>
      <script src="assets/js/matter.min.js"></script>
      <script src="assets/js/matterjs-custom.js"></script>
      <script src="assets/js/nice-select.min.js"></script>
      <script src="assets/js/main.js"></script>
   </body>
</html>