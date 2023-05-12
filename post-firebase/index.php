<?php

require 'vendor\autoload.php';
require '.\src\includes\likeButton.php';

use Google\Cloud\Firestore\FirestoreClient;

$db = new FirestoreClient([
    "keyFilePath" => "keys\infoman2-g2-2bd13-firebase-adminsdk-c7b51-c3abefd114.json",
    "projectId" => "infoman2-g2-2bd13"
]);

$postCollectionRef = $db->collection("posts");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>

    <?php
    if (isset($_GET['like'])) {
        $currLike = $postCollectionRef->document(explode(",", $_GET['like'])[1])->snapshot()['reaction'];
        $state = explode(",", $_GET['like'])[0];
        if ($state == "true") {
            $postCollectionRef->document(explode(",", $_GET['like'])[1])->set([
                'reaction' => $currLike - 1,
            ], ['merge' => true]);
        } else {
            $postCollectionRef->document(explode(",", $_GET['like'])[1])->set([
                'reaction' => $currLike + 1,
            ], ['merge' => true]);
        }
    }
    ?>
    <div class="container mt-5">
        <form class="row g-3">
            <div class="col-auto">
                <input type="text" class="form-control" name="search" placeholder="Enter here">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Search</button>
            </div>
        </form>

        <div class="row">
            <?php
            if (isset($_GET['search'])) :
                $posts = $postCollectionRef->documents();
                foreach ($posts as $post) :
                    if (
                        strpos(strtolower($post['title']), strtolower($_GET['search'])) ||
                        strpos(strtolower($post['body']), strtolower($_GET['search']))
                    ) :
            ?>
                        <div class="col-sm-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $post['title'] ?></h5>
                                    <p class="card-text"><?= $post['body'] ?></p>
                                    <form action="">
                                        <?php
                                        if (
                                            isset($_GET['like']) &&
                                            explode(",", $_GET['like'])[1] == $post->id()
                                        ) :
                                            $currState = explode(",", $_GET['like'])[0];
                                            if ($state == "false") :
                                        ?>
                                                <button type="submit" name="like" class="btn btn-primary" value="true,<?= $post->id() ?>">
                                                    Likes: <?= $post['reaction'] ?>
                                                </button>
                                            <?php
                                            else :
                                            ?>
                                                <button type="submit" name="like" value="false,<?= $post->id() ?>">
                                                    Likes: <?= $post['reaction'] ?>
                                                </button>
                                            <?php
                                            endif;
                                        else :
                                            ?>
                                            <button type="submit" name="like" value="false,<?= $post->id() ?>">
                                                Likes: <?= $post['reaction'] ?>
                                            </button>
                                        <?php
                                        endif;
                                        ?>
                                        <button type="submit" name="comment" class="btn btn-primary">Comment <?= $post['comment'] ?></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php
                    endif;
                endforeach;
            else :
                $posts = $postCollectionRef->documents();
                foreach ($posts as $post) :
                    ?>
                    <div class="col-sm-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= $post['title'] ?></h5>
                                <p class="card-text"><?= $post['body'] ?></p>
                                <form action="">
                                    <?php
                                    if (
                                        isset($_GET['like']) &&
                                        explode(",", $_GET['like'])[1] == $post->id()
                                    ) :
                                        $currState = explode(",", $_GET['like'])[0];
                                        if ($state == "false") :
                                    ?>
                                            <button type="submit" name="like" class="btn btn-primary" value="true,<?= $post->id() ?>">
                                                Likes: <?= $post['reaction'] ?>
                                            </button>
                                        <?php
                                        else :
                                        ?>
                                            <button type="submit" name="like" value="false,<?= $post->id() ?>">
                                                Likes: <?= $post['reaction'] ?>
                                            </button>
                                        <?php
                                        endif;
                                    else :
                                        ?>
                                        <button type="submit" name="like" value="false,<?= $post->id() ?>">
                                            Likes: <?= $post['reaction'] ?>
                                        </button>
                                    <?php
                                    endif;
                                    ?>

                                    <button type="submit" name="comment" class="btn btn-primary">Comment: <?= $post['comment'] ?></button>
                                </form>
                            </div>
                        </div>
                    </div>
            <?php
                endforeach;
            endif; ?>
        </div>
</body>

</html>