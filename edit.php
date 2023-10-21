<?php

use App\Database;


require_once './vendor/autoload.php';
$id = $_GET['id'];
$sql = "SELECT id,title FROM POSTS WHERE id=:id";
$database = new Database();
$pdo = $database->run();
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_OBJ);
var_dump($result);




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="update.php?id=<?= $result->id; ?>" method="post">
        <input type="hidden" value="<?php echo $_GET['id']; ?>" id="">
        <input type="text" name="title" value="<?php echo $result->title; ?>" id="">
        <input type="submit" name="add_record">
    </form>

</body>

</html>