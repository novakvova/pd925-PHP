<?php
require_once "config.php";
try {
    $dbh = new PDO(DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME,
        DB_USER, DB_PASSWORD,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES ".DB_CHARSET));
    //seedAuto($dbh);

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit();
}
function seedAuto($dbh)
{
    for ($i=0;$i<100;$i++) {
        $name = "BMW X" . $i;
        $capacity = $i;
        $fuel_id = 1;
        $stmt = $dbh->prepare("INSERT INTO `cars` (`id`, `name`, `capacity`, `fuel_id`) VALUES (NULL, :name, :capacity, :fuel);;");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':capacity', $capacity);
        $stmt->bindParam(':fuel', $fuel_id);
        $stmt->execute();
    }
}
