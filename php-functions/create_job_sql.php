<?php
  // session_start(); // turn on sessions
  require_once __DIR__ . '/database.php';


  $user_ident = $_POST['user_ident'] ?? '';
  $date = $_POST['date'] ?? '';
  $job_name = $_POST['job_name'] ?? '';
  $facility = $_POST['facility'] ?? '';
  $company = $_POST['company'] ?? '';
  $client = $_POST['client'] ?? '';

  $json = json_encode(''); 
  

  $sql = "INSERT INTO patches ";
  $sql .= "(user_ident, date, job_name, facility, company, client, full_patch_JSON, camera_patch) ";
  $sql .= "VALUES (?,?,?,?,?,?,?,?)";
    
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$user_ident, $date, $job_name, $facility, $company, $client, $json, $json]);  
  $patch_id = $pdo->lastInsertId();
  if($stmt){
    header("location: ../pages/edit.php?id=".$patch_id);
  }
?>