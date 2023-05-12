<?php

require 'vendor\autoload.php';
require '.\src\includes\likeButton.php';

use Google\Cloud\Firestore\FirestoreClient;

$db = new FirestoreClient([
    "keyFilePath" => "keys\infoman2-g2-2bd13-firebase-adminsdk-c7b51-c3abefd114.json",
    "projectId" => "infoman2-g2-2bd13"
]);

$postCollectionRef = $db->collection("posts");
$likeButton = new LikeButton();
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

    <div class="container-md mt-5">
        <form>
            <!-- <div class="col">
                <input type="text" class="form-control" name="search" placeholder="Search title">
                <button type="submit" class="btn btn-primary mb-3">Search</button>
            </div> -->
            <input type="text" name="search" placeholder="Search title">
            <button type="submit">Search</button>
        </form>
        <?php

        function card($title, $body, $reaction, $comment, $id)
        {
        ?>
            <div class="card w-75 mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?= $title ?></h5>
                    <p class="card-text"><?= $body ?></p>
                    <p class="card-text">Reaction: <?= $reaction ?></p>
                    <p class="card-text">Comment: <?= $comment ?></p>

                    <!-- <a href=<?= "?like=" . $id ?> class="btn btn-primary">Like</a> -->
                    <?php

                    $likeButton = new LikeButton();
                    $likeButton->display($id);
                    // $likeButton->handleButton($id);
                    if (isset($_GET['like']) && (explode(",", $_GET['like'])[1] == $id)) {
                        $likeButton->changeState();
                    }


                    ?>
                </div>
            </div>

        <?php
        }
        ?>

        <?php
        // if (isset($_GET['like'])) {
        //     $currReaction = $postCollectionRef->document($_GET['like'])->snapshot()['reaction'] + 1;
        //     $postCollectionRef->document($_GET['like'])->set([
        //         "reaction" => $currReaction
        //     ], ["merge" => true]);
        // }
        // code for searching
        if (isset($_GET['search'])) {
            $search = $postCollectionRef->documents();
            foreach ($search as $s) {
                if (
                    strpos(strtolower($s["title"]), strtolower($_GET['search'])) ||
                    strpos(strtolower($s["body"]), strtolower($_GET['search']))
                ) {
                    card($s['title'], $s['body'], $s['reaction'], $s['comment'], $s->id());
                }
            }
        } else {
            $posts = $postCollectionRef->documents();
            foreach ($posts as $post) {
                card($post['title'], $post['body'], $post['reaction'], $post['comment'], $post->id());
            }
        }

        ?>

        <?php
        // code cards

        ?>
    </div>





</body>

</html>