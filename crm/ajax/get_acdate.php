<?php
/* Database connection */
include("../store_db_con.php");
$conn = dbconnect();
session_start();

$mc_id = $_POST['mc_id'];
$activities_id = $_POST['activities_id'];

$content_query1   = "SELECT * FROM tb_activitiy_date WHERE status = 1 AND mc_id='$mc_id' AND act_id='$activities_id' ORDER BY act_dateid ASC";
//echo $content_query1;
  $content_res1 = mysqli_query($conn, $content_query1);
 $disabled_dates = [];
  while ($content_row1 = mysqli_fetch_object($content_res1)) {
      $act_date = $content_row1->act_date;
      $formatted_date = date('d/m/Y', strtotime($act_date)); // Format as d/m/Y
    $disabled_dates[] = $formatted_date; // Add to array
  }


// Return JSON to JavaScript
header('Content-Type: application/json');
echo json_encode($disabled_dates);
?>