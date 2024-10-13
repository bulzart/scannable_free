<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connection.php';

$connection = mysqli_connect($db_host, $db_username, $db_password, $db_name);

// Check the connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['url_id'])) {
    $url_id = $_GET['url_id'];
    $currentDateTime = date("Y-m-d H:i:s"); // Current date and time
    $hoursToAdd = 2; // Number of hours to add
    $newDateTime = date("Y-m-d H:i:s", strtotime("$currentDateTime +$hoursToAdd hours"));
    // echo $newDateTime;
    // die;

    // Use prepared statements to avoid SQL injection
    $queryAdded = "SELECT * FROM redirects WHERE qr_id=? AND from_ <= ? AND to_ >= ? AND added_ = 1";
    $stmtAdded = $connection->prepare($queryAdded);
    $stmtAdded->bind_param("iss", $url_id, $newDateTime, $newDateTime);
    $stmtAdded->execute();
    $resultAdded = $stmtAdded->get_result();

    if ($resultAdded->num_rows > 0) {
        // If there are items with added_ = 1, use this query
        $query = $queryAdded;
    } else {
        // If there are no items with added_ = 1, use this query without the added_ condition
        $query = "SELECT * FROM redirects WHERE qr_id=? AND from_ <= ? AND to_ >= ?";
    }

    // Prepare and execute the final query
    $stmt = $connection->prepare($query);
    $stmt->bind_param("iss", $url_id, $newDateTime, $newDateTime);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $r_id = (int) $row['id'];

        // Simplify device detection
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $device = "PC/Laptop"; // Default device type

        if (preg_match('/iPod|iPad|iPhone|Android|iOS/i', $userAgent, $matches)) {
            $device = $matches[0];
        }

        $ip_address = $_SERVER["REMOTE_ADDR"];

        // Insert into url_count table
        $queryInsert = "INSERT INTO url_count (url_id, device, ip_address) VALUES (?, ?, ?)";
        $stmtInsert = $connection->prepare($queryInsert);
        $stmtInsert->bind_param("sss", $url_id, $device, $ip_address);

        if (!$stmtInsert->execute()) {
            die("Error inserting URL count: " . $stmtInsert->error);
        }

        // Redirect to the URL
        header("Location: " . $row['redirect_url']);
        exit;
    } else {
        echo "No matching redirects found.";
    }

    // Close statements
    $stmt->close();
    $stmtAdded->close();
}

mysqli_close($connection);
?>