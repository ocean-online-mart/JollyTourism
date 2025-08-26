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
         <div class="container">
               <form method="POST" id="cancelForm" class="mt-40">
               <div class="row">
                  <div class="col-lg-12">
                     <h2 class="h4">Cancellation Request</h2>
                     <div class="row">
                        <div class="col-md-4 form-group"><input type="text" name="booking_id" class="form-control booking_id" placeholder="Booking Id (Check your booking conformation mail)" required></div>
                        <div class="col-md-4 form-group"><input type="text" name="cus_name" class="form-control" placeholder="Enter your Name" required></div>
                        <div class="col-md-4 form-group"><input type="text" name="mobile" class="form-control" placeholder="Enter your Mobile Number" required></div>
                        <div class="col-12 form-group"><textarea cols="20" rows="5" name="reason" class="form-control" placeholder="Write your cancellation reason for few words..." required></textarea></div>
                        <div class="col-md-4">
                        <button type="submit" class="btn  btn-danger cancel-btn">Cancel Booking</button>
                        </div>
                        <div class="mt-3 error d-none">
                           <h6 class="text-danger"><b>Invaild Booking id</b></h6>
                        </div>
                        <div class="mt-3 success d-none">
                           <h6 class="text-success"><b>Your Cancellation Request sent. We'll Contact you soon.</b></h6>
                        </div>
                        <div class="mt-3 exist d-none">
                           <h6 class="text-warning"><b>Your Cancellation Request already sent. We'll Contact you soon.</b></h6>
                        </div>
                     </div>
                  </div>
                  
               </div>
            </form>
         </div>
      
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
      <script type="text/javascript">
         $("#cancelForm").submit(function(e) {

             e.preventDefault(); // avoid to execute the actual submit of the form.

             var form = $(this);
             var actionUrl = 'cancel-booking';
             $.ajax({
                 type: "POST",
                 url: actionUrl,
                 dataType: "json",
                 data: form.serialize(), // serializes the form's elements.
                 success: function(data)
                 {
                  if(data == "yes")
                 {
                   $('.success').removeClass('d-none');
                   $('.exist').addClass('d-none');
                   $('.error').addClass('d-none');
                   $('.cancel-btn').prop('disabled', true);
                 }
                 else if(data == "exist")
                 {
                  $('.exist').removeClass('d-none');
                  $('.success').addClass('d-none');
                  $('.error').addClass('d-none');
                  $('.cancel-btn').prop('disabled', true);
                 }
                 else
                 {
                  $('.error').removeClass('d-none');
                  $('.exist').addClass('d-none');
                  $('.success').addClass('d-none');
                  $('.cancel-btn').prop('disabled', false);
                 }
                 }
             });
             
         });
      </script>
   </body>
</html>