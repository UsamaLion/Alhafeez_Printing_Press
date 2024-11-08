<?php
// functions.php
include 'db.php';

// function createJob($jobData) {
//     global $pdo;
//     $stmt = $pdo->prepare("INSERT INTO jobs (job_type_id, client_id, designer_id, status_id, rate, description) VALUES (?, ?, ?, ?, ?, ?)");
//     $stmt->execute([$jobData['type_id'], $jobData['client_id'], $jobData['designer_id'], $jobData['status_id'], $jobData['rate'], $jobData['description']]);
//     return $pdo->lastInsertId();
// }

function getJobsByStatus($status) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM jobs WHERE status_id = ?");
    $stmt->execute([$status]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getJobsOverview() {
    global $pdo;
    $stmt = $pdo->query("SELECT jobs.job_id, clients.name AS client_name, job_status.status_name, jobs.payment_status 
                         FROM jobs
                         JOIN clients ON jobs.client_id = clients.client_id
                         JOIN job_status ON jobs.status_id = job_status.status_id");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getDesignerJobs($designerId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT jobs.job_id, clients.name AS client_name, jobs.description, job_status.status_name
                           FROM jobs
                           JOIN clients ON jobs.client_id = clients.client_id
                           JOIN job_status ON jobs.status_id = job_status.status_id
                           WHERE jobs.designer_id = ?");
    $stmt->execute([$designerId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// function getPrintingJobs($userId) {
//     global $pdo;
//     $stmt = $pdo->prepare("SELECT jobs.job_id, clients.name AS client_name, job_status.status_name 
//                            FROM jobs 
//                            JOIN clients ON jobs.client_id = clients.client_id 
//                            JOIN job_status ON jobs.status_id = job_status.status_id 
//                            WHERE jobs.printing_press_id = ?");
//     $stmt->execute([$userId]);
//     return $stmt->fetchAll(PDO::FETCH_ASSOC);
// }
function createJob($jobData) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO jobs (job_type_id, client_id, designer_id, quantity, size, description, rate, status_id, file_path, created_date) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    $stmt->execute([
        $jobData['job_type'],         // job_type_id
        $jobData['client_id'],        // client_id
        $jobData['designer_id'],      // designer_id
        $jobData['quantity'],         // quantity
        $jobData['size'],             // size
        $jobData['description'],      // description
        $jobData['rate'],             // rate
        getStatusId($jobData['status']), // status_id (assuming getStatusId is used to translate the status)
        $jobData['file_path']         // file_path
    ]);
    return $pdo->lastInsertId();
}
function getClients() {
    global $pdo;
    $stmt = $pdo->query("SELECT client_id, name, email FROM clients ORDER BY name");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getStatusId($statusName) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT status_id FROM job_status WHERE status_name = ?");
    $stmt->execute([$statusName]);
    return $stmt->fetchColumn();
}function createClient($clientData) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO clients (name, email, address, primary_mobile, secondary_mobile) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        $clientData['name'],
        $clientData['email'],
        $clientData['address'],
        $clientData['primary_mobile'],
        $clientData['secondary_mobile']
    ]);
    return $pdo->lastInsertId();
}
function updateJobStatus($jobId, $status, $filePath = null) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE jobs SET status_id = ?, file_path = IFNULL(?, file_path) WHERE job_id = ?");
    return $stmt->execute([getStatusId($status), $filePath, $jobId]);
}
function getPrintingJobs($status) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT jobs.job_id, clients.name AS client_name, job_status.status_name, jobs.file_path
                           FROM jobs
                           JOIN clients ON jobs.client_id = clients.client_id
                           JOIN job_status ON jobs.status_id = job_status.status_id
                           WHERE job_status.status_name = ?");
    $stmt->execute([$status]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getAllJobs() {
    global $pdo;
    $stmt = $pdo->query("SELECT jobs.job_id, clients.name AS client_name, job_status.status_name, jobs.payment_status
                         FROM jobs
                         JOIN clients ON jobs.client_id = clients.client_id
                         JOIN job_status ON jobs.status_id = job_status.status_id");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updatePaymentStatus($jobId, $paymentStatus) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE jobs SET payment_status = ? WHERE job_id = ?");
    return $stmt->execute([$paymentStatus, $jobId]);
}
function generateReport($status, $clientId, $startDate, $endDate) {
    global $pdo;
    $query = "SELECT jobs.job_id, clients.name AS client_name, job_status.status_name, jobs.payment_status, jobs.created_date, jobs.completed_date
              FROM jobs
              JOIN clients ON jobs.client_id = clients.client_id
              JOIN job_status ON jobs.status_id = job_status.status_id
              WHERE 1=1";

    $params = [];
    if ($status !== "All") {
        $query .= " AND job_status.status_name = ?";
        $params[] = $status;
    }
    if ($clientId !== "All") {
        $query .= " AND jobs.client_id = ?";
        $params[] = $clientId;
    }
    if ($startDate) {
        $query .= " AND jobs.created_date >= ?";
        $params[] = $startDate;
    }
    if ($endDate) {
        $query .= " AND jobs.created_date <= ?";
        $params[] = $endDate;
    }

    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function createNotification($userId, $message) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO notifications (user_id, message) VALUES (?, ?)");
    $stmt->execute([$userId, $message]);
}
function getUserNotifications($userId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM notifications WHERE user_id = ? AND is_read = FALSE ORDER BY created_at DESC");
    $stmt->execute([$userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function searchJobs($jobId, $clientName, $status, $startDate, $endDate) {
    global $pdo;
    $query = "SELECT jobs.job_id, clients.name AS client_name, job_status.status_name, jobs.created_date
              FROM jobs
              JOIN clients ON jobs.client_id = clients.client_id
              JOIN job_status ON jobs.status_id = job_status.status_id
              WHERE 1=1";

    $params = [];
    if ($jobId) {
        $query .= " AND jobs.job_id = ?";
        $params[] = $jobId;
    }
    if ($clientName) {
        $query .= " AND clients.name LIKE ?";
        $params[] = '%' . $clientName . '%';
    }
    if ($status) {
        $query .= " AND job_status.status_name = ?";
        $params[] = $status;
    }
    if ($startDate) {
        $query .= " AND jobs.created_date >= ?";
        $params[] = $startDate;
    }
    if ($endDate) {
        $query .= " AND jobs.created_date <= ?";
        $params[] = $endDate;
    }

    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getJobDetails($jobId) {
    global $pdo;
    $stmt = $pdo->prepare("
        SELECT 
            jobs.job_id, 
            jobs.description,
            jobs.quantity,
            jobs.size,
            jobs.rate,
            jobs.file_path,
            jobs.payment_status,
            jobs.created_date,
            jobs.completed_date,
            job_status.status_name,
            clients.name AS client_name,
            clients.email AS client_email,
            clients.address AS client_address
        FROM 
            jobs
        JOIN 
            job_status ON jobs.status_id = job_status.status_id
        JOIN 
            clients ON jobs.client_id = clients.client_id
        WHERE 
            jobs.job_id = ?
    ");
    $stmt->execute([$jobId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


?>
