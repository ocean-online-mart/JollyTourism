<?php
include("../store_db_con.php");
$conn = dbconnect();
error_reporting(1);
date_default_timezone_set('Asia/Kolkata');
session_start(); 
$admin_id = $_SESSION['jt_id'];
$today = date( 'Y-m-d H:i:s');
$type = $_POST['type'];

echo json_encode($_POST);
$status = $_POST['status'];
die();         
// if($status == 1 && $type == 'add') {

   
// }
if($type=='delete')
{
  $act_dateid = mysqli_real_escape_string($conn, $_POST['act_dateid']);
$sql = "UPDATE tb_activitiy_date SET status ='1',crm_id='$admin_id',updated_log='$today' WHERE act_dateid='$act_dateid'";
$content_res = mysqli_query($conn, $sql); 

$sql2 = "UPDATE tb_activity_slot SET status ='1',crm_id='$admin_id',updated_log='$today' WHERE actdate_id='$act_dateid'";
$content_res2 = mysqli_query($conn, $sql2); 

$code = 'done';
}
else if($type=='active')
{
  $act_dateid = mysqli_real_escape_string($conn, $_POST['act_dateid']);
$sql = "UPDATE tb_activitiy_date SET status ='0',crm_id='$admin_id',updated_log='$today' WHERE act_dateid='$act_dateid'";
$content_res = mysqli_query($conn, $sql); 

$sql2 = "UPDATE tb_activity_slot SET status ='0',crm_id='$admin_id',updated_log='$today' WHERE actdate_id='$act_dateid'";
$content_res2 = mysqli_query($conn, $sql2); 

$code = 'done';
}
else if($type== 'add'){ 
  $status = $_POST['status'];
  // echo json_encode($_POST);
  // die();
    if ($status == 1) { 
      $act_id = mysqli_real_escape_string($conn, $_POST['activity_id']);
      $activity_date = mysqli_real_escape_string($conn,$_POST['activity_date']);
      $slots = $_POST['slot'];
     
      $sql ="SELECT * FROM `tb_activitiy_date` WHERE act_id='$act_id' AND act_date = '$activity_date' AND status = 0";
      // $sql = "UPDATE tb_activitiy_date SET status ='1',crm_id='$admin_id',updated_log='$today' WHERE act_id='$act_id' AND act_date = '$activity_date'";
      $content_res = mysqli_query($conn, $sql); 
      if ($content_res) {
        $fetch_url = mysqli_fetch_object($content_res);
        $act_date_id = $fetch_url->act_dateid;
        foreach($slots as $slot){
           $slot_query  = "SELECT slot_value FROM tb_slot WHERE slot_id2='$slot'";
            $res_slot = mysqli_query($conn,$slot_query);
            $fetch_slot = mysqli_fetch_object($res_slot);
            if (!$fetch_slot) continue;
            $slot_value=$fetch_slot->slot_value;
            $sql2 = "UPDATE tb_activity_slot SET status ='1', crm_id='$admin_id',updated_log='$today' WHERE actdate_id= $act_date_id AND slot_time = '$slot_value'";
          $content_res2 = mysqli_query($conn, $sql2); 
          $code = 'inactive done';
        }
      }
  }else{
      $activity_date = mysqli_real_escape_string($conn,$_POST['activity_date']);
      $slot_array = $_POST['slot'];
      $activity_id = $_POST['activity_id'];
      $url_query  = "SELECT * FROM tb_activities WHERE activity_id='$activity_id'";
      $res_url = mysqli_query($conn,$url_query);
      $fetch_url = mysqli_fetch_object($res_url);
      $mc_id=$fetch_url->mc_id;
      
      $act_date = 
      
      $dates = explode(' to ', $activity_date);
      
      if (count($dates) === 2) {
      $startDate = trim($dates[0]);
      $endDate = trim($dates[1]);
      
      // Validate both dates
      if (strtotime($startDate) && strtotime($endDate)) {
      $start = new DateTime($startDate);
      $end = new DateTime($endDate);
      $end->modify('+1 day'); // Include end date
      
      $interval = new DateInterval('P1D');
      $dateRange = new DatePeriod($start, $interval, $end);
      
      foreach ($dateRange as $date) {
      $act_date = $date->format('Y-m-d');
      
      $date_query  = "SELECT * FROM tb_activitiy_date WHERE act_id='$activity_id' AND act_date='$act_date'";
      $date_slot = mysqli_query($conn,$date_query);
      $fetch_date = mysqli_fetch_object($date_slot);   
      $num_rows= mysqli_num_rows($date_slot); // Get the number of rows
      
      if($num_rows == 0)
      {
      
      $sql = "INSERT INTO tb_activitiy_date(mc_id,act_id,act_date,crm_id,status,updated_log,created_log) VALUES ('$mc_id','$activity_id','$act_date','$admin_id','$status','$today','$today')";
      //echo $sql;
      $content_res = mysqli_query($conn, $sql); 
      $last_id = $conn->insert_id;
      
      foreach ($slot_array as $slots) {
      
      $slot_query  = "SELECT * FROM tb_slot WHERE slot_id2='$slots'";
      $res_slot = mysqli_query($conn,$slot_query);
      $fetch_slot = mysqli_fetch_object($res_slot);
      if (!$fetch_slot) continue;
      $slot_value=$fetch_slot->slot_value;
      $slot=$fetch_slot->slot;
      
      
      $sql1 = "INSERT INTO tb_activity_slot(actdate_id, slot_time, slot_name, total_slot, total_availability, crm_id, status, updated_log, created_log) VALUES ('$last_id','$slot_value','$slot','50','50','$admin_id','0','$today','$today')";
      //echo $sql;
      $content_res1 = mysqli_query($conn, $sql1); 
      }
      
      }
      }
      }
      }
      $code = 'done';
  }

}

echo $data = json_encode($code);
?>