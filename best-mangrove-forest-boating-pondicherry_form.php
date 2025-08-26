<?php
/* Database connection */
include("store_db_con.php");
$conn = dbconnect();
session_start();

$mc_id = base64_encode($_POST['mc_name']);
$activities_id = base64_encode($_POST['activities']);
$act_date = base64_encode($_POST['act_date']);
$person = base64_encode($_POST['person']);

header("Location: best-mangrove-forest-boating-pondicherry?id=$activities_id&act_date=$act_date");
?>
