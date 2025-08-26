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
                  <h4>CRM User</h4>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard">                                       
                        <svg class="stroke-icon">
                          <use href="assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">CRM User</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="text-end mb-2">
               <button class="btn btn-info btn-sm" href="#activeModal" data-bs-toggle="modal" data-bs-target="#activeModal"><i class="fa fa-plus"></i> Add New</button>
            </div>
            <div class="row"> 
              <?php
              $crm_query = "SELECT * FROM tb_admin ORDER BY admin_id ASC";
              $crm_res = mysqli_query($conn, $crm_query);
              while($crm_row = mysqli_fetch_object($crm_res))
              {
              $crm_name = ucwords(strtolower($crm_row->name));
              $position=$crm_row->position;
              $status=$crm_row->status;
              $username=$crm_row->username;
              $admin_id=$crm_row->admin_id;
              $password=$crm_row->password;
              if ($position == 1) {
                 $access = 'Super Admin';
                }
                elseif ($position == 2) {
                 $access = 'Admin';
                }
                elseif ($position == 3) {
                 $access = 'Booking Admin';
                }

                if($status == 0)
                {
                  $state = 'Active';
                  $color = 'btn-success';
                  $class = 'active';
                }
                else
                {
                  $state = 'Inactive';
                  $color = 'btn-danger';
                  $class = 'inactive';
                }
              ?>
              <div class="col-3 mb-3">
                <div class="card">
                  <div class="card-body text-center">
                      <div class="profile-media text-center"><img class="b-r-10" src="assets/images/dashboard/profile.png" alt="">
                      </div>
                      <h6 class="mt-2"><?php echo $crm_name; ?></h6>
                      <small><?php echo $access; ?></small>
                      <div class="mt-3">
                        <button data-bs-toggle="modal" data-bs-target="#editmodal" data-id="<?php echo $admin_id ?>" class="btn openModal btn-sm btn-primary">Edit</button>
                        <button  data-id="<?php echo $admin_id; ?>" class="btn btn-sm <?php echo $class; ?> <?php echo $color; ?>"><?php echo $state; ?></button>
                      </div>
                  </div>
                </div>
              </div>
              <?php
              }
              ?>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
      
      <!-- view model -->
       <div class="modal fade" id="editmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
           <div class="modal-content edit-content">

           </div>  
        </div>
      </div>

       <div class="modal fade" id="activeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="activemodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
             <form class="admin-form" id="adminForm" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="type" value="add">
                     <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-firstname-input" class="form-label">Employee Name</label>
                                <input type="text" class="form-control" name="emp_name" id="formrow-firstname-input" placeholder="Enter Employee Name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-password-input" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Enter Username" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formrow-input" class="form-label">Password</label>
                                <input type="text" class="form-control" id="phone-input" name="password" placeholder="Enter password" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mb-3">
                                <label for="formrow-inputState" class="form-label">Position</label>
                                <select type="text" id="ford" name="position" class="form-control form-select" required>
                                    <option value="" selected>Choose Position</option>
                                    <option value="1">Super Admin</option>
                                    <option value="2">Main Admin</option>
                                    <option value="3">Booking Team</option>
                                </select>
                            </div>

                        </div>
                     </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                     <button type="submit" id="sub-btn" class="btn btn-success w-md">Submit</button>
                </div>
                 </form>
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
    $(".delete").click(function() {
        var user_id = $(this).attr('data-id');
        var type = "active";
            Swal.fire({
                title: "Are you sure?",
                text: "You want to delete this user!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                confirmButtonClass: "btn btn-success mt-2",
                cancelButtonClass: "btn btn-danger ms-2 mt-2",
                buttonsStyling: !1
            }).then(function(t) {
                if(t.value == true)
                {
             $.ajax({
            url: "ajax/user_action.php",
            type: "POST",
             data:{"user_id":user_id,"type":type},
            dataType: "json",
            success: function (data) {
              if(data=='done'){
                Swal.fire({
                    title: "Deleted!",
                    text: "Your User has been deleted.",
                    icon: "success"
                }).then(function(t) {
                location.reload();
            })
          }
           else{
             Swal.fire("Internal Server Error!", "Please try again", "error");
            }
               },
        })
         }

            })
        })
</script>

<script type="text/javascript">
  $('.openModal').click(function(){
      var id = $(this).attr('data-id');
      $.ajax({url:"useredit_model.php?id="+id,cache:false,success:function(result){
          $(".edit-content").html(result);
      }});
  });
</script>
    <script type="text/javascript">
  // initialize validate plugin on the form
    $("#adminForm").validate({
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
         var form = $('#adminForm')[0];
        var formData = new FormData(form);
        event.preventDefault();
         $("#sub-btn").attr("disabled", true);
            $.ajax({
            type: 'POST',
            url: 'ajax/user_action',
            processData: false,
            contentType: false,
            dataType: "json",
            data: formData,
            success: function (data) {
             
              if(data=='done'){
                swal({
                  title: 'Added Successfully!',
                        text: "CRM User has been successfully Added",
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
    $(".active").click(function() {
        var user_id = $(this).attr('data-id');
        var type = "delete";
            swal({
              title: "Are you sure?",
              text: "You want to inactive this user!",
              icon: "warning",
              buttons: true,
            dangerMode: true,
          }).then((willDelete) => {
            if (willDelete) {
        $.ajax({
            url: "ajax/user_action",
            type: "POST",
            data: { "user_id": user_id, "type": type },
            dataType: "json",
            success: function(data) {
                if (data === 'done') {
                    swal({
                        title: "Inactive!",
                        text: "Crm user has been inactivated.",
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
<script type="text/javascript">
    $(".inactive").click(function() {
        var user_id = $(this).attr('data-id');
        var type = "active";
            swal({
              title: "Are you sure?",
              text: "You want to active this user!",
              icon: "warning",
              buttons: true,
            dangerMode: true,
          }).then((willDelete) => {
            if (willDelete) {
        $.ajax({
            url: "ajax/user_action",
            type: "POST",
            data: { "user_id": user_id, "type": type},
            dataType: "json",
            success: function(data) {
                if (data === 'done') {
                    swal({
                        title: "Active!",
                        text: "Crm user date has been activated.",
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