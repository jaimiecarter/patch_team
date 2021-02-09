<?php
require_once __DIR__ . '/database.php';

function log_in_admin() {
  
      global $pdo;
      $cookie_token = $_COOKIE['token'];
      $sql = "SELECT * FROM users WHERE token = ?;";
      $log_in_stmt = $pdo->prepare($sql);
      $log_in_stmt->execute([$cookie_token]);
      $frm_db = $log_in_stmt->fetch();
      $id = $frm_db['id'];
      $username = $frm_db['username'];
    
        session_regenerate_id();
      $_SESSION['id'] = $id;
       $_SESSION['username'] = $username;
      
       return true;
      

    
  }

  function log_in_team(){
    global $db;
    if(isset($_COOKIE['patch_id'])){
      return true;
    }
  }

  // Performs all actions necessary to log out an admin
  function log_out_admin() {

    session_destroy(); // optional: destroys the whole session
    setcookie('token', '', time()-1, "/");
    return true;
  }


  // is_logged_in() contains all the logic for determining if a
  // request should be considered a "logged in" request or not.
  // It is the core of require_login() but it can also be called
  // on its own in other contexts (e.g. display one link if an admin
  // is logged in and display another link if they are not)
  function is_logged_in() {

    return isset($_SESSION['id']);
  }

  function has_cookie(){
    return isset($_COOKIE['token']);
  }


  // Call require_login() at the top of any page which needs to
  // require a valid login before granting acccess to the page.
  function require_login() {
    //global $frm_db;
    if(!has_cookie()) {
      header("location: /login.php");
     } else {
      log_in_admin();
    }
  }
function require_team_login(){
  if (!isset($_COOKIE['team_token'])){
    header("location: index.php");
  } else {
    log_in_team();
  }
}
  
?>
