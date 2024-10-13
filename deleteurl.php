<!--
session_start();
error_reporting(E_ALL);
include 'connection.php';
ini_set('display_errors', 1);
// Check if user is logged in, otherwise redirect to login page
if (!isset($_SESSION['username'])) {
  header('Location: login.php');
  exit;
}

// Check if URL ID is set, otherwise redirect to manage_url page
if (!isset($_GET['url_id'])) {
  header('Location: manage_url.php');
  exit;
}

$connection = mysqli_connect($db_host, $db_username, $db_password, $db_name);
$url_id = $_GET['url_id'];
$query = "DELETE FROM redirects WHERE id = $url_id";
mysqli_query($connection, $query);
header('Location: manage_url.php');
exit;

 -->
