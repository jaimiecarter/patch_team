<?php
  ob_start(); // output buffering is turned on
  session_start(); // turn on sessions
  require_once __DIR__ . '/../php-functions/functions.php';
  require_once __DIR__ . '/team_access.php../php-functions/database.php';
  require_once __DIR__ . '/../php-functions/auth_functions.php';
  include __DIR__ . '/header.php';
  require_login();
  $username = $_SESSION['username'];
  $id = $_SESSION['id'];
?>
<div>
 <p>Welcome <?php echo $username ?>.</p>
</div>