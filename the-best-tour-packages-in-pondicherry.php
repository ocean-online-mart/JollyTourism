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
      <div class="position-relative overflow-hidden mt-4">
         <div class="container">
            <div class="row">
               <div class="col-lg-6 offset-lg-3">
                  <div class="title-area text-center">
                     <span class="sub-title">Make Your Tour More Pleasure</span>
                     <h2 class="sec-title">Popular Packages</h2>
                     <p class="sec-text">Discover the magic of Pondicherry with Jolly Tourism’s most loved tour packages—crafted for unforgettable moments and endless exploration!</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <section class="my-1">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="row gy-24 gx-24">
                     <?php
                        $activity_query = "SELECT * FROM tb_activities WHERE status != 1 AND mc_id = 3 ORDER BY activity_id ASC";
                        $activity_rec = mysqli_query($conn, $activity_query);
                        while($activity_row = mysqli_fetch_object($activity_rec))
                        {
                        $activity_id =$activity_row->activity_id;
                        $activity_image2 =$activity_row->activity_image1;
                        $short_description =$activity_row->short_description;
                        $activity_name =ucwords(strtolower($activity_row->activity_name));
                        $amount =$activity_row->amount;
                        $person =$activity_row->person;
                        $duration =$activity_row->duration;
                        $run_status =$activity_row->run_status;
                        $seater =$activity_row->seater;
                        $specialily =$activity_row->specialily;
                            if($run_status == 'inactive')
                           {
                              $link = 'tel:+918489796139';
                              $link1 = 'tel:+918489796139';
                           }
                           else
                           {
                              $link = "best-mangrove-forest-boating-pondicherry?id=".base64_encode($activity_id);
                              $link1 = "booking-confirmation?id=".base64_encode($activity_id);
                           }
                        ?>
                     <div class="col-md-4">
                        <div class="tour-box th-ani">
                           <div class="tour-box_img global-img"><img src="dynamic-images/catagory/<?php echo $activity_image2; ?>" alt="image"></div>
                           <div class="tour-content">
                              <h3 class="box-title"><a href="best-one-day-tour-packages-pondicherry?id=<?php echo base64_encode($activity_id); ?>"><?php echo $activity_name; ?></a></h3>
                              <p class="line-2"><?php echo $short_description; ?></p>
                              <div class="widget widget_categories">
                                 <ul>
                                     <?php
                                       $parts = explode(', ', $specialily);
                                       foreach ($parts as $part) {
                                        // Trim spaces and split by hyphen
                                        $pair = explode('-', trim($part), 2);

                                        // Ensure both parts exist
                                        if (count($pair) == 2) {
                                            $label = trim($pair[0]);
                                            $detail = trim($pair[1]);

                                       ?>
                                    <li><a href="#"><?php echo $label; ?></a> <span><?php echo $detail; ?></span></li>
                                    <?php
                                    }
                                 }
                                    ?>
                                 </ul>
                              </div>
                              <h4 class="tour-box_price"><span class="currency">₹<?php echo $amount; ?></span>/ <?php echo $person; ?></h4>
                              <div class="tour-action"><span><i class="fa-light fa-clock"></i><?php echo $duration; ?></span> <a href="<?php echo $link1; ?>" class="th-btn style1">Book Now</a></div>
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