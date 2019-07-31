<?php

$id = $_SESSION['id'];
$username = $_SESSION['username'];
$sql = "SELECT * FROM patches WHERE user_ident = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

?>