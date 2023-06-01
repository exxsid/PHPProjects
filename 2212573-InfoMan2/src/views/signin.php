<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once $_SERVER['DOCUMENT_ROOT'] . '\vendor\autoload.php';

include $_SERVER['DOCUMENT_ROOT'] . '\src\views\partials\header.php';
?>
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

<body style="background-color: #3A5A40;">
    <div class="container" style="margin-top: 50px; max-width: 540px; position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  padding: 10px;">
        <h1>Sign In</h1>
        <form action="../handler/signinhandler.php" method="post" class="m-5">
            <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input type="text" name="email" class="form-control">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-light">Sign In</button>
            </div>
            <div class="">
                <a href="../../index.php" style="color: #e8e8e8;">Dont't have an account yet?</a>
            </div>
        </form>
    </div>

</body>

</html>