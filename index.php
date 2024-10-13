<?php
session_start();

include 'connection.php';
if (isset($_SESSION['username'])) {
  header('Location: manage_url.php');
  exit;
} else {
  header('Location: login.php');
  exit;
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












</head>

<body class="registration-pages sign_in">





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
    <h3 class="switch to-sign-in tagline">Sign up and <br class="br">start shortening</h3>
    <h3 class="switch to-sign-up tagline">Log in and <br class="br">start sharing</h3>
    <div class="t-center">
      <div class="switch to-sign-up" tabindex="7">
        <span class="gray-link">Don't have an account?</span>
        <a id="sign-up-link" href="signup.php">Sign up</a>
      </div>
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

          <span class="error-message hidden"></span>
          <label class="text" for="password">
            Password

          </label>
          <input class="pw text" type="password" name="password" autocomplete="new-password" tabindex="5"
            autocorrect="off" autocapitalize="none" />
          <span class="error-message hidden"></span>
          <div class="switch to-sign-in password-tip">
            <div class="strength">
              <div class="strength--item">
                <div class="strength--indicator">&bull;</div>
                <div class="strength--text">6 or more characters</div>
              </div>
              <div class="strength--item">
                <div class="strength--indicator">&bull;</div>
                <div class="strength--text">One number</div>
              </div>
              <div class="strength--item">
                <div class="strength--indicator">&bull;</div>
                <div class="strength--text">One letter</div>
              </div>
              <div class="strength--item">
                <div class="strength--indicator">&bull;</div>
                <div class="strength--text">One special character</div>
              </div>
            </div>
          </div>
          <input type="hidden" name="rd" value="/" />
          <input type="hidden" name="invite_token" value="" />

          <input id="submit" type="submit" class="button button-primary sign-up-in" value="Sign up with Email"
            tabindex="8" onclick="onSubmit()" />
        </fieldset>
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
          <span class="error-message hidden"></span>
          <span class="error-message">

          </span>
          <input type="hidden" name="rd" value="/" />
          <input type="submit" class="button button-primary sign-up-in" value="Log in" tabindex="5" name="login" />
        </fieldset>
      </div>
    </form>


  </div>




  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" src="asset/bitly2/FAA16645610A1B983A0D2D86A506687C1273062F.js"></script>
  <script type="text/javascript" src="asset/bitly2/F2646B87E57084653A49DC39069E1F63751169F4.js"></script>
  <script type="text/javascript" src="asset/bitly2/DC48A284F7A5AC5604D42ED052CAD24392789DCB.js"></script>
  <script type="text/javascript" src="asset/bitly2/132D7290946D6B91858A8479F5D7E2E479A2F090.js"></script>
  <script type="text/javascript" src="asset/bitly2/D0BB1779B2B982C44A0324259497832B80101BDE.js"></script>
  <script type="text/javascript" src="asset/bitly2/2071816E49F66173069ABF96EC1CCDB1CA98AD0D.js"></script>





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