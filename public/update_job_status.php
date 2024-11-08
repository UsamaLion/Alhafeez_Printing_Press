<?php
// update_job_status.php
include '../includes/db.php';
include '../includes/functions.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jobId = $_POST['job_id'];
    $status = $_POST['status'];
    $filePath = '';

    // If status is "Design Ready", handle file upload
    if ($status === 'Design Ready' && !empty($_FILES['design_file']['name'])) {
        $uploadDir = '../uploads/';
        $fileName = basename($_FILES['design_file']['name']);
        $filePath = $uploadDir . $fileName;
        
        if (!move_uploaded_file($_FILES['design_file']['tmp_name'], $filePath)) {
            echo "File upload failed.";
            exit();
        }
    }

    // Update job status
    if (updateJobStatus($jobId, $status, $filePath)) {
        header("Location: dashboard.php?success=status_updated");
    } else {
        echo "Error updating job status.";
    }
}
?>
