<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'connection.php';

$error_message = '';
$badCreds = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $connection = mysqli_connect($db_host, $db_username, $db_password, $db_name);

  if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Sanitize user input
  $username = mysqli_real_escape_string($connection, $_POST['username']);
  $password = $_POST['password'];
  $password2 = $_POST['password2'];

  // Check if the username already exists using a prepared statement
  $query = "SELECT id FROM users WHERE username = ?";
  $stmt = $connection->prepare($query);
  $stmt->bind_param('s', $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $error_message = 'Username already exists. Please try another username.';
  } else {
    if ($password === $password2) {
      // Hash the password
      $hashed_password = password_hash($password, PASSWORD_BCRYPT);

      // Insert new user into the database using a prepared statement
      $query = "INSERT INTO users (username, password) VALUES (?, ?)";
      $stmt = $connection->prepare($query);
      $stmt->bind_param('ss', $username, $hashed_password);

      if ($stmt->execute()) {
        // Get the user ID
        $user_id = $stmt->insert_id;

        // Store the user ID in the session
        $_SESSION['username'] = $user_id;

        header('Location: index.php');
        exit;
      } else {
        $error_message = 'Error in registering the user. Please try again later.';
      }
    } else {
      $badCreds = true;
      $error_message = 'Passwords do not match. Please try again.';
    }
  }

  // Close the statement and connection
  $stmt->close();
  mysqli_close($connection);
}
?>


<!DOCTYPE HTML>
<html lang="en-US">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta content="IE=edge" http-equiv="X-UA-Compatible" />
  <meta name="referrer" content="origin" />

  <title>Artwear</title>


  <script type="text/javascript" src="asset/bitly2/7E5082ED6DA0B03895F46BF975F63B8C8B1315CF.js"></script>


  <meta name="viewport" content="width=device-width,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">


  <link rel="stylesheet" href="asset/bitly2/17BADEBB7C21D5F4FD125352FB4499EFABC75663.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

    body {
      font-family: 'Poppins';
    }
  </style>











</head>

<body class="registration-pages sign_in">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <noscript>
    <img
      src="https://ad.doubleclick.net/ddm/activity/src=12389169;type=conve0;cat=signu0;u1=[Plan Tier];dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;tfua=;npa=;gdpr=${GDPR};gdpr_consent=${GDPR_CONSENT_755};ord=1?"
      width="1" height="1" alt="" />
  </noscript>


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
    <h3 class="switch to-sign-up tagline">Sign up and <br class="br">start sharing</h3>

  </div>

  <div class="container-box">
    <?php if ($badCreds) { ?>
      <div class="success-banner" style="display: none; background-color: #ffc0c0; padding: 10px; border-radius: 10px;">
        <p>Passwords are not the same or error creating the user</p>
      </div>
    <?php } ?>
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

      </div>
    </form>
    <form method="POST">
      <input type="hidden" name="_xsrf" value="41a205b8-2d89-e18e-7994-0bc65757f3b8">
      <input type="hidden" name="rd" value="/" />


      <div class="susi-fields-wrapper">
        <fieldset>
          <label class="text" for="username">Email address or username</label>
          <input class="text" type="text" name="username" tabindex="3" autocorrect="off" autocapitalize="none" />
          <label class="text" for="password">
            Password
          </label>
          <input class="pw text" type="password" name="password" tabindex="4" autocomplete="current-password"
            autocorrect="off" autocapitalize="none" />
          <label class="text" for="password2">
            Retype password
          </label>
          <input class="pw text" type="password" name="password2" tabindex="4" autocomplete="current-password2"
            autocorrect="off" autocapitalize="none" />
          <span class="error-message hidden"></span>
          <span class="error-message">

          </span>
          <input type="hidden" name="rd" value="/" />
          <input type="submit" class="button button-primary sign-up-in" value="Sign up" tabindex="5" name="register" />
        </fieldset>
      </div>
    </form>


  </div>




  <script>
    $(document).ready(function () {
      $('.success-banner').fadeIn('slow');
      setTimeout(function () {
        $('.success-banner').fadeOut('slow');
      }, 3000);
    });
  </script>





  <script type="text/javascript">
    (function (i, s, o, g, r, a, m) {
      i["GoogleAnalyticsObject"] = r; i[r] = i[r] || function () {
        (i[r].q = i[r].q || []).push(arguments)
      }, i[r].l = 1 * new Date(); a = s.createElement(o),
        m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
    })(window, document, "script", "//www.google-analytics.com/analytics.js", "ga");

    (function (w, d) {

      var gaId = "UA-25224921-3";



      w.ga("create", gaId, "auto");



      var accountType = "user";


      w.ga("set", "dimension2", accountType);


      w.ga("send", "pageview");
    })(window, document);
  </script>



  <script async src="https://www.googletagmanager.com/gtag/js?id=G-567GCTL9BB"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { window.dataLayer.push(arguments); }
    gtag("js", new Date());
    gtag("config", "G-567GCTL9BB", {
      send_page_view: true
    });
    gtag("config", "AW-768371374");
    gtag("config", "DC-12998045");

    gtag("config", "DC-12389169");
  </script>


  <script>
    !function (f, b, e, v, n, t, s) {
      if (f.fbq) return; n = f.fbq = function () {
        n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
      };
      if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = "2.0";
      n.queue = []; t = b.createElement(e); t.async = !0;
      t.src = v; s = b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t, s)
    }(window, document, "script",
      "https://connect.facebook.net/en_US/fbevents.js");
    fbq("init", "575684804151769");
    fbq("track", "PageView");
  </script>
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

</body>

</html>










<script>

  var inputs = $('#sign-in').find('input');
  var errorMessage = $('.error-message');


  function clearErrors() {
    errorMessage.addClass('hidden');
  }


  inputs.on('input', clearErrors);
</script>