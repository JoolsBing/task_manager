<?php 
include 'funs.php';
require 'con_pdo.php';
checkSes();

if(!empty($_POST['title_name'])){
  $title_name = $_POST['title_name'];
}else{
  $errMes = "Вы не ввели название записи!";
    include 'errors.php';
    exit;
}

$description = $_POST['description'];
$id = $_GET['id'];

$sql = 'SELECT * FROM tasks WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if(!empty($_FILES['file']['name'])){
  $upload_address = $_FILES['file']['name'];
  if(file_exists('uploads/'. $result['upload_address'])){
    move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $upload_address); // Вставляем новую картинку
    unlink('uploads/'. $result['upload_address']);                                // А старую удаляем
  }
}else{
  $upload_address = $result['upload_address'];                                    // Если $_FILE пустой, оставляем старую картинку
}

$sql = 'UPDATE tasks SET title_name= :title_name, description = :description, upload_address = :upload_address WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute([':title_name' => $title_name, ':description' => $description, ':upload_address' => $upload_address, 'id' => $id]);

header('Location: list.php');
exit;