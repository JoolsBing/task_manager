<?php
require 'funs.php';
require 'con_pdo.php';
checkSes();

$id = $_GET['id'];
$task = getTask($pdo,$id);
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
      <img src="<?php echo 'uploads/'.$task['upload_address'];?>" alt="" width="400">
      <h2><?php echo $task['title_name'];?></h2>
      <p>
        <?php echo $task['description'];?>
      </p>
      <a href="edit-form.php?id=<?php echo $task['id'];?>">Изменить</a>
      <a href="delete.php?id=<?php echo $task['id'];?>" >Удалить</a>
      <a href="list.php">На главную</a>
    </div>
  </body>
</html>