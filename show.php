<?php

require 'funs.php';
checkSes();

$id = $_GET['id'];

pdoSelect($id);
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
    
    <?php foreach (pdoSelect($id) as $tasks):?>
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