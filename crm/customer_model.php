<?php 
include("store_db_con.php");
$conn = dbconnect();
 
$id = $_GET['id'];

$today= date('Y-m-d');

$query3  = "SELECT * FROM tb_booking WHERE booking_id = '$id'";
$res_query3 = mysqli_query($conn,$query3);
$fetch3 = mysqli_fetch_object($res_query3);
$booking_id=$fetch3->booking_id;
$cus_name=ucwords(strtolower($fetch3->cus_name));
$phone_no=$fetch3->phone_no;
$email_id =$fetch3->email_id;
$location =$fetch3->location;
$activity_name =$fetch3->activity_name;
$act_amount =$fetch3->act_amount;
$slot_name =$fetch3->slot_name;
$adult =$fetch3->adult;
$children =$fetch3->children;
$total_amount =$fetch3->total_amount;
$p_charge =$fetch3->p_charge;
$total_amounts =$total_amount + $p_charge;
$discount =$fetch3->discount;
$amount_recieved =$fetch3->amount_recieved;
$payment_id =$fetch3->payment_id;
$payment_type =$fetch3->payment_type;
$booking_type =$fetch3->booking_type;
$act_date =$fetch3->act_date;

?>
<div class="modal-header">
<h4>Customer Details - #JT31052500<?php echo $booking_id; ?></h4>
</div>
<div class="modal-body">
<p class="mb-1"><b>Name: </b><?php echo ucwords(strtolower($cus_name)); ?></p>
<p class="mb-1"><b>Mobile No: </b><?php echo $phone_no; ?></p>
<p class="mb-1"><b>Email: </b><?php echo $email_id; ?></p>
<p class="mb-1"><b>Address: </b><?php echo $location; ?></p>

<div class="modal-footer">
<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
</div>