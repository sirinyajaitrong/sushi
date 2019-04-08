<?php
header('Content-Type: text/html; charset=utf-8');
include "./lib/std.php";
include "./lib/helper.php";
include "./lib/dbConnector.php";
include "./model/stock.php";

// insert Type
$obj = new Stock();
 $action = $_REQUEST["action"];
 $data = array(
    "products_id" => !empty($_REQUEST["products_id"]) ?  $_REQUEST["products_id"] : "",
    "store_id" => !empty($_REQUEST["store_id"]) ?  $_REQUEST["store_id"] : "",
    "stock_quantity" => !empty($_REQUEST["stock_quantity"]) ?  $_REQUEST["stock_quantity"] : "",
    "stock_id" => !empty($_REQUEST["stock_id"]) ?  $_REQUEST["stock_id"] : ""
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
        $r = $obj->delete(" stock_id = {$data["stock_id"]} ");
        break;
    default:
        break;
}
echo $r;
if($r){
    redirect("index.php?viewName=productsList");
}else{
    echo $r;
}

