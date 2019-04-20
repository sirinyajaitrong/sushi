<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Bangkok');  

include "./lib/dbConnector.php";
include "./model/products.php";

$obj = new Products();

$rows= $obj->read();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title> ร้านเดือนวัตถุดิบซูชิ</title>
		<link href="css/site.css" rel="stylesheet" type="text/css"/>
        
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/print.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="css/datepicker.css">
        <!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
       
        <!--<link ef="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>-->
        <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/print.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="js/jquery-input-mask-phone-number.js"></script>
        <script>
        $(document).ready( function () {
            $('#myTable').DataTable({
                "searching": true
            });
            
        } );
        $(document).ready( function () {
            $('#myTable1').DataTable({
                "searching": true
            });
            
        } );
        </script>
    </head>
    <body>
    <nav class="navbar navbar-default">
    <div class="container-fluid" style="background-color: #ffffff; height:110px;">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="?viewName=home&txt="><img src="images/brand.png"  style="text-align:center; width="auto" height="auto" ></h3></a>				
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="margin-top:25px;font-weight: bold;font-size:16px;">
           
            <ul class="nav navbar-nav navbar-right">
                <li><a href="login.php"><i class="fa fa-sign-in" ></i> เข้าสู่ระบบ</a></li>
            </ul>
						
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


<div class="container">
	<div class="row">
		<div class="col-xs-11 col-md-10 col-centered">
        <br /><br />
			<div id="carousel" class="carousel slide" data-ride="carousel" data-type="multi" data-interval="2500">
				<div class="carousel-inner">
                <?php
                if ($rows != false) {
                    $count = 0;
                    foreach ($rows as $row) {
                        $count += 1;
                    if($count == 1) { ?>
					<div class="item active">
						<div class="carousel-col">
                            <img src="upload_img/<?= $row["pic"] ?>" width="250px;" height="280px" ><br /><br /> <!-- class="img-responsive" -->
                            <span>ชื่อสินค้า : <?= $row["products_name"] ?></span><br />
                            <span>ราคาสินค้า : <?= $row["price"] ?> บาท</span><br />
                            <span>สินค้าคงเหลือ : <?= $row["stock"] ?> แพ็ค</span><br />
						</div>
					</div>
                    <?php } else { ?>
					<div class="item">
						<div class="carousel-col">
                        <img src="upload_img/<?= $row["pic"] ?>" width="250px;" height="280px" ><br /><br />  <!-- class="img-responsive" -->
                            <span>ชื่อสินค้า : <?= $row["products_name"] ?></span><br />
                            <span>ราคาสินค้า : <?= $row["price"] ?> บาท</span><br />
                            <span>สินค้าคงเหลือ : <?= $row["stock"] ?> แพ็ค</span><br />
						</div>
					</div>
                <?php } } } ?>
				</div>

				<!-- Controls -->
				<div class="left carousel-control">
					<a href="#carousel" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
				</div>
				<div class="right carousel-control">
					<a href="#carousel" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
                    </div>
			</div>

		</div>
	</div>
</div>


</body>
</html>

<style>
.col-centered {
    float: none;
    margin: 0 auto;
}

.carousel-control { 
    width: 8%;
    width: 0px;
}
.carousel-control.left,
.carousel-control.right { 
    margin-right: 40px;
    margin-left: 32px; 
    background-image: none;
    opacity: 1;
}
.carousel-control > a > span {
    color: white;
	  font-size: 29px !important;
}

.carousel-col { 
    position: relative; 
    min-height: 1px; 
    padding: 5px; 
    float: left;
 }

 .active > div { display:none; }
 .active > div:first-child { display:block; }

/*xs*/
@media (max-width: 767px) {
  .carousel-inner .active.left { left: -50%; }
  .carousel-inner .active.right { left: 50%; }
	.carousel-inner .next        { left:  50%; }
	.carousel-inner .prev		     { left: -50%; }
  .carousel-col                { width: 50%; }
	.active > div:first-child + div { display:block; }
}

/*sm*/
@media (min-width: 768px) and (max-width: 991px) {
  .carousel-inner .active.left { left: -50%; }
  .carousel-inner .active.right { left: 50%; }
	.carousel-inner .next        { left:  50%; }
	.carousel-inner .prev		     { left: -50%; }
  .carousel-col                { width: 50%; }
	.active > div:first-child + div { display:block; }
}

/*md*/
@media (min-width: 992px) and (max-width: 1199px) {
  .carousel-inner .active.left { left: -33%; }
  .carousel-inner .active.right { left: 33%; }
	.carousel-inner .next        { left:  33%; }
	.carousel-inner .prev		     { left: -33%; }
  .carousel-col                { width: 33%; }
	.active > div:first-child + div { display:block; }
  .active > div:first-child + div + div { display:block; }
}

/*lg*/
@media (min-width: 1200px) {
  .carousel-inner .active.left { left: -25%; }
  .carousel-inner .active.right{ left:  25%; }
	.carousel-inner .next        { left:  25%; }
	.carousel-inner .prev		     { left: -25%; }
  .carousel-col                { width: 25%; }
	.active > div:first-child + div { display:block; }
  .active > div:first-child + div + div { display:block; }
	.active > div:first-child + div + div + div { display:block; }
}

.block {
	width: 306px;
	height: 230px;
}

.red {background: red;}

.blue {background: blue;}

.green {background: green;}

.yellow {background: yellow;}
</style>

<script>
$('.carousel[data-type="multi"] .item').each(function() {
	var next = $(this).next();
	if (!next.length) {
		next = $(this).siblings(':first');
	}
	next.children(':first-child').clone().appendTo($(this));

	for (var i = 0; i < 2; i++) {
		next = next.next();
		if (!next.length) {
			next = $(this).siblings(':first');
		}

		next.children(':first-child').clone().appendTo($(this));
	}
});
</script>