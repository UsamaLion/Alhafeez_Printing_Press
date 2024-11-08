<!-- printing_press_dashboard.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Printing Press Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <!-- Logout Button (add this where needed, like in dashboard.php) -->
    <form action="logout.php" method="POST" style="display: inline;">
    <button type="submit">Logout</button>
    </form>
    <h1>Printing Press Jobs</h1>
    <table>
        <thead>
            <tr>
                <th>Job ID</th>
                <th>Client</th>
                <th>File</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $jobs = getPrintingJobs('Sent for Printing');  // Only get jobs with "Sent for Printing" status
            foreach ($jobs as $job) {
                echo "<tr>
                        <td>{$job['job_id']}</td>
                        <td>{$job['client_name']}</td>
                        <td><a href='{$job['file_path']}' download>Download</a></td>
                        <td>{$job['status_name']}</td>
                        <td>
                            <form action='update_printing_status.php' method='POST'>
                                <input type='hidden' name='job_id' value='{$job['job_id']}'>
                                <select name='status'>
                                    <option value='Printing In Progress'>Printing In Progress</option>
                                    <option value='Completed'>Completed</option>
                                </select>
                                <button type='submit'>Update</button>
                            </form>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
