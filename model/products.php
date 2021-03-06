<?php
// header('Content-Type: text/html; charset=utf-8');
class Products {

    public $sql;

    public function insert($data) {
        $conn = new createCon();
        $con = $conn->connect();
        mysqli_query($con,"SET NAMES 'utf8'");
        $this->sql = "INSERT INTO products (`color_id`, `products_name`, `pic`, `price`, `cost`, `mfd`,`exd`, products_type_id, stock)
         VALUES ({$data["color_id"]}, '{$data["products_name"]}', '{$data["pic"]}', {$data["price"]}, {$data["cost"]}, '{$data["mfd"]}', '{$data["exd"]}', {$data["products_type_id"]}, {$data["stock"]} )";
		$query = mysqli_query($con, $this->sql);
        if ($query) {
            return  mysqli_insert_id($con);
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
            $this->sql = "UPDATE products 
            SET color_id = {$data["color_id"]}, 
            products_type_id = {$data["products_type_id"]},
            products_name = '{$data["products_name"]}', 
            pic = '{$data["pic"]}', 
            price = {$data["price"]}, 
            cost = {$data["cost"]}, 
            mfd = '{$data["mfd"]}', 
            stock = '{$data["stock"]}',
            exd = '{$data["exd"]}' 
            WHERE {$condition} ";    
        }else{
            $this->sql = "UPDATE products 
            SET color_id = {$data["color_id"]}, 
            products_type_id = {$data["products_type_id"]},
            products_name = '{$data["products_name"]}',
            price = {$data["price"]}, 
            cost = {$data["cost"]}, 
            mfd = '{$data["mfd"]}', 
            stock = '{$data["stock"]}',
            exd = '{$data["exd"]}'
            WHERE {$condition} ";      
        }  
        mysqli_query($con,"SET NAMES 'utf8'"); 
		$query = mysqli_query($con,$this->sql);   
		
        if ($query){
			return true;
		}else{
			return $this->sql;
        }
        
        $conn->close();
    }

    public function update_return($data, $condition) {
        $conn = new createCon();
        $con = $conn->connect();

            $this->sql = "UPDATE products  
            SET stock = stock + {$data["sell_quantity"]} 
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

        $this->sql_p = "DELETE FROM products WHERE {$condition}";
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

        $this->sql = "SELECT * FROM  products p LEFT OUTER JOIN color c ON p.color_id = c.color_id 
          LEFT OUTER JOIN products_type pt ON p.products_type_id = pt.products_type_id  
          WHERE $condition AND p.stock > 0 ";
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

    
    public function read_sell($condition = "1=1 ") {
		$conn = new createCon();
        $con = $conn->connect();

        $this->sql = "SELECT * FROM  products p LEFT OUTER JOIN color c ON p.color_id = c.color_id 
          LEFT OUTER JOIN products_type pt ON p.products_type_id = pt.products_type_id  
          WHERE $condition AND p.stock > 0 ORDER BY p.products_name, p.products_id ";
          mysqli_query($con,"SET NAMES 'utf8'");
        $query = mysqli_query($con,$this->sql);
        if ($query) {
            $result = array();
            $products_name = "";
            while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {    
                if($row["products_name"] != $products_name){
                    $result[] = $row;
                 }          
                 $products_name = $row["products_name"];
            }
            return $result;
        } else {
            return false;
        }       
        
		$conn->close();
    }

//name_products
    public function read_name_products($condition = "1=1 ") {
        $conn = new createCon();
        $con = $conn->connect();

        $this->sql = "SELECT * FROM  name_products 
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
    
    public function read_color($condition = "1=1 ") {
		$conn = new createCon();
        $con = $conn->connect();

        $this->sql = "SELECT * FROM  color  
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
    //products_type
    public function read_products_type($condition = "1=1 ") {
		$conn = new createCon();
        $con = $conn->connect();

        $this->sql = "SELECT * FROM  products_type  
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
}
