<?php
class Database {
    private $db_host = "localhost";
    private $db_name = "attendance_system_db";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            respond('error', 'Database connection failed: ' . $e->getMessage());
        }

        return $this->conn;
    }
}

function respond($status, $message, $redirect = null) {
    header('Content-Type: application/json');
    $response = [
        'status' => $status,
        'message' => $message
    ];
    if ($redirect) {
        $response['redirect'] = $redirect;
    }
    echo json_encode($response);
    exit;
}
?>
