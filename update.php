<?php

use App\Database;


require_once './vendor/autoload.php';



if (isset($_POST['add_record'])) {
    $id = $_GET['id'];
    $title = $_POST['title'];
    var_dump($id);
    var_dump($title);
    $database = new Database();
    $pdo = $database->run();
    $sql = "UPDATE posts SET title=:title WHERE id=:id ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);

    $stmt->execute();
}





// $database = new Database();
// $pdo = $database->run();
// $sql = "UPDATE publishers
//  SET title=:title
//  WHERE id=:id";
// $stmt = $pdo->prepare($sql);
// $stmt->bindParam(':id', $id, PDO::PARAM_INT);
// $stmt->execute();
// $result = $stmt->fetch(PDO::FETCH_OBJ);
// var_dump($result);