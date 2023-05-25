<?php
session_start();

require_once '../utils/db.php';

if (isset($_POST['logout'])) {
    session_destroy();

    header("Location: ../../../index.php");
}

include './partials/header.php';
$user = $firestore->database()->collection('users')->document($_SESSION['userId'])->snapshot();
?>

<body style="background-color: #DAD7CD;">
    <nav class="navbar navbar-expand-lg nav-bg">
        <div class="container">
            <a class="navbar-brand" href="home.php">Birdy</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </form>

            <div class="d-flex">
                <span class="mx-3">
                    <?=
                    $firestore->database()
                        ->collection('users')
                        ->document($_SESSION['userId'])
                        ->snapshot()['username']
                    ?>
                </span>
                <form action="" method="post">
                    <button type="submit" name='logout' class="btn btn-primary">Logout</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- contents -->
    <div class="container px-5 py-1">
        <!-- New Post card  -->
        <div class="card">
            <div class="card-header">
                <img src=<?= $user['avatar'] ?> alt="avatar" class="rounded-circle me-2" style="max-width: 5%; max-height: 5%">
                <span class=""><?= $user['firstname'] . " " . $user['lastname'] ?></span>
            </div>
            <div class="card-body">
                <div>
                    <form method="post">
                        <textarea class="w-100 form-control" name="newPost" id="" placeholder="Share some contents here"></textarea>
                        <button type="submit" class="btn btn-primary mt-3 float-end">Post</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- End new post card -->
        <?php

        $username = $user['username'];
        ?>
        <?= "Hello user " .  $username ?>

    </div>

</body>