<?php 
include("../store_db_con.php");
$conn = dbconnect();
error_reporting(1);
session_start();

date_default_timezone_set('Asia/Kolkata'); 
	$today = date( 'Y-m-d H:i:s');
$username = $_POST['username'];
$password = $_POST['password'];
$query  = "SELECT * FROM tb_admin WHERE username='".$username."' AND password='".$password."' AND status != 1 ";
//echo $query;
$res_query = mysqli_query($conn,$query);
$fetch = mysqli_fetch_object($res_query);
$num_rows= mysqli_num_rows($res_query); // Get the number of rows

if($num_rows >0)
{
$name=$fetch->username;
$admin_id=$fetch->admin_id;
$_SESSION['username'] = $name;
$_SESSION['jt_id']= $admin_id;
$code = 'yes';
}
else 
{
    $code = 'no';
}
// echo json_encode(['code'=>$code, 'name'=>$name]);
 echo $data = json_encode($code);
?> 
