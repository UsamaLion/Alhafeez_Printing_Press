<?php
// submit_client.php
include '../includes/db.php';
include '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $primaryMobile = $_POST['primary_mobile'];
    $secondaryMobile = $_POST['secondary_mobile'];

    // Insert client into database
    $clientId = createClient([
        'name' => $name,
        'email' => $email,
        'address' => $address,
        'primary_mobile' => $primaryMobile,
        'secondary_mobile' => $secondaryMobile
    ]);

    if ($clientId) {
        header("Location: create_job.php?success=client_added");
    } else {
        echo "Error adding client.";
    }
}
?>
