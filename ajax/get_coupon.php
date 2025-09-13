<?php
include("../store_db_con.php");
$conn = dbconnect();
session_start();

$act_da = $_POST['act_da'] ?? '';
$activities_id = $_POST['activities_id'] ?? '';
$mc_id = $_POST['mc_id'] ?? '';
$adult = (int)($_POST['adult'] ?? 0);
$children = (int)($_POST['children'] ?? 0);
$slot_id = $_POST['slot'] ?? '';
$total_members = $adult + $children;

// Log inputs
error_log("Input: act_da=$act_da, activities_id=$activities_id, mc_id=$mc_id, adult=$adult, children=$children, slot_id=$slot_id, total_members=$total_members");

// Convert date format to Y-m-d
$formatted_actdate = $act_da ? date('Y-m-d', strtotime(str_replace('/', '-', $act_da))) : '';
error_log("Formatted date: $formatted_actdate");

// Build coupon query
$coupon_query = "SELECT c.coupon_code, c.discount_percentage, c.caption, c.activity_id, c.min_members, c.valid_from, c.valid_to, c.is_midnight, c.is_weekend 
                 FROM tb_coupons c 
                 LEFT JOIN tb_activities a ON c.activity_id = a.activity_id 
                 WHERE c.is_active = 1 
                 AND c.valid_from <= '$formatted_actdate' 
                 AND c.valid_to >= '$formatted_actdate'";

// Activity filter
if ($activities_id && $mc_id) {
    $coupon_query .= " AND (
        ('$activities_id' = '6' AND c.coupon_code = 'EXPLORE20') OR
        ('$activities_id' != '6' AND (c.activity_id IS NULL OR (c.coupon_code = 'JOLLYFEST' AND a.mc_id = '1')))
    )";
} else {
    error_log("Missing activities_id or mc_id");
    $coupon_query .= " AND FALSE";
}

// Member count filter
if ($total_members > 0) {
    $coupon_query .= " AND (
        (c.coupon_code = 'FAMILYFUN' AND $total_members >= 10) OR
        (c.coupon_code = 'WBH30' AND $total_members <= 5) OR
        (c.coupon_code NOT IN ('FAMILYFUN', 'WBH30') AND (c.min_members <= $total_members OR c.min_members IS NULL))
    )";
} else {
    error_log("No members selected: total_members=$total_members");
    $coupon_query .= " AND FALSE";
}

// Weekend check for GETSETGO
$day_of_week = date('w', strtotime($formatted_actdate));
$is_weekend = ($day_of_week == 0 || $day_of_week == 6) ? 1 : 0;
error_log("Weekend check: day_of_week=$day_of_week, is_weekend=$is_weekend");
if ($is_weekend) {
    $coupon_query .= " AND (c.is_weekend = 1 OR c.is_weekend = 0)";
} else {
    $coupon_query .= " AND (c.is_weekend = 0 OR c.coupon_code != 'GETSETGO')";
}

// Long weekend/festival check for JOLLYFEST
$long_weekend_query = "SELECT long_weekend_date FROM tb_long_weekend_dates WHERE long_weekend_date = '$formatted_actdate'";
$long_weekend_result = mysqli_query($conn, $long_weekend_query);
$is_long_weekend = mysqli_num_rows($long_weekend_result) > 0 ? 1 : 0;

$festival_query = "SELECT festival_date FROM tb_festival_dates WHERE festival_date = '$formatted_actdate' AND is_seasonal = 0";
$festival_result = mysqli_query($conn, $festival_query);
$is_festival = mysqli_num_rows($festival_result) > 0 ? 1 : 0;

$is_jollyfest_eligible = ($is_long_weekend || $is_festival) ? 1 : 0;
error_log("JOLLYFEST check: is_long_weekend=$is_long_weekend, is_festival=$is_festival, is_jollyfest_eligible=$is_jollyfest_eligible");
if ($is_jollyfest_eligible) {
    $coupon_query .= " AND (c.coupon_code != 'JOLLYFEST' OR a.mc_id = '1')";
} else {
    $coupon_query .= " AND c.coupon_code != 'JOLLYFEST'";
}

// Seasonal sales check for JOLLY10
$seasonal_query = "SELECT festival_date FROM tb_festival_dates WHERE festival_date = '$formatted_actdate' AND is_seasonal = 1";
$seasonal_result = mysqli_query($conn, $seasonal_query);
$is_seasonal = mysqli_num_rows($seasonal_result) > 0 ? 1 : 0;
error_log("Seasonal check: is_seasonal=$is_seasonal");
if ($is_seasonal) {
    $coupon_query .= " AND (c.coupon_code != 'JOLLY10' OR c.coupon_code = 'JOLLY10')";
} else {
    $coupon_query .= " AND c.coupon_code != 'JOLLY10'";
}

// Midnight slot check for GETSETGO
if ($slot_id) {
    $slot_query = "SELECT slot_time FROM tb_activity_slot WHERE slot_id = '$slot_id'";
    $slot_result = mysqli_query($conn, $slot_query);
    $slot_row = mysqli_fetch_object($slot_result);
    $slot_time = $slot_row ? $slot_row->slot_time : '00:00:00';
    $hour = (int)date('H', strtotime($slot_time));
    $is_midnight = ($hour >= 0 && $hour < 3) ? 1 : 0;
    error_log("Midnight check: slot_id=$slot_id, slot_time=$slot_time, hour=$hour, is_midnight=$is_midnight");
    if ($is_midnight) {
        $coupon_query .= " AND (c.is_midnight = 1 OR c.is_midnight = 0)";
    } else {
        $coupon_query .= " AND (c.is_midnight = 0 OR c.coupon_code != 'GETSETGO')";
    }
}

// Log final query
error_log("Final query: $coupon_query");

// Execute query
$coupon_rec = mysqli_query($conn, $coupon_query);

// Log results
$options = '<option value="" selected="selected" disabled="disabled">Select Coupon</option>';
while ($coupon_row = mysqli_fetch_object($coupon_rec)) { 
    $caption = $coupon_row->caption ? ' (' . htmlspecialchars($coupon_row->caption) . ')' : '';
    $options .= '<option value="' . htmlspecialchars($coupon_row->coupon_code) . '">' 
                . htmlspecialchars($coupon_row->coupon_code) . '</option>';
    error_log("Coupon found: " . $coupon_row->coupon_code);
}

if (mysqli_num_rows($coupon_rec) == 0) {
    error_log("No coupons found for query");
}

echo $options;
mysqli_close($conn);
?>