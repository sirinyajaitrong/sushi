<?php
// header('Content-Type: text/html; charset=utf-8');
class User {

    public $sql;

    public function insert($data) {
        $conn = new createCon();
        $con = $conn->connect();
        mysqli_query($con,"SET NAMES 'utf8'");
        $this->sql = "INSERT INTO users (`codeusers`, `title_id`, `firstname`, `lastname`, `telephone`, `email`, `password`,`status`,`pic`)
         VALUES ('{$data["codeusers"]}', {$data["title_id"]}, '{$data["firstname"]}', '{$data["lastname"]}', '{$data["telephone"]}', '{$data["email"]}', '{$data["password"]}', {$data["status"]}, '{$data["pic"]}' )";
		$query = mysqli_query($con, $this->sql);
        if ($query) {
            return true;
        } else {
            return  $this->sql;
        }

        $conn->close();
    }

    public function update($data, $condition) {
        $conn = new createCon();
        $con = $conn->connect();

        $this->sql = "";

        if($data["pic"] != ""){
            $this->sql = "UPDATE users 
            SET codeusers = '{$data["codeusers"]}', 
            title_id = {$data["title_id"]}, 
            firstname = '{$data["firstname"]}', 
            lastname = '{$data["lastname"]}', 
            telephone = '{$data["telephone"]}', 
            email = '{$data["email"]}', 
            password = '{$data["password"]}', 
            status = '{$data["status"]}', 
            pic = '{$data["pic"]}' 
            WHERE {$condition} ";    
        }else{
            $this->sql = "UPDATE users 
            SET codeusers = '{$data["codeusers"]}', 
            title_id = {$data["title_id"]}, 
            firstname = '{$data["firstname"]}', 
            lastname = '{$data["lastname"]}', 
            telephone = '{$data["telephone"]}', 
            email = '{$data["email"]}', 
            password = '{$data["password"]}', 
            status = '{$data["status"]}' 
            WHERE {$condition} ";    
        }  
        mysqli_query($con,"SET NAMES 'utf8'"); 
		$query = mysqli_query($con,$this->sql);   
		
        if ($query){
			return true;
		}else{
			return false;
        }
        
        $conn->close();
    }

    public function delete($condition) {
        $conn = new createCon();
        $con = $conn->connect();

        $this->sql_p = "DELETE FROM users WHERE {$condition}";
		$query = mysqli_query($con, $this->sql_p);
				
        if ($query) {
            return true;
        } else {
            return false;
        }

        $conn->close();
    }

    public function read($condition = "1=1 ") {
		$conn = new createCon();
        $con = $conn->connect();

        $this->sql = "SELECT * FROM  users u LEFT OUTER JOIN title t ON u.title_id = t.title_id
        LEFT OUTER JOIN users_status us ON u.status = us.users_status_id 
          WHERE $condition ";
          mysqli_query($con,"SET NAMES 'utf8'");
        $query = mysqli_query($con,$this->sql);
        if ($query) {
            $result = array();
            while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                $result[] = $row;
            }
            return $result;
        } else {
            return false;
        }       
        
		$conn->close();
    }

    public function read_title($condition = "1=1") {
		$conn = new createCon();
        $con = $conn->connect();

        $this->sql = "SELECT * FROM title WHERE $condition ";
          mysqli_query($con,"SET NAMES 'utf8'");
        $query = mysqli_query($con,$this->sql);
        if ($query) {
            $result = array();
            while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                $result[] = $row;
            }
            return $result;
        } else {
            return false;
        }       
        
		$conn->close();
    }
    //users_status
    public function read_users_status($condition = "1=1") {
		$conn = new createCon();
        $con = $conn->connect();

        $this->sql = "SELECT * FROM users_status WHERE $condition ";
          mysqli_query($con,"SET NAMES 'utf8'");
        $query = mysqli_query($con,$this->sql);
        if ($query) {
            $result = array();
            while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                $result[] = $row;
            }
            return $result;
        } else {
            return false;
        }       
        
		$conn->close();
    }
}
