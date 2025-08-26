<?php
/* Database connection */
include("store_db_con.php");
$conn = dbconnect();
session_start();
$today = date( 'Y-m-d H:i:s');
$act_id = $_POST['act_id'];
$mc_id = $_POST['mc_id'];
$act_da = $_POST['act_date'];
$slot = $_POST['slot'];
$adult = $_POST['adult'];
$children = $_POST['children'];
$cus_name = $_POST['cus_name'];
$phone_no = $_POST['phone_no'];
$email_id = $_POST['email_id'];
$location = $_POST['location'];
$payment_id = $_POST['payment_id'];
$amount_recieved = $_POST['amount_recieved'];
$payment_type = $_POST['payment_type'];
$discount = $_POST['discount'];
$created_log = $_POST['created_log'];
$create = $created_log.':00';

if($act_id !='')
{
$activity_query = "SELECT * FROM tb_activities WHERE status != 1 AND activity_id= '$act_id'";
$activity_rec = mysqli_query($conn, $activity_query);
$activity_row = mysqli_fetch_object($activity_rec);
$activity_id =$activity_row->activity_id;
$mc_id =$activity_row->mc_id;
$activity_name =ucwords(strtolower($activity_row->activity_name));
$act_amount =$activity_row->amount;

$timestamp = strtotime(str_replace('/', '-', $act_da));
$formatted_actdate = date('Y-m-d', $timestamp);
$activityd_query = "SELECT * FROM tb_activitiy_date WHERE status != 1 AND act_id= '$act_id' AND mc_id= '$mc_id' AND act_date= '$formatted_actdate'";
$activityd_rec = mysqli_query($conn, $activityd_query);
$activityd_row = mysqli_fetch_object($activityd_rec);
$act_dateid =$activityd_row->act_dateid;

$slot_querys = "SELECT * FROM tb_activity_slot WHERE slot_id ='$slot'";
$slot_recs = mysqli_query($conn, $slot_querys);
$slot_rows = mysqli_fetch_object($slot_recs);
$slot_names =$slot_rows->slot_name;
$total_availability =$slot_rows->total_availability;
$avail = $total_availability - 1;

$child_amount = $act_amount/2;
$a_total = $act_amount * $adult;
$c_total = $child_amount * $children;
$total = $a_total + $c_total;
$p_charge = 0;
$f_total = $total + $p_charge;

$sql = "INSERT INTO tb_booking(cus_name,phone_no,email_id,location,act_id,mc_id,activity_name,act_amount,act_dateid,act_date,slot_id,slot_name,adult,children,adult_amount,children_amount,total_amount,p_charge,discount,amount_recieved,payment,payment_id,booking_type,payment_type,status,updated_log,created_log) VALUES ('$cus_name','$phone_no','$email_id','$location','$act_id','$mc_id','$activity_name','$act_amount','$act_dateid','$formatted_actdate','$slot','$slot_names','$adult','$children','$a_total','$c_total','$total','$p_charge','$discount','$amount_recieved','1','$payment_id','admin','$payment_type','1','$create','$create')";
$content_res = mysqli_query($conn, $sql); 
$last_id = $conn->insert_id;
$book_id = base64_encode($last_id);

$sql = "UPDATE tb_activity_slot SET total_availability='$avail' WHERE slot_id='$slot'";
$content_res = mysqli_query($conn, $sql); 

header("Location: booking_mail?bid=$book_id");


}
?>