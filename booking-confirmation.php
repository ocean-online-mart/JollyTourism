<?php
error_reporting(1);
include("store_db_con.php");
$conn = dbconnect();
$act_id = base64_decode($_GET['id']);
$act_date = base64_decode($_GET['act_date']);
$adult = base64_decode($_GET['adult']);
$children = base64_decode($_GET['children']);
$slot = base64_decode($_GET['slot']);


if($children == '')
{
   $children = 0;
}

if($act_id !='')
{
$activity_query = "SELECT * FROM tb_activities WHERE status != 1 AND activity_id= '$act_id'";
$activity_rec = mysqli_query($conn, $activity_query);
$activity_row = mysqli_fetch_object($activity_rec);
$activity_id =$activity_row->activity_id;
$mc_id =$activity_row->mc_id;
$activity_name =ucwords(strtolower($activity_row->activity_name));
$act_amount =$activity_row->amount;

if($act_date != '')
{
$timestamp = strtotime(str_replace('/', '-', $act_date));
$formatted_actdate = date('Y-m-d', $timestamp);
$activityd_query = "SELECT * FROM tb_activitiy_date WHERE status != 1 AND act_id= '$act_id' AND mc_id= '$mc_id' AND act_date= '$formatted_actdate'";
$activityd_rec = mysqli_query($conn, $activityd_query);
$activityd_row = mysqli_fetch_object($activityd_rec);
$act_dateid =$activityd_row->act_dateid;
$actdate = date('d M Y', strtotime($formatted_actdate));
}
$slot_querys = "SELECT * FROM tb_activity_slot WHERE slot_id ='$slot'";
$slot_recs = mysqli_query($conn, $slot_querys);
$slot_rows = mysqli_fetch_object($slot_recs);
$slot_names =$slot_rows->slot_name;
}



if($adult !='')
{
$child_amount = $act_amount/2;
$a_total = $act_amount * $adult;
$c_total = $child_amount * $children;
if($activity_id == 11)
{
   $total = $act_amount; 
}
else
{
   $total = $a_total + $c_total;
}
$p_charge = $total*2/100;
$f_total = $total + $p_charge;
}
else
{
   $actdate = '-';
   $adult = 0;
   $children = 0;
   $c_total = 0;
   $total = 0;
   $p_charge = 0;
   $f_total = 0;
}

if($activity_id == 8)
{
   $couple_label = 'No of Couples';
   $inactive = 'disabled';
   $gender = 'Couples';
}
else
{
   $couple_label = 'No of Adult (Above aged 11)';
   $inactive = '';
   $gender = 'Adult';
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
         .coupon-message {
            color: #0c36d7;
            font-size: 14px;
              
        }
        .coupon-error {
            color: red;
            font-size: 14px;
          
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
            <form action="booking.php" method="POST" class="booking-form">
            <div class="row">
               <div class="col-lg-8">
                  <div class="tour-page-single">
                     <h2 class="box-title">Booking Confimation</h2>
                     <form action="#" class="woocommerce-cart-form">
                        <table class="cart_table mb-20">
                           <thead>
                              <tr>
                                 <th class="cart-col-image">Activity Details</th>
                                 <th class="cart-col-price">Booking Slot</th>
                                 <th class="cart-col-total">Ticket</th>
                                 <th class="cart-col-quantity">No of Person</th>
                                 <th class="cart-col-total">Total</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr class="cart_item">
                                
                                 <td data-title="Activity"><a class="cart-productname" href="#"><?php echo $activity_name ?></a></td>
                                 <td data-title="Slot"><span class="amount" id="ac_date"><?php echo $actdate; ?></span> <br> <span class="amount" id="ac_slot"><?php echo $slot_names; ?></span></td>
                                 <td data-title="Ticket"><strong>₹<span class="amount" id="ac_amount"><?php echo $act_amount ?></span></strong></td>
                                 <td data-title="Person"><span class="amount" id="ac_adult"><?php echo $adult ?> <?php echo $gender ?> </span> <span class="amount" id="ac_child"><?php echo $children ?> Children</span></td>
                                 <td data-title="Total">₹<span class="amount" id="ac_total"><?php echo $total; ?></span></td>
                              </tr>
                           </tbody>
                           <tfoot class="checkout-ordertable">
                              <tr class="cart-subtotal">
                                 <th>Subtotal</th>
                                 <td data-title="Subtotal" colspan="5">₹<span class="amount" id="ac_subtotal"><?php echo $total; ?></span></td>
                              </tr>
                               <tr class="">
                                 <th>Coupen Code discount</th>
                                 <td data-title="Coupen Code discount" colspan="5">- ₹<span class="amount" id="ac_coup_dis">0</span></td>
                              </tr>
                              <tr class="woocommerce-shipping-totals shipping">
                                 <th>Platform Charges (2%)</th>
                                 <td data-title="Platform Charges" colspan="5">₹<span class="amount" id="ac_charges"><?php echo $p_charge; ?></span></td>
                              </tr>
                              <tr class="order-total">
                                 <th>Total Amount</th>
                                 <td data-title="Payable Amount" colspan="5"><span style="color:#01db24;">₹</span><span class="amount" id="ac_finaltotal"><?php echo $f_total; ?></span></td>
                              </tr>
                           </tfoot>
                        </table>
                     </form>
                     <div class="row">
                         <div class="col-md-6 form-group"><input type="text" class="form-control" placeholder="Enter Your Name" name="cus_name" required></div>
                        <div class="col-md-6 form-group"><input type="text" class="form-control" placeholder="Phone number" name="phone_no" required></div>
                        <div class="col-md-6 form-group"><input type="email" class="form-control" placeholder="Email Address" name="email_id" required> </div>
                        <div class="col-md-6 form-group"><input type="text" class="form-control" placeholder="Where your are Located?" name="location" required> </div>
                    </div>
                  </div>
               </div>
               <div class="col-lg-4">
               
                     <div class="widget tour-booking">
                        <h5>Let's make a reservation now!</h5> 
                           <div class="input-wrap">
                              <div class="row align-items-center justify-content-between">
                                 
                                 <div class="form-group col-md-12">
                                    <div class="icon"><i class="fa-light fa-calendar-check"></i></div>
                                    <div class="search-input">
                                       <label>Choose Date</label> 
                                       <input type="date" name="act_date"  id="min-max" value="" class="date-input td-change" placeholder="dd/mm/yyyy" required readonly>
                                       <input type="hidden" name="act_id" id="act_id" value="<?php echo $activity_id; ?>">
                                       <input type="hidden" name="mc_id" id="mc_id" value="<?php echo $mc_id; ?>">
                                    </div>
                                 </div>
                                 <div class="form-group col-md-12">
                                    <div class="icon"><i class="fa-light fa-clock"></i></div>
                                    <div class="search-input">
                                       <label>Choose Slot</label> 
                                       <select name="slot" id="slot" class="form-select nice-select td-change" required>
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
                                          <option value="<?php echo $slot_id; ?>" <?php if($slot_id == $slot) { echo 'selected'; } ?>><?php echo $slot_name; ?></option>
                                          <?php
                                          }
                                          ?>
                                          
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group col-md-12">
                                    <div class="icon"><i class="fa-light fa-male"></i></div>
                                    <div class="search-input">
                                       <label><?php echo $couple_label; ?></label> 
                                       <select name="adult" id="adult" class="form-select nice-select td-change" required>
                                          <option value="" selected="selected" disabled="disabled">Select </option>
                                          <option value="1" <?php if($adult == 1) { echo 'selected'; } ?>>1</option>
                                          <option value="2" <?php if($adult == 2) { echo 'selected'; } ?>>2</option>
                                          <option value="3" <?php if($adult == 3) { echo 'selected'; } ?>>3</option>
                                          <option value="4" <?php if($adult == 4) { echo 'selected'; } ?>>4</option>
                                          <option value="5" <?php if($adult == 5) { echo 'selected'; } ?>>5</option>
                                          <option value="6" <?php if($adult == 6) { echo 'selected'; } ?>>6</option>
                                          <option value="7" <?php if($adult == 7) { echo 'selected'; } ?>>7</option>
                                          <option value="8" <?php if($adult == 8) { echo 'selected'; } ?>>8</option>
                                          <option value="9" <?php if($adult == 9) { echo 'selected'; } ?>>9</option>
                                          <option value="10" <?php if($adult == 10) { echo 'selected'; } ?>>10</option>
                                          <?php if($activity_id != 11) {
                                            ?>
                                          <option value="11" <?php if($adult == 11) { echo 'selected'; } ?>>11</option>
                                          <option value="12" <?php if($adult == 12) { echo 'selected'; } ?>>12</option>
                                          <option value="13" <?php if($adult == 13) { echo 'selected'; } ?>>13</option>
                                          <option value="14" <?php if($adult == 14) { echo 'selected'; } ?>>14</option>
                                          <option value="15" <?php if($adult == 15) { echo 'selected'; } ?>>15</option>
                                          <?php
                                          }
                                          ?>
                                       </select>
                                       
                                    </div>
                                 </div>
                                 <div class="form-group col-md-12">
                                    <div class="icon"><i class="fa-light fa-child"></i></div>
                                    <div class="search-input">
                                       <label>No of Children (Above aged 6–10)</label> 
                                       <select name="children" id="children" class="form-select nice-select td-change" <?php echo $inactive; ?>>
                                          <option value="0" selected="selected" >0 </option>
                                          <option value="1" <?php if($children == 1) { echo 'selected'; } ?>>1</option>
                                          <option value="2" <?php if($children == 2) { echo 'selected'; } ?>>2</option>
                                          <option value="3" <?php if($children == 3) { echo 'selected'; } ?>>3</option>
                                          <option value="4" <?php if($children == 4) { echo 'selected'; } ?>>4</option>
                                          <option value="5" <?php if($children == 5) { echo 'selected'; } ?>>5</option>
                                         <?php if($activity_id != 11) {
                                            ?>
                                          <option value="6" <?php if($children == 6) { echo 'selected'; } ?>>6</option>
                                          <option value="7" <?php if($children == 7) { echo 'selected'; } ?>>7</option>
                                          <option value="8" <?php if($children == 8) { echo 'selected'; } ?>>8</option>
                                          <option value="9" <?php if($children == 9) { echo 'selected'; } ?>>9</option>
                                          <option value="10" <?php if($children == 10) { echo 'selected'; } ?>>10</option>
                                        <?php
                                          }
                                          ?>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group col-md-12">
                                     <div class="icon"><i class="fas fa-ticket-alt"></i></div>
                                    <div class="search-input">
                                       <label>Choose Coupon</label>
                                       <select name="coupon_code_select" id="coupon_select" class="form-select nice-select td-change" disabled>
                                          <option value="" selected="selected" disabled="disabled">Select Coupon</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="form-group col-md-12 mb-5">
                                    <div class="icon"><i class="fas fa-ticket-alt"></i></div>
                                     <div class="search-input">
                                      <label>Enter the coupen code (if any...)</label> 
                                       <input type="text" name="coupen_code" id="coupen"  class="coupen_field td-change" placeholder="Enter Coupen code">
                                        <span id="coupon-message" class="coupon-message "></span>
                                          <span id="coupon-error" class="coupon-error"></span>
                                    </div>
                                    <input type="hidden" name="discount_amount" id="dis_amt">
                                 </div> 
                                <button type="submit" class="th-btn th-icon mt-2">Confirm Booking</button> 
                              </div>
                              <p class="form-messages mb-0 mt-3"></p>
                           </div>
                        
                        <span class="review mt-3"><i class="fa-light fa-heart"></i> Children aged 0–5 can join for free, and those aged 6–10 are eligible for half-price tickets.</span>
                     </div>
               </div>
            </div>
            </form>
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
      <script type="text/javascript">
         $(".td-change").change(function (e) {
          var act_da = $('#min-max').val();
          var slot = $('#slot').val();
          var adult = $('#adult').val();
          var children = $('#children').val();
          var mc_id = $('#mc_id').val();
          var act_id = $('#act_id').val();
          var coupon_code = $('#coupen').val();
         //  console.log(act_da);
         //  console.log(slot);
         //  console.log(adult);
         //  console.log(children);
         //  console.log(mc_id);
         //  console.log(act_id);
         //  console.log(coupon_code);
         

          
           $('#coupon-message').text('');
            $('#coupon-error').text('');
          $('.amount').empty();
          $.ajax({
                  url: "ajax/get_booking_data.php",
                  type: "POST",
                  dataType: "json",
                   data:{"act_id":act_id, "mc_id":mc_id, "act_da":act_da, "slot":slot, "adult":adult, "children":children, 
                     "coupon_code": coupon_code
                   },
               
                      success: function(data) {
                          $('#ac_date').text(data.ac_date);
                          $('#ac_slot').text(data.ac_slot);
                          $('#ac_adult').text(data.ac_adult);
                          $('#ac_child').text(data.ac_child);
                          $('#ac_amount').text(data.ac_amount);
                          $('#ac_total').text(data.ac_total);
                          $('#ac_subtotal').text(data.ac_subtotal);
                          $('#ac_charges').text(data.ac_charges);
                          $('#ac_finaltotal').text(data.ac_finaltotal);
                          if (data.ac_coup_dis) {
                             $('#ac_coup_dis').text(data.ac_coup_dis);
                              $('#dis_amt').val(data.ac_coup_dis);
                          }else{
                            $('#ac_coup_dis').text(0);
                          }
                           if(data.coupon_message) {
                              $('#coupon-message').text(data.coupon_message);
                           }
                           // if(data.coupon_error) {
                           //    $('#coupon-error').text(data.coupon_error);
                           // }
                      },
                      error: function(xhr, status, error) {
                          console.error("AJAX Error:", error);
                      }
         
                    });
           });
      </script>
   </body>
</html>

