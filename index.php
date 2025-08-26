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
      <link rel="stylesheet" type="text/css" href="assets/vendor/flatpickr/flatpickr.min.css">
      <link rel="stylesheet" href="assets/css/fontawesome.min.css">
      <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
      <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
      <link rel="stylesheet" href="assets/css/style.css">
      <style type="text/css">
         .menu-area
         {
             border-bottom: unset;
         }
         .date-input::placeholder {
           color: black;
           opacity: 1;
         }
         
         .offer-img{
            max-width: 75% !important;
         }
        .space-extra2 {
            padding-top: calc(var(--section-space) - -40px);
            padding-bottom: calc(var(--section-space) - -80px);
         }
         .offer-img1{
            max-width: 45% !important;
         }
         .app-mockup{
            right: 5rem;
         }
         @media (max-width: 480px) {
            .app-mockup{
               right: 2rem;
            }
            .offer-img1{
               max-width: none !important;
            }
         }
      </style>
   </head>
   <body>
      <?php include('header.php'); ?>
      <?php include('offer-model.php'); ?>
      <div class="container menu-mobile d-none mt-3">
         <div class="row">
            <div class="col-4 col-md-4 col-sm-4 text-center">
               <a href="the-best-boating-adventure-rides-in-pondicherry"><img class="h100" src="assets/img/menu/1.png"></a>
            </div>
            <div class="col-4 col-md-4 col-sm-4 text-center">
               <a href="best-sea-view-hotels-in-pondicherry"><img class="h100" src="assets/img/menu/2.png"></a>
            </div>
            <div class="col-4 col-md-4 col-sm-4 text-center">
               <a href="the-best-tour-packages-in-pondicherry"><img class="h100" src="assets/img/menu/3.png"></a>
            </div>
            <div class="col-4 col-md-4 col-sm-4 text-center mt-3">
               <a href="the-best-boating-adventure-rides-in-pondicherry"><img class="h100" src="assets/img/menu/4.png"></a>
            </div>
            <div class="col-4 col-md-4 col-sm-4 text-center mt-3">
               <a href="the-best-pondicherry-tourism-service"><img class="h100" src="assets/img/menu/5.png"></a>
            </div>
            <div class="col-4 col-md-4 col-sm-4 text-center mt-3">
               <a href="the-best-tourist-place"><img class="h100" src="assets/img/menu/6.png"></a>
            </div>
         </div>
      </div>
      <div class="booking-sec">
         <div class="container">
            <form action="best-mangrove-forest-boating-pondicherry_form" method="POST" class="booking-form">
               <div class="input-wrap">
                  <div class="row align-items-center justify-content-between">
                     <div class="form-group col-md-6 col-lg-auto">
                        <div class="icon"><i class="fa-light fa-route"></i></div>
                        <div class="search-input">
                           <label>Tour Categories</label> 
                           <select name="mc_name" id="mc_name" class="form-select nice-select" required>
                              <option value="" selected="selected" disabled="disabled">Select Category</option>
                              <?php
                              $mc_query = "SELECT * FROM tb_main_catagory WHERE status != 1 and mc_id !=2 and mc_id !=4 ";
                              $mc_rec = mysqli_query($conn, $mc_query);
                              while($mc_row = mysqli_fetch_object($mc_rec))
                              {
                              $mc_id =$mc_row->mc_id;
                              $mc_name =ucwords(strtolower($mc_row->mc_name));
                              ?>
                              <option value="<?php echo $mc_id; ?>"><?php echo $mc_name; ?></option>
                              <?php
                              }
                              ?>
                           </select>
                        </div>
                     </div>
                     <div class="form-group col-md-6 col-lg-auto">
                        <div class="icon"><i class="fa-regular fa-person-hiking"></i></div>
                        <div class="search-input">
                           <label>Activities / Packages</label> 
                           <select class="nice-select" name="activities" id="activities" required>
                              <option value="" selected="selected" disabled="disabled">Explore Activities</option>
                           </select>
                        </div>
                     </div>
                     <div class="form-group col-md-6 col-lg-auto">
                        <div class="icon"><i class="fa-light fa-clock"></i></div>
                        <div class="search-input" >
                           <label>Activity / Event Date</label> 
                           <input type="date" name="act_date"  id="min-max" value="" class="date-input" placeholder="dd/mm/yyyy" required readonly>
                        </div>
                     </div>
                     <div class="form-group col-md-6 col-lg-auto">
                        <div class="icon"><i class="fa-light fa-users"></i></div>
                        <div class="search-input">
                           <label>No of Persons</label> 
                           <select name="person" id="category" class="form-select nice-select" required>
                              <option value="" selected="" disabled="disabled">Select Persons</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6</option>
                              <option value="7">7</option>
                              <option value="8">8</option>
                              <option value="9">9</option>
                              <option value="10">10</option>
                              <option value="11">11</option>
                              <option value="12">12</option>
                              <option value="13">13</option>
                              <option value="14">14</option>
                              <option value="15">15</option>
                           </select>
                        </div>
                     </div>
                     <div class="form-btn col-md-12 col-lg-auto"><button class="th-btn" type="submit"><img src="assets/img/icon/search.svg" alt="">Search</button></div>
                  </div>
                  <p class="form-messages mb-0 mt-3"></p>
               </div>
            </form>
         </div>
      </div>
      <section class="category-area bg-top-center" data-bg-src="assets/img/bg/category_bg_1.png">
         <div class="container th-container">
            <div class="title-area text-center">
               <span class="sub-title">Pondicherry’s Ultimate Boating Adventure</span>
               <h2 class="sec-title">Top Adventures</h2>
            </div>
            <div class="swiper th-slider has-shadow categorySlider" id="categorySlider1" data-bg-src="assets/img/bg/category_bg_1.png" data-slider-options='{"spaceBetween": "50","breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"5"},"1200":{"slidesPerView":"5"},"1400":{"slidesPerView":"5"}}}'>
               <div class="swiper-wrapper">
                 
                  <?php
                  $activity_query = "SELECT * FROM tb_activities WHERE status != 1 AND mc_id = 1 AND activity_id != 3 AND activity_id != 4 AND activity_id != 5 ORDER BY activity_id ASC";
                  $activity_rec = mysqli_query($conn, $activity_query);
                  while($activity_row = mysqli_fetch_object($activity_rec))
                  {
                  $activity_id =$activity_row->activity_id;
                  $activity_image1 =$activity_row->activity_image1;
                  $activity_name =ucwords(strtolower($activity_row->activity_name));
                  if($activity_name == 'Mangrove Kayaking - 2 Seater - 30 Mins')
                  {
                     $activity_name = 'Mangrove Kayaking';
                  }
                  $run_status =$activity_row->run_status;
                  if($run_status == 'inactive')
                  {
                     $link = 'tel:+918489796139';
                  }
                  else
                  {
                     $link = "best-mangrove-forest-boating-pondicherry?id=".base64_encode($activity_id);
                  }
                  ?>
                  <div class="swiper-slide">
                     <div class="category-card single">
                        <div class="box-img global-img"><img src="dynamic-images/catagory/<?php echo $activity_image1; ?>" alt="Image"></div>
                        <h3 class="box-title"><a href="<?php echo $link; ?>"><?php echo $activity_name; ?></a></h3>
                        <a class="line-btn" href="<?php echo $link; ?>">Book Now</a>
                     </div>
                  </div>
                  <?php
                  }
                  ?>

               </div>
               <div class="slider-pagination"></div>
            </div>
         </div>
      </section>
      <div class="position-relative overflow-hidden">
         <div class="container">
            <div class="title-area text-center">
               <span class="sub-title">Best Offer For You</span>
               <h2 class="sec-title">Popular Packages</h2>
            </div>
            <div class="swiper th-slider destination-slider slider-drag-wrap" id="aboutSlider1" data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"3"}},"effect":"coverflow","coverflowEffect":{"rotate":"0","stretch":"95","depth":"212","modifier":"1"},"centeredSlides":"true"}'>
               <div class="swiper-wrapper">
                  <div class="swiper-slide">
                     <div class="destination-box gsap-cursor">
                        <div class="destination-img">
                           <img src="dynamic-images/catagory/package1.jpg" alt="destination image">
                           <div class="destination-content">
                              <div class="media-left">
                                 <h4 class="box-title"><a href="best-one-day-tour-packages-pondicherry?id=<?php echo base64_encode(15) ?>">Eco Tourism Package</a></h4>
                                 <span class="destination-subtitle">“Be with fisherman” - 1 Day</span>
                              </div>
                              <div class=""><a href="best-one-day-tour-packages-pondicherry?id=<?php echo base64_encode(15) ?>" class="th-btn style6 th-icon">Book Now</a></div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="swiper-slide">
                     <div class="destination-box gsap-cursor">
                        <div class="destination-img">
                           <img src="dynamic-images/catagory/package2.jpg" alt="destination image">
                           <div class="destination-content">
                              <div class="media-left">
                                 <h4 class="box-title"><a href="best-one-day-tour-packages-pondicherry?id=<?php echo base64_encode(16) ?>">Eco Tourism Package</a></h4>
                                 <span class="destination-subtitle">“Village Chronicles” - 2 days</span>
                              </div>
                              <div class=""><a href="best-one-day-tour-packages-pondicherry?id=<?php echo base64_encode(16) ?>" class="th-btn style6 th-icon">Book Now</a></div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="swiper-slide">
                     <div class="destination-box gsap-cursor">
                        <div class="destination-img">
                           <img src="dynamic-images/catagory/package3.jpg" alt="destination image">
                           <div class="destination-content">
                              <div class="media-left">
                                 <h4 class="box-title"><a href="best-one-day-tour-packages-pondicherry?id=<?php echo base64_encode(17) ?>">3 in 1 Activity - 3 Hrs</a></h4>
                                 <span class="destination-subtitle">Water Bicycle, Kayaking & Boating</span>
                              </div>
                              <div class=""><a href="best-one-day-tour-packages-pondicherry?id=<?php echo base64_encode(17) ?>" class="th-btn style6 th-icon">Book Now</a></div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="swiper-slide">
                     <div class="destination-box gsap-cursor">
                        <div class="destination-img">
                           <img src="dynamic-images/catagory/package4.jpg" alt="destination image">
                           <div class="destination-content">
                              <div class="media-left">
                                 <h4 class="box-title"><a href="best-one-day-tour-packages-pondicherry?id=<?php echo base64_encode(18) ?>">Explore Pondicherry</a></h4>
                                 <span class="destination-subtitle">3 Days - 15 Places</span>
                              </div>
                              <div class=""><a href="best-one-day-tour-packages-pondicherry?id=<?php echo base64_encode(18) ?>" class="th-btn style2 th-icon">Book Now</a></div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="swiper-slide">
                     <div class="destination-box gsap-cursor">
                        <div class="destination-img">
                           <img src="dynamic-images/catagory/package5.jpg" alt="destination image">
                           <div class="destination-content">
                              <div class="media-left">
                                 <h4 class="box-title"><a href="best-one-day-tour-packages-pondicherry?id=<?php echo base64_encode(19) ?>">Couples Package</a></h4>
                                 <span class="destination-subtitle">2 Days - 10 Places</span>
                              </div>
                              <div class=""><a href="best-one-day-tour-packages-pondicherry?id=<?php echo base64_encode(19) ?>" class="th-btn style2 th-icon">Book Now</a></div>
                           </div>
                        </div>
                     </div>
                  </div>
                  
               </div>
            </div>
         </div>
      </div>
      
      <section class="tour-area position-relative bg-top-center overflow-hidden space mt-5 py-5" id="service-sec" data-bg-src="assets/img/bg/tour_bg_1.jpg">
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
               <div class="swiper th-slider has-shadow slider-drag-wrap" data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"},"1300":{"slidesPerView":"4"}}}'>
                  <div class="swiper-wrapper">
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
                     <div class="swiper-slide">
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
       <div class="space-extra2 position-relative overflow-hidden">
        <div class="cta-sec5 bg-title" data-bg-src="assets/img/bg/cta_bg_2.jpg">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-7">
                        <div class="space">
                            <div class="title-area mb-40"><span class="sub-title style1 text-white">This Summer
                                    Offer</span>
                                <h2 class="sec-title cta-title text-white">Get 30% Off</h2>
                                <h2 class="sec-title text-white">Next trip</h2>
                                <p class="text-white">Travel from Aug 25 to Nov 28 for exciting offers and guaranteed
                                    rewards.</p>
                            </div>
                            <div class="btn-group">
                              <a href="offers.php" class="th-btn style6 th-icon">Explore Offers</a>
                           </div>
                           </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="app-mockup movingX">
                           <img src="assets/img/normal/app_mockup.png" alt="app mockup" class="offer-img1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="shape-mockup d-none d-xxl-block" data-bottom="0%" data-right="-8%">
               <img src="assets/img/normal/about-slide-img3.png" alt="" class="offer-img"></div>
        </div>
    </div>
      <div class="gallery-area">
         <div class="container th-container">
            <div class="title-area text-center">
               <span class="sub-title">Make Your Tour More Pleasure</span>
               <h2 class="sec-title">Explore Pondicherry</h2>
            </div>
            <div class="row gy-10 gx-10 justify-content-center align-items-center">
               <div class="col-md-6 col-lg-2">
                  <div class="gallery-card">
                     <div class="box-img global-img">
                        <a href="the-best-tourist-place">
                           <img src="assets/img/gallery/1.jpg" alt="gallery image">
                        </a>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-2">
                  <div class="gallery-card">
                     <div class="box-img global-img">
                        <a href="the-best-tourist-place">
                           <img src="assets/img/gallery/3.jpg" alt="gallery image">
                        </a>
                     </div>
                  </div>
                  <div class="gallery-card">
                     <div class="box-img global-img">
                        <a href="the-best-tourist-place">
                           <img src="assets/img/gallery/4.jpg" alt="gallery image">
                        </a>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-2">
                  <div class="gallery-card">
                     <div class="box-img global-img">
                        <a href="the-best-tourist-place">
                           <img src="assets/img/gallery/7.jpg" alt="gallery image">
                        </a>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-2">
                  <div class="gallery-card">
                     <div class="box-img global-img">
                        <a href="the-best-tourist-place">
                           <img src="assets/img/gallery/5.jpg" alt="gallery image">
                        </a>
                     </div>
                  </div>
                  <div class="gallery-card">
                     <div class="box-img global-img">
                        <a href="the-best-tourist-place">
                           <img src="assets/img/gallery/6.jpg" alt="gallery image">
                        </a>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-lg-2">
                  <div class="gallery-card">
                     <div class="box-img global-img">
                        <a href="the-best-tourist-place">
                           <img src="assets/img/gallery/2.jpg" alt="gallery image">
                        </a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="shape-mockup d-none d-xl-block" data-top="-25%" data-left="0%"><img src="assets/img/shape/line.png" alt="shape"></div>
            <div class="shape-mockup movingX d-none d-xl-block" data-top="30%" data-left="-3%"><img class="gmovingX" src="assets/img/shape/shape_4.png" alt="shape"></div>
         </div>
      </div>
     
      <?php include('footer.php'); ?>
      
     <script src="assets/js/jquery.min.js"></script>
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
      <script src="assets/vendor/flat-pickr/flatpickr.js"></script>
      <script type="text/javascript">
        $("#mc_name").change(function (e) {
          var mc_id = $(this).val();
          $('#activities').empty();
          $.ajax({
                  url: "ajax/get_activity.php",
                  type: "POST",
                   data:{"mc_id":mc_id},
                  success: function (data) {
                    $('#activities').append(data);
                    $('#activities').niceSelect('destroy'); //destroy the plugin 
                    $('#activities').niceSelect(); //apply again
                }
              })
        });
      </script>
      <script type="text/javascript">
         $("#activities").change(function (e) {
          var mc_id = $('#mc_name').val();
          var activities_id = $(this).val();
          $('#min-max').empty();
          $.ajax({
                  url: "ajax/get_acdate.php",
                  type: "POST",
                   data:{"activities_id":activities_id, "mc_id":mc_id },
                   dataType: 'json',
                      success: function(response) {
                          flatpickr("#min-max", {
                              dateFormat: "d/m/Y",
                              disable: response,    
                              minDate: "today"
                          });
                            $('#min-max').removeAttr("readonly");
                      },
                      error: function(xhr, status, error) {
                          console.error("AJAX Error:", error);
                      }
         
                    });
           });
      </script>
     
   </body>
</html>