<?php
session_start();
//var_dump($_SESSION);
require_once "./components/db_connect.php";

if (isset($_SESSION['user'])) {
    header("Location: home.php");
    exit;
}
if (isset($_SESSION['adm'])) {
    header("Location: dashboard.php");
    exit;
}
require_once "./components/db_connect.php";

$emailError = $passwordError = '';
$error = false;
if (isset($_POST['login'])) {
    $email = cleanInputs($_POST['email']);
    $password = cleanInputs($_POST['password']);

    if (empty($email)) {
        $error = true;
        $emailError = "Please enter your email address";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // if the provided text is not a format of an email, error will be true
        $error = true;
        $emailError = "Please enter a valid email address";
    }

    if (empty($password)) {
        $error = true;
        $passwordError = "Please enter your password";
    }
    if (!$error) { // if there is no error with any input, data will be inserted to the database


        // hashing the password before inserting it to the database
        $password = hash("sha256", $password);

        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            var_dump($row);

            if ($row["status"] == "adm") {
                $_SESSION['adm'] = $row['id'];
                header("Location: dashboard.php");
            } else {
                $_SESSION['user'] = $row['id'];
                header("Location: home.php");
            }
            echo "Login successful!";
        } else {
            echo "<div class='alert alert-danger'>
               <p>Something went wrong, please try again later ...</p>
           </div>";
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="text-center">Login page</h1>
        <form method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email address">
                <span class="text-danger"><?= $emailError ?></span>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <span class="text-danger"><?= $passwordError ?></span>
            </div>
            <button name="login" type="submit" class="btn btn-primary">Login</button>

            <span>you don't have an account? <a href="register.php">register here</a></span>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>