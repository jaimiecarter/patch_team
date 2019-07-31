<?php
require_once __DIR__ . '/database.php';

$token = urlencode($_POST["team_token"]);
$patch_id = urlencode($_POST["patch_id"]);


 $sql = "INSERT INTO team_tokens (team_token, patch_id) VALUES (?,?);";
 $stmt = $pdo->prepare($sql)->execute([$token, $patch_id]);

?>