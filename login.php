<!doctype>
<html>
    <head>
        <title></title>
        <meta charset="utf-8" />
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/site.css" rel="stylesheet" type="text/css"/>
        <style>
        </style>
    </head>
    <body>
    <div class="row" style="background-color: #ffffff;">
        <div class="col-md-12 text-center">
            <img src="images/login.png" style="text-align:center;color:#333"; width="auto" height="auto"></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
        </div>
        <div class="col-md-2">
            <form class="form-signin center " method="post" action="checkLogin.php">  
                <br/> <br/>            
                <label for="inputEmail" class="sr-only ">กรอกอีเมล</label>
            
                <label for="inputPassword" class="sr-only ">กรอกรหัสผ่าน</label>
                
                
                <div class="input-group input-group-unstyled">
                    <span class="input-group-addon">
                        <i class="fa fa-user"></i>
                    </span>
                    <input type="email" name="username" id="inputEmail" class="form-control" placeholder="กรอกอีเมล" required="" autofocus=""> 
                </div>
                <br />
                <div class="input-group input-group-unstyled">
                    <span class="input-group-addon" >
                        <i class="fa fa-lock"></i>
                    </span>
                    <input  type="password" name="password" id="inputPassword" class="form-control" placeholder="กรอกรหัสผ่าน" required="">
                </div>

                <br/>
                <button class="btn btn-lg btn-info btn-block  f18"  type="submit">เข้าสู่ระบบ</button>
            </form>
        </div>
        <div class="col-md-5">
        </div>  
    </div>
    </body>
</html>