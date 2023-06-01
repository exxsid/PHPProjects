<?php

use Google\Cloud\Firestore\FieldValue;
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
    header("Location: " . $_SERVER['HTTP_REFERER']);
}

if (isset($_POST['newPost'])) {
    $content = $_POST['newPost'];
    $newPost = [
        'content' => $content,
        'userId' => $_SESSION['userId'],
        'post_time' => FieldValue::serverTimestamp(),
        'comment_count' => 0,
        'like_count' => 0,
    ];
    $firestore->database()->collection("posts")->add($newPost);
    $lastUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    header("Location: " . $lastUrl);
}

if (isset($_GET['comment'])) {
    $_SESSION['postId'] = $_GET['comment'];

    header("Location: comment.php");
}
?>

<body style="background-color: #3A5A40;">
    <?php
    include './partials/topnavbar.php';
    ?>

    <div class="container px-5">
        <div class="card mb-3" style="background-color: #588157;">
            <div class="row g-0 align-items-center">
                <div class="col-md-4 p-3">
                    <img src=<?= $loggedinUser['avatar'] ?> alt="avatar" class="rounded-circle me-2" style="max-width: 100%; max-height: 100%">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h1><?= $loggedinUser['firstname'] . " " . $loggedinUser['lastname'] ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- contents -->
    <div class="container px-5" style="max-width: 800px;">
        <!-- New Post card  -->
        <div class="card my-3" style="background-color: #588157;">
            <div class="card-header">
                <img src=<?= $loggedinUser['avatar'] ?> alt="avatar" class="rounded-circle me-2" style="max-width: 5%; max-height: 5%">
                <span class=""><?= $loggedinUser['firstname'] . " " . $loggedinUser['lastname'] ?></span>
            </div>
            <div class="card-body">
                <div>
                    <form method="post">
                        <textarea class="w-100 form-control" name="newPost" id="" placeholder="Share some contents here" style="background-color: #A3B18A;"></textarea>
                        <button type="submit" class="btn btn-light mt-3 float-end">Post</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- End new post card -->

        <!-- Posts -->

        <?php
        if (isset($_GET['search'])) :
            $posts = $firestore->database()->collection('posts')->documents();
            if ($posts->size() == 0) :
        ?>
                <h1>No result found</h1>
                <?php
            else :
                foreach ($posts as $post) :
                    $originalPoster = $users->document($post['userId'])->snapshot();
                    if (stripos($post['content'], $_GET['search']) !== false) :
                ?>
                        <div class="card my-2" style="background-color: #588157;">
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
                                        <a href="<?= "?like=" . $post->id() ?>" style="text-decoration: none;">
                                            <i class="<?= $likeStatus ? "fa-solid fa-thumbs-up" : "fa-regular fa-thumbs-up" ?>"></i>

                                            <span>
                                                <?= $post['like_count'] ?> likes
                                            </span>
                                        </a>
                                    </div>
                                    |
                                    <div class="col">
                                        <a href="<?= "?comment=" . $post->id() ?>" style="text-decoration: none;">
                                            <i class="fa-regular fa-comment"></i>
                                            <span>
                                                <?= $post['comment_count'] ?> comments
                                            </span>
                                        </a>

                                    </div>
                                </div>
                            </div>
                            <!-- end footer -->
                        </div>
                    <?php
                    endif;
                endforeach;
            endif;
        else :
            $posts = $firestore->database()->collection('posts')->documents();
            foreach ($posts as $post) :
                if ($_SESSION['userId'] == $post['userId']) :
                    $originalPoster = $users->document($post['userId'])->snapshot();
                    ?>

                    <div class="card my-2" style="background-color: #588157;">
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
                                    <a href="<?= "?comment=" . $post->id() ?>" style="text-decoration: none;">
                                        <i class="fa-regular fa-comment"></i>
                                        <span>
                                            <?= $post['comment_count'] ?> comments
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- end footer -->
                    </div>

        <?php
                endif;
            endforeach;
        endif;


        ?>

        <!-- end posts -->

    </div>
    <!-- End content -->

</body>