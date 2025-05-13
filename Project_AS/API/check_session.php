<?php
session_start();

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
    // User is logged in
    echo json_encode([
        'loggedIn' => true,
        'role' => $_SESSION['role'],  // You can send back the role for UI adjustments
        'email' => $_SESSION['email']
    ]);
} else {
    // User is not logged in
    echo json_encode([
        'loggedIn' => false
    ]);
}
?>
