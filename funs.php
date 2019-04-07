<?php 

function checkSes()
{
    session_start();
    if(!isset($_SESSION['user_email'])){
        header('Location: login-form.php');
        exit;
  }
}

function getTask($pdo, $id){
  $sql = 'SELECT * FROM tasks WHERE id = :id';
  $stmt = $pdo->prepare($sql);
  $stmt->execute([':id' => $id]);
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return $result[0];
}