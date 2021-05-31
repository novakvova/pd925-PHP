<?php require_once "connection_database.php"; ?>
<?php include "_head.php"; ?>

<?php include "modal.php"; ?>
<div class="container">
    <h1>Animals</h1>
    <a class="btn btn-primary" href="addAnimal.php">Add new animal</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>image</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <?php
        $command = $dbh->prepare("SELECT id, name, image FROM animals");
        $command->execute();
        while ($row = $command->fetch(PDO::FETCH_ASSOC))
        {
            echo"
            <tr>
            <td>{$row["id"]}</td>
            <td>{$row["name"]}</td>
            <td><img style='width: 200px; height=200px;' src='{$row["image"]}' class='img-thumbnail' alt='Animal image'></td>
            <td><a class='btn btn-dark' href='editAnimal.php?id=${row["id"]}'>Edit  <i class='far fa-edit'></i></td>
            <td>
                <button  onclick='loadDeleteModal(${row["id"]})' data-toggle='modal' data-target='#modalDelete' class='btn btn-danger' >Delete  <i class='fas fa-trash-alt'></i></button>
            </td>
            </tr>";
        }

        ?>
    </table>
    </div>


   <!-- <form action='deleteAnimal.php' method='post'>
        <input type='hidden' name='id' value='${row["id"]}'>
        <button  type='submit' class='btn btn-danger' >Delete  <i class='fas fa-trash-alt'></i></button>
    </form>-->

<script>
    function loadDeleteModal(id)
    {
        $(`#modalDeleteContent`).empty();
        $(`#modalDeleteContent`).append(`<div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete animal ${id}?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <form action="deleteAnimal.php" method="post">
                <input type='hidden' name='id' value='${id}'>
                <button type="submit" name="delete_submit" class="btn btn-danger">Delete</button>
            </form>
        </div>`);
    }
</script>




<?php include "_footer.php"; ?>