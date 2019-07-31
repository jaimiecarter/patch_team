<?php
  ob_start(); // output buffering is turned on
  session_start(); // turn on sessions

   require_once __DIR__ . '/../php-functions/functions.php';
   require_once __DIR__ . '/../php-functions/database.php';
   require_once __DIR__ . '/../php-functions/auth_functions.php';
  // require_once __DIR__ . '/../php-functions/test.php';

  $errors = [];
  $username = '';
  $password = '';
  $t = random_bytes(5);
  $token = urlencode(bin2hex($t));


function user_cookie($id){

  global $pdo;
  global $token;
  $sql = "UPDATE users SET token = '$token' WHERE id = ?;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$id]);
}

if (is_post_request()) {

  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE email = ?";

  $stmt = $pdo->prepare($sql);
  $stmt->execute([$email]);

  $frm_db = $stmt->fetch();
  
  $id = $frm_db['id'];
  $username = $frm_db['username'];
  
  if (password_verify($password, $frm_db['password'])) {
    global $id;
    $_SESSION['id'] = $id;
    user_cookie($id);
    
    setcookie('token', $token, time() + 86400 * 30, "/");
    
    log_in_admin();
    header("location: select.php");

  } else {
    echo "<script> alert('Details wrong, try again.') </script>";
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

<?php $page_title = 'Log in'; ?>

<div id="content">
  <h1>Log in</h1>



  <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
      <label>Email:</label><br />
      <input type="text" name="email" value="" /><br />
      <label>Password:</label><br />
      <input type="password" name="password" value="" /><br />
      <input type="submit" name="submit" value="Submit" class="submit" /><br />
    </form>
    <form action="../pages/register.php">
    <input type="submit" value="Or register here" />
  </form>
</div>


  </body>
  </html>
