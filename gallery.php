<?php
$_SESSION['userid'] = "Admin";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom styles -->
    <link rel="stylesheet" type="text/css" href="styles.css">

    <title>Gallery</title>
</head>
<body>
<section>
    <div class="container">
    <h2>Gallery</h2>

    <div class="container grid-4 center">
        <?php
        include_once "dbh.php";

        $query = "SELECT * FROM gallery ORDER BY reorder DESC";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $query)) {
            echo "Query failed";
        } else {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            while ($row = mysqli_fetch_assoc($result)){
                echo '<a href="">
                    <div style="background-image: url(img/gallery/'.$row["imgFullName"].');"></div>
                    <h3>'.$row["title"].'</h3>
                    <p>'.$row["description"].'</p>        
                </a>';
            }
        }
        ?>
        </div>
    <div>
    <?php
    if (isset($_SESSION['userid'])) { 
    echo '<div class="container">
            <div class="row justify-content-center">
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <input type="text" name="filename" placeholder="File name...">
                    </div>
                    <div class="form-group row">
                        <input type="text" name="filetitle" placeholder="Image title...">
                    </div>
                    <div class="form-group row">
                        <input type="text" name="filedesc" placeholder="Image description...">
                    </div>
                    <div class="form-group row">
                        <input type="file" name="file">
                    </div>
                    <button type="submit" name="submit" class="btn btn-success">UPLOAD</button>
                </form>
            </div> 
        </div>
    </div>';
    }
    ?>
    </div>
</section>
    
</body>
</html>