<?php
/* Database connection */
include("../store_db_con.php");
$conn = dbconnect();
session_start();

// Sanitize input to prevent SQL injection
$act_id = mysqli_real_escape_string($conn, $_POST['act_id'] ?? '');
$mc_id = mysqli_real_escape_string($conn, $_POST['mc_id'] ?? '');
$act_da = mysqli_real_escape_string($conn, $_POST['act_da'] ?? '');
$slot = mysqli_real_escape_string($conn, $_POST['slot'] ?? '');
$adult = mysqli_real_escape_string($conn, $_POST['adult'] ?? '');
$children = mysqli_real_escape_string($conn, $_POST['children'] ?? '');
$coupon_code = mysqli_real_escape_string($conn, $_POST['coupon_code'] ?? '');

if($act_id != '') {
    $activity_query = "SELECT * FROM tb_activities WHERE status != 1 AND activity_id = '$act_id'";
    $activity_rec = mysqli_query($conn, $activity_query);
    if($activity_rec && mysqli_num_rows($activity_rec) > 0) {
        $activity_row = mysqli_fetch_object($activity_rec);
        $activity_id = $activity_row->activity_id;
        $mc_id = $activity_row->mc_id;
        $activity_name = ucwords(strtolower($activity_row->activity_name));
        $act_amount = $activity_row->amount;
    } else {
        echo json_encode(['error' => 'Activity not found']);
        exit;
    }

    if($act_da != '') {
        $timestamp = strtotime(str_replace('/', '-', $act_da));
        $formatted_actdate = date('Y-m-d', $timestamp);
        $activityd_query = "SELECT * FROM tb_activitiy_date WHERE status != 1 AND act_id = '$act_id' AND mc_id = '$mc_id' AND act_date = '$formatted_actdate'";
        $activityd_rec = mysqli_query($conn, $activityd_query);
        if($activityd_rec && mysqli_num_rows($activityd_rec) > 0) {
            $activityd_row = mysqli_fetch_object($activityd_rec);
            $act_dateid = $activityd_row->act_dateid;
            $actdate = date('d M Y', strtotime($formatted_actdate));
        } else {
            $actdate = '-';
        }
    } else {
        $actdate = '-';
    }

    if($slot != '') {
        $slot_querys = "SELECT * FROM tb_activity_slot WHERE slot_id = '$slot'";
        $slot_recs = mysqli_query($conn, $slot_querys);
        if($slot_recs && mysqli_num_rows($slot_recs) > 0) {
            $slot_rows = mysqli_fetch_object($slot_recs);
            $slot_names = $slot_rows->slot_name;
        } else {
            $slot_names = '';
        }
    } else {
        $slot_names = '';
    }
} else {
    echo json_encode(['error' => 'Invalid activity ID']);
    exit;
}

$coupon_discount = 0;
$coupon_message = '';
$coupon_error = '';
if($coupon_code != '') {
    $total_members = (is_numeric($adult) ? (int)$adult : 0) + (is_numeric($children) ? (int)$children : 0);
    if($total_members <= 5) {
        $coupon_query = "SELECT * FROM tb_coupons WHERE coupon_code = '$coupon_code' AND status = 1 AND valid_until >= CURDATE()";
        $coupon_rec = mysqli_query($conn, $coupon_query);
        if($coupon_rec && mysqli_num_rows($coupon_rec) > 0) {
            $coupon_row = mysqli_fetch_object($coupon_rec);
            $coupon_discount = $coupon_row->discount_percentage;
            $coupon_message = "Coupon applied: $coupon_discount% discount";
        } else {
            $coupon_message = "Invalid or expired coupon code"; 
        }
    } else {
        $coupon_message = "Coupon code not applicable: Booking must have 5 or less 5 members";
    }
}

if($adult != '' && is_numeric($adult) && $adult >= 0) {
    $child_amount = $act_amount/2;
    $a_total = $act_amount * $adult;
    $c_total = $child_amount * $children;
    if($activity_id == 11) {
        $total = $act_amount;
    } else {
        $total = $a_total + $c_total;
    }
    $discount_amount = $total * ($coupon_discount / 100);
    $subtotal_after_discount = $total - $discount_amount;
    $p_charge = $subtotal_after_discount * 2 / 100;
    $f_total = $subtotal_after_discount + $p_charge;
    if($activity_id == 8) {
        $adult = $adult.' Couples'; 
    } else {
        $adult = $adult.' Adult';
    }
    $children = $children.' Children';
} else {
    $actdate = '-';
    if($activity_id == 8) {
        $adult = '0 Couples'; 
    } else {
        $adult = '0 Adult';
    }
    $children = '0 Children';
    $c_total = 0;
    $total = 0;
    $p_charge = 0;
    $f_total = 0;
    $discount_amount = 0; // Ensure discount_amount is 0 when no adults
}

$adate = !empty($actdate) ? $actdate : '-';

echo json_encode([
    'ac_date' => $adate,
    'ac_slot' => $slot_names,
    'ac_adult' => $adult,
    'ac_child' => $children,
    'ac_amount' => $act_amount ?? 0,
    'ac_total' => $total,
    'ac_subtotal' => $total,
    'ac_charges' => $p_charge,
    'ac_finaltotal' => $f_total,
    'ac_coup_dis' => $discount_amount, // Changed from $subtotal_after_discount to $discount_amount
    'coupon_message' => $coupon_message,
]);

// Close database connection
mysqli_close($conn);
?>