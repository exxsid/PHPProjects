<?php
session_start();

echo "Hello user " . $_SESSION['userId'];

if (isset($_POST['logout'])) {
    session_destroy();

    header("Location: index.php");
}
?>

<form action="" method="post">
    <button type="submit" name='logout' class="btn btn-primary">Logout</button>
</form>