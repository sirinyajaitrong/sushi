<?php
// header('Content-Type: text/html; charset=utf-8');
class Login {

    public $sql;

    public function insert($data) {
        $conn = new createCon();
        $con = $conn->connect();
        mysqli_query($con,"SET NAMES 'utf8'");
        $this->sql = "INSERT INTO login (`email`, `password`)
         VALUES ('{$data["email"]}', '{$data["password"]}' )";
		$query = mysqli_query($con, $this->sql);
        if ($query) {
            $conn->close();
            return true;
        } else {
            $conn->close();
            return  $this->sql;
        }

        $conn->close();
    }

}
