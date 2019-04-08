<?php
// header('Content-Type: text/html; charset=utf-8');
class Orders {

    public $sql;
//stock_id	store_id	products_id	date	stock_quantity

    public function insert($data) {
        $conn = new createCon();
        $con = $conn->connect();
        mysqli_query($con,"SET NAMES 'utf8'");

        $this->sql = "SELECT * FROM orders WHERE store_id = {$data["store_id"]} AND products_id = {$data["products_id"]} 
         AND DATE_FORMAT(date,'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d') ";
        mysqli_query($con,"SET NAMES 'utf8'");
        $query = mysqli_query($con, $this->sql);
        $num = mysqli_num_rows($query);
        if ($num > 0) {
            $result = array();
            while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                $this->sql = "UPDATE orders SET stock_quantity = stock_quantity + {$data["stock_quantity"]}   
                WHERE orders_id =  {$row['orders_id']} ";    
            }
        }else {
            $this->sql = "INSERT INTO orders (`store_id`, `products_id`, `stock_quantity`)
            VALUES ({$data["store_id"]}, {$data["products_id"]}, {$data["stock_quantity"]}) ";
        }
        mysqli_query($con,"SET NAMES 'utf8'"); 
        $query = mysqli_query($con, $this->sql);
        if($query){
            $this->sql = "UPDATE products SET stock = stock + {$data["stock_quantity"]} 
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

    public function delete($condition) {
        $conn = new createCon();
        $con = $conn->connect();

        $this->sql_p = "DELETE FROM orders WHERE {$condition} ";
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

        $this->sql = "SELECT * FROM orders o 
          LEFT OUTER JOIN products p  ON o.products_id = p.products_id 
          LEFT OUTER JOIN color c ON p.color_id = c.color_id 
          LEFT OUTER JOIN products_type pt ON p.products_type_id = pt.products_type_id  
          LEFT OUTER JOIN store sto ON o.store_id = sto.store_id   
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
