<?php
/* Database connection */
include("store_db_con.php");
$conn = dbconnect();
session_start();

$mc_id = base64_encode($_POST['mc_name']);
$activities_id = base64_encode($_POST['act_id']);
$act_date = base64_encode($_POST['act_date']);
$slot = base64_encode($_POST['slot']);
$adult = base64_encode($_POST['adult']);
$children = base64_encode($_POST['children']);

header("Location: booking-confirmation?id=$activities_id&act_date=$act_date&mc_id=$mc_id&slot=$slot&adult=$adult&children=$children");
?>
