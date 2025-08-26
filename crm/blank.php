$query_booking_paid_mon  = "SELECT count(booking_id) as book_id FROM tb_booking WHERE status=1 AND payment=1 AND MONTH(updated_log) = '$today_month'";
$res_query_booking_paid_mon = mysqli_query($conn,$query_booking_paid_mon);
$fetch_booking_paid_mon  = mysqli_fetch_object($res_query_booking_paid_mon);
$month_booking_paid =$fetch_booking_paid_mon->book_id;