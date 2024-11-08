<?php
// mark_notifications.php
include '../includes/db.php';

$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare("UPDATE notifications SET is_read = TRUE WHERE user_id = ?");
$stmt->execute([$userId]);

header("Location: dashboard.php");
exit();
?>
