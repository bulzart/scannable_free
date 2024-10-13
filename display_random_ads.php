<!-- <?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connection.php';

// Secure the database connection
$connection = mysqli_connect($db_host, $db_username, $db_password, $db_name);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Use a prepared statement to prevent SQL injection
$query = "SELECT * FROM ad_files WHERE file_type IN (?, ?, ?, ?, ?, ?, ?) AND display_count > 0 ORDER BY RAND() LIMIT 1";
$stmt = $connection->prepare($query);
$fileTypes = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'mov', 'avi'];
$stmt->bind_param('sssssss', ...$fileTypes);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $fileName = htmlspecialchars($row['file_name']);
    $fileType = htmlspecialchars($row['file_type']);
    $displayCount = (int)$row['display_count'];

    // Use a prepared statement to update view count
    $updateViewCountQuery = "UPDATE ad_files SET view_count = view_count + 1 WHERE file_name = ?";
    $updateStmt = $connection->prepare($updateViewCountQuery);
    $updateStmt->bind_param('s', $fileName);
    $updateStmt->execute();

    if (in_array($fileType, ['mp4', 'mov', 'avi'])) {
        echo "<div id='status' style='display:flex; justify-content:center;'>
                <video controls autoplay muted playsinline>
                    <source src='uploads/{$fileName}' type='video/{$fileType}'>
                    Your browser does not support the video tag.
                </video>
              </div>";
    } else {
        echo "<div id='status' style='display:flex; justify-content:center;'>
                <img src='uploads/{$fileName}' alt='ad image' style='max-width:100%; height:auto;' />
              </div>";
    }

    // Countdown timer
    echo '<p id="countdown">7</p>';
    echo '<script>
            var countdown = 7;
            var countdownDisplay = document.getElementById("countdown");
            var countdownInterval = setInterval(function () {
                countdown--;
                countdownDisplay.textContent = countdown;
                if (countdown <= 0) {
                    clearInterval(countdownInterval);
                    // Redirect logic here after countdown
                    // window.location.href = "your_redirect_url_here";
                }
            }, 1000);
          </script>';
} else {
    echo "No available files to display.";
}

// Close statement and connection
$stmt->close();
?> -->
