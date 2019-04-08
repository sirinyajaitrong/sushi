<?php
header('Content-Type: text/html; charset=utf-8');
include "./lib/std.php";
include "./lib/helper.php";
include "./lib/dbConnector.php";
include "./model/user.php";

// insert Type
$obj = new User();
 $action = $_REQUEST["action"];
 $data = array(
    "users_id" => !empty($_REQUEST["users_id"]) ?  $_REQUEST["users_id"] : "",
    "codeusers" => !empty($_REQUEST["codeusers"]) ?  $_REQUEST["codeusers"] : "",
    "title_id" => !empty($_REQUEST["title_id"]) ?  $_REQUEST["title_id"] : "",
    "firstname" => !empty($_REQUEST["firstname"]) ?  $_REQUEST["firstname"] : "",
    "lastname" => !empty($_REQUEST["lastname"]) ?  $_REQUEST["lastname"] : "",
    "telephone" => !empty($_REQUEST["telephone"]) ?  $_REQUEST["telephone"] : "",
    "email" => !empty($_REQUEST["email"]) ?  $_REQUEST["email"] : "",
    "password" => !empty($_REQUEST["password"]) ?  $_REQUEST["password"] : "",
    "status" => !empty($_REQUEST["status"]) ?  $_REQUEST["status"] : "",
    "pic" => ""
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
        $r = $obj->update($data, " users_id = {$data["users_id"]} ");
        break;
    case "delete":
        $r = $obj->delete(" users_id = {$data["users_id"]} ");
        break;
    default:
        break;
}
echo $r;
if($r){
    redirect("index.php?viewName=userList");
}else{
    echo $r;
}

