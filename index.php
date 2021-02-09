<?php
if (isset($_COOKIE['token'])) {
  header("location: /pages/select.php");
}

?>
<!DOCTYPE html>

<head>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/header.css" type="text/css" />
  <link rel="stylesheet" href="css/index.css" type="text/css" />
</head>

<body>
 
  <ul class="topnav">
    <li><a class="active" href="index.php">Home</a></li>
    <li><a href="pages/login.php">Login</a></li>
    <li><a href="pages/register.php">Register</a></li>
  </ul>
  <h3>Welcome to PatchTeam</h3>
  <div class="description">
    <p>
      PatchTeam enables broadcast audio professionals
      to share audio configuration in a simple, easy to
      read and always available format.</br>
      This web app is currently in Beta.</br>
      Any feedback or feature requests can be made at our <a href="https://www.facebook.com/Patchteam-292485024978503/">facebook page</a>. </br>
    </p>
    <p>
      Simple, easy to use.</br>
    </p>
    <p>
      Only information needed for the patch.</br>
    </p>
    <p>
      All patches from previous broadcasts, stored
      in database.</br>
    </p>
    <p>
      Edit existing patches to suit 'on the day' changes.</br>
    </p>
    <p>
      Share with your team via SMS.</br>
    </p>
    <p>
      Formatted for mobile, on-site use.</br>
    </p>
    <p>
      No app to download and update. Everything here on this URL.</br>
    </p>
  </div>