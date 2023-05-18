<?php
$user = $db->collection("users2")->document($post['user_id'])->snapshot();
?>

<div class="card mb-3">
    <div class="card-header ch">
        <img class="avatar me-3" src="<?= $user['avatar'] ?>" alt="avatar">
        <div style="display: flex; flex-direction: column; margin: 0;">
            <h5><?= $user['firstname'] . " " . $user['lastname'] ?></h5>
            <span><?= date_format(date_create($post['date']), 'F d, Y') ?></span>
        </div>

    </div>
    <div class="card-body">
        <p class="card-text ms-5"><?= $post['content'] ?></p>
        <hr>
        <div>
            <?php
            $comments = $db->collection('post2')->document($post->id())
                ->collection('comments')->documents();
            ?>
            <a href="#" class="me-4"><?= $post['like_count'] ?> | Like</a>
            <a href="#"><?= $comments->size() ?> | Comments</a>
        </div>
        <!-- comments -->
        <?php include "./comment.php" ?>
    </div>
</div>