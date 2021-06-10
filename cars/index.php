<?php require_once "../connection_database.php"; ?>
<?php include "../_head.php"; ?>

<div class="container">
    <h1>Авто</h1>
    <?php
    $sql = "SELECT COUNT(*) as count FROM cars ";

    $command = $dbh->prepare($sql);
    $command->execute();
    $row = $command->fetch(PDO::FETCH_ASSOC);
    $count_items = $row["count"];
    $show_item=3;
    $page = 1;
    $count_pages=ceil($count_items/$show_item);
    if(isset($_GET["page"]))
        $page=$_GET["page"];

    echo "<h2>{$count_items}</h2>";
    echo "<h2>{$count_pages}</h2>";
    ?>
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

        $sql = "SELECT c.id, c.name,c.capacity, f.name as fuel"
        . " FROM cars as c, fuels as f"
        ." WHERE c.fuel_id=f.id LIMIT ".($page-1)*$show_item.", ".$show_item;

        $command = $dbh->prepare($sql);
        $command->execute();
        while ($row = $command->fetch(PDO::FETCH_ASSOC)) {
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

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php
            $show_begin=13;
            $active ="active";
            $right_items = 8;
            for($i=1;$i<=$count_pages;$i++) {
                $active="";
                if($i==$page)
                    $active="active";

                if($page<=5 and $i<=$show_begin)  {
                    echo "<li class='page-item {$active}'><a class='page-link' href='?page={$i}'>{$i}</a></li>";
                }
                if($page>5 && $page<9 && $i <= ($right_items+$page))
                {
                    echo "<li class='page-item {$active}'><a class='page-link' href='?page={$i}'>{$i}</a></li>";
                }
                if($page>=9)
                {
                    if($i<=3) {
                        echo "<li class='page-item {$active}'><a class='page-link' href='?page={$i}'>{$i}</a></li>";
                    }
                    else if($i==4) {
                        echo "<li class='page-item'><a class='page-link' href='?page={$i}'>...</a></li>";
                    }
                    else if(($page-4)<=$i && $i<=($page+5)) {
                        echo "<li class='page-item {$active}'><a class='page-link' href='?page={$i}'>{$i}</a></li>";
                    }
                }
            }
            $i--;
            echo "<li class='page-item'><a class='page-link' href='?page={$i}'>...</a></li>";
            echo "<li class='page-item'><a class='page-link' href='?page={$i}'>$i</a></li>";

            ?>
        </ul>
    </nav>
</div>
</div>

<?php include "../_footer.php"; ?>
