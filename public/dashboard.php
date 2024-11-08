<?php
// dashboard.php
session_start();
include '../includes/auth.php';

$dashboardFile = '';

// Determine the dashboard file based on the role
switch ($_SESSION['role']) {
    case '1':
        $dashboardFile = 'admin_dashboard.php';
        break;
    case '2':
        $dashboardFile = 'designer_dashboard.php';
        break;
    case '3':
        $dashboardFile = 'printing_press_dashboard.php';
        break;
    default:
        echo "Unauthorized access.";
        exit();
}

// Include the appropriate dashboard file
if (file_exists($dashboardFile)) {
    include $dashboardFile;
} else {
    echo "Dashboard file not found for role: " . htmlspecialchars($_SESSION['role']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Dashboard</h1>
    <a href="mark_notifications.php">Mark All as Read</a>

    <h2>Notifications</h2>
    <ul>
        <?php
        // Check if getUserNotifications() is defined and fetch notifications
        if (function_exists('getUserNotifications')) {
            $notifications = getUserNotifications($_SESSION['user_id']);
            foreach ($notifications as $notification) {
                echo "<li>" . htmlspecialchars($notification['message']) . "</li>";
            }
        } else {
            echo "<li>No notifications available.</li>";
        }
        ?>
    </ul>
</body>
</html>
