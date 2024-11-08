<?php
// submit_job.php
include '../includes/db.php';
include '../includes/functions.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jobType = $_POST['job_type'];
    $clientId = $_POST['client_id'];
    $designerId = $_SESSION['user_id'];
    $quantity = $_POST['quantity'];
    $size = $_POST['size'];
    $description = $_POST['description'];
    $rate = $_POST['rate'];
    $status = 'Working';  // Initial status for a new job

    // File upload handling
    $uploadDir = '../uploads/';
    $filePath = '';
    if (!empty($_FILES['design_file']['name'])) {
        $fileName = basename($_FILES['design_file']['name']);
        $filePath = $uploadDir . $fileName;
        if (move_uploaded_file($_FILES['design_file']['tmp_name'], $filePath)) {
            echo "File uploaded successfully.";
        } else {
            echo "File upload failed.";
            exit();
        }
    }

    // Insert job into database
    $jobId = createJob([
        'job_type' => $jobType,
        'client_id' => $clientId,
        'designer_id' => $designerId,
        'quantity' => $quantity,
        'size' => $size,
        'description' => $description,
        'rate' => $rate,
        'status' => $status,
        'file_path' => $filePath
    ]);

    if ($jobId) {
        header("Location: dashboard.php?success=job_created");
    } else {
        echo "Error creating job.";
    }
}
?>
