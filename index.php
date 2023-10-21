<?php

use App\Database;

require_once './vendor/autoload.php';
if (isset($_POST['add_record'])) {
    echo "Record added";
    echo $_GET['id'];
}


$database = new Database();
$pdo = $database->run();
$sql = "SELECT id,title FROM posts LIMIT 10";
$stmt = $pdo->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_OBJ);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="index.php" method="post">
        <?php if (count($result)) foreach ($result as $arr) : ?>
            <p><?= $arr->title; ?></p>
            <a href="edit.php?id=<?php echo $arr->id; ?>">Edit</a>
            <input type="submit" name="add_record">
            <a href="delete.php?id=<?php echo $arr->id; ?>">DELETE</a>
            <input type="submit" name="add_record">
        <?php endforeach; ?>

    </form>

</body>

</html>