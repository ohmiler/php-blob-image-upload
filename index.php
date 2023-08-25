<?php 

    session_start();
    require "config.php";
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Upload Blob image to database</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>

    <div class="container">
        <h1>Upload blob image to database</h1>
        <?php if (isset($_SESSION["success"])) { ?>
            <div class="alert alert-success">
                <?php 
                    echo $_SESSION["success"];
                    unset($_SESSION["success"]);
                ?>
            </div>
        <?php } ?>
        <?php if (isset($_SESSION["error"])) { ?>
            <div class="alert alert-danger">
                <?php 
                    echo $_SESSION["error"];
                    unset($_SESSION["error"]);
                ?>
            </div>
        <?php } ?>
        <hr>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <label for="upload">Upload image</label>
            <input type="file" class="form-control" name="image">
            <button type="submit" class="btn btn-success">Upload</button>
        </form>
        <hr>
        <h3>Uploaded images</h3>
        <?php 
            $result = $conn->query("SELECT * FROM images");
            $result->execute();
            $imgData = $result->fetchAll(PDO::FETCH_ASSOC);

            if ($imgData) {
                echo "<div class='row'>";
                foreach($imgData as $img) {
                    echo "<div class='col-md-3'>";
                    echo '<img class="img-thumbnail" src="data:image/jpeg;base64,' . base64_encode($img['image']) . '" alt="Uploaded image" style="width: 100%;" />';
                    echo "</div>";
                }
                echo "</div>";
            } else {
                echo "No image uploaded yet.";
            }
             
        ?>
    </div>
    
</body>
</html>