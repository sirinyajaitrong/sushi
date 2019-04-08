<?php
include "./lib/std.php";
include "./lib/helper.php";
include "./lib/dbConnector.php";
$username = $_REQUEST["username"];
$password = $_REQUEST["password"];
?>

<html>

    <head>
        <meta charset="UTF-8">
        <title>ร้านเดือนวัตถุดิบซูชิ </title>
		<link href="css/site.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="css/datepicker.css">
        <!--<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>-->
        <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
              
    </head>
    <body>
        
        <div class="modal fade" tabindex="-1" role="dialog"  id="myModal" name="myModal">
          <div class="modal-dialog">
          <form class="form-horizontal" role="form" method="post" action="login.php">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">แจ้งเตือน</h4>
              </div>
              <div class="modal-body">
                <p style="text-align:center">ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง !</p>
              </div>
              <div class="modal-footer">
                 <input type="submit" value="OK" id="submit" name="submit" class="btn btn-primary">
              </div>
            </div><!-- /.modal-content -->
            </form>
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

		<script type="text/javascript">
            function msgShow(){
                //alert("hello world");
				$('#myModal').modal('toggle');
				$('#myModal').modal('show');
				//$('#myModal').modal('hide');
            }
		</script>

      <?php
		       $conn = new createCon();
           $con = $conn->connect();
							// go to check in database
							$sql = "select * from users u 
							LEFT OUTER JOIN users_status us ON u.status = us.users_status_id 
							WHERE u.email = '$username' and u.password = '$password' ";
							mysqli_query($con,"SET NAMES 'utf8'");
							$query = mysqli_query($con, $sql);
							$count = mysqli_num_rows($query);
							//var_dump($count);
							if ($count > 0) {
								$_SESSION["logedIn"] = true;
								$_SESSION["isAdmin"] = true;
								while ($row = mysqli_fetch_assoc($query)) {
									$_SESSION["email"] = $row['email'];
									$_SESSION["status"] = $row['status'];
									$_SESSION["users_status_name"] = $row['users_status_name'];
									$_SESSION["user_id"] = $row['id'];
								}
							redirect("index.php?viewName=home");
							} 
							else {
								echo "<script type='text/javascript'>
								$(document).ready(function(){
								$('#myModal').modal('show');
								});
								</script>";
								//echo "aaaa";
								//redirect("login.php");
							}  
							//$conn->close();				
					           			    
           ?>
    </body>
</html>
