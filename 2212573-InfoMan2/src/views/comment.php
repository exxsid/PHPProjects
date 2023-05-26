<?php

use Google\Cloud\Firestore\FieldValue;

if (!isset($_SESSION)) {
    session_start();
}

require_once '../utils/db.php';

if (isset($_POST['logout'])) {
    session_destroy();

    header("Location: ../../../index.php");
}

include_once './partials/header.php';

$post = $firestore->database()->collection('posts')->document($_SESSION['postId'])->snapshot();
$opId = $post['userId'];
$originalPoster = $firestore->database()->collection('users')->document($opId)->snapshot();


if (isset($_POST['addComment'])) {
    $newComment = [
        'comment' => $_POST['addComment'],
        'comment_time' => FieldValue::serverTimestamp(),
        'post_id' => $_SESSION['postId'],
        'user_id' => $_SESSION['userId']
    ];

    $firestore->database()->collection('post_comments')->add($newComment);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if (isset($_GET['search'])) {
    header("Location: home.php?search=" . $_GET['search']);
}
?>

<body style="background-color: #3A5A40;">

    <?php
    include './partials/topnavbar.php';
    ?>

    <!-- content -->
    <div class="container px-5">
        <!-- header -->
        <div class="card my-2">
            <div class="card-header">
                <img src=<?= $originalPoster['avatar'] ?> alt="avatar" class="rounded-circle me-2" style="max-width: 5%; max-height: 5%">
                <span class="h6"><strong><?= $originalPoster['firstname'] . " " . $originalPoster['lastname'] ?></strong></span>
                <span style="font-size: xx-small;"><?= date_format(date_create($post['post_time']), 'F d, Y') ?></span>

                <a href="home.php" class="float-end" style="text-decoration: none;"><i class="fa-solid fa-house"></i>Home</a>
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
                        <i class="<?= $likeStatus ? "fa-solid fa-thumbs-up" : "fa-regular fa-thumbs-up" ?>"></i>

                        <span>
                            <?= $post['like_count'] ?> likes
                        </span>
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
            <!-- comments -->
            <ul class="list-group list-group-flush w-100 ps-5">
                <li class="list-group-item">
                    <?php
                    // get all comment associated with the post
                    $comments = $firestore->database()->collection('post_comments')->where('post_id', '=', $_SESSION['postId'])->documents();
                    foreach ($comments as $comment) :
                        $commenter = $firestore->database()->collection('users')->document($comment['user_id'])->snapshot();
                    ?>
                        <div class="col">
                            <img src=<?= $commenter['avatar'] ?> alt="avatar" class="rounded-circle me-2" style="max-width: 5%; max-height: 5%">
                            <span class="h6"><strong><?= $commenter['firstname'] . " " . $commenter['lastname'] ?></strong></span>
                            <span style="font-size: xx-small;"><?= date_format(date_create($comment['comment_time']), 'F d, Y') ?></span>
                        </div>
                        <div class="ps-5">
                            <?= $comment['comment'] ?>
                        </div>
                    <?php
                    endforeach;
                    ?>
                </li>
            </ul>
            <!-- end comments -->
            <!-- add comment -->
            <div class="card-footer px-5">
                <form action="" method="post" class="form row">
                    <div class="col-10">
                        <input type="text" name="addComment" placeholder="Add your own comment about the post" class="form-control">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary">Comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end content -->

</body>