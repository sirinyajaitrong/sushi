<?php
// header('Content-Type: text/html; charset=utf-8');
include "./model/products.php";

$obj = new Products();


$rows_color = $obj->read_color();
$rows_products_type = $obj->read_products_type();

?>
<script type="text/javascript">
	// When the document is ready
	$(document).ready(function () {		
		$('#mfd').datepicker({
			format: "yyyy-mm-dd"
		});  
		$('#exd').datepicker({
			format: "yyyy-mm-dd"
		});  
	});
</script>

<div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-12 col-md-offset-0 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title f20 " style="text-align: center; font-weight: bold; " >เพิ่มสินค้า</div>                     
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >
                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>        
						<form action="conProducts.php" method="post" class="form form-horizontal" enctype="multipart/form-data">
							<input type="hidden" id="action" name="action" value="add" />
							<fieldset>          
								<div class="row">	
									<div class="col-md-3 f16">
										<label>ชื่อสินค้า</label>
										<input type="text" name="products_name" value="" class="form-control"  required="" />
									</div>
									<div class="col-md-3 f16">
										<label>สี</label>
										<select id="color_id" name="color_id" class="form-control">
											<?php
											if ($rows_color != false) {
												foreach ($rows_color as $row_color) {
												?>				
												<option value="<?= $row_color["color_id"] ?>" ><?= $row_color["color_name"] ?></option>
											<?php } } ?>
										</select> 
									</div>
									<div class="col-md-3 f16">
										<label>ประเภทสินค้า</label>
										<select id="products_type_id" name="products_type_id" class="form-control">
											<?php
											if ($rows_products_type != false) {
												foreach ($rows_products_type as $row_products_type) {
												?>				
												<option value="<?= $row_products_type["products_type_id"] ?>" ><?= $row_products_type["products_type_name"] ?></option>
											<?php } } ?>
										</select> 
									</div>
									<div class="col-md-3 f16">
										<label>ราคา</label>
										<input type="number" name="price" value="" class="form-control text-right" min="1" value=""  required="" />
									</div>
								</div>
								</br>
								<div class="row">	
									
									<div class="col-md-3 f16">
										<label>ต้นทุน</label>
										<input type="number" name="cost" value="" class="form-control text-right" min="1" value=""  required="" />
									</div>
									<div class="col-md-3 f16">
										<label>วันที่ผลิต</label>
										<input type="text" id="mfd" name="mfd" value="" class="form-control"  required="" readonly="readonly"  />
									</div>	
									<div class="col-md-3 f16">
										<label>วันที่หมดอายุ</label>
										<input type="text" id="exd" name="exd" value="" class="form-control"  required="" readonly="readonly" />
									</div>
									<div class="col-md-3 f16">
										<label>รูปภาพ</label>
										<input type="file" name="pic" id="fileToUpload">
									</div>
								</br>
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
