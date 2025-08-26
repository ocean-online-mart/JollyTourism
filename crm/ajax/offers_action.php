<?php
include("../store_db_con.php");
$conn = dbconnect();
error_reporting(1);
date_default_timezone_set('Asia/Kolkata');
session_start(); 
$crm_id = $_SESSION['jt_id'];
$today = date( 'Y-m-d H:i:s');
$user_id = $_POST['admin_id'];
$type = isset($_POST['type']) ? $_POST['type'] : '';

if (!isset($_SESSION['jt_id'])) {
    echo json_encode('error: Unauthorized access');
    exit;
}

$uploadDir = '../uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
$maxFileSize = 5 * 1024 * 1024; 

// echo  json_encode($user_id);

if ($type == "add") {
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $file = $_FILES['image'];
        $fileType = $file['type'];
        $fileSize = $file['size'];

        // Validate file type and size
        if (!in_array($fileType, $allowedTypes)) {

            echo json_encode('error: Invalid file type. Only JPEG, PNG, and GIF are allowed.');
            exit;
        }
        if ($fileSize > $maxFileSize) {
            echo json_encode('error: File size exceeds 5MB limit.');
            exit;
        }

        // Generate unique filename
        $filename = uniqid() . '_' . basename($file['name']);
        $filename = mysqli_real_escape_string($conn, $filename);
        $destination = $uploadDir . $filename;
        $admin_id = mysqli_real_escape_string($conn, $user_id);

        // Move file to uploads directory
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            $query = "INSERT INTO offer_banners (image_url, uploaded_user) VALUES ('$filename', '$admin_id')";
            if (mysqli_query($conn, $query)) {
                echo json_encode('done');
            } else {
                echo json_encode('error: Database insertion failed');
            }
        } else {
            echo json_encode('error: File upload failed');
        }
    } else {
        echo json_encode('error: No file uploaded or upload error');
    }
}elseif ($type == "replace") {
  
    $image_id = isset($_POST['banner_id']) ? mysqli_real_escape_string($conn, $_POST['banner_id']) : '';
    $status = $_POST['offer_status']; 
    $oldImage = $_POST['current_image'];
    $files = $_FILES['image'];
    // echo json_encode($_POST);
    // die();
    if (!$image_id) {
        echo json_encode('error: Image ID missing');
        exit;
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $file = $_FILES['image'];
        $fileType = $file['type'];
        $fileSize = $file['size'];

        // Validate file type and size
        if (!in_array($fileType, $allowedTypes)) {
            echo json_encode('error: Invalid file type. Only JPEG, PNG, and GIF are allowed.');
            exit;
        }
        if ($fileSize > $maxFileSize) {
            echo json_encode('error: File size exceeds 5MB limit.');
            exit;
        }

        // Delete old image
        $query = "SELECT image_url FROM offer_banners WHERE banner_id  = '$image_id'";
        $result = mysqli_query($conn, $query);
        if ($row = mysqli_fetch_object($result)) {
            $old_file = $uploadDir . $row->filename;
            if (file_exists($old_file)) {
                unlink($old_file);
            }
        } else {
            echo json_encode('error: Image not found');
            exit;
        }

        // Upload new image
        $filename = uniqid() . '_' . basename($file['name']);
        $filename = mysqli_real_escape_string($conn, $filename);
        $destination = $uploadDir . $filename;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            $query = "UPDATE offer_banners SET image_url = '$filename', is_active = '$status' WHERE banner_id = '$image_id'";
            if (mysqli_query($conn, $query)) {
                echo json_encode('done');
            } else {
                echo json_encode('error: Database update failed');
            }
        } else {
            echo json_encode('error: File upload failed');
        }
    } 
    else {
        if ($oldImage) {
            // print_r($oldImage);
            // print_r($status);
            $query = "UPDATE offer_banners SET image_url = '$oldImage', is_active = '$status' WHERE banner_id = '$image_id'";
            if (mysqli_query($conn, $query)) {
                echo json_encode('done');
            } else {
                echo json_encode('error: Database update failed');
            }
        } else {
            echo json_encode('error');
        }
    }
} elseif ($type == "delete") {
    $image_id = isset($_POST['image_id']) ? mysqli_real_escape_string($conn, $_POST['image_id']) : '';
    // print_r($image_id);
    // die();
    if (!$image_id) {
        echo json_encode('error: Image ID missing');
        exit;
    }

    $query = "SELECT image_url FROM offer_banners WHERE banner_id = '$image_id'";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_object($result)) {
        $filename = $row->image_url;
        $file_path = $uploadDir . $filename;
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        $delete_query = "DELETE FROM offer_banners WHERE banner_id = '$image_id'";
        if (mysqli_query($conn, $delete_query)) {
            echo json_encode('done');
        } else {
            echo json_encode('error: Database deletion failed');
        }
    } else {
        echo json_encode('error: Image not found');
    }
} else {
    echo json_encode('error: Invalid action type');
}

mysqli_close($conn);
