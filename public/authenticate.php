<?php
// authenticate.php
session_start();
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check user credentials
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['role'] = $user['role_id']; // assuming role_id corresponds to the role name
        $_SESSION['name'] = $user['name'];

        // Redirect based on role
        switch ($_SESSION['role']) {
            case '1':
                header('Location: dashboard.php');
                break;
            case '2':
                header('Location: dashboard.php');
                break;
            case '3':
                header('Location: dashboard.php');
                break;
            default:
                echo "Invalid role.";
        }
        exit();
    } else {
        echo "Invalid login credentials.";
    }
}
?>
