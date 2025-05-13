<?php
  header("Content-Type: application/json");
  header("Access-Control-Allow-Origin: *");
  
  include 'database.php'; // erase when needed

  $database = new Database();
  $db = $database->getConnection();

  class DbTest{
    private $conn;

    public function __construct($db){
      $this->conn = $db;
    }

    public function checkConnection(){
      if($this->conn){
        return ["status" => "success", "message" => "Database Connect successfully" ];
      }
      else{
        return ["status" => "failed", "message" => "Failed to connect to database" ];
      }
    }
  }
  $test = new DbTest($db);

  echo json_encode($test->checkConnection());
  
?>