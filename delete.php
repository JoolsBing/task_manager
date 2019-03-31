<?php

session_start();
if(!isset($_SESSION['user_email'])){
    header('Location: list.php');
    exit;
}
$id = $_GET['id'];

$pdo = new PDO('mysql:host=localhost;dbname=test_data', 'root','');
$sql = 'DELETE FROM tasks WHERE id = :id';
$stmt= $pdo->prepare($sql);
$stmt->execute([':id' => $id]);

header('Location: list.php');
exit;