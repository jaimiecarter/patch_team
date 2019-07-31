<?php
require_once __DIR__ . '/database.php';
$patch_id = $_POST['patch_id'];
$sql = "DELETE FROM patches WHERE patch_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$patch_id]);

?>