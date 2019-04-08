<?php
// header('Content-Type: text/html; charset=utf-8');
include "./model/customer.php";

$obj = new Customer();
$rows_title = $obj->read_title();

?>

<div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-12 col-md-offset-0 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title f20 " style="text-align: center; font-weight: bold;" >เพิ่มลูกค้า</div>                     
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >
                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>        
						<form action="conCustomer.php" method="post" class="form form-horizontal" enctype="multipart/form-data">
							<input type="hidden" id="action" name="action" value="add" />
							<fieldset>          
								<div class="row">	
									<div class="col-md-3 f16">
										<label>คำนำหน้า</label>
										<select id="title_id" name="title_id" class="form-control">
										<?php
											if ($rows_title != false) {
												foreach ($rows_title as $row_title) {
												?>				
												<option value="<?= $row_title["title_id"] ?>" ><?= $row_title["title_name"] ?></option>
											<?php } } ?>
									</select> 
									</div>
									<div class="col-md-3 f16">
										<label>ชื่อลูกค้า</label>
										<input type="text" name="customer_name" value="" class="form-control"  required="" />
									</div>
									<div class="col-md-3 f16">
										<label>ชื่อร้านค้า</label>
										<input type="text" name="name_store" value="" class="form-control"  required="" />
									</div>
									
									<div class="col-md-3 f16">
										<label>ที่อยู่</label>
										<input type="text" name="address" value="" class="form-control"  required="" />
									</div>
								</div>
								</br>
								<div class="row">	
									<div class="col-md-3 f16">
										<label>หมายเลขโทรศัพท์</label>
										<input type="tel" id="tel" name="tel" value="" class="form-control"  required="" />
									</div>
									<div class="col-md-3 f16">
										<label>หมายเลขโทรศัพท์เคลื่อนที่</label>
										<input type="telephone" id="telephone" name="telephone" value="" class="form-control"  required="" />
									</div>
									</br>
								</div>
								
								<div class="row">			
									<div class="col-md-12">
										<br />
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
		
		$('#tel').usPhoneFormat({
             format: 'x-xxxx-xxxx',
         });

		$('#telephone').usPhoneFormat();
	
    });
</script>