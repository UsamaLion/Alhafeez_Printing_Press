<?php
// auth.php
// session_start();

function checkRole($requiredRole) {
    if ($_SESSION['role'] !== $requiredRole) {
        header('Location: no_access.php');
        exit();
    }
}

// authenticate.php
// session_start();
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
            case 'Admin':
                header('Location: dashboard.php');
                break;
            case 'Designer':
                header('Location: dashboard.php');
                break;
            case 'Printing Press':
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
