<?php
require_once "./vendor/autoload.php";



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script src="script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <?php
    if (isset($_GET['error'])) {
    ?>
        <script>
            alert("<?= $_GET['error'] ?>");
        </script>
    <?php
    }
    ?>
    <div class="container ">
        <h1>Sign Up</h1>
        <form action="signup.php" method="post" class="m-5">
            <div class="mb-3">
                <label for="" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" required>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input type="Email" class="form-control" name="email" required>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required id="password" onblur="validatePass()">
                <div id="errorMessage"></div>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="confirmPass" required id="conpassword" onblur="validateConPass()">
                <div id="conerrorMessage"></div>
            </div>
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>
    </div>
</body>

</html>