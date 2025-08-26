<?php
/* Database connection */
include("../store_db_con.php");
$conn = dbconnect();
session_start();

$mc_id = $_POST['mc_id'];
$content_query1   = "SELECT * FROM tb_activities WHERE status != 1 AND mc_id='$mc_id' ORDER BY activity_id ASC";
//echo $content_query1;
  $content_res1 = mysqli_query($conn, $content_query1);
  ?>
  <option value="" selected="selected" disabled="disabled">Explore Activities</option>
  <?php
  while($content_row1 = mysqli_fetch_object($content_res1))
  {
    $activity_id=$content_row1->activity_id;
    $activity_name =ucwords(strtolower($content_row1->activity_name));
?>
<option value="<?php echo $activity_id; ?>"><?php echo $activity_name; ?></option>
<?php
}
?>