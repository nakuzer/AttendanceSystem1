<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once '../API/database.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-type: application/json');
$database = new Database();
$conn = $database->getConnection();

$response = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $email = filter_var($data['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $schoolID = htmlspecialchars($data['schoolID'] ?? '');
    $role = $data['role'] ?? '';
    $course = ($role === 'student') ? htmlspecialchars($data['course'] ?? '') : null;
    $field = ($role === 'teacher') ? htmlspecialchars($data['field'] ?? '') : null;
    $firstName = htmlspecialchars($data['firstName'] ?? '');
    $lastName = htmlspecialchars($data['lastName'] ?? '');
    $password = $data['password'] ?? '';
    $passwordConfirm = $data['confirmPass'] ?? '';


    $conn->beginTransaction();
    try {
        $checkStmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $checkStmt->bindParam(1, $email);
        $checkStmt->execute();

        if (empty($role)) {
            throw new Exception("You must choose a role.");
        }
        if ($checkStmt->fetchColumn() > 0) {
            throw new Exception("Email is already registered.");
        }
        if (!$email) {
            throw new Exception("Invalid email format.");
        }

        // Ensure email is from @wmsu.edu.ph
        if (!preg_match('/@wmsu\.edu\.ph$/', $email)) {
            throw new Exception("Email must be from @wmsu.edu.ph email.");
        }
        if (strlen($password) < 8) {
            throw new Exception("Password must be at least 8 characters long.");
        }
        if ($password !== $passwordConfirm) {
            throw new Exception("Password does'nt match. Please try again.");
        }
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        if (!$hashed_password) {
            throw new Exception("Error hashing the password.");
        }
        if ($role === 'student' && empty($course)) {
            throw new Exception("Course is required for students.");
        }
        if ($role === 'teacher' && empty($field)) {
            throw new Exception("Field is required for teachers.");
        }

        $qry = "INSERT INTO users (email, schoolID, password, role, first_name, last_name) VALUES (?,?,?,?,?,?)";
        $stmt = $conn->prepare($qry);
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $schoolID);
        $stmt->bindParam(3, $hashed_password);
        $stmt->bindParam(4, $role);
        $stmt->bindParam(5, $firstName);
        $stmt->bindParam(6, $lastName);


        if ($stmt->execute()) {
            $user_id = $conn->lastInsertId();

            if ($role === 'student') {
                $stmt = $conn->prepare("INSERT INTO students(user_id, course) VALUES(?,?)");
                $stmt->bindParam(1, $user_id);
                $stmt->bindParam(2, $course);
                // $stmt->bindParam(3, $department);

                $stmt->execute();
            } elseif ($role === 'teacher') {
                $stmt = $conn->prepare("INSERT INTO teachers(user_id, field) VALUES (?,?)");
                $stmt->bindParam(1, $user_id);
                $stmt->bindParam(2, $field);
                // $stmt->bindParam(3, $department);
                $stmt->execute();
            }
        }
        $conn->commit();
        respond('success', 'Account created successfully.');
    } catch (Exception $e) {
        $conn->rollBack();
        respond('error', $e->getMessage());
    }
}
?>