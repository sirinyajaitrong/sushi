<?php
header('Content-Type: text/html; charset=utf-8');
include "./lib/std.php";
include "./lib/helper.php";
include "./lib/dbConnector.php";
include "./model/products.php";

// insert Type
$obj = new Products();
 $action = $_REQUEST["action"];
 $data = array(
    "products_id" => !empty($_REQUEST["products_id"]) ?  $_REQUEST["products_id"] : "",
    "products_name" => !empty($_REQUEST["products_name"]) ?  $_REQUEST["products_name"] : "",
    "color_id" => !empty($_REQUEST["color_id"]) ?  $_REQUEST["color_id"] : "",
    "products_type_id" => !empty($_REQUEST["products_type_id"]) ?  $_REQUEST["products_type_id"] : "",
    "pic" => !empty($_REQUEST["pic"]) ?  $_REQUEST["pic"] : "",
    "price" => !empty($_REQUEST["price"]) ?  $_REQUEST["price"] : "",
    "cost" => !empty($_REQUEST["cost"]) ?  $_REQUEST["cost"] : "",
    "mfd" => !empty($_REQUEST["mfd"]) ?  $_REQUEST["mfd"] : "",
    "exd" => !empty($_REQUEST["exd"]) ?  $_REQUEST["exd"] : "",
  );

  $currentDir = getcwd();
  $uploadDirectory = "/upload_img/";
  $errors = []; // Store all foreseen and unforseen errors here
  $fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions'
  $size =9200000000; // 20MB
  //-----------------------------------------------------------------------------------
  $fileName = $_FILES['pic']['name'];
  $fileSize = $_FILES['pic']['size'];
  $fileTmpName  = $_FILES['pic']['tmp_name'];
  $fileType = $_FILES['pic']['type'];

  $data["pic"] =  $fileName;

  echo "xxx ".$data["pic"]." yyy";
  //$fileExtension = strtolower(end(explode('.',$fileName)));
  $tmp = explode('.', $fileName);
  $fileExtension = end($tmp);
  $uploadPath = $currentDir . $uploadDirectory . basename($fileName); 
  //if (isset($_POST['submit'])) {
      if (! in_array($fileExtension,$fileExtensions)) {
          $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
      }

      if ($fileSize > $size) {
          $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
      }

      if (empty($errors)) {
          $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

          if ($didUpload) {
              echo "The file " . basename($fileName) . " has been uploaded";
          } else {
              echo "An error occurred somewhere. Try again or contact the admin";
          }
      } else {
          foreach ($errors as $error) {
              echo $error . "These are the errors" . "\n";
          }
      }
//-----------------------------------------------------------------------------------
$r = false;
switch ($action) {
    case "add":
        $r = $obj->insert($data);
        break;
    case "edit":
        $r = $obj->update($data, " products_id = {$data["products_id"]} ");
        break;
    case "delete":
        $r = $obj->delete(" products_id = {$data["products_id"]} ");
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

