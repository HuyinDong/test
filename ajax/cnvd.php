<?php
$pagename='vl';

require_once("./db.php");

$limit=$_GET['limits'];

if($_REQUEST)
{
	$para = " and (  ( ctitle like \"%$_REQUEST[keywords]%\") or    ( cve like \"%$_REQUEST[keywords]%\") or    ( cid like \"%$_REQUEST[keywords]%\")  )";
}



$vul_sql = "select cpublished, cid
					from  smartexploits.cnvd
			where 1=1 $para
						order by id desc
				limit $limit";

$vul_results  = mysql_query($vul_sql) or die("Query failed: " . mysql_error());

$total_sql = "select count(id) from   smartexploits.cnvd   where 1=1 $para";

$total_results  = mysql_query($total_sql) or die("Query failed: " . mysql_error());

$total_row = mysql_fetch_array($total_results) ;
$sig_total = $total_row[0];

$cnvd = array();

if ($vul_results) {
    while ($row = mysql_fetch_object($vul_results)){
			$utf8string = html_entity_decode(preg_replace("/U\+([0-9A-F]{4})/", "&#x\\1;", $row->ctitle), ENT_NOQUOTES, 'UTF-8');
			$row->ctitle = $utf8string;
			$cnvd[] = $row;
		}
}


$data = array();

$data['data'] = $cnvd;
$data['total'] = $sig_total;
echo json_encode($utf8string);


?>
