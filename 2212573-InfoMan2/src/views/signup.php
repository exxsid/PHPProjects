<?php
require_once "vendor/autoload.php";

include './src/views/partials/header.php';
?>

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
        <form action="./src/handler/signuphandler.php" method="post" class="m-5">
            <div class="mb-3">
                <label for="" class="form-label">First Name</label>
                <input type="text" class="form-control" name="firstname" required>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="lastname" required>
            </div>

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
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </div>

            <div class="">
                <a href="./src/views/signin.php">Already have an account?</a>
            </div>
        </form>
    </div>
</body>

</html>