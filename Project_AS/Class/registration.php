<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start();
    require_once '../API/database.php';
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");

    
    $response = array();
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $database = new Database();
        $conn = $database->getConnection();

        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

        $checkStmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $checkStmt->bindParam(1, $email);
        $checkStmt->execute();

        if($checkStmt->fetchColumn() > 0){
            $response['status'] = 'error';
            $response['message'] = 'Email is already registered.';
            echo json_encode($response);
            exit;
        }

         if (!$email) {
            $response['status'] = 'error';
            $response['message'] = 'Invalid email format';
            echo json_encode($response);
            exit;
        }

        // Ensure email is from @wmsu.edu.ph
        if (!preg_match('/@wmsu\.edu\.ph$/', $email)) {
            $response['status'] = 'error';
            $response['message'] = 'Email must be from @wmsu.edu.ph email.';
            echo json_encode($response);
            exit;
        }

        $schoolID = htmlspecialchars($_POST['schoolID']);
        $role = $_POST['role'];
        $course = ($role === 'student')? htmlspecialchars($_POST['course']) : null;
        $field = ($role === 'teacher')? htmlspecialchars($_POST['field']) : null;
        $firstName = htmlspecialchars($_POST['firstName']);
        $lastName = htmlspecialchars($_POST['lastName']);
        // $department = htmlspecialchars($_POST['department']);
        $password = $_POST['password'];
        $passwordConfirm = $_POST['confirmPassword'];

        if(strlen($password) < 8){
            $response['status'] = 'error';
            $response['message'] = 'password must be more than 8';
            echo json_encode($response);
            exit;
        }
        if($password !== $passwordConfirm){
            $response['status'] = 'error';
            $response['message'] = 'Password doesn\'t match please try again';
            echo json_encode($response);
            exit;
        }
        $conn->beginTransaction();
        try{
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            if(!$hashed_password){
                throw new Exception("Error hashing the password.");
            }

            $qry = "INSERT INTO users (email, password, role, first_name, last_name) VALUES (?,?,?,?,?)";
            $stmt = $conn->prepare($qry);
            $stmt->bindParam(1, $email);
            $stmt->bindParam(2, $hashed_password);
            $stmt->bindParam(3, $role);
            $stmt->bindParam(4, $firstName);
            $stmt->bindParam(5, $lastName);

            if($stmt->execute()){
                $user_id = $conn->lastInsertId();

                if($role === 'student'){
                    $stmt = $conn->prepare("INSERT INTO students(user_id, course) VALUES(?,?)");
                    $stmt->bindParam(1, $user_id);
                    $stmt->bindParam(2, $course);
                    // $stmt->bindParam(3, $department);

                    $stmt->execute();
                }elseif($role === 'teacher'){
                    $stmt = $conn->prepare("INSERT INTO teacher(user_id, field) VALUES (?,?)");
                    $stmt->bindParam(1, $user_id);
                    $stmt->bindParam(2, $field);
                    // $stmt->bindParam(3, $department);

                    $stmt->execute();
                }
            }
            $conn->commit();
            $response['status'] = 'success';
            $response['message'] = 'Account created successfully.';
        }catch(Exception $e){
            $conn->rollBack();
            $response['status'] = 'error';
            $response['message'] = 'An error occurred during the registration process. Please try again later.'; // Generic message
            echo json_encode($response);
            exit;
        }

    }
    
    
    header('Content-type: application/json');
    echo json_encode($response);

?>