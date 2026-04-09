<?php
require_once "./components/db_connect.php";

$id = (int)$_GET["id"]; // to take the value from the parameter "id" in the url
$sql = "SELECT * FROM products WHERE id = $id"; // finding the product
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);  // fetching the data
if ($row["picture"] != "product.png") { // if the picture is not product.png (the default picture) we will delete the picture
    unlink("pictures/$row[picture]");
}

$delete = "DELETE FROM products WHERE id = $id"; // query to delete a record from the database

if (mysqli_query($conn, $delete)) {
    header("Location: index.php");
} else {
    echo  "Error";
}
// if (isset($_POST['id'])) {
//     $id = (int)$_POST['id'];

//     $sql = "DELETE * FROM products WHERE id = ?"; // finding the product
//     $stmt  = mysqli_prepare($conn, $sql);
//     mysqli_stmt_bind_param($stmt, "i", $id);
//     mysqli_stmt_execute($stmt);
//     header("Location: index.php");
//     exit;
//}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1>Products is deleted</h1>
        <!--<a href="form.php" class="btn btn-primary mb-3">Product is deleted</a>-->
        <a href="index.php" class="btn btn-secondary mb-3">Back to products</a>
        <!-- <h1>Products</h1>
        <div class="row row-cols-lg-3 row-cols-sm-1 row-cols-xs-1">
            <?= $layout ?>
        </div> -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4" crossorigin="anonymous"></script>
</body>

</html>