<?php
class Database{
 
    // specify your own database credentials
    // private $host = "136.198.117.80, 1433";
    // private $host = "136.198.117.80, 53313";
    private $host = "136.198.117.80, 61266";
    private $db_name = "magenta";
    private $username = "sa";
    private $password = "JvcSql@123";
    private $driver = 'sqlsrv';
    public $conn;

    public function __construct(array $arg = null){
        if (!is_null($arg)) {
            # code...
            $this->host = $arg['host'];
            $this->db_name = $arg['db_name'];
            $this->username = $arg['username'];
            $this->password = $arg['password'];
            $this->driver = $arg['driver'];
        }
    }
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            if($this->driver == 'firebird'){
                $connectionString = $this->driver.":host=" . $this->host . ";dbname=" . $this->db_name;
            }

            if($this->driver == 'sqlsrv'){
                $connectionString = $this->driver.':Server='.$this->host.';Database='.$this->db_name;
            }
            
            $this->conn = new PDO($connectionString,$this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>