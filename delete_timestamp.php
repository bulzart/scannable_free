<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connection.php';

// Check if user is logged in, otherwise redirect to login page
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
$user_id = $_SESSION['username'];


// Check if URL ID is set, otherwise redirect to manage_url page
if (!isset($_GET['url_id'])) {
    header('Location: manage_url.php');
    exit;
}

$connection = mysqli_connect($db_host, $db_username, $db_password, $db_name);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$url_id = $_GET['url_id'];
$qr_id = $_GET['qr_id'];
// Use a prepared statement to prevent SQL injection
$query = "DELETE FROM redirects
          WHERE id = ? AND EXISTS (
              SELECT 1 FROM urls WHERE urls.id = redirects.qr_id AND urls.user_id = ?
          )";
$stmt = $connection->prepare($query);
$stmt->bind_param('ii', $url_id, $user_id);

if ($stmt->execute()) {
    header('Location: edit_url.php?url_id='.$qr_id);
    exit;
} else {
    echo "Error deleting record: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
mysqli_close($connection);
?>
