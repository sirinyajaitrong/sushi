<?php
//----------------------------
class createCon  {
    var $host = 'localhost';
    var $user = 'root';
    var $pass = '';
    var $db = 'sushi';
    var $myconn;

    function connect() {
        $con = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        if (!$con) {
            die('Could not connect to database!');
        } else {
            $this->myconn = $con;
          // echo 'Connection established!';
		}
        return $this->myconn;
    }

    function close() {
       // mysqli_close($myconn);
        //echo 'Connection closed!';
    }

}

//$dbName = "inventory_management";
//mysqli_query($link,"SET CHARACTER SET 'utf8'");
//mysqli_query($link,"SET SESSION collation_connection ='utf8_unicode_ci'");