
<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Bangkok');
include "../lib/std.php";
include "../lib/dbConnector.php";
include "../model/address.php";

$action = $_REQUEST["action"];
$condition = $_REQUEST["condition"];
if($condition == ""){
	$condition  = " 1=1 ";
}

$obj = new Address();
$resultArray = array();

switch ($action) {
    case "read_province":
		$rows = $obj->read_province();	
		if ($rows != false) {
			foreach ($rows as $row) {
				$arrCol = array();
				$arrCol["PROVINCE_ID"] = $row["PROVINCE_ID"];
				$arrCol["PROVINCE_CODE"] = $row["PROVINCE_CODE"];
				$arrCol["PROVINCE_NAME"] = $row["PROVINCE_NAME"];
				$arrCol["PROVINCE_NAME_ENG"] = $row["PROVINCE_NAME_ENG"];
                $arrCol["GEO_ID"] = $row["GEO_ID"];
                
				array_push($resultArray,$arrCol);
			}
		}
		echo json_encode($resultArray);
		break;
		case "read_amphur":
		$rows = $obj->read_amphur($condition);	
		if ($rows != false) {
			foreach ($rows as $row) {
				$arrCol = array();
				$arrCol["AMPHUR_ID"] = $row["AMPHUR_ID"];
				$arrCol["AMPHUR_CODE"] = $row["AMPHUR_CODE"];
				$arrCol["AMPHUR_NAME"] = $row["AMPHUR_NAME"];
				$arrCol["POSTCODE"] = $row["POSTCODE"];
				//$arrCol["AMPHUR_NAME_ENG"] = $row["AMPHUR_NAME_ENG"];
				$arrCol["GEO_ID"] = $row["GEO_ID"];
                $arrCol["PROVINCE_ID"] = $row["PROVINCE_ID"];
                
				array_push($resultArray,$arrCol);
			}
		}
		echo json_encode($resultArray);
		break;
		case "read_district":
		$rows = $obj->read_district($condition);	
		if ($rows != false) {
			foreach ($rows as $row) {
				$arrCol = array();
				$arrCol["DISTRICT_ID"] = $row["DISTRICT_ID"];
				$arrCol["DISTRICT_CODE"] = $row["DISTRICT_CODE"];
				$arrCol["DISTRICT_NAME"] = $row["DISTRICT_NAME"];
				$arrCol["AMPHUR_ID"] = $row["AMPHUR_ID"];
				$arrCol["PROVINCE_ID"] = $row["PROVINCE_ID"];
                $arrCol["GEO_ID"] = $row["GEO_ID"];
                
				array_push($resultArray,$arrCol);
			}
		}
		echo json_encode($resultArray);
        break;
    default:
	   echo "Action is not found.";
	   break;
}

?>