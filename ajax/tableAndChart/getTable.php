<?php
require_once("../db.php");

$vendor = $_GET['vendor'];
$product = $_GET['product'];
$version = $_GET['version'];
$limit = $_GET['limits'];
/*$sql = "SELECT * FROM `vendor` WHERE vendor_name = '".$vendor.
       "' and prod_name = '".$product."' and vers_num LIKE '%".$version."%'";
*/

$sql = "SELECT a.vers_num, a.edition, c.cvename from vendor a
        inner join cve_vendor b on a .vendor_id = b.vendor_id
        inner join CVEs c on b.cve_id = c.cve_id
        where vendor_name = '".$vendor."' and prod_name = '".$product."' and vers_num
        LIKE '%".$version."%'
        order by vers_num,cvename asc
  			limit   $limit"  ;
$results  = mysql_query($sql) or die("Query failed: " . mysql_error());

$versions = array();
$data = array();

if ($results) {
    while ($row = mysql_fetch_object($results))
      $versions[] = $row;

}

$data['data'] = $versions;
//echo $sql;
echo json_encode($data);

 ?>
