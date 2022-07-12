<?php 
class Sql extends PDO{

    private $conn;

    public function __construct(){

        $this->conn = new PDO ("mysql:dbname=dbphp7;host:localhost","root","");
  
    }

    public function setParams($statement, $parameters = array()){

        forEach($parameters as $key=>$value){
                $this->setParam($statement,$key, $value);
            } 

    }

    public function setParam($statement, $key, $value){
            $statement->bindParam($key, $value);
    }

    public function run($rawQuery, $params = array()){

        $stmt = $this->conn->prepare($rawQuery);

            $this->setParams($stmt, $params);
            
            $stmt->execute(); 

        return $stmt;
    }

    public function select($rawQuery, $params = array()):array
    {
        $stmt = $this->run($rawQuery, $params);
        return $stmt ->fetchAll(PDO::FETCH_ASSOC);

    }
}

?>