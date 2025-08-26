<?php
/* Database connection */
error_reporting(0);
include("store_db_con.php");
$conn = dbconnect();
session_start();

// login or not
 if($_SESSION['username'] == '' && $_SESSION['jt_id'] ==''){
 header('location:logout.php');
 die();
}

$username = $_SESSION['username'];
$crm_id = $_SESSION['jt_id'];
$query  = "SELECT * FROM tb_admin WHERE username='".$username."' AND admin_id='".$crm_id."'";
$res_query = mysqli_query($conn,$query);
$fetch = mysqli_fetch_object($res_query);
$username=$fetch->name;
$adminposition = $fetch->position;

if ($adminposition == 1) {
 $type = 'Super Admin';
}
elseif ($adminposition == 2) {
 $type = 'Admin';
}
elseif ($adminposition == 3) {
 $type = 'Booking Admin';
}

 date_default_timezone_set('Asia/Kolkata'); 
 $today_date = date('Y-m-d');
 $today = date('j M Y');
 $time = date('h:i:s A');
 $day = date("l");
 $month = date('F');
 $date = date('jS');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Jolly Tourism - CRM Panel">
    <meta name="author" content="Jollytourism">
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <title>CRM Panel | Jolly Tourism</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@200;300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/slick.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/sweetalert2.css">
  
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link id="color" rel="stylesheet" href="assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
    <link  rel="stylesheet" href="assets/css/validation/tooltip-style.css">
   
  </head>
  <body> 
    <!-- loader starts-->
    <div class="loader-wrapper">
      <div class="loader"> 
        <div class="loader4"></div>
      </div>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      <?php include('static-header.php'); ?>
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <?php include('static-sidebar.php'); ?>
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h4>Direct Booking</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard">                                       
                        <svg class="stroke-icon">
                          <use href="assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">Direct Booking</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row"> 
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <form class="booking-form" id="bookingForm" enctype="multipart/form-data">
                      <input type="hidden" name="type" value="add">
                     <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-firstname-input" class="form-label">Customer Name</label>
                                <input type="text" class="form-control" name="cus_name" id="formrow-firstname-input" placeholder="Enter Customer Name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-Apassword-input" class="form-label">Mobile Number</label>
                                <input type="text" class="form-control" name="phone_no" placeholder="Enter Mobile Number" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrowS-input" class="form-label">Email Id</label>
                                <input type="text" class="form-control" name="email_id" placeholder="Enter Email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-Sinput" class="form-label">Location</label>
                                <input type="text" class="form-control" name="location" placeholder="Enter Location" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mb-3">
                                <label for="formrow-inpSutState" class="form-label">Choose Category</label>
                                <select type="text" id="mc_name" name="mc_id" class="form-control form-select" required>
                                    <option value="" selected="selected" disabled="disabled">Choose Category</option>
                                    <?php
                                      $mc_query = "SELECT * FROM tb_main_catagory WHERE status != 1 and mc_id !=2 and mc_id !=4";
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
                        <div class="col-md-6">
                           <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Choose Activities / Packages</label>
                                <select type="text" class="form-control form-select" name="act_id" id="activities"  required>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mb-3">
                                <label for="formrow-inpautStaate" class="form-label">Activity / Event Date</label>
                                 <input type="date" name="act_date"  id="min-max" value="" class="form-control" placeholder="dd/mm/yyyy" required readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mb-3">
                                <label for="formrow-inpautStaate" class="form-label">Activity / Event Slot</label>
                                 <select name="slot" id="slot" type="text" class="form-control form-select" required>
                                      <option value="" selected="selected" disabled="disabled">Select Slot</option>
                                  </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mb-3">
                                <label for="formrow-inpautStaaate" class="form-label">No of Adult <small>(Above aged 11)</small></label>
                                 <select name="adult" type="text" id="adult" class="form-select form-control td-change" required>
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
                        <div class="col-md-6">
                           <div class="mb-3">
                                <label for="formrow-inpautStaadte" class="form-label">No of Children <small>(Above aged 6–10)</small></label>
                                 <select name="children" type="text" id="children" class="form-select form-control td-change">
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
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-Swinput" class="form-label">Ticket Amount</label>
                                <input type="text" class="form-control" name="adult_amount" id="ac_amount" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-Swinpqut" class="form-label">Total Amount</label>
                                <input type="text" class="form-control" name="total_amount" id="ac_total" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-Swinprut" class="form-label">Discount</label>
                                <input type="text" class="form-control td-change1" id="discount" name="discount" placeholder="Enter Discount" value="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-Swidnput" class="form-label">Payable Amount</label>
                                <input type="text" class="form-control" name="pay_amount" id="ac_subtotal" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="frormrow-Swinprut" class="form-label">Amount Received</label>
                                <input type="text" class="form-control" name="amount_recieved" placeholder="Enter Received Amount" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="wformrow-Swinprut" class="form-label">Payment Id</label>
                                <input type="text" class="form-control" name="payment_id" placeholder="Enter Payment Id" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-Sawinpsrut" class="form-label">Payment Type</label>
                                 <select type="text" name="payment_type" id="payment_type" class="form-select form-control">
                                  <option value="" selected="selected">Select </option>
                                  <option value="Cash">Cash</option>
                                  <option value="UPI">UPI</option>
                                  <option value="Bank Transfer">Bank Transfer</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-Sawinprut" class="form-label">Booking Date</label>
                                <input type="date" class="form-control" id="datetime-local1" name="created_log" required>
                            </div>
                        </div>
                        <div class="col-md-12 text-end">
                            <button type="submit" id="sub-btn" class="btn btn-success w-md">Confirm Booking</button>
                        </div>
                      </form>
                     </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
      
    </div>
    <!-- latest jquery-->
    <script src="assets/js/jquery.min.js"></script>
    <!-- Bootstrap js-->
    <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- feather icon js-->
    <script src="assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- scrollbar js-->
    <script src="assets/js/scrollbar/simplebar.js"></script>
    <script src="assets/js/scrollbar/custom.js"></script>
    <!-- Sidebar jquery-->
    <script src="assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="assets/js/sidebar-menu.js"></script>
    <script src="assets/js/sidebar-pin.js"></script>
    <script src="assets/js/slick/slick.min.js"></script>
    <script src="assets/js/slick/slick.js"></script>
    <script src="assets/js/header-slick.js"></script>
    <!-- calendar js-->
    <script src="assets/js/flat-pickr/flatpickr.js"></script>
    <script src="assets/js/flat-pickr/custom-flatpickr.js"></script>
    <script src="assets/js/height-equal.js"></script>
    <!-- Plugins JS Ends-->

    <!-- Theme js-->
    <script src="assets/js/script.js"></script>
    <script src="assets/js/sweet-alert/sweetalert.min.js"></script>
    <script src="assets/css/validation/jquery.validate.min.js"></script>
    <script src="assets/css/validation/form-validation.js"></script>
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
      <script type="text/javascript">
         $("#min-max").change(function (e) {
          var act_da = $(this).val();
          var mc_id = $('#mc_name').val();
          var activities_id = $('#activities').val();
          $('#slot').empty();
          $.ajax({
                  url: "ajax/get_acslot.php",
                  type: "POST",
                   data:{"act_da":act_da, "activities_id":activities_id, "mc_id":mc_id},
                      success: function(data) {
                          $('#slot').append(data);
                      },
                      error: function(xhr, status, error) {
                          console.error("AJAX Error:", error);
                      }
         
                    });
           });
      </script>
    <script type="text/javascript">
  // initialize validate plugin on the form
    $("#bookingForm").validate({
        errorPlacement: function(error, element) {
            var ele = $(element),
                err = $(error),
                msg = err.text();
            if (msg != null && msg !== "") {
                ele.tooltipster('content', msg);
                ele.tooltipster('open'); //open only if the error message is not blank. By default jquery-validate will return a label with no actual text in it so we have to check the innerHTML.
            }
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass(errorClass).addClass(validClass).tooltipster('close');
        },
       
        submitHandler: function(form) { // for demo
         var form = $('#bookingForm')[0];
        var formData = new FormData(form);
        event.preventDefault();
         $("#sub-btn").attr("disabled", true);
            $.ajax({
            type: 'POST',
            url: 'booking',
            processData: false,
            contentType: false,
            dataType: "json",
            data: formData,
            success: function (data) {
             
              if(data=='done'){
                swal({
                  title: 'Booked Successfully!',
                        text: "Your booking booked been successfully Added",
                        icon: 'success',
                        confirmButtonColor: '#3f51b5',
                        closeOnEsc: false,
                        closeOnClickOutside: false,
                        
                      }).then(function(t) {
                     location.reload();
                     }) 
               
               } 
            },
            error: function (data) {
               swal({
                  title: 'Internal Sever Error!',
                        text: "Try again",
                        icon: 'warning',
                        closeOnEsc: false,
                        closeOnClickOutside: false,   
                })
            },
        });
        }
    });
</script>
<script type="text/javascript">
         $(".td-change").change(function (e) {
          var act_da = $('#min-max').val();
          var slot = $('#slot').val();
          var adult = $('#adult').val();
          var children = $('#children').val();
          var mc_id = $('#mc_name').val();
          var act_id = $('#activities').val();
          var discount = $('#discount').val();
          $('.amount').empty();
          $.ajax({
                  url: "ajax/get_booking_data.php",
                  type: "POST",
                  dataType: "json",
                   data:{"act_id":act_id, "mc_id":mc_id, "act_da":act_da, "slot":slot, "adult":adult, "children":children,"discount":discount },
                      success: function(data) {
                          $('#ac_amount').val(data.ac_amount);
                          $('#ac_total').val(data.ac_total);
                          $('#ac_subtotal').val(data.ac_finaltotal);
                      },
                      error: function(xhr, status, error) {
                          console.error("AJAX Error:", error);
                      }
         
                    });
           });
      </script>
      <script type="text/javascript">
         $(".td-change1").keyup(function (e) {
          var act_da = $('#min-max').val();
          var slot = $('#slot').val();
          var adult = $('#adult').val();
          var children = $('#children').val();
          var mc_id = $('#mc_name').val();
          var act_id = $('#activities').val();
          var discount = $('#discount').val();
          $('.amount').empty();
          $.ajax({
                  url: "ajax/get_booking_data.php",
                  type: "POST",
                  dataType: "json",
                   data:{"act_id":act_id, "mc_id":mc_id, "act_da":act_da, "slot":slot, "adult":adult, "children":children,"discount":discount },
                      success: function(data) {
                          $('#ac_amount').val(data.ac_amount);
                          $('#ac_total').val(data.ac_total);
                          $('#ac_subtotal').val(data.ac_finaltotal);
                      },
                      error: function(xhr, status, error) {
                          console.error("AJAX Error:", error);
                      }
         
                    });
           });
      </script>
  </body>
</html>