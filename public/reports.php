<!-- reports.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reports</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Generate Reports</h1>
    <form action="generate_report.php" method="POST">
        <label for="status">Filter by Job Status:</label>
        <select name="status" id="status">
            <option value="All">All</option>
            <option value="Working">Working</option>
            <option value="Design Ready">Design Ready</option>
            <option value="Sent for Printing">Sent for Printing</option>
            <option value="Printing In Progress">Printing In Progress</option>
            <option value="Completed">Completed</option>
        </select>

        <label for="client">Filter by Client:</label>
        <select name="client_id" id="client">
            <option value="All">All Clients</option>
            <?php
            $clients = getClients();
            foreach ($clients as $client) {
                echo "<option value='{$client['client_id']}'>{$client['name']}</option>";
            }
            ?>
        </select>

        <label for="date_range">Filter by Date Range:</label>
        <input type="date" name="start_date"> to <input type="date" name="end_date">

        <button type="submit">Generate Report</button>
    </form>
</body>
</html>
