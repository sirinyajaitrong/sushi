<?php
// header('Content-Type: text/html; charset=utf-8');
class Sell {

    public $sql;
//stock_id	customer_id	products_id	date	sell_quantity

    public function insert($data) {
        $conn = new createCon();
        $con = $conn->connect();
        mysqli_query($con,"SET NAMES 'utf8'");

        $this->sql = "SELECT * FROM sell WHERE customer_id = {$data["customer_id"]} AND products_id = {$data["products_id"]} 
         AND DATE_FORMAT(date,'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d') ";
        mysqli_query($con,"SET NAMES 'utf8'");
        $query = mysqli_query($con, $this->sql);
        $num = mysqli_num_rows($query);
        if ($num > 0) {
            $result = array(); 	
            while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                $this->sql = "UPDATE sell SET sell_quantity = sell_quantity + {$data["sell_quantity"]}   
                WHERE sell_id =  {$row['sell_id']} ";    
            }
        }else {
            $this->sql = "INSERT INTO sell (`customer_id`, `products_id`, `sell_quantity`)
            VALUES ({$data["customer_id"]}, {$data["products_id"]}, {$data["sell_quantity"]}) ";
        }
        mysqli_query($con,"SET NAMES 'utf8'"); 
        $query = mysqli_query($con, $this->sql);
        if($query){
            $this->sql = "UPDATE products SET stock = stock - {$data["sell_quantity"]} 
            WHERE products_id = {$data["products_id"]} ";
         $query = mysqli_query($con, $this->sql);
        }
        if ($query) {
            $conn->close();
            return true;
        } else {
            $conn->close();
            return  $this->sql;
        }      
    }

    public function update($data, $condition) {
        $conn = new createCon();
        $con = $conn->connect();

        $this->sql = "UPDATE sell SET delivery_status_id = 1 WHERE {$condition} ";    
       
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

        $this->sql_p = "DELETE FROM sell WHERE {$condition} ";
		$query = mysqli_query($con, $this->sql_p);
				
        if ($query) {
            return true;
        } else {
            return $this->sql_p;
        }

        $conn->close();
    }

    public function read($condition = "1=1 ") {
		$conn = new createCon();
        $con = $conn->connect();

        $this->sql = "SELECT * FROM sell s 
          LEFT OUTER JOIN products p  ON s.products_id = p.products_id 
          LEFT OUTER JOIN color c ON p.color_id = c.color_id 
          LEFT OUTER JOIN products_type pt ON p.products_type_id = pt.products_type_id  
          LEFT OUTER JOIN customer cus ON s.customer_id = cus.customer_id   
          WHERE $condition ORDER BY date DESC";
          mysqli_query($con,"SET NAMES 'utf8'");
        $query = mysqli_query($con,$this->sql);
        if ($query) {
            $result = array();
            while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                $result[] = $row;
            }
            $conn->close();
            return $result;
        } else {
            $conn->close();
            return false;
        }       
    }

}
