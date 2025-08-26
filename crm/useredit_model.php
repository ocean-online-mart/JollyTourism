<?php 
error_reporting(1);
include("store_db_con.php");
$conn = dbconnect();
 
$id = $_GET['id'];

$today= date('Y-m-d');

$content_query = "SELECT * FROM tb_admin WHERE admin_id = '$id'";
$content_res = mysqli_query($conn, $content_query);
$content_row = mysqli_fetch_object($content_res);
$admin_id=$content_row->admin_id;
$name=$content_row->name;
$position=$content_row->position;
$password=$content_row->password;
$user_name=$content_row->username;
$status=$content_row->status;
?>
  <form class="admin-forms" id="admineditForm" enctype="multipart/form-data">
  <div class="modal-header">
      <h5 class="modal-title" id="staticBackdropLabel">Edit CRM User</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">
      <input type="hidden" name="type" value="update">
      <input type="hidden" name="user_id" value="<?php echo $admin_id ?>">
       <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
                <label for="formrow-firstname-input" class="form-label">Employee Name</label>
                <input type="text" class="form-control" name="emp_name" id="formrow-firstname-input" placeholder="Enter Employee Name" value="<?php echo $name ?>" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="formrow-password-input" class="form-label">Username</label>
                <input type="text" class="form-control" value="<?php echo $user_name ?>" name="username" placeholder="Enter Username" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="formrow-input" class="form-label">Password</label>
                <input type="text" class="form-control" id="phone-input"  name="password" placeholder="Enter password" required>
            </div>
        </div>
        <div class="col-md-6">
           <div class="mb-3">
                <label for="formrow-inputState" class="form-label">Position</label>
                <select type="text" id="ford" name="position" class="form-control form-select" required>
                    <option value="" selected>Choose Position</option>
                    <option value="1" <?php if($position == 1) echo 'selected'; ?>>Super Admin</option>
                    <option value="2" <?php if($position == 2) echo 'selected'; ?>>Main Admin</option>
                    <option value="3" <?php if($position == 3) echo 'selected'; ?>>Booking Team</option>
                </select>
            </div>

        </div>
      </div>
  </div>
  <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
       <button type="submit" id="sub-btns" class="btn btn-success w-md">Submit</button>
  </div>
  </form>
 <script src="assets/css/validation/jquery.validate.min.js"></script>
    <script src="assets/css/validation/form-validation.js"></script>
   <script type="text/javascript">
  // initialize validate plugin on the form
    $("#admineditForm").validate({
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
         var form = $('#admineditForm')[0];
        var formData = new FormData(form);
        event.preventDefault();
         $("#sub-btns").attr("disabled", true);
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
                  title: 'Updated Successfully!',
                        text: "CRM User has been successfully updated",
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
