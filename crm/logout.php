<?php
header('Refresh: 0;');
error_reporting(0);
include("store_db_con.php");
$conn = dbconnect();
session_start();
session_destroy();
$home_url = 'https://jollytourism.com/crm/';
header('Location: ' . $home_url);
?>