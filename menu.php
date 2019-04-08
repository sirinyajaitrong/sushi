<nav class="navbar-fixed-top navbar-default">
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
            <ul class="nav navbar-nav">
                <li class="1">
                    <a href="?viewName=home"><i fa fa-home"></i> หน้าหลัก</a>
                </li>
                <li class="2">
                    <a href="?viewName=userList"><i fa fa-user"></i> ผู้ใช้งาน <span class="sr-only">(current)</span></a></li>
                </li>
                <li class="3">
                    <a href="?viewName=customerList"><i class="fa fa-users"></i> ลูกค้า <span class="sr-only">(current)</span></a></li>
                </li>
                <li class="4">
                    <a href="?viewName=ordersList"><i class="fa fa-shopping-basket"></i> สั่งซื้อสินค้า <span class="sr-only">(current)</span></a></li>
                </li>
                <li class="5">
                    <a href="?viewName=productsList"><i class="fa fa-cube"></i> สินค้า <span class="sr-only">(current)</span></a></li>
                </li>
                <li class="6">
                    <a href="?viewName=sellList"><i class="fa fa-shopping-cart"></i> ขายสินค้า <span class="sr-only">(current)</span></a></li>
                </li>
                <li class="7">
                    <a href="?viewName=sellReport&dateFrom=<?= date("Y-m-d") ?>&dateTo=<?= date("Y-m-d") ?>"> <i class="fa fa-file-text" ></i> รายงานยอดขายสินค้า</a>
                </li>       
			</ul>   					
			
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php"><i class="fa fa-sign-out" ></i> ออกจากระบบ</a></li>
            </ul>
						
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<style type='text/css'>

</style>
