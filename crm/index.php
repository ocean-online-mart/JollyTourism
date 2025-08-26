<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Jolly Tourism - CRM Panel">
    <meta name="keywords" content="">
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
    <!-- login page start-->
    <div class="container-fluid p-0">
      <div class="row m-0">
        <div class="col-12 p-0">    
          <div class="login-card login-dark">
            <div>
              
              <div class="login-main"> 
                  <div><a class="logo" href="#"><img class="img-fluid for-light" src="assets/images/logo/logo_dark.png" alt="looginpage"></a></div>
                  <h4 class="text-center">Sign in your account </h4>
                  <p class="text-center">Enter your username & password to login</p>
                  <div class="form-group">
                    <label class="col-form-label">Username</label>
                    <input class="form-control" type="text" required="" id="username" placeholder="Enter your Username">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Password </label>
                    <div class="form-input position-relative">
                      <input class="form-control" type="password" id="password" name="login[password]" required="" placeholder="*********">
                      <div class="show-hide"> <span class="show"></span></div>
                    </div>
                  </div>
                  <div class="form-group mb-0">
                    
                    <div class="text-end mt-4">
                      <button class="btn btn-primary btn-block w-100" id="login">Sign in</button>
                    </div>
                  </div>
                  
              </div>
            </div>
          </div>
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
      <!-- Sidebar jquery-->
      <script src="assets/js/config.js"></script>
      <!-- Plugins JS start-->
      <!-- calendar js-->
      <!-- Plugins JS Ends-->
      <!-- Theme js-->
      <script src="assets/js/script.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#login").on('click', function(event){
           var username = $("#username").val();
           var password = $("#password").val();
           $('.form-control').css({'border':'1px solid #d5dae2'});
           if(username.length == '' && password.length =='')
           {
           $('.form-control').css({'border':'1px solid #ec0c17'});
           $('#password').css({'border':'1px solid #ec0c17'});
           }
           else if(username.length =='')
           {
            $('#username').css({'border':'1px solid #ec0c17'});
           }
           else if(password.length =='')
           {
            $('#password').css({'border':'1px solid #ec0c17'});
           }
           else
           {
            $("#login").attr("disabled", true);
           $.ajax({

            type: "POST",
            url:"ajax/login.php",
            data:{"username":username,"password":password},
            dataType:'json',

            success: function (data) {            
               if(data == 'no')
               {
                console.log('no');
                  $('#username').css({'border':'1px solid #ec0c17'});
                  $('#password').css({'border':'1px solid #ec0c17'});
                  // $('#username').val('');
                  // $('#password').val('');
               }
               else
               {
                   window.location.href ="dashboard"
               }
               
            }
          });
           $("#login").attr("disabled", false);
         }
        });
     });
</script>
  </body>

</html>