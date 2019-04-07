<?php 
require 'funs.php';
require 'con_pdo.php';
checkSes();

$title_name = $_POST['title_name'];
$description = $_POST['description'];

if(empty($title_name)){
    $errMes = "Вы не дали название новой записи!";
    include 'errors.php';
    exit;
}
if(!empty($_FILES)){
    $upload_address = $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $upload_address);
}else{
    echo "Файл не загружен!";
}

$sql = 'INSERT INTO tasks(title_name,description,upload_address,user_email) VALUES(:title_name,:description,:upload_address,:user_email)';
$stmt = $pdo->prepare($sql);
$result = $stmt->execute([":title_name" => $title_name, ":description" => $description, ":upload_address" => $upload_address, ":user_email" => $_SESSION['user_email']]);

if(!$result){
    $errMes = "Ошибка !";
    include 'errors.php';
    exit;
}
else{
    header("Location: list.php");
    exit;
}