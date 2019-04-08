<?php
// header('Content-Type: text/html; charset=utf-8');
class Store {

    public $sql;
//stock_id	store_id	products_id	date	stock_quantity

    public function insert($data) {
        $conn = new createCon();
        $con = $conn->connect();
        mysqli_query($con,"SET NAMES 'utf8'");
        $this->sql = "INSERT INTO stock (`store_id`, `products_id`, `stock_quantity`)
         VALUES ({$data["store_id"]}, {$data["products_id"]}, {$data["stock_quantity"]}) ";
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

        $this->sql = "SELECT * FROM  store 
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
