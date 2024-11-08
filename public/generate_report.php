<?php
// generate_report.php
include '../includes/functions.php';

$status = $_POST['status'];
$clientId = $_POST['client_id'];
$startDate = $_POST['start_date'];
$endDate = $_POST['end_date'];

$reportData = generateReport($status, $clientId, $startDate, $endDate);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Report Results</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Report Results</h1>
    <table>
        <thead>
            <tr>
                <th>Job ID</th>
                <th>Client</th>
                <th>Status</th>
                <th>Payment Status</th>
                <th>Created Date</th>
                <th>Completed Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reportData as $row): ?>
                <tr>
                    <td><?php echo $row['job_id']; ?></td>
                    <td><?php echo $row['client_name']; ?></td>
                    <td><?php echo $row['status_name']; ?></td>
                    <td><?php echo $row['payment_status']; ?></td>
                    <td><?php echo $row['created_date']; ?></td>
                    <td><?php echo $row['completed_date']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
