<!-- admin_dashboard.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <!-- Logout Button (add this where needed, like in dashboard.php) -->
    <form action="logout.php" method="POST" style="display: inline;">
    <button type="submit">Logout</button>
    </form>
    <h1>Admin Dashboard</h1>
    <h2>Job Status Overview</h2>
    <table>
        <thead>
            <tr>
                <th>Job ID</th>
                <th>Client</th>
                <th>Status</th>
                <th>Payment Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../includes/functions.php';
            $jobs = getAllJobs();
            foreach ($jobs as $job) {
                echo "<tr>
                        <td>{$job['job_id']}</td>
                        <td>{$job['client_name']}</td>
                        <td>{$job['status_name']}</td>
                        <td>{$job['payment_status']}</td>
                        <td>
                            <form action='update_payment_status.php' method='POST'>
                                <input type='hidden' name='job_id' value='{$job['job_id']}'>
                                <select name='payment_status'>
                                    <option value='Pending'" . ($job['payment_status'] === 'Pending' ? 'selected' : '') . ">Pending</option>
                                    <option value='Received'" . ($job['payment_status'] === 'Received' ? 'selected' : '') . ">Received</option>
                                </select>
                                <button type='submit'>Update Payment</button>
                            </form>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
