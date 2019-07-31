<?php
  require_once __DIR__ . '/database.php';
  
    $patch_id = $_POST['patch_id'] ?? '';
    $full_cam_patch = $_POST['cam_patch'] ?? '';
    

    $sql = "UPDATE patches SET camera_patch = ? WHERE patch_id = ?;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$full_cam_patch, $patch_id]);
    return $stmt;

?>