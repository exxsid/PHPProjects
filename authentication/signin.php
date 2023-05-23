<?php
require_once './vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
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

    <div class="container">
        <h1>Sign In</h1>
        <form action="signinhandler.php" method="post" class="m-5">
            <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input type="text" name="email" class="form-control">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Sign In</button>
            </div>
            <div class="">
                <a href="index.php">Dont't have an account yet?</a>
            </div>
        </form>
    </div>

</body>

</html>