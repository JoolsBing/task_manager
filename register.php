<?php
require 'con_pdo.php';
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

$password = password_hash($password, PASSWORD_DEFAULT);

foreach ($_POST as $key) {
    if(empty($key)){
        include 'errors.php';
        exit;
    }
}

$sql = 'SELECT id FROM test WHERE email=:email';
$stmt = $pdo->prepare($sql);
$stmt->execute([':email' => $email]);
$users = $stmt->fetchColumn();

if($users){
    $errMes = "Животное с таким e-mail уже существует!";
    include 'errors.php';
    exit;
}

$sql = 'INSERT INTO test (username,password,email) VALUES(:username,:password,:email)';
$stmt = $pdo->prepare($sql);
$result = $stmt->execute([':username' => $username, ':password' => $password,':email' => $email]);

require 'funs.php';
erroMes("регистрации"); // Проверка 
