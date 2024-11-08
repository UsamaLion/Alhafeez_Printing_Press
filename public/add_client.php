<!-- add_client.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add New Client</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Add New Client</h1>
    <form action="submit_client.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="address">Address:</label>
        <textarea name="address" rows="4" required></textarea>

        <label for="primary_mobile">Primary Mobile:</label>
        <input type="text" name="primary_mobile" required>

        <label for="secondary_mobile">Secondary Mobile (optional):</label>
        <input type="text" name="secondary_mobile">

        <button type="submit">Add Client</button>
    </form>
</body>
</html>
