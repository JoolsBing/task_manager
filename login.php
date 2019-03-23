<?php 
$email = $_POST['email'];
$password = $_POST['password'];

foreach ($_POST as $key) {
    if(empty($key)){
        include 'errors.php';
        exit;
    }
}

$pdo = new PDO('mysql:host=localhost;dbname=test_data','root','');
$sql = 'SELECT password FROM test WHERE email =:email';
$stmt = $pdo->prepare($sql);
$stmt->execute([':email' => $email]);
$users = $stmt->fetch(PDO::FETCH_OBJ);

if ($users) {
    if(password_verify($password, $users->password)) {
        header('Location: list.php');
    }else{
        echo "Неверный логин или пароль";
    }
}else {
    echo "Неверный логин или пароль";
}