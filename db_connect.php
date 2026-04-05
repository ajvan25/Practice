<?php
try {
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "php_crud";

    $conn = mysqli_connect($host, $user, $password, $database);
    echo "Connected successfully!";
} catch (mysqli_sql_exception $e) {
    echo "Connection failed: " . $e->getMessage();
}
