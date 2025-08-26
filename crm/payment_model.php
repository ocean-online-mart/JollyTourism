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
$activity_name =$fetch3->activity_name;
$act_amount =$fetch3->act_amount;
$slot_name =$fetch3->slot_name;
$adult =$fetch3->adult;
$children =$fetch3->children;
$adult_amount =$fetch3->adult_amount;
$children_amount =$fetch3->children_amount;
$total_amount =$fetch3->total_amount;
$p_charge =$fetch3->p_charge;
$discount =$fetch3->discount;
$total_amounts =$total_amount + $p_charge - $discount;
$amount_recieved =$fetch3->amount_recieved;
$payment_id =$fetch3->payment_id;
$payment =$fetch3->payment;
$payment_type =$fetch3->payment_type;
$booking_type =$fetch3->booking_type;
$act_date =$fetch3->act_date;
$child = $act_amount /2;

if($booking_type == 'website')
{
	$pay_type = 'Razorpay';
}
else
{
	$pay_type = '';
}

if($payment == 1)
{
	$pay = 'Paid';
	$color = 'text-success';
}
else
{
	$pay = 'Unpaid';
	$color = 'text-danger';
}
?>
<div class="modal-header">
<h4>Payment Details - #JT31052500<?php echo $booking_id; ?></h4>
</div>
<div class="modal-body">
<p class="mb-1"><b>Ticket: </b><?php echo $adult; ?> Adult * <?php echo $act_amount; ?> + <?php echo $children; ?> Children * <?php echo $child; ?></p>
<p class="mb-1"><b>Total: </b><?php echo $adult_amount; ?> + <?php echo $children_amount; ?> = ₹<?php echo $total_amount; ?></p>
<?php if($p_charge != 0 ) { ?> <p class="mb-1"><b>Charges: </b><small>(+)</small> ₹<?php echo $p_charge; ?></p> <?php } ?>
<?php if($discount != 0 ) { ?> <p class="mb-1"><b>Discount: </b><small>(-)</small> ₹<?php echo $discount; ?></p> <?php } ?>
<p class="mb-1"><b>Total Pay: </b>₹<?php echo $total_amounts; ?> </p>
<p class="mb-1"><b>Pay Status: </b><span class="fw-bold <?php echo $color ?>"><?php echo $pay; ?></span></p>
<?php if($payment != 0 ) { ?> <p class="mb-1"><b>Payment ID: </b><?php echo $payment_id; ?></p> <?php } ?>
<?php if($payment != 0 ) { ?> <p class="mb-1"><b>Payment Method: </b><?php echo $pay_type.' '.$payment_type; ?></p> <?php } ?></div>

<div class="modal-footer">
<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
</div>