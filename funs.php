<?php 

function checkSes()
{
    session_start();
    if(!isset($_SESSION['user_email'])){
        header('Location: login-form.php');
        exit;
  }
}

function pdoSelect($id){
  $pdo = new PDO('mysql:host=localhost;dbname=test_data','root','');
  $sql = 'SELECT * FROM tasks WHERE id = :id';
  $stmt = $pdo->prepare($sql);
  $stmt->execute([':id' => $id]);
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $result;
}

function erroMes($regMistake,$link){
  if(!$result){
    $errMes = "Ошибка $regMistake!";
    include 'errors.php';
    exit;
}
else{
    header("Location: $link.php");
    exit;
}
}