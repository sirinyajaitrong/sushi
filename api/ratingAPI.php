
<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Bangkok');
include "../lib/std.php";
include "../lib/dbConnector.php";
include "../model/rating.php";

$action = $_REQUEST["action"];
$product_detail_id = $_REQUEST["product_detail_id"];

$obj = new Rating();
$resultArray = array();

switch ($action) {
    case "read_rating":
		$rows = $obj->read_rating($product_detail_id);	
		if ($rows != false) {
			foreach ($rows as $row) {
				$arrCol = array();
				$arrCol["rating"] = round($row["rating"]/$row["count"]);                           
				array_push($resultArray,$arrCol);
			}
		}else{
			  $arrCol = array();
				$arrCol["rating"] = 0;                           
				array_push($resultArray,$arrCol);
		}
		echo json_encode($resultArray);
		break;
    default:
	   echo "Action is not found.";
	   break;
}

?>