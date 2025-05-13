<?php
// Set session settings and error reporting
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', isset($_SERVER['HTTPS']));
ini_set('session.use_strict_mode', 1); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start the session and check if the user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Pages/login.php");
    exit();
}

// Allow CORS and handle OPTIONS request for preflight
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once '../API/database.php';
$database = new Database();
$conn = $database->getConnection();

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Decode the incoming JSON request
        $data = json_decode(file_get_contents("php://input"), true);
        
        // Get the user ID from the session
        $userId = $_SESSION['user_id'];

        // Validate input fields
        if (
            isset($data['subjectName'], $data['subjectCode'], $data['section'], $data['startTime'], $data['endTime'], $data['days'])
        ) {
            // Prepare the SQL query
            $query = "INSERT INTO classes (subject_name, subject_code, section, start_time, end_time, days, teacher_id) 
                      VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);

            // Bind parameters
            $stmt->bindParam(1, $data['subjectName']);
            $stmt->bindParam(2, $data['subjectCode']);
            $stmt->bindParam(3, $data['section']);
            $stmt->bindParam(4, $data['startTime']);
            $stmt->bindParam(5, $data['endTime']);
            $stmt->bindParam(6, $data['days']);
            $stmt->bindParam(7, $userId, PDO::PARAM_INT);

            // Execute the query
            if ($stmt->execute()) {
                http_response_code(200);
                respond('success', 'Class created successfully');
            } else {
                http_response_code(500);
                throw new Exception("Insert failed");
            }
        } else {
            http_response_code(400);
            throw new Exception('Missing required fields');
        }
    }
} catch (Exception $e) {
    // Return the error message as JSON
    respond('error', $e->getMessage());
}
?>
