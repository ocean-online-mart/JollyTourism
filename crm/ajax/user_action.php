<?php
include("../store_db_con.php");
$conn = dbconnect();
error_reporting(1);
date_default_timezone_set('Asia/Kolkata');
session_start(); 
$crm_id = $_SESSION['jt_id'];
$today = date( 'Y-m-d H:i:s');
$user_id = $_POST['user_id'];
$type = $_POST['type'];

if($type=='delete')
{
$sql = "UPDATE tb_admin SET status ='1',crm_id='$crm_id',updated_log='$today' WHERE admin_id='$user_id'";

$content_res = mysqli_query($conn, $sql); 
$code = 'done';
}
if($type=='active')
{
$sql = "UPDATE tb_admin SET status ='0',crm_id='$crm_id',updated_log='$today' WHERE admin_id='$user_id'";

$content_res = mysqli_query($conn, $sql); 
$code = 'done';
}
else if($type== 'add'){
$emp_name = mysqli_real_escape_string($conn,$_POST['emp_name']);
$position = mysqli_real_escape_string($conn,$_POST['position']);
$password = mysqli_real_escape_string($conn,$_POST['password']);
$username = mysqli_real_escape_string($conn,$_POST['username']);

$sql = "INSERT INTO tb_admin(name,username,password,position,crm_id,status,updated_log,created_log) VALUES ('$emp_name','$username','$password','$position','$crm_id','0','$today','$today')";
$content_res = mysqli_query($conn, $sql); 
$code = 'done';
}
else if($type== 'update')
{
$user_id = $_POST['user_id'];
$emp_name = mysqli_real_escape_string($conn,$_POST['emp_name']);
$position = mysqli_real_escape_string($conn,$_POST['position']);
$password = mysqli_real_escape_string($conn,$_POST['password']);
$username = mysqli_real_escape_string($conn,$_POST['username']);

$sql = "UPDATE tb_admin SET name='$emp_name',username='$username',password='$password',status='$status',crm_id='$crm_id',updated_log='$today',position='$position' WHERE admin_id='$user_id'";
$content_res = mysqli_query($conn, $sql); 
$code = 'done';
}

echo $data = json_encode($code);
?>