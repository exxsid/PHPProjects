<?php
session_start();

if (isset($_POST['logout'])) {
    session_destroy();

    header("Location: index.php");
}

include './views/partials/header.php';
?>

<body>
    <?= "Hello user " . $_SESSION['userId']; ?>
    <form action="" method="post">
        <button type="submit" name='logout' class="btn btn-primary">Logout</button>
    </form>
</body>