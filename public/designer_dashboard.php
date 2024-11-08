<!-- designer_dashboard.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Designer Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Designer Dashboard</h1>

        <!-- Quick Actions -->
        <div class="dashboard-actions">
            <button><a href="create_job.php" class="button" style="color: #fff;">Create New Job</a></button>
            <button><a href="add_client.php" class="button" style="color: #fff;">Add New Client</a></button>
            <button><a href="view_job.php" class="button" style="color: #fff;">View All Jobs</a></button>
        </div>

        <h2>Your Active Jobs</h2>
        <table>
            <thead>
                <tr>
                    <th>Job ID</th>
                    <th>Client</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../includes/functions.php';
                // session_start();
                
                $designerId = $_SESSION['user_id'];
                $jobs = getDesignerJobs($designerId); // Fetch jobs assigned to this designer

                if (!empty($jobs)) {
                    foreach ($jobs as $job) {
                        echo "<tr>
                                <td>{$job['job_id']}</td>
                                <td>{$job['client_name']}</td>
                                <td>{$job['description']}</td>
                                <td class='status {$job['status_name']}'>{$job['status_name']}</td>
                                <td>
                                    <a href='view_job.php?job_id={$job['job_id']}'>View</a> | 
                                    <a href='edit_job.php?job_id={$job['job_id']}'>Edit</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No active jobs found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
