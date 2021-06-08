<?php require_once "../connection_database.php"; ?>
<?php include "../_head.php"; ?>

<div class="container">
    <h1>Авто</h1>
    <a class="btn btn-primary" href="/cars/add.php">Додати авто</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Назва авто</th>
            <th>Об'єм двигуна</th>
            <th>Тип пального</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $sql = "SELECT c.id, c.name,c.capacity, f.name as fuel FROM cars as c, fuels as f WHERE c.fuel_id=f.id";

            $command = $dbh->prepare($sql);
            $command->execute();
            while ($row = $command->fetch(PDO::FETCH_ASSOC))
            {
                echo "
                <tr>
                    <td>{$row["name"]}</td>
                    <td>{$row["capacity"]}</td>
                    <td>{$row["fuel"]}</td>
                </tr>
                ";
            }
        ?>

        </tbody>

    </table>
</div>
</div>

<?php include "../_footer.php"; ?>
