<?php
require 'funs.php';
require 'con_pdo.php';
checkSes();

$id = $_GET['id'];

$sql = 'DELETE FROM tasks WHERE id = :id';
$stmt= $pdo->prepare($sql);
$stmt->execute([':id' => $id]);

header('Location: list.php');
exit;