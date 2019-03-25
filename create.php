<?php 

$title_name = $_POST['title_name'];
$description = $_POST['description'];
$upload_address = "/upload/". $_FILES['file']['name'];

if(empty($title_name)){
    echo "Вы не дали название новой записи!";
    exit;
}
if(isset($_FILES)){
    move_uploaded_file($_FILES['file']['tmp_name'], 'upload/'. $_FILES['file']['name']);
}else{
    echo "Файл не загружен!";
}

$pdo = new PDO('mysql:host=localhost;dbname=test_data','root','');
$sql = 'INSERT INTO tasks(title_name,description,upload_address) VALUES(:title_name,:description,:upload_address)';
$stmt = $pdo->prepare($sql);
$result = $stmt->execute([':title_name' => $title_name, ':description' => $description, ':upload_address' => $upload_address]);

if(!$result){
    echo "Ошибка при добавления записи!";
    exit;
}else {
    header('Location: list.php');
}