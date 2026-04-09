<?php
try {
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "crud_login";

    $conn = mysqli_connect($host, $user, $password, $database);
    // echo "Connected successfully!";
} catch (mysqli_sql_exception $e) {
    echo "Connection failed: " . $e->getMessage();
}
function cleanInputs($input)
{
    $data = trim($input); // removing extra spaces, tabs, newlines out of the string
    $data = strip_tags($data); // removing tags from the string
    $data = htmlspecialchars($data); // converting special characters to HTML entities, something like "<" and ">", it will be replaced by "&lt;" and "&gt";

    return $data;
}
