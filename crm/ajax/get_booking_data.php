<?php
/* Database connection */
include("../store_db_con.php");
$conn = dbconnect();
session_start();

$act_id = $_POST['act_id'];
$mc_id = $_POST['mc_id'];
$act_da = $_POST['act_da'];
$slot = $_POST['slot'];
$adult = $_POST['adult'];
$children = $_POST['children'];
$discount = $_POST['discount'];


if($act_id !='')
{
$activity_query = "SELECT * FROM tb_activities WHERE status != 1 AND activity_id= '$act_id'";
$activity_rec = mysqli_query($conn, $activity_query);
$activity_row = mysqli_fetch_object($activity_rec);
$activity_id =$activity_row->activity_id;
$mc_id =$activity_row->mc_id;
$activity_name =ucwords(strtolower($activity_row->activity_name));
$act_amount =$activity_row->amount;

if($act_da != '')
{
$timestamp = strtotime(str_replace('/', '-', $act_da));
$formatted_actdate = date('Y-m-d', $timestamp);
$activityd_query = "SELECT * FROM tb_activitiy_date WHERE status != 1 AND act_id= '$act_id' AND mc_id= '$mc_id' AND act_date= '$formatted_actdate'";
$activityd_rec = mysqli_query($conn, $activityd_query);
$activityd_row = mysqli_fetch_object($activityd_rec);
$act_dateid =$activityd_row->act_dateid;
$actdate = date('d M Y', strtotime($formatted_actdate));
}
if($slot != '')
{
$slot_querys = "SELECT * FROM tb_activity_slot WHERE slot_id ='$slot'";
$slot_recs = mysqli_query($conn, $slot_querys);
$slot_rows = mysqli_fetch_object($slot_recs);
$slot_names =$slot_rows->slot_name;
}
else
{
	$slot_names = '';
}
}

if($adult !='')
{
$child_amount = $act_amount/2;
$a_total = $act_amount * $adult;
$c_total = $child_amount * $children;
$total = $a_total + $c_total;
$f_total = $total - $discount;
$adult = $adult.' Adult';
$children = $children.' Children';
}
else
{
   $actdate = '-';
   $adult = '0 Adult';
   $children = '0 Children';
   $c_total = 0;
   $total = 0;
   $p_charge = 0;
   $f_total = 0;
}

$adate = date('d M Y', strtotime($formatted_actdate));

echo json_encode([
    'ac_date' => $adate,
    'ac_slot' => $slot_names,
    'ac_adult' => $adult,
    'ac_child' => $children,
    'ac_amount' => $act_amount,
    'ac_total' => $total,
    'ac_subtotal' =>$total,
    'ac_finaltotal' => $f_total
]);

?>