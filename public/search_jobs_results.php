<?php
// search_jobs_results.php
include '../includes/functions.php';

$jobId = $_GET['job_id'] ?? null;
$clientName = $_GET['client_name'] ?? null;
$status = $_GET['status'] ?? null;
$startDate = $_GET['start_date'] ?? null;
$endDate = $_GET['end_date'] ?? null;

$jobs = searchJobs($jobId, $clientName, $status, $startDate, $endDate);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Search Results</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Search Results</h1>
    <table>
        <thead>
            <tr>
                <th>Job ID</th>
                <th>Client</th>
                <th>Status</th>
                <th>Created Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jobs as $job): ?>
                <tr>
                    <td><?php echo $job['job_id']; ?></td>
                    <td><?php echo $job['client_name']; ?></td>
                    <td><?php echo $job['status_name']; ?></td>
                    <td><?php echo $job['created_date']; ?></td>
                    <td><a href="view_job.php?job_id=<?php echo $job['job_id']; ?>">View</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
