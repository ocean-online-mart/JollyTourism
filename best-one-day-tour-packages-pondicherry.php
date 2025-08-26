<?php
error_reporting(0);
include("store_db_con.php");
$conn = dbconnect();
$act_id = base64_decode($_GET['id']);
$act_date = base64_decode($_GET['act_date']);

$activity_query = "SELECT * FROM tb_activities WHERE status != 1 AND activity_id= '$act_id'";
$activity_rec = mysqli_query($conn, $activity_query);
$activity_row = mysqli_fetch_object($activity_rec);
$activity_id =$activity_row->activity_id;
$mc_id =$activity_row->mc_id;
$activity_image1 =$activity_row->activity_image1;
$activity_image2 =$activity_row->activity_image2;
$activity_image3 =$activity_row->activity_image3;
$activity_image4 =$activity_row->activity_image4;
$activity_image5 =$activity_row->activity_image5;
$short_description =$activity_row->short_description;
$duration =$activity_row->duration;
$amount =$activity_row->amount;
$person =$activity_row->person;
$run_status =$activity_row->run_status;
$seater =$activity_row->seater;
$specialily =$activity_row->specialily;
$header1 =$activity_row->header1;
$description1 =$activity_row->description1;
$header2 =$activity_row->header2;
$description2 =$activity_row->description2;
$content_listing =$activity_row->content_listing;
$crm_id =$activity_row->crm_id;
$status =$activity_row->status;
$activity_name =ucwords(strtolower($activity_row->activity_name));

if($act_date != '')
{
$timestamp = strtotime(str_replace('/', '-', $act_date));
$formatted_actdate = date('Y-m-d', $timestamp);
$activityd_query = "SELECT * FROM tb_activitiy_date WHERE status != 1 AND act_id= '$act_id' AND mc_id= '$mc_id' AND act_date= '$formatted_actdate'";
$activityd_rec = mysqli_query($conn, $activityd_query);
$activityd_row = mysqli_fetch_object($activityd_rec);
$act_dateid =$activityd_row->act_dateid;
}
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
         .widget .form-group label {
                padding-left: 0px;
         }
         .input-wrap .form-group
         {
            border-left: none;
            padding-left: 0px;
            margin-left: 0px;
            margin-bottom: 25px;
         }
         .input-wrap .form-group .icon
         {
           width: 30px;
         }
         .input-wrap .form-group:not(:first-child)
         {
            border-left: none;
            padding-left: 0px;
            margin-left: 0px;
         }
         .input-wrap .form-group .nice-select
         {
            font-size: 14px;
         }
         .input-wrap .form-group .icon i
         {
                font-size: 28px;
         }
         .nice-select .option {
                line-height: 30px;
                    min-height: 30px;
         }
         .space, .space-bottom
         {
            padding-bottom: 10px;
         }
         .date-input::placeholder {
           color: black !important;
           opacity: 1;
         }
      </style>
   </head>
   <body>
    
      <!-- <div id="preloader" class="preloader">
         <button class="btn btn-primary  preloaderCls">Cancel Preloader</button>
         <div class="preloader-inner"><img src="assets/img/logo/logo.png" alt=""></div>
      </div> -->
      <?php include('header.php'); ?>
      <section class="space">
         <div class="container">
            <div class="row">
               <div class="col-lg-8">
                  <div class="tour-page-single">
                     <h2 class="box-title"><?php echo $activity_name; ?></h2>
                     <p><?php echo $short_description; ?></p>
                     <div class="slider-area tour-slider1 row">
                        <div class="col-md-9 swiper th-slider mb-4" id="tourSlider4" data-slider-options='{"effect":"fade","loop":true,"thumbs":{"swiper":".tour-thumb-slider"},"autoplayDisableOnInteraction":"true"}'>
                           <div class="swiper-wrapper">
                              <div class="swiper-slide">
                                 <div class="tour-slider-img"><img src="dynamic-images/activity/<?php echo $activity_image3; ?>" alt="img"></div>
                              </div>
                              <div class="swiper-slide">
                                 <div class="tour-slider-img"><img src="dynamic-images/activity/<?php echo $activity_image2; ?>" alt="img"></div>
                              </div>
                              <div class="swiper-slide">
                                 <div class="tour-slider-img"><img src="dynamic-images/activity/<?php echo $activity_image4; ?>" alt="img"></div>
                              </div>
                              <div class="swiper-slide">
                                 <div class="tour-slider-img"><img src="dynamic-images/activity/<?php echo $activity_image5; ?>" alt="img"></div>
                              </div>
                              
                           </div>
                        </div>
                        <div class="col-md-3 swiper th-slider tour-thumb-slider d-none d-md-block" data-slider-options='{  "direction": "vertical","slidesPerView": 3,"effect":"slide","loop":true,"breakpoints":{"0":{"slidesPerView":2},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"3"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"3"}},"autoplayDisableOnInteraction":"true"}'  style="height: 420px;padding-left: 20px;">
                           <div class="swiper-wrapper row">
                              <div class="swiper-slide">
                                 <div class="tour-slider-img"><img src="dynamic-images/activity/<?php echo $activity_image3; ?>" alt="Image"></div>
                              </div>
                              <div class="swiper-slide">
                                 <div class="tour-slider-img"><img src="dynamic-images/activity/<?php echo $activity_image2; ?>" alt="Image"></div>
                              </div>
                              <div class="swiper-slide">
                                 <div class="tour-slider-img"><img src="dynamic-images/activity/<?php echo $activity_image4; ?>" alt="Image"></div>
                              </div>
                              <div class="swiper-slide">
                                 <div class="tour-slider-img"><img src="dynamic-images/activity/<?php echo $activity_image5; ?>" alt="Image"></div>
                              </div>
                           </div>
                        </div>
                        <button data-slider-prev="#tourSlider4" class="slider-arrow style3 slider-prev"><img src="assets/img/icon/hero-arrow-left.svg" alt=""></button> <button data-slider-next="#tourSlider4" class="slider-arrow style3 slider-next"><img src="assets/img/icon/hero-arrow-right.svg" alt=""></button>
                     </div>
                     <div class="page-content">
                       
                        <div class="tour-snapshot mt-4">
                           <div class="tour-snap-wrapp">
                              <div class="tour-snap">
                                 <div class="icon"><i class="fa-light fa-clock"></i></div>
                                 <div class="content"><span class="title">Duration</span> <span><?php echo $duration; ?></span></div>
                              </div>
                              <div class="tour-snap">
                                 <div class="icon"><img src="assets/img/icon/guide2.svg" alt=""></div>
                                 <div class="content"><span class="title"><?php echo $person; ?></span> <span>₹<?php echo $amount; ?></span></div>
                              </div>
                              <div class="tour-snap">
                                 <div class="icon"><img src="assets/img/icon/ship.svg" alt=""></div>
                                 <div class="content"><span class="title">Guide</span> <span><?php echo $seater; ?></span></div>
                              </div>
                              <div class="tour-snap">
                                 <div class="icon"><img src="assets/img/icon/01.svg" alt=""></div>
                                 <div class="content"><span class="title">Free Cancellation</span> <a href="#" class="line-btn">Learn more</a></div>
                              </div>
                           </div>
                        </div>
                        
                     </div>
                
                  </div>
               </div>
               <div class="col-lg-4">
               
                     <div class="widget tour-booking">
                        <h5>Let's make a reservation now!</h5>
                       
                        <form action="booking-act" method="POST" class="booking-form">
                           <div class="input-wrap">
                              <div class="row align-items-center justify-content-between">
                                 
                                 <div class="form-group col-md-12">
                                    <div class="icon"><i class="fa-light fa-calendar-check"></i></div>
                                    <div class="search-input">
                                       <label>Choose Date</label> 
                                       <input type="date" name="act_date"  id="min-max" value="" class="date-input" placeholder="dd/mm/yyyy" required readonly>
                                       <input type="hidden" name="act_id" value="<?php echo $act_id; ?>">
                                       <input type="hidden" name="mc_id" value="<?php echo $mc_id; ?>">
                                    </div>
                                 </div>
                                 <div class="form-group col-md-12">
                                    <div class="icon"><i class="fa-light fa-clock"></i></div>
                                    <div class="search-input">
                                       <label>Choose Slot</label> 
                                       <select name="slot" id="slot" class="form-select nice-select" required>
                                          <option value="" selected="selected" disabled="disabled">Select </option>
                                          <?php
                                          $time = date('H:i');
                                          $today = date('Y-m-d');
                                          if($formatted_actdate == $today)
                                          {
                                             $date_compare = "AND slot_time >= '$time'";
                                          }
                                          $slot_query = "SELECT * FROM tb_activity_slot WHERE status != 1 and total_availability !=0 and actdate_id ='$act_dateid' {$date_compare} ";
                                          $slot_rec = mysqli_query($conn, $slot_query);
                                          while($slot_row = mysqli_fetch_object($slot_rec))
                                          {
                                          $slot_id =$slot_row->slot_id;
                                          $slot_name =$slot_row->slot_name;
                                          ?>
                                          <option value="<?php echo $slot_id; ?>"><?php echo $slot_name; ?></option>
                                          <?php
                                          }
                                          ?>
                                          
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group col-md-12">
                                    <div class="icon"><i class="fa-light fa-male"></i></div>
                                    <div class="search-input">
                                       <label>No of Adult (Above aged 11)</label> 
                                       <select name="adult" id="adult" class="form-select nice-select" required>
                                          <option value="" selected="selected" disabled="disabled">Select </option>
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
                                 <div class="form-group col-md-12">
                                    <div class="icon"><i class="fa-light fa-child"></i></div>
                                    <div class="search-input">
                                       <label>No of Children (Above aged 6–10)</label> 
                                       <select name="children" id="children" class="form-select nice-select">
                                          <option value="0" selected="selected">0 </option>
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
                                       </select>
                                    </div>
                                 </div>
                                <button type="submit" class="th-btn th-icon">Book Now</button> 
                              </div>
                              <p class="form-messages mb-0 mt-3"></p>
                           </div>
                        </form>
                        <span class="review mt-3"><i class="fa-light fa-heart"></i> Children aged 0–5 can join for free, and those aged 6–10 are eligible for half-price tickets.</span>
                     </div>
                    
               </div>
               <div class="col-lg-12">
                  <h2 class="box-title"><?php echo $header1; ?></h2>
                        <p class="box-text mb-50"><?php echo $description1; ?></p>
                        <h2 class="box-title"><?php echo $header2; ?></h2>
                        <p class="box-text mb-30"><?php echo $description2; ?></p>
                        <div class="checklist mb-50">
                           <ul>
                              <?php
                              $list = explode(', ', $content_listing);
                              foreach($list as $list_value) 
                              {
                              ?>
                              <li><?php echo $list_value; ?></li>
                              <?php
                              }
                              ?>
                           </ul>
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
      <script src="assets/vendor/flat-pickr/flatpickr.js"></script>
      <script type="text/javascript">
         $(document).ready(function() {
          var mc_id = '<?php echo $mc_id ?>';
          var activities_id = '<?php echo $activity_id ?>';
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
                              defaultDate: ["<?php echo $act_date ?>"],
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
      <script type="text/javascript">
         $("#min-max").change(function (e) {
          var act_da = $(this).val();
          var mc_id = '<?php echo $mc_id ?>';
          var activities_id = '<?php echo $activity_id ?>';
          $('#slot').empty();
          $.ajax({
                  url: "ajax/get_acslot.php",
                  type: "POST",
                   data:{"act_da":act_da, "activities_id":activities_id, "mc_id":mc_id},
                      success: function(data) {
                          $('#slot').append(data);
                          $('#slot').niceSelect('destroy'); //destroy the plugin 
                          $('#slot').niceSelect(); //apply again
                      },
                      error: function(xhr, status, error) {
                          console.error("AJAX Error:", error);
                      }
         
                    });
           });
      </script>
   </body>
</html>