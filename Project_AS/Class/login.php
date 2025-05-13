<?php
session_start();
include_once '../API/database.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = htmlspecialchars($_POST['role']);

    // Select table based on role
    if ($role === 'student') {
        $sql = "SELECT * FROM students WHERE email = :email";
    } elseif ($role === 'teacher') {
        $sql = "SELECT * FROM teachers WHERE email = :email";
    } else {
        echo "Invalid role selected!";
        exit;
    }

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "DEBUG: No user found with email: " . $email . " in role: " . $role;
        echo "No user found.";
        exit;
    }
    
    // Check if user exists and verify password
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        header("Location: ../Pages/dashboard.php");
        exit;
    } else {
        echo "Invalid credentials!";
        exit;
    }
    
    
    
}
?>

