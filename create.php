<?php
require_once "./components/db_connect.php";
require_once "./components/file_upload.php";

$sqlSuppliers = "SELECT * FROM suppliers";
$resultSupplier = mysqli_query($conn, $sqlSuppliers);
$supplierRows = mysqli_fetch_all($resultSupplier, MYSQLI_ASSOC);
//var_dump($supplierRows);

$options = '';
foreach ($supplierRows as $supplier) {
    $options .= "<option value = '{$supplier['supplierId']}'>{$supplier['sup_name']}</options>";
}
//var_dump($_POST)
if (isset($_POST["create_product"])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $supplier = $_POST['supplier'];

    $picture = fileUpload($_FILES['picture']);
    //var_dump($FILES);
    //exit;

    $sql = "INSERT INTO products (name, price, picture,fk_supplier_id) VALUES ('$name', $price, '$picture[0]',$supplier)";
    //echo $sql;
    //exit();
    $result = mysqli_query($conn, $sql);
    //var_dump($result);
    if ($result) {
        echo "<div class ='alert alert-success'>
         New product has been created! $picture[1]
         </div>
         ";
    } else {
        echo "<div class ='alert alert-success'>
         Something went wrong!
         </div>
         ";
    }
    header("refresh: 3;url=index.php");
}




//     if (mysqli_query($conn, $sql)) {
//         echo "<div class = 'alert alert-success' role='alert'>new Product created successfully!, {$picture[1]}
//         </div>";
//         header("refresh: 3;url=index.php");
//     } else {
//         echo "<div class = 'alert alert-danger' role='alert'>Error found, {$picture[1]}
//         </div>";
//     }
// }



?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">

        <h1>Create a new product</h1>
        <form method="POST" enctype="multipart/form-data">

            <div class="mb-3 mt-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="picture" class="form-label">Picture</label>
                <input type="file" class="form-control" id="picture" name="picture">
            </div>
            <div class="mb-3">
                <label for="supplier">Supplier</label>
                <select name="supplier" id="supplier" class="form-select">
                    <option value="null">Select one of the options</option>
                    <?= $options ?>

                </select>
            </div>


            <input type="submit" class="btn btn-primary" name="create_product" value="Create Product"></input>
            <a href="index.php" class="btn btn-warning">Back to products</a>

        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>