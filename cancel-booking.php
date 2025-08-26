<?php
include("store_db_con.php");
$conn = dbconnect();
$today = date( 'Y-m-d H:i:s');
$booking_id = $_POST['booking_id'];
$cus_name = mysqli_real_escape_string($conn,$_POST['cus_name']);
$mobile = mysqli_real_escape_string($conn,$_POST['mobile']);
$reason = mysqli_real_escape_string($conn,$_POST['reason']);

$booking_sample= '#JT31052500';

$book_id = str_replace($booking_sample, '', $booking_id);

$query  = "SELECT * FROM tb_cancel WHERE booking_id='".$book_id."'";
$res_query = mysqli_query($conn,$query);
$fetch = mysqli_fetch_object($res_query);
$num_rows= mysqli_num_rows($res_query); // Get the number of rows

if($num_rows == 1 )
{
$code = 'exist';
}
else
{

$query2  = "SELECT * FROM tb_booking WHERE payment=1 AND booking_id='".$book_id."'";
$res_query2 = mysqli_query($conn,$query2);
$fetch2 = mysqli_fetch_object($res_query2);
$num_rows2= mysqli_num_rows($res_query2); // Get the number of rows

if($num_rows2 == 1)
{

$sql1 = "INSERT INTO tb_cancel(booking_id, cus_name, mobile, reason, status, crm_id, updated_log, created_log) VALUES ('$book_id','$cus_name','$mobile','$reason','0','0','$today','$today')";
//echo $sql;
$content_res1 = mysqli_query($conn, $sql1); 

$code = 'yes';

}
else
{
	$code = 'no';

}
}
echo $data = json_encode($code);

?>