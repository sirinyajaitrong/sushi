<?php
// header('Content-Type: text/html; charset=utf-8');
class Customer {

    public $sql;

    public function insert($data) {
        $conn = new createCon();
        $con = $conn->connect();
        mysqli_query($con,"SET NAMES 'utf8'");
        $this->sql = "INSERT INTO customer (`title_id`, `name_store`, `customer_name`, `address`, `tel`, `telephone`)
         VALUES ({$data["title_id"]}, '{$data["name_store"]}', '{$data["customer_name"]}', '{$data["address"]}', '{$data["tel"]}', '{$data["telephone"]}')";
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

        $this->sql = "UPDATE customer 
        SET title_id = {$data["title_id"]}, 
        name_store = '{$data["name_store"]}', 
        customer_name = '{$data["customer_name"]}', 
        address = '{$data["address"]}', 
        tel = '{$data["tel"]}', 
        telephone = '{$data["telephone"]}' 
        WHERE {$condition} ";    

        mysqli_query($con,"SET NAMES 'utf8'"); 
		$query = mysqli_query($con,$this->sql);   
		
        if ($query){
			return true;
		}else{
			return $this->sql;
        }
        
        $conn->close();
    }

    public function delete($condition) {
        $conn = new createCon();
        $con = $conn->connect();

        $this->sql_p = "DELETE FROM customer WHERE {$condition}";
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

        $this->sql = "SELECT * FROM  customer c LEFT OUTER JOIN title t ON c.title_id = t.title_id 
          WHERE $condition ORDER BY c.customer_id ";
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
