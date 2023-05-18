<hr>
<ul class="list-group list-group-flush ms-5 ms-5">
    <!-- Comment -->
    <li class="list-group-item">
        <?php
        foreach ($comments as $com) :
            $comUserId = $com['user_id'];
            $userDetails = $db->collection('users2')->document($comUserId)->snapshot();
        ?>
            <div class="col">
                <img class="avatar me-3" src=<?= $userDetails['avatar'] ?> alt="avatar">
                <span><?= $userDetails['firstname'] . " " . $userDetails['lastname'] ?></span>
            </div>
            <div class="col ms-5">
                <span><?= $com['comment'] ?></span>
            </div>
        <?php endforeach; ?>
    </li>
</ul>
<form method="POST" class="row" action="./uploadcomment.php">
    <div class="col-sm-6 col-md-8">
        <textarea name="comment" class="form-control" placeholder="Add comment"></textarea>
    </div>
    <div class="col-6 col-md-4">
        <button name="button" type="submit" class="btn btn-primary" value=<?= $post->id() . "," . $id ?>>Comment</button>
    </div>

</form>