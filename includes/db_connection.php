<?php
  
  // Check mysql errors
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  
class Database
{
        
    public $connection;
    
    public function __construct()
    {
       
        // Create database connection
        $this->connection = new mysqli("localhost", "root", "mysql", "tyy_beit_shemesh");
        $this->connection->set_charset("utf8"); 

    }
}
  
  $database = new Database;
  $conn = $database->connection;
    
?>