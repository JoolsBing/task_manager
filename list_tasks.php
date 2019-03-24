<?php

$pdo = new PDO('mysql:host=localhost;dbname=test_data','root','');
$sql = 'SELECT title_name,description,upload_address FROM tasks WHERE id';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_OBJ);