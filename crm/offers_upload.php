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
   <style>
  .card-body {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    color: #fff; /* Optional: Adjust text color for better visibility on background */
    position: relative;
  }
  .card-body::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.3); /* Optional: Add overlay for better text readability */
    z-index: 1;
  }
  .card-body > * {
    position: relative;
    z-index: 2;
  }
  .dropzone {
    cursor: pointer;
    background-color: #f8f9fa;
  }
  .dropzone:hover {
    background-color: #e9ecef;
  }
  #imagePreview {
    margin: auto; /* Center image horizontally */
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

              $image_query = "SELECT b.image_url,b.banner_id,b.uploaded_user,a.name AS uploader_name 
                                FROM offer_banners b JOIN tb_admin a ON b.uploaded_user = a.admin_id ORDER BY b.banner_id ASC";
                // echo $image_query;
                  $_res = mysqli_query($conn, $image_query);
              while($crm_row = mysqli_fetch_object($_res))
              {
              $crm_name = ucwords(strtolower($crm_row->uploader_name));
            //   print_r($crm_name);
              $img_id = $crm_row->banner_id;
              $img_url = $crm_row->image_url;
              ?>
              <div class="col-3 mb-3">
                <div class="card">
                  <div class="card-body text-center">
                      <div class="profile-media text-center">
                          <img src="uploads/<?php echo htmlspecialchars($img_url); ?>"  style="max-height: 300px;" alt="Uploaded Image">
                      </div>
                      <h6 class="mt-2"><?php echo $crm_name; ?></h6>
                      <div class="mt-3"> 
                        <button data-bs-toggle="modal" data-bs-target="#editmodal" data-id="<?php echo $img_id ?>" class="btn openModal btn-sm btn-primary">Edit</button>
                        <button  data-id="<?php echo $img_id; ?>" class="btn btn-sm delete">delete</button>
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
            <form class="admin-form" id="imageForm" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="type" value="add">
                      <input type="hidden" name="admin_id" value="<?php echo $crm_id; ?>">
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                    <label for="imageUpload" class="form-label">Upload Image</label>
                                    <div class="card">
                                        <div class="card-body text-center">
                                        <div class="dropzone border border-2 border-dashed p-4" id="dropzone">
                                            <input type="file" class="form-control visually-hidden" id="imageUpload" name="image" accept="image/*">
                                            <p class="mb-0 text-secondary">Drag and drop an image here or click to upload</p>
                                        </div>
                                        <div class="mt-3 d-flex justify-content-center align-items-center flex-column" style="min-height: 200px;">
                                            <img id="imagePreview" class="img-fluid" style="max-height: 200px; display: none;" alt="Image Preview">
                                            <button type="button" id="removeButton" class="btn btn-sm btn-danger mt-2" style="display: none;">Remove</button>
                                        </div>
                                        </div>
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
     <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/js/sweet-alert/sweetalert.min.js"></script>
    <script src="assets/css/validation/jquery.validate.min.js"></script>
    <script src="assets/css/validation/form-validation.js"></script>
    <script type="text/javascript">
    $(".delete").click(function() {
        var img_id = $(this).attr('data-id');
        var type = "delete";
            Swal.fire({
                title: "Are you sure?",
                text: "You want to delete this Offer!",
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
            url: "ajax/Offers_action",
            type: "POST",
             data:{"image_id":img_id,"type":type},
            dataType: "json",
            success: function (data) {
              // console.log(data);
              if(data=='done'){
                Swal.fire({
                    title: "Deleted!",
                    text: "Your offer banner has been deleted.",
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
        });

 $('.openModal').click(function() {
        var id = $(this).attr('data-id');
        // console.log(id);
        
        $.ajax({
            url: "ajax/get_offBanner",
            type:"GET",
            data:{"img_id":id, "type":"getImg"},
            success: function(result) {
              // console.log(result);
              
                $(".edit-content").html(result);
            }
        });
    });
</script>

<!-- <script type="text/javascript">
  $('.openModal').click(function(){
      var id = $(this).attr('data-id');
      $.ajax({url:"useredit_model.php?id="+id,cache:false,success:function(result){
          $(".edit-content").html(result);
      }});
  });
</script> -->
    <script type="text/javascript">
  // initialize validate plugin on the form
    $("#imageForm").validate({
        errorPlacement: function(error, element) {
            var ele = $(element),
                err = $(error),
                msg = err.text();
            if (msg != null && msg !== "") {
                ele.tooltipster('content', msg);
                ele.tooltipster('open');
            }
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass(errorClass).addClass(validClass).tooltipster('close');
        },
       
        submitHandler: function(form) { // for demo
         var form = $('#imageForm')[0];
        var formData = new FormData(form);
        event.preventDefault();
         $("#sub-btn").attr("disabled", true);
            $.ajax({
            type: 'POST',
            url: 'ajax/Offers_action',
            processData: false,
            contentType: false,
            dataType: "json",
            data: formData,
            success: function (data) {
                console.log(data);
              if(data=='done'){
                swal({
                  title: 'Added Successfully!',
                        text: "Offer Banner has been successfully Added",
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
                  console.log(data);
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
  
document.addEventListener('DOMContentLoaded', function () {
  const dropzone = document.getElementById('dropzone');
  const fileInput = document.getElementById('imageUpload');
  const imagePreview = document.getElementById('imagePreview');
  const removeButton = document.getElementById('removeButton');

  // Handle click to trigger file input
  dropzone.addEventListener('click', () => {
    fileInput.click();
  });

  // Handle file selection
  fileInput.addEventListener('change', (e) => {
    const file = e.target.files[0];
    if (file && file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = function (e) {
        imagePreview.src = e.target.result;
        imagePreview.style.display = 'block';
        removeButton.style.display = 'block';
      };
      reader.readAsDataURL(file);
    }
  });

  // Handle drag and drop
  dropzone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropzone.classList.add('border-primary');
  });

  dropzone.addEventListener('dragleave', () => {
    dropzone.classList.remove('border-primary');
  });

  dropzone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropzone.classList.remove('border-primary');
    const file = e.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
      fileInput.files = e.dataTransfer.files;
      const reader = new FileReader();
      reader.onload = function (e) {
        imagePreview.src = e.target.result;
        imagePreview.style.display = 'block';
        removeButton.style.display = 'block';
      };
      reader.readAsDataURL(file);
    }
  });

  // Handle remove button click
  removeButton.addEventListener('click', () => {
    fileInput.value = ''; // Clear file input
    imagePreview.src = '';
    imagePreview.style.display = 'none';
    removeButton.style.display = 'none';
  });
});
</script>
  </body>
</html>