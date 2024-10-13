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

// Database connection
$connection = mysqli_connect($db_host, $db_username, $db_password, $db_name);
if (!$connection) {
  die("Connection failed: " . mysqli_connect_error());
}

$user_id = $_SESSION['username'];

// Prepare and execute the select query
$query = "SELECT * FROM redirects WHERE qr_id = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("s", $url_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if URL exists, otherwise redirect to manage_url page
if ($result->num_rows == 0) {
  header('Location: manage_url.php');
  exit;
}

$row = $result->fetch_assoc();
$url = $row['redirect_url'];
$qrcodeid = $row['qrcode'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $r_id = $_POST["redirect_id"];
  $urls = filter_var($_POST['url'][0], FILTER_SANITIZE_URL);
  $from = htmlspecialchars($_POST['from'][0], ENT_QUOTES, 'UTF-8');
  $to = htmlspecialchars($_POST['to'][0], ENT_QUOTES, 'UTF-8');

  // Use the first element from each array as it's unclear why arrays are used here
  $currentDateTime = !empty($from[0]) ? $from[0] : date("Y-m-d H:i:s");
  $desiredDateTime = !empty($to[0]) ? $to[0] : date("Y-m-d H:i:s", strtotime("2055-10-10 20:00:00"));

  // Prepare and execute the update query
  $query = "UPDATE redirects 
    JOIN urls ON redirects.qr_id = urls.id
    SET redirects.redirect_url = ?, redirects.from_ = ?, redirects.to_ = ?
    WHERE redirects.id = ? AND redirects.qr_id = ? AND urls.user_id = ?";
  $stmt = $connection->prepare($query);
  $stmt->bind_param("sssiii", $urls, $from, $to, $r_id, $url_id, $user_id);
  $stmt->execute();

  header('Location: edit_url.php?url_id=' . $url_id);
  exit;
}
?>
<!DOCTYPE HTML>
<html lang="en-US">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta content="IE=edge" http-equiv="X-UA-Compatible" />
  <meta name="referrer" content="origin" />

  <title>Scannable</title>


  <script type="text/javascript" src="asset/bitly2/7E5082ED6DA0B03895F46BF975F63B8C8B1315CF.js"></script>

  <link rel="icon" type="image/png" href="" />

  <meta name="viewport" content="width=device-width,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">


  <link rel="stylesheet" href="asset/bitly2/17BADEBB7C21D5F4FD125352FB4499EFABC75663.css">









  <style>
    .img-fluid {
      max-width: 100%;
      height: auto;
      padding: 10px;
      margin: 0 auto;
      display: block;
    }

    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');

    .inner-content {
      font-family: 'Poppins', sans-serif;
    }

    .icon-wrapper {
      background-color: #007BFF;
      color: white;
      font-size: 24px;
      padding: 15px;
      border-radius: 50%;
      margin-bottom: 20px;
      display: inline-block;
    }

    h5 {
      font-size: 24px;
      color: #333;
      padding-bottom: 20px;
    }

    .redirect-url {
      font-size: 16px;
      color: #555;
      padding-bottom: 10px;
      display: inline-block;
    }

    .fancy-box {
      background: linear-gradient(135deg, #f3f4f6, #ffffff);
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 20px;
      margin: 10px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .fancy-button {
      background-color: #007BFF;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
      transition: background-color 0.3s ease;
      margin-top: 10px;
    }

    .fancy-button:hover {
      background-color: #0056b3;
    }

    input.text {
      width: 100%;
      padding: 10px;
      margin: 5px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }

    /* Media query for larger screens (PC and laptops) */
    @media (min-width: 1101px) {
      .input-group {
        display: flex;
        gap: 10px;
        align-items: center;
        justify-content: space-between;
        margin-top: 10px;
      }

      .container-box {
        width: 85%;
      }

      .fancy-box {
        display: flex;
        align-items: center;
        gap: 20px;
      }

      .fancy-box img {
        flex-shrink: 0;
        width: 150px;
        border-radius: 10px;
      }

      .fancy-box .content {
        display: flex;
        flex-direction: column;
        flex: 1;
      }
    }

    /* Media query for smaller screens (phones) */
    @media (max-width: 1100px) {
      .fancy-box {
        display: block;
      }

      .fancy-box img {
        width: 100%;
        border-radius: 10px;
      }

      .fancy-box .content {
        display: block;
      }
    }
  </style>









</head>

<body class="registration-pages sign_in">




  <noscript>
    <img
      src="https://ad.doubleclick.net/ddm/activity/src=12389169;type=conve0;cat=signu0;u1=[Plan Tier];dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;tfua=;npa=;gdpr=${GDPR};gdpr_consent=${GDPR_CONSENT_755};ord=1?"
      width="1" height="1" alt="" />
  </noscript>


  <div class="container-header">
    <h2 class=""><a href="https://scannabl.ink" style="text-decoration:none; color:black" rel="nofollow">Scannable</a>
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

      <span class="switch to-sign-in" tabindex="8">
        <span class="gray-link">Already have an account?</span>
        <br class="br">
        <a id="sign-in-link" href="https://bitly.com//a/sign_in">Log in</a>
        <span>&bull;</span>
        <span class="switch"><a id="sso-sign-in-link-top" href="https://bitly.com//sso/url_slug" tabindex="9">Log in
            with SSO</a></span>
      </span>
    </div>
  </div>
  <div class="container-box">
    <form id="sign-up" method="POST">
      <div class="social-sign-in">
        <a id="google-sign-up" rel="nofollow" href="https://bitly.com//a/add_google_account?rd=%2f"
          class="susi-btn social-susi-btn button" data-network="google"><img
            src="https://d1ayxb9ooonjts.cloudfront.net/bitly2/7D3D4B49B3CB108E9DD416FA967849FBABBC49CF.svg" alt="Google"
            width="20"><span class="sign-up-text">Sign up with Google</span></a>
      </div>
      <p class="separator t-center">
        <span>Or</span>
      </p>
      <div class="susi-fields-wrapper">
        <fieldset>
          <label class="text" for="username">Username</label>
          <input class="text" type="text" name="username" autocomplete="username" tabindex="3" autocorrect="off"
            autocapitalize="none" />
          <span class="error-message hidden"></span>
          <label class="text" for="email">Email address</label>

          <input class="text" type="text" name="email" autocomplete="email" tabindex="4" autocorrect="off"
            autocapitalize="none" />


          <input type="hidden" name="rd" value="/" />
          <input type="hidden" name="invite_token" value="" />

          <input id="submit" type="submit" class="button button-primary sign-up-in" value="Sign up with Email"
            tabindex="8" onclick="onSubmit()" />
        </fieldset>
      </div>
    </form>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <div class="fancy-box">
        <img src="qrcode/qrcode<?php echo $qrcodeid; ?>.png" class="img-fluid">
        <div class="content">
          <form name="changeurl" method="POST">
            <input type="hidden" name="rd" value="/" />
            <label class="text" for="url[]">QR code's forwarding link</label>
            <input type="hidden" name="redirect_id" value="<?php echo $row['id']; ?>">
            <div class="input-group">
              <input type="text" name="url[]" value="<?php echo $row['redirect_url']; ?>"
                placeholder="QR code's forwarding link" class="text" />
              <input type="datetime-local" name="from[]" value="<?php echo $row['from_']; ?>" class="text"
                placeholder="From" />
              <input type="datetime-local" name="to[]" value="<?php echo $row['to_']; ?>" class="text" placeholder="To" />
            </div>

            <input type="submit" class="button button-primary sign-up-in" style="width: 100%" value="Submit" tabindex="5"
              name="login" />
            <a href="deleteurl.php?url_id=<?php echo $row['id']; ?>">
              <button type="button" style="width:100%; background: red;" class="button button-primary sign-up-in"
                tabindex="5">Delete</button>
            </a>
            <button onclick="history.back()" style="width: 50%;" type="button" class="button button-primary sign-up-in"
              tabindex="5">← Back</button>
            <a href="qrcode/qrcode<?php echo $qrcodeid; ?>.png" download="qrcode<?php echo $row['qrcode']; ?>.png">
              <button type="button" class="button button-primary sign-up-in" style="width: 48%"
                tabindex="5">Download</button>
            </a>
          </form>
        </div>
      </div>




    <?php } ?>


  </div>
</body>



<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="asset/bitly2/FAA16645610A1B983A0D2D86A506687C1273062F.js"></script>
<script type="text/javascript" src="asset/bitly2/F2646B87E57084653A49DC39069E1F63751169F4.js"></script>
<script type="text/javascript" src="asset/bitly2/DC48A284F7A5AC5604D42ED052CAD24392789DCB.js"></script>
<script type="text/javascript" src="asset/bitly2/132D7290946D6B91858A8479F5D7E2E479A2F090.js"></script>
<script type="text/javascript" src="asset/bitly2/D0BB1779B2B982C44A0324259497832B80101BDE.js"></script>
<script type="text/javascript" src="asset/bitly2/2071816E49F66173069ABF96EC1CCDB1CA98AD0D.js"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-567GCTL9BB"></script>



<noscript>
  <img height="1" width="1" style="display:none;" alt=""
    src="https://px.ads.linkedin.com/collect/?pid=3409844&fmt=gif" />
</noscript>


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