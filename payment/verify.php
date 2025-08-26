<?php
// Include the Razorpay PHP library
require('razorpay-php/Razorpay.php');

use Razorpay\Api\Api;

// Initialize Razorpay with your key and secret
$api_key = 'rzp_live_jC4M6DlSqXQkJ5';
$api_secret = '4fZiDk319h9nNXA8CO6Vd8iF';

/* Database connection */
include("../store_db_con.php");
$conn = dbconnect();

$booking_ids = $_GET['bid'];

$booking_id = base64_decode($_GET['bid']);

$today = date( 'Y-m-d H:i:s');

$api = new Api($api_key, $api_secret);

// Check if payment is successful
$success = true;

$error = null;

// Get the payment ID and the signature from the callback
$payment_id = $_POST['razorpay_payment_id'];
$razorpay_signature = $_POST['razorpay_signature'];

try {
    // Verify the payment
    $attributes = array(
        'razorpay_order_id' => $_POST['razorpay_order_id'],
        'razorpay_payment_id' => $payment_id,
        'razorpay_signature' => $razorpay_signature
    );
    $api->utility->verifyPaymentSignature($attributes);
} catch (\Razorpay\Api\Errors\SignatureVerificationError $e) {
    $success = false;
    $error = 'Razorpay Signature Verification Failed';
}

if ($success) {
    // Payment is successful, update your database or perform other actions

    // Fetch the payment details
    $payment = $api->payment->fetch($payment_id);

    // You can access payment details like $payment->amount, $payment->status, etc.
    $amount_paid = $payment->amount / 100; // Convert amount from paise to rupees
    $payment_id = $payment->id;
    $payment_method = $payment->method;

    $payment_type = "Razorpay - ".$payment_method;

    $sql = "UPDATE tb_booking SET status=1,amount_recieved='$amount_paid',payment_id='$payment_id',payment=1,updated_log='$today',payment_type='$payment_type'  WHERE booking_id='$booking_id'";
    $content_res = mysqli_query($conn, $sql); 

    header("Location: https://jollytourism.com/booking-mail?bid=$booking_ids");
} else {
    // Payment failed, handle accordingly
    $sql = "UPDATE tb_booking SET status=1,payment=2,updated_log='$today'  WHERE booking_id='$booking_id'";
    $content_res = mysqli_query($conn, $sql); 

     header("Location: https://jollytourism.com/booking-fail?bid=$booking_ids");
}
?>
