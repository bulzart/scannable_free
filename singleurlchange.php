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

// Check if URL ID is set, otherwise redirect to manage_url page
if (!isset($_GET['url_id'])) {
  header('Location: manage_url.php');
  exit;
}

$url_id = $_GET['url_id'];
$user_id = $_SESSION['username'];
$connection = mysqli_connect($db_host, $db_username, $db_password, $db_name);

if (!$connection) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if URL exists
$query = "SELECT * FROM redirects
JOIN urls ON redirects.qr_id = urls.id
WHERE urls.user_id = ? AND redirects.qr_id = ?";
if ($stmt = $connection->prepare($query)) {
  $stmt->bind_param('ii', $user_id, $url_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 0) {
    header('Location: manage_url.php');
    exit;
  }

  $row = $result->fetch_assoc();
  $url = $row['redirect_url'];
  $qrcodeid = $row['qrcode'];

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $urls = $_POST['url'];
    $from = $_POST['from'];
    $to = $_POST['to'];

    // Validate and sanitize input
    if (!is_array($urls) || !is_array($from) || !is_array($to) || count($urls) !== count($from) || count($from) !== count($to)) {
      die("Input arrays are invalid or do not have matching lengths.");
    }

    // Assuming the first elements are used for the insertion
    $currentDateTime = !empty($from[0]) ? $from[0] : date("Y-m-d H:i:s");
    $desiredDateTime = !empty($to[0]) ? $to[0] : date("Y-m-d H:i:s", strtotime("2055-10-10 20:00:00"));

    // Insert new redirect record
    $insertQuery = "INSERT INTO redirects (qr_id, redirect_url, qrcode, from_, to_, added_) VALUES (?, ?, ?, ?, ?, 1)";
    if ($insertStmt = $connection->prepare($insertQuery)) {
      $insertStmt->bind_param('sssss', $url_id, $urls[0], $qrcodeid, $currentDateTime, $desiredDateTime);
      $insertStmt->execute();
    } else {
      die("Error preparing the insert statement.");
    }

    header('Location: manage_url.php');
    exit;
  }
} else {
  die("Error preparing the select statement.");
}

mysqli_close($connection);
?>

<!DOCTYPE HTML>
<html lang="en-US">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta content="IE=edge" http-equiv="X-UA-Compatible" />
  <meta name="referrer" content="origin" />

  <title>Artwear</title>


  <script type="text/javascript" src="asset/bitly2/7E5082ED6DA0B03895F46BF975F63B8C8B1315CF.js"></script>
  <link rel="icon" type="image/png" href="" />
  <meta name="viewport" content="width=device-width,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="stylesheet" href="asset/bitly2/17BADEBB7C21D5F4FD125352FB4499EFABC75663.css">










  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

    body {
      font-family: 'Poppins';
    }

    .fancy-box {
      background: linear-gradient(135deg, #f3f4f6, #ffffff);
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 20px;
      margin: 10px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .fancy-box:hover {
      transform: translateY(-10px);
      box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
    }

    .img-fluid {
      max-width: 100%;
      height: auto;
    }

    .img-fluid {
      padding: 10px;
      /* Adjust as needed */
      margin: 0 auto;
      /* Center the image */
      display: block;
      /* Ensure the image is treated as a block element */
    }



    @media (max-width: 767px) {
      .img-fluid {
        padding: 5px;
        /* Adjust as needed for smaller screens */
      }
    }
  </style>

</head>

<body class="registration-pages sign_in">





  <div class="container-header">
    <h2 class=""><a href="https://scannabl.ink" style="text-decoration:none; color:black" rel="nofollow">Artwear</a>
    </h2>
    <div class="signup-flow-container hidden">
      <span class="signup-flow-elem em">Create an <br class="signup-flow-br">account</span>
      <hr>
      <span class="signup-flow-elem"> Enter payment <br class="signup-flow-br">information</span>
      <hr>
      <span class="signup-flow-elem">Get your free <br class="signup-flow-br">domain</span>
    </div>
  </div>
  <div class="signup-flow-container hidden post-header">
    <span class="signup-flow-elem em">Create an <br class="signup-flow-br">account</span>
    <hr>
    <span class="signup-flow-elem"> Enter payment <br class="signup-flow-br">information</span>
    <hr>
    <span class="signup-flow-elem">Get your free <br class="signup-flow-br">domain</span>
  </div>
  <div class="container-box title">

    <div class="t-center">
    </div>
  </div>
  <div class="container-box">


    <form name="changeurl" method="POST">
      <input type="hidden" name="rd" value="/" />


      <div class="susi-fields-wrapper fancy-box">
        <center>
          <img src="qrcode/qrcode<?php echo $qrcodeid; ?>.png" class="img-fluid">
          <div id="buttonContainer" <label class="text" for="url[]">QR code's forwarding link</label>
            <input type="hidden" name="redirect_id" value="<?php echo $row['id']; ?>">
            <input class="text" type="text" id="new_url" name="url[]" value="<?php $row['redirect_url']; ?>"
              style="text-align:center;" tabindex="3" autocorrect="off" autocapitalize="none" />
            <!-- <center><label class="text">Full link (For NFC or redirect)</center>
            <input class="text" type="text" id="nfc_url" style="text-align:center;" tabindex="3" autocorrect="off"
              autocapitalize="none" /> -->
            <center><label class="text">From</center>
            <input name="from[]" class="text" type="datetime-local" id="nfc_url" style="text-align:center;" tabindex="3"
              autocorrect="off" autocapitalize="none" step="1" />



            <center><label class="text">To</center>
            <input name="to[]" class="text" type="datetime-local" id="nfc_url" style="text-align:center;" tabindex="3"
              autocorrect="off" autocapitalize="none" step="1" />

          </div>
          <input type="hidden" name="rd" value="/" />
          <a id="currentUrlLink" target="_blank"><input type="button" class="button button-primary sign-up-in"
              value="New schedule" tabindex="5" name="login" /></a>
          <input type="submit" class="button button-primary sign-up-in" value="Submit" tabindex="5" name="login" />
          <button onclick="history.back()" style="width: 50%" type="button" id="addButton"
            class="button button-primary sign-up-in" tabindex="5">← Back</button>
          <a href="qrcode/qrcode<?php echo $qrcodeid; ?>.png" download="qrcode<?php echo $row['qrcode']; ?>.png"><button
              type="button" class="button button-primary sign-up-in" style="width: 48%" tabindex="5"
              name="login" />Download</button></a>
      </div>
    </form>



  </div>
</body>



<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="asset/bitly2/FAA16645610A1B983A0D2D86A506687C1273062F.js"></script>
<script type="text/javascript" src="asset/bitly2/F2646B87E57084653A49DC39069E1F63751169F4.js"></script>
<script type="text/javascript" src="asset/bitly2/DC48A284F7A5AC5604D42ED052CAD24392789DCB.js"></script>
<script type="text/javascript" src="asset/bitly2/132D7290946D6B91858A8479F5D7E2E479A2F090.js"></script>
<script type="text/javascript" src="asset/bitly2/D0BB1779B2B982C44A0324259497832B80101BDE.js"></script>
<script type="text/javascript" src="asset/bitly2/2071816E49F66173069ABF96EC1CCDB1CA98AD0D.js"></script>








<noscript>
  <img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=575684804151769&ev=PageView&noscript=1" />
</noscript>
<script type="text/javascript">
  _linkedin_partner_id = "3409844";
  window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
  window._linkedin_data_partner_ids.push(_linkedin_partner_id);
</script>
<script type="text/javascript">
  (function (l) {
    if (!l) {
      window.lintrk = function (a, b) { window.lintrk.q.push([a, b]) };
      window.lintrk.q = []
    }
    var s = document.getElementsByTagName("script")[0];
    var b = document.createElement("script");
    b.type = "text/javascript"; b.async = true;
    b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
    s.parentNode.insertBefore(b, s);
  })(window.lintrk);
</script>
<noscript>
  <img height="1" width="1" style="display:none;" alt=""
    src="https://px.ads.linkedin.com/collect/?pid=3409844&fmt=gif" />
</noscript>

<script>
  !function (e, t, n, s, u, a) {
    e.twq || (s = e.twq = function () {
      s.exe ? s.exe.apply(s, arguments) : s.queue.push(arguments);
    }, s.version = '1.1', s.queue = [], u = t.createElement(n), u.async = !0, u.src = '//static.ads-twitter.com/uwt.js',
      a = t.getElementsByTagName(n)[0], a.parentNode.insertBefore(u, a))
  }(window, document, 'script');

  twq("init", "o2pdk");
  twq("track", "PageView");
</script>

<script>

  (function (w, d) {
    var id = 'pdst-capture', n = 'script';
    if (!d.getElementById(id)) {
      w.pdst =
        w.pdst ||
        function () {
          (w.pdst.q = w.pdst.q || []).push(arguments);
        };
      var e = d.createElement(n); e.id = id; e.async = 1;
      e.src = 'https://cdn.pdst.fm/ping.min.js';
      var s = d.getElementsByTagName(n)[0];
      s.parentNode.insertBefore(e, s);
    }
    w.pdst('conf', { key: "96312ad4d097468aab67dc86ba4c34fd" });
    w.pdst('view');
  })(window, document);
</script>


<script>

  (function (w, d, t, r, u) {
    var f, n, i;
    w[u] = w[u] || [], f = function () {
      var o = { ti: "", enableAutoSpaTracking: true };
      o.q = w[u], w[u] = new UET(o), w[u].push("pageLoad")
    },
      n = d.createElement(t), n.src = r, n.async = 1, n.onload = n.onreadystatechange = function () {
        var s = this.readyState;
        s && s !== "loaded" && s !== "complete" || (f(), n.onload = n.onreadystatechange = null)
      },
      i = d.getElementsByTagName(t)[0], i.parentNode.insertBefore(n, i)
  })
    (window, document, "script", "//bat.bing.com/bat.js", "uetq");

</script>
<script>
  var currentUrl = window.location.href;

  // Find the anchor element
  var anchor = document.getElementById('currentUrlLink');

  // Set the href attribute to the current URL
  anchor.href = currentUrl;
</script>

</body>

</html>










<script>

  var inputs = $('#sign-in').find('input');
  var errorMessage = $('.error-message');


  function clearErrors() {
    errorMessage.addClass('hidden');
  }


  inputs.on('input', clearErrors);

  let previousInput = '';

  function addButtons() {



    const newLabel0 = document.createElement('label');
    newLabel0.textContent = "QR code's forwarding link";
    const newButton0 = document.createElement('input');
    newButton0.textContent = 'Previous Input';

    newButton0.type = 'text';
    newButton0.name = 'url[]';
    newButton0.classList.add('text');
    newButton0.style.textAlign = 'center';



    const buttonContainer = document.getElementById('buttonContainer');
    const newLabel = document.createElement('label');
    newLabel.textContent = 'From';
    const newButton1 = document.createElement('input');
    newButton1.textContent = 'Previous Input';
    newButton1.type = 'datetime-local'; // Set the input type to 'button'
    newButton1.name = 'from[]'; // Set the input name to 'custom-button'
    newButton1.classList.add('text');
    newButton1.style.textAlign = 'center';



    const newLabel2 = document.createElement('label');
    newLabel2.textContent = 'to';
    const newButton2 = document.createElement('input');
    newButton2.textContent = 'Previous Input';
    newLabel.textContent = 'From';
    newButton2.type = 'datetime-local'; // Set the input type to 'button'
    newButton2.name = 'to[]'; // Set the input name to 'custom-button'
    newButton2.classList.add('text');
    newButton2.style.textAlign = 'center';

    buttonContainer.appendChild(newLabel0);
    buttonContainer.appendChild(newButton0);
    buttonContainer.appendChild(newLabel);
    buttonContainer.appendChild(newLabel);
    buttonContainer.appendChild(newButton1);
    buttonContainer.appendChild(newLabel2);
    buttonContainer.appendChild(newButton2);
  }


</script>