<?php
session_start();

require_once '../utils/db.php';

if (isset($_POST['logout'])) {
    session_destroy();

    header("Location: ../../index.php");
}

include './partials/header.php';
?>

<body>
    <?php
    $user = $firestore->database()->collection('users')->document($_SESSION['userId'])->snapshot();
    $username = $user['username'];
    ?>
    <?= "Hello user " .  $username ?>
    <form action="" method="post">
        <button type="submit" name='logout' class="btn btn-primary">Logout</button>
    </form>
</body>