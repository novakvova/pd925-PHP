<?php require_once "connection_database.php"; ?>
<?php include "_head.php"; ?>

<?php
echo $_SERVER['REQUEST_METHOD'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST["id"];
    $command = $dbh->prepare("DELETE FROM animals WHERE animals.id = :id");
    $command->bindParam(':id', $id);
    $command->execute();
}

header("Location: index.php");
exit;
?>
