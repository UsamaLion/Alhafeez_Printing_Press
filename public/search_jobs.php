<!-- search_jobs.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Search Jobs</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Search Jobs</h1>
    <form action="search_jobs_results.php" method="GET">
        <label for="job_id">Job ID:</label>
        <input type="text" name="job_id" id="job_id">
        
        <label for="client_name">Client Name:</label>
        <input type="text" name="client_name" id="client_name">
        
        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="">Any</option>
            <option value="Working">Working</option>
            <option value="Design Ready">Design Ready</option>
            <option value="Sent for Printing">Sent for Printing</option>
            <option value="Printing In Progress">Printing In Progress</option>
            <option value="Completed">Completed</option>
        </select>

        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" id="start_date">

        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" id="end_date">

        <button type="submit">Search</button>
    </form>
</body>
</html>
