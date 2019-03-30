<?php 
session_start();

if(!isset($_SESSION['user_email'])){
  header('Location: login-form.php');
  exit;
}

$title_name = $_POST['title_name'];
$description = $_POST['description'];
$upload_address = $_FILES['file']['name'];

if(empty($title_name)){
    echo "Вы не дали название новой записи!";
    exit;
}
if(isset($_FILES)){
    move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/'. $_FILES['file']['name']);
}else{
    echo "Файл не загружен!";
}

$pdo = new PDO('mysql:host=localhost;dbname=test_data','root','');
$sql = 'INSERT INTO tasks(title_name,description,upload_address,user_email) VALUES(:title_name,:description,:upload_address,:user_email)';
$stmt = $pdo->prepare($sql);
$result = $stmt->execute([":title_name" => $title_name, ":description" => $description, ":upload_address" => $upload_address, ":user_email" => $_SESSION['user_email']]);

if(!$result){
    echo "Ошибка при добавления записи!";
    exit;
}else {
    header('Location: list.php');
}