<?php
// update_payment_status.php
include '../includes/db.php';
include '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jobId = $_POST['job_id'];
    $paymentStatus = $_POST['payment_status'];

    // Update payment status in database
    if (updatePaymentStatus($jobId, $paymentStatus)) {
        header("Location: admin_dashboard.php?success=payment_updated");
    } else {
        echo "Error updating payment status.";
    }
}
?>
