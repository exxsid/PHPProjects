<?php
$user = $db->collection("users2")->document($post['user_id'])->snapshot();
?>

<div class="card">
    <div class="card-header ch">
        <img class="avatar me-3" src="<?= $user['avatar'] ?>" alt="avatar">
        <div style="display: flex; flex-direction: column; margin: 0;">
            <h5><?= $user['firstname'] . $user['lastname'] ?></h5>
            <span><?= date_format(date_create($post['date']), 'F d, Y') ?></span>
        </div>

    </div>
    <div class="card-body">
        <p class="card-text ms-5"><?= $post['content'] ?></p>
        <div>
            <a href="#" class="me-4"><?= $post['like_count'] ?> | Like</a>
            <a href="#"><?= $post['comment_count'] ?> | Comments</a>
        </div>
        <hr>
        <ul class="list-group list-group-flush ms-5 ms-5">
            <!-- Comment -->
            <li class="list-group-item">
                <div class="col">
                    <img class="avatar me-3" src="https://robohash.org/verovoluptasvoluptate.png" alt="avatar">
                    <span>Jerick</span>
                </div>

            </li>
            <!-- end comment -->
            <li class="list-group-item">A second item</li>
            <li class="list-group-item">
                dfadfas
            </li>
        </ul>
        <form class="row">
            <div class="col-sm-6 col-md-8">
                <textarea name="comment" class="form-control" placeholder="Add comment"></textarea>
            </div>
            <div class="col-6 col-md-4">
                <button type="submit" class="btn btn-primary">Comment</button>
            </div>

        </form>
    </div>
</div>