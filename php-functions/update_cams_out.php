<?php
require_once __DIR__ . '/database.php';

$patch_id = $_SESSION['patch_id'];



$sql = "SELECT camera_patch FROM patches WHERE patch_id = ?;";
$stmt = $pdo->prepare($sql);
$stmt->execute([$patch_id]);
$JSON_cam_patch_data =  $stmt->fetch();

$cam_patch_JSON = $JSON_cam_patch_data['camera_patch'];
return $cam_patch_JSON;

?>