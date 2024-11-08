<?php
// update_printing_status.php
include '../includes/db.php';
include '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jobId = $_POST['job_id'];
    $status = $_POST['status'];

    // Update job status
    if (updateJobStatus($jobId, $status)) {
        header("Location: printing_press_dashboard.php?success=status_updated");
    } else {
        echo "Error updating job status.";
    }
}
?>
