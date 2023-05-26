<?php

use Kreait\Firebase\Database\Snapshot;

session_start();

require_once '../utils/db.php';

if (isset($_POST['logout'])) {
    session_destroy();

    header("Location: ../../../index.php");
}

include './partials/header.php';
$loggedinUser = $firestore->database()->collection('users')->document($_SESSION['userId'])->snapshot();
$users = $firestore->database()->collection('users');
$posts = $firestore->database()->collection('posts')->documents();

if (isset($_GET['like'])) {
    $postLikes = $firestore->database()->collection('post_likes')->where('post_id', "=", $_GET['like'])->documents();
    $likeStatus = false;
    $plDocId = "";
    foreach ($postLikes as $pl) {
        if ($pl['user_id'] === $_SESSION['userId']) {
            $likeStatus = true;
            $plDocId = $pl->id();
            break;
        }
    }
    if ($likeStatus) {
        $firestore->database()->collection('post_likes')->document($plDocId)->delete();
    } else {
        $newPL = [
            "post_id" => $_GET['like'],
            "user_id" => $_SESSION['userId']
        ];
        $firestore->database()->collection("post_likes")->add($newPL);
    }
    $lastUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    header("Location: " . $lastUrl);
}
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
    <div class="container px-5">
        <!-- New Post card  -->
        <div class="card my-3">
            <div class="card-header">
                <img src=<?= $loggedinUser['avatar'] ?> alt="avatar" class="rounded-circle me-2" style="max-width: 5%; max-height: 5%">
                <span class=""><?= $loggedinUser['firstname'] . " " . $loggedinUser['lastname'] ?></span>
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

        <!-- Posts -->

        <?php
        foreach ($posts as $post) :
            $originalPoster = $users->document($post['userId'])->snapshot();
        ?>

            <div class="card my-2">
                <!-- headre -->
                <div class="card-header">
                    <img src=<?= $originalPoster['avatar'] ?> alt="avatar" class="rounded-circle me-2" style="max-width: 5%; max-height: 5%">
                    <span class="h6"><strong><?= $originalPoster['firstname'] . " " . $originalPoster['lastname'] ?></strong></span>
                    <span style="font-size: xx-small;"><?= date_format(date_create($post['post_time']), 'F d, Y') ?></span>
                </div>
                <!-- end header -->
                <!-- body -->
                <div class="card-body ps-5">
                    <div>
                        <p>
                            <?=
                            $post['content']
                            ?>
                        </p>
                    </div>
                </div>
                <!-- end body -->
                <!-- footer -->
                <?php
                $postLikes = $firestore->database()->collection('post_likes')->where('post_id', "=", $post->id())->documents();
                $likeStatus = false;
                foreach ($postLikes as $pl) {
                    if ($pl['user_id'] === $_SESSION['userId']) {
                        $likeStatus = true;
                        break;
                    }
                }
                ?>

                <div class="card-footer text-body-secondary">
                    <div class="row  row-cols-auto ms-2">
                        <div class="col">
                            <a href=<?= "?like=" . $post->id() ?> style="text-decoration: none;">
                                <i class="<?= $likeStatus ? "fa-solid fa-thumbs-up" : "fa-regular fa-thumbs-up" ?>"></i>

                                <span>
                                    <?= $post['like_count'] ?> likes
                                </span>
                            </a>
                        </div>
                        |
                        <div class="col">
                            <i class="fa-regular fa-comment"></i>
                            <span>
                                <?= $post['comment_count'] ?> comments
                            </span>
                        </div>
                    </div>
                </div>
                <!-- end footer -->
            </div>

        <?php
        endforeach;
        ?>

        <!-- end posts -->

    </div>
    <!-- End content -->

</body>