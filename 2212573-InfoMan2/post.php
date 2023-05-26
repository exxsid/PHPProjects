<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once 'src/utils/db.php';

// $post = [
//     "content" => "Malapit na ang finals",
//     "userId" => $_SESSION['userId'],
//     "comment_count" => 0,
//     "like_count" => 0,
// ];

// $firestore->database()->collection("posts")->add($post);

// $like = [
//     'post_id' => "e0ff7e5029824f4bac14",
//     'user_id' => "T43G0iMqudtAdmcqsAEUzx8DO6by"
// ];

// $firestore->database()->collection("post_likes")->add($like);

$comments = [
    'post_id' => "e0ff7e5029824f4bac14",
    'user_id' => "T43G0iMqudtAdmcqsAEUzx8DO6by",
    'comment' => "Kahit tres lang",
];

$firestore->database()->collection("post_comments")->add($comments);
