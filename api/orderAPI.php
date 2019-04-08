<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Bangkok');
include "../lib/std.php";
include "../lib/dbConnector.php";
include "../model/product.php";
include "../model/order.php";

$action = $_REQUEST["action"];
$condition = $_REQUEST["condition"];

$obj = new Product();
$obj_order = new Order();
$resultArray = array();

switch ($action) {
	case "insert":
		$data = array(
			"product_id" => $_REQUEST["product_id"],
			"qty" => $_REQUEST["qty"],
			"customer_id" => $_REQUEST["customer_id"]
		);			
		$r = $obj_order->insert($data);
		echo json_encode($r);
		break;
    case "read":
		$rows = $obj->read();	
		if ($rows != false) {
			foreach ($rows as $row) {
				$arrCol = array();
				$arrCol["product_id"] = $row["product_id"];
				$arrCol["barcode"] = $row["barcode"];
				$arrCol["product_name"] = $row["product_name"];
				$arrCol["type_id"] = $row["type_id"];
				$arrCol["type_name"] = $row["type_name"];
				$arrCol["unit_id"] = $row["unit_id"];
				$arrCol["unit_name"] = $row["unit_name"];
				$arrCol["color"] = $row["color"];
				$arrCol["quantity"] = $row["quantity"];
				$arrCol["low_quantity"] = $row["low_quantity"];
				$arrCol["price"] = $row["price"];
				$arrCol["product_desc"] = $row["product_desc"];
				$arrCol["product_img_id"] = $row["product_img_id"];

				array_push($resultArray,$arrCol);
			}
		}
		echo json_encode($resultArray);
		break;
		case "read_product_img_detail":		
		$rows = $obj->read_product_img_detail($condition);	
		if ($rows != false) {
			foreach ($rows as $row) {
				$arrCol = array();  

				$arrCol["product_img_id"] = $row["product_img_id"];
				$arrCol["product_img_detail_id"] = $row["product_img_detail_id"];
				$arrCol["product_img"] = $row["product_img"];

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