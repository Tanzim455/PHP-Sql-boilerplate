<?php

use App\Database;


require_once './vendor/autoload.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$database = new Database();
$pdo = $database->run();

$sql = "DELETE FROM posts WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
