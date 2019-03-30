<?php 
session_start();
if(!isset($_SESSION['user_email'])){
  header('Location: login-form.php');
  exit;
}
if(isset($_POST['title_name'])){
  $title_name = $_POST['title_name'];
}else{
  echo "Вы не ввели название записи!";
  exit;
}
$description = $_POST['description'];
$id = $_GET['id'];

$pdo = new PDO('mysql:host=localhost;dbname=test_data','root','');
$sql = 'SELECT * FROM tasks WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);


if(isset($_FILES['file'])){
  $upload_address = $_FILES['file']['name'];
  if(file_exists('uploads/'. $result['upload_address'])){
    move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' .$upload_address);
    unlink('uploads/'. $result['upload_address']);
  }
}
/* Если при редактировании записи не выбрать file с картинкой, пусть останется уже выбранная ранее картинка (НО У МЕНЯ ЭТО НЕ РАБОТАЕТ!!)*/
if(!isset($_FILES['file'])){
  $upload_address = $result['upload_address'];
}

 /* if(isset($_FILES['file'])){
  $upload_address = $_FILES['file']['name'];
  if(file_exists('uploads/'. $result['upload_address'])){
    chmod('uploads/'. $result['upload_address'], 0755);
    unlink('uploads/'. $result['upload_address']);
    move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' .$upload_address);
  }else{
    $upload_address = $result['upload_address'];
  }
   */


$sql = 'UPDATE tasks SET title_name= :title_name, description = :description, upload_address = :upload_address WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute([':title_name' => $title_name, ':description' => $description, ':upload_address' => $upload_address, 'id' => $id]);

header('Location: list.php');
exit;