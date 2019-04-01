<?php
session_start();
if(!isset($_SESSION['user_email'])){
  header('Location: login-form.php');
  exit;
}

$id = $_GET['id'];

$pdo = new PDO('mysql:host=localhost;dbname=test_data','root','');
$sql = 'SELECT * FROM tasks WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>Show</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/some.css">
    
    <style>
      
    </style>
  </head>

  <body>
    <div class="form-wrapper text-center">
      <?php foreach ($result as $tasks):?>
      <img src="<?php echo 'uploads/'.$tasks['upload_address'];?>" alt="" width="400">
      <h2><?php echo $tasks['title_name'];?></h2>
      <p>
        <?php echo $tasks['description'];?>
      </p>
      <a href="edit-form.php?id=<?php echo $tasks['id'];?>">Изменить</a>
      <a href="delete.php?id=<?php echo $tasks['id'];?>" >Удалить</a>
      <a href="list.php">На главную</a>
      <?php endforeach;?>
    </div>
  </body>
</html>
