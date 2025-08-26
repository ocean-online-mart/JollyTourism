<?php
// Include the Razorpay PHP library
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;

// Initialize Razorpay with your key and secret
$api_key = 'rzp_live_jC4M6DlSqXQkJ5';
$api_secret = '4fZiDk319h9nNXA8CO6Vd8iF';

include("../store_db_con.php");
$conn = dbconnect();

$booking_id = base64_decode($_GET['bid']);
$activity_query = "SELECT * FROM tb_booking WHERE booking_id= '$booking_id'";
$activity_rec = mysqli_query($conn, $activity_query);
$activity_row = mysqli_fetch_object($activity_rec);
$booking_id =$activity_row->booking_id;
$cus_name =$activity_row->cus_name;
$phone_no =$activity_row->phone_no;
$email_id =$activity_row->email_id;
$amounts =$activity_row->total_amount;
$p_charge =$activity_row->p_charge;
$discount =$activity_row->discount;
$total_amount = $amounts + $p_charge - $discount;
$booking_ids = base64_encode($booking_id);

$api = new Api($api_key, $api_secret);
// Create an order
$order = $api->order->create([
  'amount' => $total_amount * 100, 
    // 'amount' => 10 * 100,
    'currency' => 'INR',
    'receipt' => 'order_receipt_12asa3'
]);
// Get the order ID
$order_id = $order->id;

// Set your callback URL
$callback_url = "https://jollytourism.com/payment/verify?bid=$booking_ids";

// Include Razorpay Checkout.js library
echo '<script src="https://checkout.razorpay.com/v1/checkout.js"></script>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jolly Tourism – Pondicherry’s Ultimate Boating Adventure</title>
    <link rel="icon" type="image/png" href="favicon.png">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 400px;
            width: 100%;
        }
        .icon {
            color: #4caf50;
            font-size: 60px;
            margin-bottom: 20px;
        }
        h1 {
            color: #1804cd;
            margin-bottom: 20px;
        }
        p {
            color: #555;
            margin-bottom: 20px;
        }
        .button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
         <img src="../assets/img/logo/logo.png" alt="jollytourism" height="100">
        <h1>Complete Your Payment</h1>
        <h1 style="color: #4caf50;">₹<?php echo $total_amount; ?></h1>
        <p>Your chosen package is almost booked! To secure your spot, please complete the payment!</p>
        <button onclick="startPayment()" class="button">Proceed to pay</button>
         <div style="margin-top:20px;font-weight:bold;">Authorized Online Booking portal for <br>"Wills Boat House"</div>
    </div>
</body>
</html>
<?php


// Add a script to handle the payment
echo '<script>
    function startPayment() {
        var options = {
            key: "' . $api_key . '",
            amount: ' . $order->amount . ',
            currency: "' . $order->currency . '",
            name: "Wills Boat House - Jolly Tourism",
            description: "Payment for your Booking",
            image: "https://jollytourism.com/assets/img/logo/logo.png",
            order_id: "' . $order_id . '",
            theme:
            {
                "color": "#0003a9"
            },
            prefill: { 
            "name": "' . $cus_name . '", 
            "email": "' . $email_id . '",
            "contact": "' . $phone_no . '" 
          },
          redirect: true,
            callback_url: "' . $callback_url . '"
        };
        var rzp = new Razorpay(options);
        rzp.open();
    }
</script>';
?>
