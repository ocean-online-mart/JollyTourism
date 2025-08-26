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
 $today_month = date('m');
 $yesterday_date= date('Y-m-d',strtotime("-1 days"));
 $year_date = date('Y');

$query_booking_paid_m  = "SELECT count(booking_id) as book_id FROM tb_booking WHERE status=1 AND payment=1 AND MONTH(updated_log) = '$today_month'";
$res_query_booking_paid_m = mysqli_query($conn,$query_booking_paid_m);
$fetch_booking_paid_m  = mysqli_fetch_object($res_query_booking_paid_m);
$booking_paid_m =$fetch_booking_paid_m->book_id;

$query_booking_unpaid_m  = "SELECT count(booking_id) as book_id FROM tb_booking WHERE status=0 AND payment=0 AND MONTH(updated_log) = '$today_month'";
$res_query_booking_unpaid_m = mysqli_query($conn,$query_booking_unpaid_m);
$fetch_booking_unpaid_m  = mysqli_fetch_object($res_query_booking_unpaid_m);
$booking_unpaid_m =$fetch_booking_unpaid_m->book_id;

$query_booking_unpaid_mt  = "SELECT count(booking_id) as book_id FROM tb_booking WHERE status=0 AND payment=0";
$res_query_booking_unpaid_mt = mysqli_query($conn,$query_booking_unpaid_mt);
$fetch_booking_unpaid_mt  = mysqli_fetch_object($res_query_booking_unpaid_mt);
$total_booking_unpaid_mt =$fetch_booking_unpaid_mt->book_id;

$query_booking_paid_mt  = "SELECT count(booking_id) as book_id FROM tb_booking WHERE status=1 AND payment=1";
$res_query_booking_paid_mt = mysqli_query($conn,$query_booking_paid_mt);
$fetch_booking_paid_mt  = mysqli_fetch_object($res_query_booking_paid_mt);
$total_booking_paid_mt =$fetch_booking_paid_mt->book_id;

$query_booking_paid  = "SELECT count(booking_id) as book_id FROM tb_booking WHERE status=1 AND payment=1 AND date(updated_log) = '$today_date'";
$res_query_booking_paid = mysqli_query($conn,$query_booking_paid);
$fetch_booking_paid  = mysqli_fetch_object($res_query_booking_paid);
$today_booking_paid =$fetch_booking_paid->book_id;

$query_booking_unpaid  = "SELECT count(booking_id) as book_id FROM tb_booking WHERE status=0 AND payment=0 AND date(updated_log) = '$today_date'";
$res_query_booking_unpaid = mysqli_query($conn,$query_booking_unpaid);
$fetch_booking_unpaid  = mysqli_fetch_object($res_query_booking_unpaid);
$today_booking_unpaid =$fetch_booking_unpaid->book_id;

$query_booking_unpaid_yes  = "SELECT count(booking_id) as book_id FROM tb_booking WHERE status=0 AND payment=0 AND date(updated_log) = '$yesterday_date'";
$res_query_booking_unpaid_yes = mysqli_query($conn,$query_booking_unpaid_yes);
$fetch_booking_unpaid_yes  = mysqli_fetch_object($res_query_booking_unpaid_yes);
$yesterday_booking_unpaid =$fetch_booking_unpaid_yes->book_id;

$query_booking_paid_yes  = "SELECT count(booking_id) as book_id FROM tb_booking WHERE status=1 AND payment=1 AND date(updated_log) = '$yesterday_date'";
$res_query_booking_paid_yes = mysqli_query($conn,$query_booking_paid_yes);
$fetch_booking_paid_yes  = mysqli_fetch_object($res_query_booking_paid_yes);
$yesterday_booking_paid =$fetch_booking_paid_yes->book_id;

$query_booking_reservation  = "SELECT count(booking_id) as book_id FROM tb_booking WHERE status=1 AND payment=1 AND date(act_date) >= '$today_date' ORDER BY updated_log DESC";
$res_query_booking_reservation = mysqli_query($conn,$query_booking_reservation);
$fetch_booking_reservation  = mysqli_fetch_object($res_query_booking_reservation);
$upcoming_booking_reservation =$fetch_booking_reservation->book_id;

$query_booking_reservation_to  = "SELECT count(booking_id) as book_id FROM tb_booking WHERE status=1 AND payment=1 AND date(act_date) = '$today_date' ORDER BY updated_log DESC";
$res_query_booking_reservation_to = mysqli_query($conn,$query_booking_reservation_to);
$fetch_booking_reservation_to  = mysqli_fetch_object($res_query_booking_reservation_to);
$total_booking_reservation =$fetch_booking_reservation_to->book_id;

$query_booking_reservation_past = "SELECT count(booking_id) as book_id FROM tb_booking WHERE status=1 AND payment=1 AND date(act_date) < '$today_date' ORDER BY updated_log DESC";
$res_query_booking_reservation_past= mysqli_query($conn,$query_booking_reservation_past);
$fetch_booking_reservation_past = mysqli_fetch_object($res_query_booking_reservation_past);
$past_booking_reservation=$fetch_booking_reservation_past->book_id;

$query_booking_reservation_amt = "SELECT SUM(total_amount) as book_id FROM tb_booking WHERE status=2  ORDER BY updated_log DESC";
$res_query_booking_reservation_amt= mysqli_query($conn,$query_booking_reservation_amt);
$fetch_booking_reservation_amt = mysqli_fetch_object($res_query_booking_reservation_amt);
$amt_booking_reservation=$fetch_booking_reservation_amt->book_id;
if($amt_booking_reservation == '')
{
  $amt_booking_reservation =0; 
}

$query_revenue_amt = "SELECT SUM(amount_recieved) as revenue FROM tb_booking WHERE status=1 AND payment=1 AND date(updated_log) = '$today_date'";
$res_query_revenue_amt= mysqli_query($conn,$query_revenue_amt);
$fetch_revenue_amt = mysqli_fetch_object($res_query_revenue_amt);
$today_revenue=$fetch_revenue_amt->revenue;

$query_revenue_yes = "SELECT SUM(amount_recieved) as revenue FROM tb_booking WHERE status=1 AND payment=1 AND date(updated_log) = '$yesterday_date'";
$res_query_revenue_yes= mysqli_query($conn,$query_revenue_yes);
$fetch_revenue_yes = mysqli_fetch_object($res_query_revenue_yes);
$yesterday_revenue=$fetch_revenue_yes->revenue;

$query_revenue_total = "SELECT SUM(amount_recieved) as revenue FROM tb_booking WHERE status=1 AND payment=1";
$res_query_revenue_total= mysqli_query($conn,$query_revenue_total);
$fetch_revenue_total = mysqli_fetch_object($res_query_revenue_total);
$total_revenue=$fetch_revenue_total->revenue;

$query_revenue_month = "SELECT SUM(amount_recieved) as revenue FROM tb_booking WHERE status=1 AND payment=1";
$res_query_revenue_month= mysqli_query($conn,$query_revenue_month);
$fetch_revenue_month = mysqli_fetch_object($res_query_revenue_month);
$month_revenue=$fetch_revenue_month->revenue;

$query_booking_paid_mon  = "SELECT count(booking_id) as book_id FROM tb_booking WHERE status=1 AND payment=1 AND MONTH(updated_log) = '$today_month'";
$res_query_booking_paid_mon = mysqli_query($conn,$query_booking_paid_mon);
$fetch_booking_paid_mon  = mysqli_fetch_object($res_query_booking_paid_mon);
$month_booking_paid =$fetch_booking_paid_mon->book_id;

if($total_revenue == '')
{
  $total_revenue = 0;
}
if($month_revenue == '')
{
  $month_revenue = 0;
}
if($yesterday_revenue == '')
{
  $yesterday_revenue = 0;
}
if($today_revenue == '')
{
  $today_revenue = 0;
}
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
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link id="color" rel="stylesheet" href="assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
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
      <!-- Page Header Ends-->
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
                  <h4>
                     Super Admin Dashboard</h4>
                </div>
                <div class="col-6"> 
                  <ol class="breadcrumb"> 
                    <li class="breadcrumb-item"> <a href="dashboard">
                        <svg class="stroke-icon">
                          <use href="assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Dashboard </li>
                    <li class="breadcrumb-item active">Super Admin</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts -->
          <div class="container-fluid">
            <div class="row"> 
                  <div class="col-md-3 col-sm-6">
                    <div class="card o-hidden small-widget">
                      <a href="overall-booking-today">
                        <div class="card-body total-project border-b-primary border-2"><span class="f-light f-w-500 f-14">Today Paid Booking</span>
                          <div class="project-details"> 
                            <div class="project-counter"> 
                              <h4 class="f-w-600"><?php echo $today_booking_paid; ?></h4><br>
                            </div>
                            <div class="product-sub bg-primary-light">
                              <svg class="invoice-icon">
                                <use href="assets/svg/icon-sprite.svg#color-swatch"></use>
                              </svg>
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="col-xl-3 col-sm-6">
                    <div class="card o-hidden small-widget">
                      <a href="overall-booking-yesterday">
                        <div class="card-body total-Complete border-b-primary border-2"><span class="f-light f-w-500 f-14">Yesterday Paid Booking</span>
                          <div class="project-details">
                            <div class="project-counter">
                              <h4 class="f-w-600"><?php echo $yesterday_booking_paid; ?></h4>
                            </div>
                            <div class="product-sub bg-primary-light"> 
                              <svg class="invoice-icon">
                                <use href="assets/svg/icon-sprite.svg#color-swatch"></use>
                              </svg>
                            </div>
                          </div>
                         
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="col-xl-3 col-sm-6">
                    <div class="card o-hidden small-widget">
                      <a href="overall-booking-monthly">
                        <div class="card-body total-Complete border-b-primary border-2"><span class="f-light f-w-500 f-14"><?php echo date('F') ?> Paid Booking</span>
                          <div class="project-details">
                            <div class="project-counter">
                              <h4 class="f-w-600"><?php echo $booking_paid_m; ?></h4>
                            </div>
                            <div class="product-sub bg-primary-light"> 
                              <svg class="invoice-icon">
                                <use href="assets/svg/icon-sprite.svg#color-swatch"></use>
                              </svg>
                            </div>
                          </div>
                          
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="col-xl-3 col-sm-6">
                    <div class="card o-hidden small-widget">
                      <a href="overall-booking-all">
                        <div class="card-body total-Complete border-b-primary border-2"><span class="f-light f-w-500 f-14">Overall Paid Booking</span>
                          <div class="project-details">
                            <div class="project-counter">
                              <h4 class="f-w-600"><?php echo $total_booking_paid_mt; ?></h4>
                            </div>
                            <div class="product-sub bg-primary-light"> 
                              <svg class="invoice-icon">
                                <use href="assets/svg/icon-sprite.svg#color-swatch"></use>
                              </svg>
                            </div>
                          </div>
                          
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="col-xl-3 col-sm-6">
                    <div class="card o-hidden small-widget">
                      <a href="overall-unbooking-today">
                        <div class="card-body total-Progress border-b-secondary border-2"> <span class="f-light f-w-500 f-14">Today Unpaid Booking</span>
                          <div class="project-details">
                            <div class="project-counter">
                              <h4 class="f-w-600"><?php echo $today_booking_unpaid; ?></h4>
                            </div>
                            <div class="product-sub bg-secondary-light"> 
                              <svg class="invoice-icon">
                                <use href="assets/svg/icon-sprite.svg#calendar"></use>
                              </svg>
                            </div>
                          </div>
                         
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="col-xl-3 col-sm-6">
                    <div class="card o-hidden small-widget">
                      <a href="overall-unbooking-yesterday">
                        <div class="card-body total-upcoming border-b-secondary border-2"><span class="f-light f-w-500 f-14">Yesterday Unpaid Booking</span>
                          <div class="project-details"> 
                            <div class="project-counter">
                              <h4 class="f-w-600"><?php echo $yesterday_booking_unpaid; ?></h4>
                            </div>
                            <div class="product-sub bg-secondary-light"> 
                              <svg class="invoice-icon">
                                <use href="assets/svg/icon-sprite.svg#calendar"></use>
                              </svg>
                            </div>
                          </div>
                         
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="col-xl-3 col-sm-6">
                    <div class="card o-hidden small-widget">
                      <a href="overall-unbooking-monthly">
                        <div class="card-body total-upcoming border-b-secondary border-2"><span class="f-light f-w-500 f-14"><?php echo date('F') ?> Unpaid Booking</span>
                          <div class="project-details"> 
                            <div class="project-counter">
                              <h4 class="f-w-600"><?php echo $booking_unpaid_m; ?></h4>
                            </div>
                            <div class="product-sub bg-secondary-light"> 
                              <svg class="invoice-icon">
                                <use href="assets/svg/icon-sprite.svg#calendar"></use>
                              </svg>
                            </div>
                          </div>
                         
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="col-xl-3 col-sm-6">
                    <div class="card o-hidden small-widget">
                      <a href="overall-unbooking-all">
                        <div class="card-body total-upcoming border-b-secondary border-2"><span class="f-light f-w-500 f-14">Overall Unpaid Booking</span>
                          <div class="project-details"> 
                            <div class="project-counter">
                              <h4 class="f-w-600"><?php echo $total_booking_unpaid_mt; ?></h4>
                            </div>
                            <div class="product-sub bg-secondary-light"> 
                              <svg class="invoice-icon">
                                <use href="assets/svg/icon-sprite.svg#calendar"></use>
                              </svg>
                            </div>
                          </div>
                         
                        </div>
                      </a>
                    </div>
                  </div>
              <div class="col-md-6 col-sm-6"> 
                <div class="row">
                  <div class="col-xl-6 col-sm-6">
                    <div class="card height-equal">
                      <div class="card-body"> 
                        <ul class="product-costing">
                          <li class="product-cost">
                            <div class="product-icon bg-primary-light">
                              <svg>
                                <use href="assets/svg/icon-sprite.svg#activity"></use>
                              </svg>
                            </div>
                            <div><a href="reservation-today"><span class="f-w-500 f-14 mb-0">Today Reservation</span></a>
                              <h4 class="f-w-600"><?php echo $total_booking_reservation; ?></h2>
                            </div>
                          </li>
                          <li> <span class="f-light f-14 f-w-500">Overall reservations.</span></li>
                        </ul>
                        <ul class="product-costing">
                          <li class="product-cost">
                            <div class="product-icon bg-warning-light">
                              <svg>
                                <use href="assets/svg/icon-sprite.svg#people"></use>
                              </svg>
                            </div>
                            <div><a href="reservation-upcoming"><span class="f-w-500 f-14 mb-0">Upcoming Reservation</span></a>
                              <h4 class="f-w-600"><?php echo $upcoming_booking_reservation; ?></h2>
                            </div>
                          </li>
                          <li> <span class="f-light f-14 f-w-500">Future reservations.</span></li>
                        </ul>
                        <ul class="product-costing">
                          <li class="product-cost">
                            <div class="product-icon bg-light">
                              <svg>
                                <use href="assets/svg/icon-sprite.svg#task-square"></use>
                              </svg>
                            </div>
                            <div><a href="reservation-past"><span class="f-w-500 f-14 mb-0">Past Reservation</span></a>
                              <h4 class="f-w-600"><?php echo $past_booking_reservation; ?></h2>
                            </div>
                          </li>
                          <li> <span class="f-light f-14 f-w-500">Completed reservations.</span></li>
                        </ul>
                        <ul class="product-costing">
                          <li class="product-cost">
                            <div class="product-icon bg-danger-light">
                              <svg>
                                <use href="assets/svg/icon-sprite.svg#money-recive"></use>
                              </svg>
                            </div>
                            <div><span class="f-w-500 f-14 mb-0">Refunded</span>
                              <h4 class="f-w-600">₹<?php echo $amt_booking_reservation; ?></h2>
                            </div>
                          </li>
                          <li> <span class="f-light f-14 f-w-500">Cancel booking.</span></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-6 col-sm-6">
                    <div class="card height-equal">
                      <div class="card-header pb-0 total-revenue card-no-border"> 
                        <h5>Revenue History </h5>
                      </div>
                      <div class="card-body"> 
                        <ul>
                          <li class="sale-history-card">
                            <div class="history-price"><a class="f-w-500 f-14  mb-0" href="#">Today</a><span class="mb-0 txt-primary f-w-600 f-16">₹<?php echo $today_revenue; ?></span></div>
                            <div class="state-time"> <span class="f-w-500 f-14 f-light mb-0"><?php echo $today_booking_paid; ?> Booking</span></div>
                          </li>
                          <li class="sale-history-card">
                            <div class="history-price"><a class="f-w-500 f-14  mb-0" href="#">Yesterday</a><span class="mb-0 txt-primary f-w-600 f-16">₹<?php echo $yesterday_revenue; ?></span></div>
                            <div class="state-time"> <span class="f-w-500 f-14 f-light mb-0"><?php echo $yesterday_booking_paid; ?> Booking</span></div>
                          </li>
                          <li class="sale-history-card">
                            <div class="history-price"><a class="f-w-500 f-14  mb-0" href="#"><?php echo date('F'); ?></a><span class="mb-0 txt-primary f-w-600 f-16">₹<?php echo $month_revenue; ?></span></div>
                            <div class="state-time"> <span class="f-w-500 f-14 f-light mb-0"><?php echo $month_booking_paid; ?> Booking</div>
                          </li>
                          <li class="sale-history-card">
                            <div class="history-price"><a class="f-w-500 f-14  mb-0" href="#">Overall</a><span class="mb-0 txt-primary f-w-600 f-16">₹<?php echo $total_revenue; ?></span></div>
                            <div class="state-time"> <span class="f-w-500 f-14 f-light mb-0"><?php echo $total_booking_reservation; ?> Booking</div>
                          </li>
                          <li class="sale-history-card  text-center">
                            <div class="text-center"><a class="text-primary" href="#">View All</a></div>
                            <div class="state-time text-center"> <span class="f-w-500 f-14 f-light mb-0">Searching Filter Available</span></div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="col-md-6  col-sm-6">
                <div class="card"> 
                  <div class="card-header total-revenue card-no-border"> 
                    <h5>Booking History</h4>
                  </div>
                  <div class="card-body pt-0">
                    <div class="table-order table-responsive custom-scrollbar">
                      <table class="order-table w-100">
                        <thead> 
                          <tr>
                            <th>Boating Adventures</th>
                            <th>Paid</th>
                            <th>Unpaid</th>
                            <th>Revenue</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $query5  = "SELECT count(booking_id) as bk_id, SUM(amount_recieved) as am FROM tb_booking WHERE mc_id = 1 AND status=1 AND payment=1 AND act_id = 1";
                          $res_query5 = mysqli_query($conn,$query5);
                          $fetch5 = mysqli_fetch_object($res_query5);
                          $bk_id=$fetch5->bk_id;
                          $am=$fetch5->am;

                          if($am == '')
                          {
                            $am = 0 ;
                          }

                          $query6  = "SELECT count(booking_id) as unbk_id FROM tb_booking WHERE mc_id = 1 AND status=0 AND payment=0 AND act_id = 1";
                          $res_query6 = mysqli_query($conn,$query6);
                          $fetch6 = mysqli_fetch_object($res_query6);
                          $unbk_id=$fetch6->unbk_id;
                          ?>
                          <tr>
                            <td>
                              Four Places Boat Ride
                            </td>
                            <td>
                              <?php echo $bk_id; ?>
                            </td>
                            <td>
                              <?php echo $unbk_id; ?>
                            </td>
                            <td>
                              ₹<?php echo $am; ?>
                            </td>
                          </tr>
                          <?php
                          $query7  = "SELECT count(booking_id) as bk_id, SUM(amount_recieved) as am FROM tb_booking WHERE mc_id = 1 AND status=1 AND payment=1 AND act_id IN (2,3,4,5)";
                          $res_query7 = mysqli_query($conn,$query7);
                          $fetch7 = mysqli_fetch_object($res_query7);
                          $mbk_id=$fetch7->bk_id;
                          $mam=$fetch7->am;
                          if($mam == '')
                          {
                            $mam = 0 ;
                          }
                          $query8  = "SELECT count(booking_id) as unbk_id FROM tb_booking WHERE mc_id = 1 AND status=0 AND payment=0 AND act_id IN (2,3,4,5)";
                          $res_query8 = mysqli_query($conn,$query8);
                          $fetch8 = mysqli_fetch_object($res_query8);
                          $munbk_id=$fetch8->unbk_id;
                          ?>
                          <tr>
                            <td>
                              Mangrove Kayaking
                            </td>
                            <td>
                              <?php echo $mbk_id; ?>
                            </td>
                            <td>
                              <?php echo $munbk_id; ?>
                            </td>
                            <td>
                              ₹<?php echo $mam; ?>
                            </td>
                          </tr>
                          <?php
                          $query9  = "SELECT count(booking_id) as bk_id, SUM(amount_recieved) as am FROM tb_booking WHERE mc_id = 1 AND status=1 AND payment=1 AND act_id = 6";
                          $res_query9 = mysqli_query($conn,$query9);
                          $fetch9 = mysqli_fetch_object($res_query9);
                          $bkm_id=$fetch9->bk_id;
                          $amm=$fetch9->am;

                          if($amm == '')
                          {
                            $amm = 0 ;
                          }

                          $query10  = "SELECT count(booking_id) as unbk_id FROM tb_booking WHERE mc_id = 1 AND status=0 AND payment=0 AND act_id = 6";
                          $res_query10 = mysqli_query($conn,$query10);
                          $fetch10 = mysqli_fetch_object($res_query10);
                          $munbk_id=$fetch10->unbk_id;
                          ?>
                          <tr>
                            <td>
                              Mangrove Speed Boat
                            </td>
                            <td>
                              <?php echo $bkm_id ?>
                            </td>
                            <td>
                              <?php echo $munbk_id ?>
                            </td>
                            <td>
                              ₹<?php echo $amm ?>
                            </td>
                          </tr>
                          <tr>
                            <?php
                            $query11  = "SELECT count(booking_id) as bk_id, SUM(amount_recieved) as am FROM tb_booking WHERE mc_id = 1 AND status=1 AND payment=1 AND act_id = 8";
                          $res_query11 = mysqli_query($conn,$query11);
                          $fetch11 = mysqli_fetch_object($res_query11);
                          $wbk_id=$fetch11->bk_id;
                          $wam=$fetch11->am;
                          if($wam == '')
                          {
                            $wam = 0 ;
                          }

                          $query12  = "SELECT count(booking_id) as unbk_id FROM tb_booking WHERE mc_id = 1 AND status=0 AND payment=0 AND act_id = 8";
                          $res_query12 = mysqli_query($conn,$query12);
                          $fetch12 = mysqli_fetch_object($res_query12);
                          $wunbk_id=$fetch12->unbk_id;
                          ?>
                            <td>
                              Water Bicycle
                            </td>
                            <td>
                              <?php echo $wbk_id ?>
                            </td>
                            <td>
                              <?php echo $wunbk_id ?>
                            </td>
                            <td>
                              ₹<?php echo $wam ?>
                            </td>
                          </tr>
                          <tr>
                            <?php
                            $query13  = "SELECT count(booking_id) as bk_id, SUM(amount_recieved) as am FROM tb_booking WHERE mc_id = 1 AND status=1 AND payment=1 AND act_id = 8";
                          $res_query13 = mysqli_query($conn,$query13);
                          $fetch13 = mysqli_fetch_object($res_query13);
                          $cbk_id=$fetch13->bk_id;
                          $cam=$fetch13->am;
                          if($cam == '')
                          {
                            $cam = 0 ;
                          }

                          $query14  = "SELECT count(booking_id) as unbk_id FROM tb_booking WHERE mc_id = 1 AND status=0 AND payment=0 AND act_id = 8";
                          $res_query14 = mysqli_query($conn,$query14);
                          $fetch14 = mysqli_fetch_object($res_query14);
                          $cunbk_id=$fetch14->unbk_id;
                          ?>
                            <td>
                              Couple Water Bicycle
                            </td>
                            <td>
                              <?php echo $cbk_id ?>
                            </td>
                            <td>
                              <?php echo $cunbk_id ?>
                            </td>
                            <td>
                              ₹<?php echo $cam ?>
                            </td>
                          </tr>
                           <tr>
                          <?php
                          $query16  = "SELECT count(booking_id) as b3k_id, SUM(amount_recieved) as am3 FROM tb_booking WHERE mc_id = 3 AND status=1 AND payment=1 AND act_id = 17";
                          $res_query16 = mysqli_query($conn,$query16);
                          $fetch16 = mysqli_fetch_object($res_query16);
                          $cbk_id3=$fetch16->b3k_id;
                          $camt=$fetch16->am3;
                          if($camt == '')
                          {
                            $camt = 0 ;
                          }
                          $query15  = "SELECT count(booking_id) as unbk3_id FROM tb_booking WHERE mc_id = 3 AND status=0 AND payment=0 AND act_id = 17";
                          $res_query15 = mysqli_query($conn,$query15);
                          $fetch15 = mysqli_fetch_object($res_query15);
                          $cunbk_id3=$fetch15->unbk3_id;
                          ?>
                            <td>
                              3 in 1 Activity - 3 Hrs
                            </td>
                            <td>
                              <?php echo $cbk_id3 ?>
                            </td>
                            <td>
                              <?php echo $cunbk_id3 ?>
                            </td>
                            <td>
                              ₹<?php echo $camt ?>
                            </td>
                          </tr>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-8 col-xl-8 box-col-8">
                <div class="card">
                  <div class="card-header">
                    <h4>Booking Chart - <?php echo date('Y') ?></h4>
                  </div>
                  <div class="card-body">
                    <div id="column-chart"></div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-4 box-col-4">
                <div class="card">
                  <div class="card-header total-revenue card-no-border">
                    <h5>Booking Category Chart</h5>
                  </div>
                  <div class="card-body pt-0"> 
                    <div class="revenueproduct" id="revenueproduct"> </div>
                    <div class="sales-chart-dropdown"> 
                      <ul class="balance-data flex-wrap flex">
                        <li><span class="circle bg-primary"></span><span class="f-light ms-1">Boating Adventure</span></li>
                        <li><span class="circle bg-warning"></span><span class="f-light ms-1">Tour Booking</span></li>
                        <li><span class="circle bg-secondary"></span><span class="f-light ms-1">Cancel Booking</span></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends -->
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
    <script src="assets/js/chart/apex-chart/apex-chart.js"></script>
    <script src="assets/js/chart/apex-chart/moment.min.js"></script>
    <script src="assets/js/notify/bootstrap-notify.min.js"></script>
    <!-- calendar js-->
    <script src="assets/js/notify/index.js"></script>
    <script src="assets/js/typeahead/handlebars.js"></script>
    <script src="assets/js/typeahead-search/handlebars.js"></script>
    <script src="assets/js/height-equal.js"></script>
    <script src="assets/js/animation/wow/wow.min.js"></script>
    <script src="assets/js/chart/apex-chart/stock-prices.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="assets/js/script.js"></script>
    <script>new WOW().init();</script>
    <script type="text/javascript">

      <?php
        function sum_arrays($array1, $array2) {
    $array = array();
    foreach($array1 as $index => $value) {
        $array[$index] = isset($array2[$index]) ? $array2[$index] + $value : $value;
    }
    return $array;
}
        $counters=1;
        for ($i=1; $i <= 12; $i++) { 
        $counters++;
        $content_query = "SELECT count(booking_id) as acdata FROM tb_booking WHERE MONTH(updated_log) = '$i' AND status = 1 AND payment = 1 AND mc_id = 1 AND YEAR(updated_log) = '$year_date' ";
        $content_res= mysqli_query($conn, $content_query);
        $content_row = mysqli_fetch_object($content_res);
        $datas=$content_row->acdata;
        if($datas == '')
        {
           $datas =0; 
        }
         $data_list[] = $datas;
        $data =  implode(', ', $data_list);

        if($data=='')
        {
           $data = '0'; 
        }

        $content_queryf = "SELECT count(booking_id) as fdata FROM tb_booking WHERE MONTH(updated_log) = '$i' AND status = 1 AND payment = 1 AND mc_id = 3 AND YEAR(updated_log) = '$year_date' ";
        $content_resf= mysqli_query($conn, $content_queryf);
        $content_rowf = mysqli_fetch_object($content_resf);
        $fdatas=$content_rowf->fdata;
        if($fdatas == '')
        {
           $fdatas =0; 
        }
        $fdata_list[] = $fdatas;

        $fdata =  implode(', ', $fdata_list);

        if($fdata=='')
        {
           $fdata = '0'; 
        }

        $content_queryfc = "SELECT count(booking_id) as acsdata FROM tb_booking WHERE MONTH(updated_log) = '$i' AND status = 2 AND YEAR(updated_log) = '$year_date' ";
        $content_resfc= mysqli_query($conn, $content_queryfc);
        $content_rowfc = mysqli_fetch_object($content_resfc);
        $fdatasc=$content_rowfc->acsdata;
        if($fdatasc == '')
        {
           $fdatasc =0; 
        }
        $fdata_listc[] = $fdatasc;

        $fdatac =  implode(', ', $fdata_listc);

        if($fdatac=='')
        {
           $fdatac = '0'; 
        }

        
        }
        ?>

      var options3 = {
      chart: {
        height: 350,
        type: "bar",
        toolbar: {
          show: false,
        },
      },
      plotOptions: {
        bar: {
          horizontal: false,
          endingShape: "rounded",
          columnWidth: "55%",
        },
      },
      dataLabels: {
        enabled: false,
      },
      stroke: {
        show: true,
        width: 2,
        colors: ["transparent"],
      },
      series: [
        {
          name: "Boating Adventure",
          data: [<?php echo $data ?>],
        },
        {
          name: "Tour Package",
          data: [<?php echo $fdata ?>],
        },
        {
          name: "Cancel Booking",
          data: [<?php echo $adata ?>],
        },
      ],
      xaxis: {
        categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      },
      yaxis: {
        title: {
          text: "Booking",
        },
      },
      fill: {
        opacity: 1,
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return  val + " Booking";
          },
        },
      },
      colors: [RihoAdminConfig.primary, "#51bb25", RihoAdminConfig.secondary,],
    };

    var chart3 = new ApexCharts(document.querySelector("#column-chart"), options3);

    chart3.render();
    </script>

    <script type="text/javascript">
      <?php
      $query_booking_boat  = "SELECT count(booking_id) as book_id FROM tb_booking WHERE status=1 AND payment=1 AND mc_id = 1";
      $res_query_booking_boat = mysqli_query($conn,$query_booking_boat);
      $fetch_booking_boat  = mysqli_fetch_object($res_query_booking_boat);
      $booking_boat =$fetch_booking_boat->book_id;

      $query_booking_tour  = "SELECT count(booking_id) as book_id FROM tb_booking WHERE status=1 AND payment=1 AND mc_id = 3";
      $res_query_booking_tour = mysqli_query($conn,$query_booking_tour);
      $fetch_booking_tour  = mysqli_fetch_object($res_query_booking_tour);
      $booking_tour =$fetch_booking_tour->book_id;

      $query_booking_cancel  = "SELECT count(booking_id) as book_id FROM tb_booking WHERE status=2";
      $res_query_booking_cancel = mysqli_query($conn,$query_booking_cancel);
      $fetch_booking_cancel  = mysqli_fetch_object($res_query_booking_cancel);
      $booking_cancel =$fetch_booking_cancel->book_id;
      ?>
      var options = {
        series: [<?php echo $booking_boat ?>, <?php echo $booking_tour ?>, <?php echo $booking_cancel ?>],
        chart: { 
        height: 240,
        type: 'donut',
      }, 
      stroke: {
        width: 0,
      },  
      labels: ['Boating Adventure','Tour Package' ,'Cancel Booking'],
      colors: ['var(--theme-deafult)','#096829','#ff0606'],
      dataLabels: { 
        enabled: false,
      },
      responsive: [{
        breakpoint: 480,
        options: {
          chart: { 
            height : 280,
          },
        },
      }],
      legend: {
        show: false,
        offsetY: 0, 
      },
      plotOptions: {
        pie: {
          donut: {
            size: '80%',
            labels: {
              show: true,
               name: {
              show: true,
              color: '#dfsda',
              offsetY: 16
            },
            value: {
              show: true,
              color: undefined,
              offsetY: -25,
              formatter: function (val) {
                return val
              }
            },
              total: {
              show: true,
              label: 'Booking',
              color: '#86909C',
              formatter: function (w) {
                return w.globals.seriesTotals.reduce((a, b) => {
                  return a + b
                }, 0)
              }
            }
            }
          }
        }
      },
      };
      var revenueproduct = new ApexCharts(document.querySelector("#revenueproduct"), options);
      revenueproduct.render();
    </script>
  </body>
</html>