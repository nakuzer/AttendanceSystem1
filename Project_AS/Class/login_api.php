<?php
    ini_set('session.cookie_httponly', 1);
    ini_set('session.cookie_secure', isset($_SERVER['HTTPS']));
    ini_set('session.use_strict_mode', 1);
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(0);

    session_start();
    require_once '../API/database.php';
    header('Content-Type: application/json');

    $database = new Database();
    $conn = $database->getConnection();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        $email = $data['email'];
        $password = $data['password'];
        $role = $data['role'];
        
        try {
            // Prepare and execute query to fetch user by email and role
            if($role === 'student'){
                 $stmt = $conn->prepare("SELECT s.user_id, u.role, u.schoolID, u.email, u.first_name, u.last_name, u.password, s.course FROM users u
                                         INNER JOIN students s ON u.id = s.user_id WHERE u.email = ? AND u.role = ? LIMIT 1");
            }elseif($role === 'teacher'){
                $stmt = $conn->prepare("SELECT t.user_id, u.role, u.schoolID, u.email, u.first_name, u.last_name, u.password, t.field FROM users u
                                         INNER JOIN teachers t ON u.id = t.user_id WHERE u.email = ? AND u.role = ? LIMIT 1");
            }
           
            $stmt->bindParam(1, $email);
            $stmt->bindParam(2, $role);
            $stmt->execute();

            // Fetch the user details
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                throw new Exception("Email or Role is incorrect.");
            }

            // Verify the password
            if (!password_verify($password, $user['password'])) {
                throw new Exception("Incorrect password.");
            }

            // Regenerate session ID for security
            
            
            // Store user info in the session
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['firstName'] = $user['first_name'];
            $_SESSION['lastName'] = $user['last_name'];
            $_SESSION['schoolID'] = $user['schoolID'];
            if ($role === 'student') {
                $_SESSION['course'] = $user['course'];
            }

            if( !isset($_SESSION['email']) ||
                !isset($_SESSION['role']) ||
                !isset($_SESSION['user_id'])
                ){
                throw new Exception("Something went wrong");
            }else{
                $redirect = $role === 'student' ? '../Pages/qr-card.php?id=' . $user['user_id']: '../Pages/dashboard.php?id=' . $user['user_id'];
                respond('success', "You're logged in", $redirect);
            }

            // Set the redirect URL based on role
            

        } catch (Exception $e) {
            respond('error', $e->getMessage());
        }
    }

?>



