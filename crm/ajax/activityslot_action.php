<?php
include("../store_db_con.php");
$conn = dbconnect();
error_reporting(1);
date_default_timezone_set('Asia/Kolkata');
session_start(); 
$admin_id = $_SESSION['jt_id'];
$today = date( 'Y-m-d H:i:s');
$type = $_POST['type'];

if($type=='delete')
{
$slot_id = $_POST['slot_id'];
$sql = "UPDATE tb_activity_slot SET status ='1',crm_id='$admin_id',updated_log='$today' WHERE slot_id='$slot_id'";
$content_res = mysqli_query($conn, $sql); 
$code = 'done';
}
else if($type=='active')
{
$slot_id = $_POST['slot_id'];
$date_id = $_POST['date_id'];
$sql = "UPDATE tb_activity_slot SET status ='0',crm_id='$admin_id',updated_log='$today' WHERE slot_id='$slot_id'";
$content_res = mysqli_query($conn, $sql);

$sql3 = "UPDATE tb_activitiy_date SET status ='0',crm_id='$admin_id',updated_log='$today' WHERE act_dateid='$date_id'";
$content_res3 = mysqli_query($conn, $sql3); 

$code = 'done';
}

echo $data = json_encode($code);
?>