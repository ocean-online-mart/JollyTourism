<?php
   error_reporting(0);
    include("store_db_con.php");
    $conn = dbconnect();
   header("Access-Control-Allow-Origin: *");
   header('Access-control-Allow-Headers: Authorization,Content-Type ,X-Auth-Token , Origin');
   
   $booking_id = base64_decode($_GET['bid']);
    $activity_query = "SELECT * FROM tb_booking WHERE booking_id= '$booking_id'";
    $activity_rec = mysqli_query($conn, $activity_query);
    $activity_row = mysqli_fetch_object($activity_rec);
    $booking_id =$activity_row->booking_id;
    $booking_ids= '#JT31052500'.$booking_id;
    $cus_name =$activity_row->cus_name;
    $activity_name =ucwords(strtolower($activity_row->activity_name));
    $act_date =$activity_row->act_date;
    $actdate = date('d M Y', strtotime($act_date));
    $slot_name =$activity_row->slot_name;
    $phone_no =$activity_row->phone_no;
    $children =$activity_row->children;
    $adult =$activity_row->adult;
    $to =$activity_row->email_id;
    $amounts =$activity_row->total_amount;
    $p_charge =$activity_row->p_charge;
    $discount =$activity_row->discount;
    $total_amount = $amounts + $p_charge - $discount;
    $act_amount =$activity_row->act_amount;
    $amount_recieved =$activity_row->amount_recieved;
    $book_ids = base64_encode($booking_id);
    $invoiceDate = date("F d, Y");

   $username="support@jollytourism.com";
   $password="pZZz6ZVu81QoiXhf";

   require 'dompdf/vendor/autoload.php';

   use Dompdf\Dompdf;
   use Dompdf\Options;
    
   // Import PHPMailer classes into the global namespace
   // These must be at the top of your script, not inside a function
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\SMTP;
   use PHPMailer\PHPMailer\Exception;

   // Load Composer's autoloader
   require 'phpmailer/src/PHPMailer.php';
   require 'phpmailer/src/SMTP.php';
   require 'phpmailer/src/Exception.php';

ob_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }

        .invoice-container {
            max-width: 750px;
            margin: auto;
            padding: 30px;
            background: #fff;
            border: 1px solid #eee;
        }

        .header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #00aaff;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .logo {
            width: 140px;
        }

        .company-info {
            margin-top: -60px;
            margin-left: auto;
            text-align: right;
        }
        .text-right
        {
            margin-top: -40px;
            margin-left: auto;
            text-align: right;
        }
        .section-title {
            font-size: 16px;
            color: #00aaff;
            margin-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .two-column {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .two-column div {
            width: 48%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f0f8ff;
        }

        .total-row td {
            font-weight: bold;
        }

        .thank-you {
            text-align: center;
            font-size: 16px;
            margin-top: 30px;
            color: #00aaff;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #aaa;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="invoice-container">
    <div class="header">
        <img src="https://jollytourism.com/assets/img/logo/logo.png" class="logo" alt="Logo">
        <div class="company-info">
            <strong>Jolly Tourism</strong><br>
             Pondicherry – 605007<br>
            support@jollytourism.com
        </div>
    </div>

    <div class="two-column">
        <div>
            <div class="section-title">Bill To</div>
            <?php echo $cus_name ?><br>
            <?php echo $to ?><br>
            <?php echo $phone_no ?>
        </div>
        <div class="text-right">
            <strong>Invoice #:</strong> <?php echo $booking_ids ?><br>
            <strong>Date:</strong> <?php echo $invoiceDate ?><br>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Activity Details</th>
                <th style="text-align:center;">No of Person</th>
                <th style="text-align:right;">Ticket</th>
                <th style="text-align:right;">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $activity_name ?></td>
                <td style="text-align:center;"><?php echo $adult ?> Adult <?php echo $children ?> Children</td>
                <td style="text-align:right;"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span><?php echo $act_amount ?></td>
                <td style="text-align:right;"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span><?php echo $amounts; ?></td>
            </tr>
            <tr class="total-row">
                <td colspan="3" style="text-align:right;">Subtotal</td>
                <td style="text-align:right;"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span><?php echo $amounts; ?></td>
            </tr>
            <tr class="total-row">
                <td colspan="3" style="text-align:right;">Discount</td>
                <td style="text-align:right;"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span><?php echo $discount; ?></td>
            </tr>
            <tr class="total-row">
                <td colspan="3" style="text-align:right;">Total</td>
                <td style="text-align:right;"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span><?php echo $total_amount; ?></td>
            </tr>
            <tr class="total-row">
                <td colspan="3" style="text-align:right;">Amount Received</td>
                <td style="text-align:right;"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span><?php echo $amount_recieved; ?></td>
            </tr>
        </tbody>
    </table>

    <div class="thank-you">Thank you for your booking!</div>
    <div class="footer">This is an auto generated invoice no signature required.</div>
</div>
</body>
</html>

<?php
$html = ob_get_clean();

// Generate PDF from HTML using Dompdf
$options = new Options();
$options->set('defaultFont', 'Arial');
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Get PDF as string (not saved to file)
$pdfOutput = $dompdf->output();
$pdfFileName = "invoice_{$invoiceNumber}.pdf";

   // Instantiation and passing `true` enables exceptions
   $mail = new PHPMailer(true);

   try {
    //Server settings
     $mail->SMTPDebug = 0;                      // Enable verbose debug output
     $mail->isSMTP();                                            // Send using SMTP
     $mail->Host       = 'jollytourism.com';                    // Set the SMTP    server    to send through
     $mail->SMTPAuth   = true;                                   // Enable SMTP      authentication
    $mail->Username   = $username;                     // SMTP username
    $mail->Password   = $password;                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `  PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

//Recipients
   $mail->setFrom('support@jollytourism.com',$username);
   $mail->addAddress($to);     // Add a recipient
   $mail->addBcc("neelakkadalpvtltd@gmail.com");

   $mail->addStringAttachment($pdfOutput, $pdfFileName);


   // Attachments
   // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

   // Content
   $mail->isHTML(true);                                  // Set email format to HTML
   $mail->Subject = 'Booking Confirmation - JollyTourism';
   $mail->Body = "
    <html>
    <body style='font-family: Arial, sans-serif; color: #333;'>
        <div style='max-width: 600px; margin: auto; border: 1px solid #ddd; padding: 20px;'>
            <div style='text-align: center;'>
                <img src='https://jollytourism.com/assets/img/logo/logo.png' alt='Jolly Tourism' height='60'>
                <h2 style='color: #2c3e50;'>Booking Confirmation</h2>
            </div>
            <p>Hi <strong>$cus_name</strong>,</p>
            <p>Thank you for booking with <strong>Jolly Tourism</strong>! We're excited to welcome you to Pondicherry.</p>

            <h3 style='color: #2980b9;'>Your Booking Details:</h3>
            <table cellpadding='5' cellspacing='0' border='0'>
                <tr><td><strong>Booking ID:</strong></td><td>$booking_ids</td></tr>
                <tr><td><strong>Package:</strong></td><td>$activity_name</td></tr>
                <tr><td><strong>Date:</strong></td><td>$actdate - $slot_name</td></tr>
                <tr><td><strong>Guests:</strong></td><td>$adult Adult $children Children</td></tr>
                <tr><td><strong>Payment Received:</strong></td><td>$total_amount</td></tr>
                <tr><td><strong>Location:</strong></td><td>https://maps.app.goo.gl/T4fwa7p2JYqE1R3A6</td></tr>
            </table>

            <p>We’ll send more details and your itinerary shortly. For any assistance, feel free to contact us.</p>

            <p style='margin-top: 30px;'>Warm regards,<br>
            <strong>Team Jolly Tourism</strong><br>
            📞 +91-84897 96139 | 🌐 www.jollytourism.com</p>

            <hr>
        </div>
    </body>
    </html>
    ";
    $mail->AltBody = "Hi $cus_name,\n\nThank you for booking with Jolly Tourism!\n\nBooking ID: $booking_ids\nPackage: $activity_name\nDate: $actdate - $slot_name\n\nVisit www.jollytourism.com for more info.";

   $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true,
    )
);

   $mail->send();

   $code = 'done';



  } catch (Exception $e) {
  $code = 'no';
  }
  echo $data = json_encode($code);

 ?>