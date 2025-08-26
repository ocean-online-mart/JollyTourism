<?php
include("../store_db_con.php");
$conn = dbconnect();
error_reporting(1);
date_default_timezone_set('Asia/Kolkata');
session_start(); 
$crm_id = $_SESSION['jt_id'];
$today = date('Y-m-d H:i:s');
$type = isset($_GET['type']) ? $_GET['type'] : '';

if (!isset($_SESSION['jt_id'])) {
    echo json_encode(['error' => 'Unauthorized access']);
    exit;
}

$id = intval($_GET['img_id']);
    $query = "SELECT image_url,is_active FROM offer_banners WHERE banner_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $image_url = htmlspecialchars($row['image_url']);
        $status = $row['is_active'];
        ?>
        <div class="modal-header">
            <h5 class="modal-title" id="editmodalLabel">Edit Offer Banner</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="editBannerForm" enctype="multipart/form-data">
                <input type="hidden" name="type" value="replace">
                <input type="hidden" name="banner_id" value="<?php echo $id; ?>">
                <div class="row">
                     <div class="col-md-6">
                        <div class="mb-3">
                            <label for="formrow-inputState" class="form-label">Offer Status</label>
                            <select type="text" id="ford" name="offer_status" class="form-control form-select" required>
                                <option value="" selected>Choose Position</option>
                                <option value="0" <?php if($status == NULL) echo 'selected'; ?>>In Active</option>
                                <option value="1" <?php if($status == 1) echo 'selected'; ?>>Active</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                         <label for="formrow-inputState" class="form-label">current Banner</label>
                        <div class="mb-3 text-center">
                            <img id="currentImage" src="uploads/<?php echo $image_url; ?>" alt="Current Banner" class="img-fluid" style="max-height: 200px;">
                            <input type="hidden" name="current_image" value= "<?php echo $image_url ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="newImage" class="form-label">Upload New Banner Image</label>
                            <input type="file" class="form-control" id="newImage" name="image" accept="image/*">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                             <label for="formrow-inputState" class="form-label">New Banner</label>
                            <img id="imagePreview" src="#" alt="Image Preview" class="img-fluid mt-2 d-none" style="max-height: 200px;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <?php

                        ?>
                        <button type="button" class="btn btn-secondary" id="removeImage">Remove</button>
                        <button type="submit" id="editBanner" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
        <script>
            // JavaScript for real-time image preview
            document.getElementById('newImage').addEventListener('change', function(event) {
                const file = event.target.files[0];
                const preview = document.getElementById('imagePreview');
                const removeBtn = document.getElementById('removeImage');
                if (file) {
                    preview.src = URL.createObjectURL(file);
                    preview.classList.remove('d-none');
                    removeBtn.classList.add('d-block');
                } else {
                    preview.src = '#';
                    preview.classList.add('d-none');
                    removeBtn.classList.add('d-none');
                }
            });
            document.getElementById('removeImage').addEventListener('click', function() {
                const fileInput = document.getElementById('newImage');
                const preview = document.getElementById('imagePreview');
                fileInput.value = ''; // Clear the file input
                preview.src = '#';
                preview.classList.add('d-none'); // Hide the preview
            });
        </script>
        <?php
    } else {
        echo '<div class="modal-body"><p>Banner not found.</p></div>';
    }
    mysqli_stmt_close($stmt);
?>
<script>
    $('#editBanner').click(function(e) {
         var form = $('#editBannerForm')[0];
        var formData = new FormData(form);
        e.preventDefault();
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
                  title: 'changed Successfully!',
                        text: "Offer Banner has been successfully Changed",
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
    });
</script>