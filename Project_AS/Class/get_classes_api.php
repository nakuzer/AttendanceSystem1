<?php
session_start();
// Make sure the session is active
if (!isset($_SESSION['user_id'])) {
    header("Location: ../Pages/login.php");
    exit();
}

header("Access-Control-Allow-Origin: *"); // or replace * with a specific domain like http://localhost:3000
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

require_once '../API/database.php';
$database = new Database();
$conn = $database->getConnection();

try{
    $userId = $_SESSION['user_id'];
    $query = "SELECT id, teacher_id, subject_name, subject_code, section, start_time, end_time, days FROM classes WHERE teacher_id = :userID";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':userID', $userId, PDO::PARAM_INT);
    $stmt->execute();
    
    $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($classes) {
        echo json_encode(['status' => 'success', 'data' => $classes]);
    } 
    if(!$classes) {
        throw new Exception("No classes found!");
    }
}catch(Exception $e){
    respond('error', $e->getMessage());
}

?>
