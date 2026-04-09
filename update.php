<?php
require_once "./components/db_connect.php";
require_once "./components/file_upload.php";



$id = (int)$_GET['id']; // sanitize id

$sql = "SELECT * FROM products WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) != 1) {
    header("Location: index.php");
    exit;
}

$row = mysqli_fetch_assoc($result);
var_dump($row);


if (isset($_POST["update"])) {
    $name = trim($_POST["name"]);
    $price = (float)$_POST["price"];
    $picture = $row["picture"]; // default to existing picture

    if ($_FILES["picture"]["error"] == 4) {
        // No new picture
        $sql = "UPDATE products SET picture = ?,name = ?, price = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssi", $picture, $name, $price, $id);
    } else {
        // New picture uploaded
        $picture = fileUpload($_FILES["picture"]);
        if ($row["picture"] != "product.png") {
            unlink("pictures/" . $row["picture"]);
        }
        $sql = "UPDATE products SET name = ?, price = ?, picture = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssi", $name, $price, $picture[0], $id);
    }

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Redirect after update
    header("Location: index.php");
    exit;
}

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
        <h2>Update product</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3 mt-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" aria-describedby="name" name="name" value="<?= $row["name"] ?>">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">price</label>
                <input type="number" class="form-control" id="price" aria-describedby="price" name="price" value="<?= $row["price"] ?>">
            </div>
            <div class="mb-3">
                <label for="picture" class="form-label"> picture</label>
                <input type="file" class="form-control" id="picture" aria-describedby="picture" name="picture">
            </div>
            <button name="update" type="submit" class="btn btn-primary">Update product</button>
            <a href="index.php" class="btn btn-warning">Back to home page</a>
        </form>
    </div>

</body>

</html>