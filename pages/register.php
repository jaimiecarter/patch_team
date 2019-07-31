<?php
  ob_start(); // output buffering is turned on
  session_start(); // turn on sessions
  require_once __DIR__ . '/../php-functions/functions.php';
  require_once __DIR__ . '/../php-functions/database.php';
  require_once __DIR__ . '/../php-functions/auth_functions.php';
if (isset($_POST['submit'])){
  $email = $_POST['email'];
  $secret_key = "6LfIRZcUAAAAAF49fqh807qecQO5SnAsf6pWSFM5";
  $response_key =  $_POST['g-recaptcha-response'];
  $userIP = $_SERVER['REMOTE_ADDR'];
  $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret_key . "&response=" . $response_key;
 
  $response = file_get_contents($url);
  $data = json_decode($response);
  if(isset($data->success) AND $data->success==true){
    $reg = __DIR__ . '/../php-functions/register_funct.php';
  }
}
?>
<!DOCTYPE html>
<head>
    <!-- Google Tag Manager -->
    <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-TNJ5PZG');
  </script>
  <!-- End Google Tag Manager -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/login_register.css" type="text/css"/>
</head>
<body>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TNJ5PZG" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

<div id="content">
  <h1>Register</h1>
  <form action="../php-functions/register_funct.php" method="post">
    <label>Username:</label><br />
    <input type="text" name="username" value="" /><br />
    <label>Email:</label><br />
    <input type="text" name="email" value="" /><br />
    <label>Password:</label><br />
    <input type="password" name="password1" value="" /><br />
    <label>Retype password:</label><br />
    <input type="password" name="password2" value="" /><br />
    <div class="g-recaptcha" data-sitekey="6LfIRZcUAAAAAHNjK-okHqvv9NP-lmh1fkN95j36"></div>
    <input type="submit" name="register" value="Submit"  /><br />
  </form>
  <form action="../pages/login.php">
    <input type="submit" value="Log In" />
  </form> 
</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>