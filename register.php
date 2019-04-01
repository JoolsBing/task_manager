<?php
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

$pdo = new PDO('mysql:host=localhost;dbname=test_data','root','');
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
$res = $stmt->execute([':username' => $username, ':password' => $password,':email' => $email]);

if(!$res){
    $errMes = "Ошибка регистрации!";
    include 'errors.php';
    exit;
}
else{
    header('Location: login-form.php');
    exit;
}
