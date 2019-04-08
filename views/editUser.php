<?php
// header('Content-Type: text/html; charset=utf-8');
include "./model/user.php";

$obj = new User();
$rows = $obj->read(" users_id = {$_REQUEST['users_id']} ");
$row = $rows[0];
$rows_title = $obj->read_title();
$rows_status = $obj->read_users_status();

?>

<div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-12 col-md-offset-0 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title f20" style="text-align: center; font-weight: bold;"  >แก้ไขผู้ใช้งาน</div>                     
                    </div>     
                    <div style="padding-top:30px" class="panel-body" >
                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>        
						<form action="conUser.php" method="post" class="form form-horizontal" enctype="multipart/form-data">
							<input type="hidden" id="action" name="action" value="edit" />
							<input type="hidden" id="users_id" name="users_id" value="<?= $_REQUEST['users_id'] ?>" />
							<fieldset>          
								<div class="row">	
									<div class="col-md-3 f16">
										<label>รหัสผู้ใช้งาน</label>
										<input type="text" name="codeusers" value="<?= $row['codeusers'] ?>" class="form-control"  required="" />
									</div>
									<div class="col-md-3 f16">
										<label>คำนำหน้า</label>
										<select id="title_id" name="title_id" class="form-control">
										<?php
											if ($rows_title != false) {
												foreach ($rows_title as $row_title) {
												?>				
												<option <?php if ($row_title["title_id"] == $row["title_id"]) echo 'selected'; ?> value="<?= $row_title["title_id"] ?>" ><?= $row_title["title_name"] ?></option>
											<?php } } ?>
									</select> 
									</div>
									<div class="col-md-3 f16">
										<label>ชื่อ</label>
										<input type="text" name="firstname" value="<?= $row['firstname'] ?>" class="form-control"  required="" />
									</div>
									<div class="col-md-3 f16">
										<label>นามสกุล</label>
										<input type="text" name="lastname" value="<?= $row['lastname'] ?>" class="form-control"  required="" />
									</div>
								</div>
								</br>
								<div class="row">	
									<div class="col-md-3 f16">
										<label>หมายเลขโทรศัพท์เคลื่อนที่</label>
										<input type="tel" id="telephone" name="telephone" value="<?= $row['telephone'] ?>" class="form-control"  required="" />
									</div>
									<div class="col-md-3 f16">
										<label>อีเมล</label>
										<input type="text" name="email" value="<?= $row['email'] ?>" class="form-control"  required="" />
									</div>
									<div class="col-md-3 f16">
										<label>รหัสผ่าน</label>
										<input type="password" name="password" value="<?= $row['password'] ?>" class="form-control"  required="" />
									</div>	
									<div class="col-md-3 f16">
										<label>สถานะ</label>
										<select id="status" name="status" class="form-control">
										<?php
											if ($rows_status != false) {
												foreach ($rows_status as $row_status) {
												?>				
												<option <?php if ($row_status["users_status_id"] == $row["users_status_id"]) echo 'selected'; ?> value="<?= $row_status["users_status_id"] ?>" ><?= $row_status["users_status_name"] ?></option>
											<?php } } ?>
										</select> 
									</div>
								</div>
								</br>
								<div class="row">	
									<div class="col-md-3 f16">
										<?php if(!empty($row["pic"])){ ?>
											<img src="./upload_img/<?php echo $row["pic"]; ?>" width="100" height="100" alt="">
										<?php }  ?>
										<br />
										<label></label>
										<br />
										<input type="file" name="pic" id="fileToUpload">
									</div>	
								</div>
								<div class="row">			
									<div class="col-md-12 f16">
										<button type="submit" class="btn btn-primary pull-right f16">
												บันทึกข้อมูล
										</button>
									</div>
									<div class="col-md-8">
									</div>
								</div>
							</fieldset>
						</form>



                        </div>                     
                    </div>  
        </div>

                   
                
         </div> 
</div>

<script>
//  $('.phone').mask('(999) 999-9999');
    $(document).ready(function () {
        // $('#telephone').usPhoneFormat({
        //     format: '(xxx) xxx-xxxx',
        // });

        $('#telephone').usPhoneFormat();
    });
</script>