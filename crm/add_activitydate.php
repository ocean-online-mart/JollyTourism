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
    <!-- Plugins css Ends-->
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
                  <h4>Activity Date & Slot Creation</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard">                                       
                        <svg class="stroke-icon">
                          <use href="assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">Activity Date</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row"> 
              <div class="col-md-12">
                <div class="card height-equal">
                 
                  <div class="card-body main-flatpickr">
                    <div class="card-wrapper">
                      <form class="timepicker-wrapper" id="submitForm" enctype="multipart/form-data">
                        <div class="row">
                          <div class="col-md-4 box-col-12">
                            <label> Activity</label> 
                            <div class="input-group">
                              <select type="text" class="form-control" name="activity_id" id="activity_id" required>
                                <?php 
                                $content_query1   = "SELECT * FROM tb_activities WHERE status != 1 AND activity_id != 12 AND activity_id != 13 AND activity_id != 14 ORDER BY activity_id ASC";
                                //echo $content_query1;
                                  $content_res1 = mysqli_query($conn, $content_query1);
                                  ?>
                                  <option value="" selected="selected" disabled="disabled">Explore Activities</option>
                                  <?php
                                  while($content_row1 = mysqli_fetch_object($content_res1))
                                  {
                                    $activity_id=$content_row1->activity_id;
                                    $activity_name =ucwords(strtolower($content_row1->activity_name));
                                    
                                ?>
                                <option value="<?php echo $activity_id; ?>"><?php echo $activity_name; ?></option>
                                   <?php
                                   }
                                   ?>                 
                              </select>
                            </div>
                          </div>
                          <div class="col-md-4 box-col-12">
                            <label> Choose Activity Date</label> 
                            <div class="input-group flatpicker-calender">
                              <input class="form-control" id="range-date" type="date" name="activity_date" required>
                            </div>
                          </div>
                          <div class="col-md-4 box-col-12">
                            <label> Status</label> 
                            <div class="input-group">
                              <input type="hidden" name="type" value="add">
                              <select type="text" class="form-control" name="status" id="status" required>
                                <option value="" selected="selected" disabled="disabled">Choose Status</option>
                                <option value="0">Active</option>
                                <option value="1">Inactive</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-12 mt-4">
                            <label> Choose Slot</label> 
                            <div class=" common-flex main-checkbox-toggle">
                            <?php 
                            $content_query_slot   = "SELECT * FROM tb_slot WHERE status != 1 ORDER BY slot_id2 ASC";
                            //echo $content_query1;
                              $content_res_slot = mysqli_query($conn, $content_query_slot);
                              while($content_row_slot = mysqli_fetch_object($content_res_slot))
                              {
                                $slot_id2=$content_row_slot->slot_id2;
                                $slot=$content_row_slot->slot;
                              ?>
                             <input class="btn-check" id="btn-<?php echo $slot_id2; ?>" name="slot[]" type="checkbox" value="<?php echo $slot_id2; ?>" required>
                              <label class="btn btn-outline-info" for="btn-<?php echo $slot_id2; ?>"> <?php echo $slot; ?></label>
                              <?php 
                            }
                            ?>
                            </div>
                          </div>
                          <div class="col-md-4 box-col-12 mt-4">
                            <button class="btn btn-success" type="submit">Submit</button>
                          </div>
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
  // initialize validate plugin on the form
    $("#submitForm").validate({
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
         var form = $('#submitForm')[0];
        var formData = new FormData(form);
        event.preventDefault();

        // console.log(formData);
        
        // $("#sub-btn").attr("disabled", true);
            $.ajax({
            type: 'POST',
            url: 'ajax/activitydate_action',
            processData: false,
            contentType: false,
            dataType: "json",
            data: formData,
            success: function (data) {
              console.log(data);
              
              if(data=='done'){
                swal({
                  title: 'Added Successfully!',
                        text: "Date & Slot has been successfully Added",
                        icon: 'success',
                        confirmButtonColor: '#3f51b5',
                        closeOnEsc: false,
                        closeOnClickOutside: false,
                        
                      }).then(function(t) {
                     location.reload();
                     }) 
               
               } else if(data == "inactive done"){
                   swal({
                  title: 'updated Successfully!',
                        text: "Date & Slot has been successfully Inactived",
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
  </body>
</html>