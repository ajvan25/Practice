<?php
require_once "db_connect.php";
require_once "index.php";


if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $sql = 'SELECT * FROM products WHERE id =  $id'; // write the query
    $result = mysqli_query($conn, $sql);

    // Fetch the product data
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
    } else {
        header("Location: index.php");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}



?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1>Product Details</h1>

        <div class="card" style="width: 100%; max-width: 600px;">
            <img src="pictures/<?= $row['picture'] ?>" class="card-img-top" alt="<?= $row['name'] ?>">
            <div class="card-body">
                <h5 class="card-title"><?= $row['name'] ?></h5>
                <p class="card-text">
                    <strong>Price:</strong> €<?= $row['price'] ?>
                </p>
                <p class="card-text">
                    <strong>Product ID:</strong> <?= $row['id'] ?>
                </p>

                <a href="index.php" class="btn btn-secondary">Back to products</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>