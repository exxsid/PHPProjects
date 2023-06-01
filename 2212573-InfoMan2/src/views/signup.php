<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once "vendor/autoload.php";

include './src/views/partials/header.php';
?>

<body style="background-color: #588157;">
    <?php
    if (isset($_SESSION['userId'])) {
        header("Location: home.php");
    }


    if (isset($_GET['error'])) {
    ?>
        <script>
            alert("<?= $_GET['error'] ?>");
        </script>
    <?php
    }
    ?>
    <div class="container " style="margin-top: 50px; max-width: 540px; position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  padding: 10px;">
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
                <button type="submit" class="btn btn-light">Sign Up</button>
            </div>

            <div class="">
                <a href="./src/views/signin.php" style="color: #e8e8e8">Already have an account?</a>
            </div>
        </form>
    </div>
</body>

</html>