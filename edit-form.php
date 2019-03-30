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
var_dump($result);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>Edit Task</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    
    <style>
      
    </style>
  </head>

  <body>
    <div class="form-wrapper text-center">
  <?php foreach ($result as $tasks):?>
      <form class="form-signin" action="edit.php?id=<?php echo $tasks['id'];?>" method="POST" enctype="multipart/form-data">
        <img class="mb-4" src="assets/img/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Добавить запись</h1>
        <label for="inputEmail" class="sr-only">Название</label>
        <input type="text" name="title_name" id="inputEmail" class="form-control" placeholder="Название" value="<?php echo $tasks['title_name'];?>">
        <label for="inputEmail" class="sr-only">Описание</label>
        <textarea name="description" class="form-control" cols="30" rows="10" placeholder="Описание"><?php echo $tasks['description'];?></textarea>
        <input type="file" name='file'>
        <img src="assets/img/no-image.jpg" alt="" width="300" class="mb-3">
        <button class="btn btn-lg btn-success btn-block" type="submit">Редактировать</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2018-2019</p>
      </form>

    <?php endforeach;?>
    </div>
  </body>
</html>
