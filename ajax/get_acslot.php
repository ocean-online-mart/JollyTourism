<?php
/* Database connection */
include("../store_db_con.php");
$conn = dbconnect();
session_start();

$act_date = $_POST['act_da'];
$mc_id = $_POST['mc_id'];
$act_id = $_POST['activities_id'];
$today = date('Y-m-d');
if($act_date != '')
{
$timestamp = strtotime(str_replace('/', '-', $act_date));
$formatted_actdate = date('Y-m-d', $timestamp);
$activityd_query = "SELECT * FROM tb_activitiy_date WHERE status != 1 AND act_id= '$act_id' AND mc_id= '$mc_id' AND act_date= '$formatted_actdate'";
$activityd_rec = mysqli_query($conn, $activityd_query);
$activityd_row = mysqli_fetch_object($activityd_rec);
$act_dateid =$activityd_row->act_dateid;
}
$time = date('H:i');
if($formatted_actdate == $today)
{
   $date_compare = "AND slot_time >= '$time'";
}
$slot_query = "SELECT * FROM tb_activity_slot WHERE status != 1 and total_availability !=0 and actdate_id ='$act_dateid' {$date_compare} ";
echo $slot_query;
$slot_rec = mysqli_query($conn, $slot_query);
?>
<option value="" selected="selected" disabled="disabled">Select </option>
<?php
while($slot_row = mysqli_fetch_object($slot_rec))
{
$slot_id =$slot_row->slot_id;
$slot_name =$slot_row->slot_name;
?>
<option value="<?php echo $slot_id; ?>"><?php echo $slot_name; ?></option>
<?php
}
?>
