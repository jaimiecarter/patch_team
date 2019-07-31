<?php
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/functions.php';
$email = "";
$emailerr = $passworderr = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!filter_var(test_input($_POST["email"]), FILTER_VALIDATE_EMAIL)){
        echo "email in wrong format";
    } else {
        $email = test_input($_POST['email']);
    }
    $username = test_input($_POST['username']);
    $password1 = test_input($_POST['password1']);
    $password2 = test_input($_POST['password2']);

        if($password1 === $password2){
            $password = $password1;
        } else {
            echo "type the password again";
        }
    $encrypt_pwd = password_hash($password, PASSWORD_BCRYPT);
}


  $sql = "INSERT INTO users (username, email, password) VALUES (?,?,?)";
  
  $stmt = $pdo->prepare($sql)->execute([$username, $email, $encrypt_pwd]);

  if($stmt){
    header('Location: ../pages/login.php');
  }

?>