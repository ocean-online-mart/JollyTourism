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
    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link id="color" rel="stylesheet" href="assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
    <link  rel="stylesheet" href="assets/css/validation/tooltip-style.css">
    <style type="text/css">
    @media (min-width: 768px) { /* use the max to specify at each container level */
    td {    
        max-width: 260px;
        white-space: pre-wrap !important;
    }
    }
    th
    {
        background: #e7f4ff !important;
    }
    </style>
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
                  <h4>Activity Slot  - Inactive</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard">                                       
                        <svg class="stroke-icon">
                          <use href="assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">Activity Slot</li>
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
                      <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100" table-layout="auto">
                        <thead>
                          <tr>
                            <th>SI.NO</th>
                            <th>Catogory Name</th>
                            <th>Activity Name</th>
                            <th>Activity Date</th>
                            <th>Activity Slot</th>
                            <th>Available Slot</th>
                            <th>Action</th>
                            <th>Updated By</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $time = date('H:i');
                          $query3  = "SELECT * FROM tb_activitiy_date WHERE date(act_date) >='$today_date' ORDER BY updated_log DESC";
                          $res_query3 = mysqli_query($conn,$query3);
                          $counter=0;
                          while($fetch3 = mysqli_fetch_object($res_query3))
                          {
                         
                          $mc_id=$fetch3->mc_id;
                          $act_id=$fetch3->act_id;
                          $act_dateid=$fetch3->act_dateid;
                          $act_date =$fetch3->act_date;
                          $acti_date = date('d M Y', strtotime($act_date));
                          $crm_id =$fetch3->crm_id;
                          

                          $content_querym = "SELECT * FROM tb_main_catagory WHERE mc_id = '$mc_id'";
                          $content_resm = mysqli_query($conn, $content_querym);
                          $content_rowm = mysqli_fetch_object($content_resm);
                          $mc_name=$content_rowm->mc_name;

                          $content_querymc = "SELECT * FROM tb_activities WHERE activity_id = '$act_id'";
                          $content_resmc = mysqli_query($conn, $content_querymc);
                          $content_rowmc = mysqli_fetch_object($content_resmc);
                          $activity_name=$content_rowmc->activity_name;

                          $crm_query = "SELECT * FROM tb_admin WHERE admin_id ='$crm_id' ";
                          $crm_res = mysqli_query($conn, $crm_query);
                          $crm_row = mysqli_fetch_object($crm_res);
                          $crm_name = ucwords(strtolower($crm_row->name));

                          if($act_date == $today_date)
                          {
                             $date_compare = "AND slot_time >= '$time'";
                          }
                          $slot_query = "SELECT * FROM tb_activity_slot WHERE actdate_id ='$act_dateid' AND status = 1 {$date_compare} ";
                          $slot_res = mysqli_query($conn, $slot_query);
                          while($slot_row = mysqli_fetch_object($slot_res))
                          {
                          $counter++;
                          $slot_id = $slot_row->slot_id;
                          $slot_name = $slot_row->slot_name;
                          $total_availability = $slot_row->total_availability;
                          $updated_at =$slot_row->updated_log;
                          $updated_log = date('d-m-Y h:i:s A', strtotime($updated_at));

                          
                          ?>
                          <tr>
                            <td><?php echo $counter; ?></td>
                            <td><?php echo $mc_name; ?></td>
                            <td><?php echo $activity_name; ?></td>
                            <td><b><?php echo $acti_date; ?></b></td>
                            <td><b><?php echo $slot_name; ?></b></td>
                            <td><b><?php echo $total_availability; ?></b></td>
                            <td class="text-center"><button class="btn btn-success btn-sm inactive" id="inactive" data-id="<?php echo $slot_id; ?>" data-aid="<?php echo $act_dateid; ?>"><i class="fa fa-check fa-lg"></i></button></td>
                            <td><?php echo $crm_name; ?><br><?php echo $updated_log; ?></td>
                          </tr>
                          <?php } } ?>
                        </tbody>
                      </table>
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
    <!-- Required datatable js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/libs/jszip/jszip.min.js"></script>
    <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <!-- Datatable init js -->
    <script src="assets/js/datatable/datatables.init.js"></script> 
    <!-- Theme js-->
    <script src="assets/js/script.js"></script>
    <script src="assets/js/sweet-alert/sweetalert.min.js"></script>
    <script src="assets/css/validation/jquery.validate.min.js"></script>
    <script src="assets/css/validation/form-validation.js"></script>
    <script type="text/javascript">
    $(".inactive").click(function() {
        var slot_id = $(this).attr('data-id');
        var date_id = $(this).attr('data-aid');
        var type = "active";
            swal({
              title: "Are you sure?",
              text: "You want to active this slot!",
              icon: "warning",
              buttons: true,
            dangerMode: true,
          }).then((willDelete) => {
            if (willDelete) {
        $.ajax({
            url: "ajax/activityslot_action.php",
            type: "POST",
            data: { "slot_id": slot_id, "type": type , "date_id": date_id },
            dataType: "json",
            success: function(data) {
              console.log(data);
              
                if (data === 'done') {
                    swal({
                        title: "Active!",
                        text: "Slot date has been activated.",
                        icon: "success"
                    }).then(function() {
                        location.reload();
                    });
                } else {
                    swal("Error", "Something went wrong!", "error");
                }
            },
        })
         }

            });
        })
</script>
  </body>
</html>