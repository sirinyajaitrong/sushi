<?php
// header('Content-Type: text/html; charset=utf-8');
include "./model/customer.php";

$obj = new Customer();
$rows = $obj->read(" customer_id = {$_REQUEST['customer_id']} ");
$row = $rows[0];
$rows_title = $obj->read_title();

?>

<div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-12 col-md-offset-0 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title f18" style="text-align: center; font-weight: bold;"  >แก้ไขลูกค้า</div>                     
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >
                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>        
						<form action="conCustomer.php" method="post" class="form form-horizontal" enctype="multipart/form-data">
							<input type="hidden" id="action" name="action" value="edit" />
							<input type="hidden" id="customerid" name="customer_id" value="<?= $_REQUEST['customer_id'] ?>" />
							<fieldset>          
								<div class="row">	
									<div class="col-md-3">
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
									<div class="col-md-3">
										<label>ชื่อลูกค้า</label>
										<input type="text" name="customer_name" value="<?= $row['customer_name'] ?>" class="form-control"  required="" />
									</div>
									<div class="col-md-3">
										<label>ชื่อร้านค้า</label>
										<input type="text" name="name_store" value="<?= $row['name_store'] ?>" class="form-control"  required="" />
									</div>
									<div class="col-md-3">
										<label>ที่อยู่</label>
										<input type="text" name="address" value="<?= $row['address'] ?>" class="form-control"  required="" />
									</div>
								</div>
								</br>
								<div class="row">
								<div class="col-md-3">
										<label>หมายเลขโทรศัพท์</label>
										<input type="tel" id="tel" name="tel" value="<?= $row['tel'] ?>" class="form-control"  required="" />
									</div>	
									<div class="col-md-3">
										<label>หมายเลขโทรศัพท์เคลื่อนที่</label>
										<input type="tel" id="telephone" name="telephone" value="<?= $row['telephone'] ?>" class="form-control"  required="" />
									</div>
								</br>
								</div>
								<div class="row">			
									<div class="col-md-12">
										<br />
										<button type="submit" class="btn btn-primary pull-right">
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
		
		$('#tel').usPhoneFormat({
             format: 'x-xxxx-xxxx',
         });

		$('#telephone').usPhoneFormat();
	
    });
</script>