<?php
require_once("../db.php");

$vendor = $_GET['vendor'];
$product = $_GET['product'];
$sql = "SELECT DISTINCT(vers_num) FROM `vendor` WHERE vendor_name = '".$vendor.
       "' and prod_name = '".$product."'";
$results  = mysql_query($sql) or die("Query failed: " . mysql_error());

$versions = array();
if ($results) {
    while ($row = mysql_fetch_array($results)) $versions[] = $row['vers_num'];
}

//header('Content-type: application/json');
echo json_encode($versions);

 ?>
