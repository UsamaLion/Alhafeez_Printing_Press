<!-- create_job.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create New Job</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Create New Job</h1>
    <form action="submit_job.php" method="POST" enctype="multipart/form-data">
        <!-- Job Type Selection -->
        <label for="job_type">Job Type:</label>
        <select name="job_type" id="job_type" required>
            <option value="1">Plates</option>
            <option value="2">Color Print</option>
            <option value="3">Pana Flex</option>
            <option value="4">Film</option>
            <option value="5">Offset</option>
            <option value="6">Wedding Card</option>
            <option value="7">Other Jobs</option>
        </select>

        <!-- Client Selection -->
        <label for="client">Client:</label>
        <select name="client_id" id="client" required>
            <?php
            include '../includes/functions.php';
            $clients = getClients();
            foreach ($clients as $client) {
                echo "<option value='{$client['client_id']}'>{$client['name']} - {$client['email']}</option>";
            }
            ?>
        </select>
        
        <!-- Option to Add New Client -->
        <p><a href="add_client.php">Add New Client</a></p>
        
        <!-- Job Details -->
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" required>

        <label for="size">Size:</label>
        <input type="text" name="size" required>

        <label for="description">Description:</label>
        <textarea name="description" rows="4" required></textarea>

        <label for="rate">Rate:</label>
        <input type="number" name="rate" step="0.01" required>

        <!-- File Upload -->
        <label for="design_file">Upload Design File:</label>
        <input type="file" name="design_file" id="design_file" required>

        <button type="submit">Create Job</button>
    </form>
</body>
</html>
