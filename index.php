<?php
require_once  "./components/db_connect.php";
//echo "Welcome to PHP CRUD Application!";

$sql = 'SELECT * FROM products'; // write the query 
$result = mysqli_query($conn, $sql); //execute the query
//var_dump($result);
$layout = '';

if (mysqli_num_rows($result) > 0) {
    //fetch data
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // var_dump($rows);


    foreach ($rows as $row) {
        $layout .= "
        <div> 
        <div class='card my-3' style='width: 18rem;'>
  <img src='./pictures/{$row['picture']}' class='card-img-top' alt='{$row['name']}'>
  <div class='card-body'>
    <h5 class='card-title'>{$row['name']}</h5>
    <p class='card-text'>{$row['price']}</p>
    <a href='details.php?id={$row['id']}' class='btn btn-primary'>Details</a>
    <a href='update.php?id={$row["id"]}'  class='btn btn-warning'>Update</a>
    <a href='delete.php?id={$row["id"]}'  class='btn btn-danger'>Delete</a>
    </div>
  </div>
</div>
 ";
    }

    // $layout = 'We will display the data here!';
} else {
    $layout = "No records found!";
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <a class="btn btn-info" href="create.php">Create product</a></br></br>
        <h1>Products List</h1>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3"></div>

        <?= $layout ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>