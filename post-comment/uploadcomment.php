<?php
include "./db.php";

if (isset($_POST['comment'])) {
    $db->collection('post2')->document(explode(",", $_POST['button'])[0])
        ->collection('comments')->add([
            "comment" => $_POST['comment'],
            'user_id' => explode(",", $_POST['button'])[1],
        ]);
    header("Location: index.php");
}
