<!-- 
session_start();
include 'connection.php';
$connection = mysqli_connect($db_host, $db_username, $db_password, $db_name);

if (isset($_GET['q'])) {
  $url_id = $_GET['q'];
  $query = "SELECT * FROM urls JOIN redirects ON redirects.qr_id = urls.id WHERE title LIKE '%$url_id%'";

  $result = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($result);


  header("Location: " . $row['redirect_url']);
  exit();
}

mysqli_close($connection);
?> -->