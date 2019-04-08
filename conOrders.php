<?php
header('Content-Type: text/html; charset=utf-8');

include "./lib/std.php";
include "./lib/helper.php";
include "./lib/dbConnector.php";
include "./model/orders.php";

// insert Type
$obj = new Orders();
 $action = $_REQUEST["action"];
 $data = array(
    "products_id" => !empty($_REQUEST["products_id"]) ?  $_REQUEST["products_id"] : "",
    "store_id" => !empty($_REQUEST["store_id"]) ?  $_REQUEST["store_id"] : "",
    "stock_quantity" => !empty($_REQUEST["stock_quantity"]) ?  $_REQUEST["stock_quantity"] : "",
    "orders_id" => !empty($_REQUEST["orders_id"]) ?  $_REQUEST["orders_id"] : ""
    );

$r = false;
switch ($action) {
    case "add":
        $r = $obj->insert($data);
        break;
    // case "edit":
    //     $r = $obj->update($data, " customer_id = {$data["customer_id"]} ");
    //     break;
    case "delete":
        $r = $obj->delete(" orders_id = {$data["orders_id"]} ");
        break;
    default:
        break;
}
echo $r;
if($r){
    redirect("index.php?viewName=ordersList&store_id={$data['store_id']}");
}else{
    echo $r;
}

