<!-- view_job.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Job</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php
    include '../includes/functions.php';
    session_start();
    
    // Fetch job details
    $jobId = $_GET['job_id'];
    $job = getJobDetails($jobId);

    if (!$job) {
        echo "Job not found.";
        exit();
    }
    ?>
    
    <h1>Job Details</h1>
    <p><strong>Job ID:</strong> <?php echo $job['job_id']; ?></p>
    <p><strong>Client:</strong> <?php echo $job['client_name']; ?></p>
    <p><strong>Status:</strong> <?php echo $job['status_name']; ?></p>
    <p><strong>Description:</strong> <?php echo $job['description']; ?></p>
    
    <!-- Update Job Status -->
    <h2>Update Status</h2>
    <form action="update_job_status.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="job_id" value="<?php echo $jobId; ?>">
        <label for="status">New Status:</label>
        <select name="status" id="status" required>
            <option value="Working" <?php echo ($job['status_name'] === 'Working') ? 'selected' : ''; ?>>Working</option>
            <option value="Design Ready" <?php echo ($job['status_name'] === 'Design Ready') ? 'selected' : ''; ?>>Design Ready</option>
            <option value="Sent for Printing" <?php echo ($job['status_name'] === 'Sent for Printing') ? 'selected' : ''; ?>>Sent for Printing</option>
        </select>

        <!-- File upload for Design Ready status -->
        <div id="file-upload" style="display: none;">
            <label for="design_file">Upload Design File:</label>
            <input type="file" name="design_file" id="design_file">
        </div>

        <button type="submit">Update Status</button>
    </form>
    
    <script>
        // Show file upload when status is "Design Ready"
        document.getElementById('status').addEventListener('change', function() {
            document.getElementById('file-upload').style.display = this.value === 'Design Ready' ? 'block' : 'none';
        });
    </script>
</body>
</html>
