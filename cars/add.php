<?php include "../_head.php"; ?>


<div class="container">
    <div class="p-3">
        <h2>Додати автомобіль</h2>
        <form  method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">Назва</label>
                <?php
                echo "<input type='text' name='name' class='form-control' id='exampleInputEmail1'
                           placeholder='Enter animal name'>"
                ?>
            </div>

            <div class="form-group">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="card" style="width: 100%;">
                                <div class="card-body">
                                    <img src="/uploads/no-profile-photo.jpg"
                                         style="width:100%; cursor: pointer;"
                                         id="uploadImage"
                                         alt="hello">
                                    <form id="formUpload" action="/cars/upload.php" method="post">

                                    </form>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-primary mt-2">Додати</button>
        </form>
    </div>
</div>

<?php include "../_footer.php"; ?>

<script>

    $(function() {
        var uploader;
       $("#uploadImage").on("click", function() {
           if (uploader) {
               uploader.remove();
           }
           uploader = $('<input type="file" name="workImage" accept="image/* style="display:none"/>');
           $("#formUpload").html = uploader;
           uploader.click();
           uploader.on("change", function() {
               //обраний файл відпраляємо на сервер
               $("#formUpload").submit();
           });
       });
    });
</script>
