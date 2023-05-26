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

// $comments = [
//     'post_id' => "e0ff7e5029824f4bac14",
//     'user_id' => "T43G0iMqudtAdmcqsAEUzx8DO6by",
//     'comment' => "Kahit tres lang",
// ];

// $firestore->database()->collection("post_comments")->add($comments);

// $post = [
//     "content" => "Nuggets vs Heats on the Finals. Lets goooooo",
//     "userId" => "T43G0iMqudtAdmcqsAEUzx8DO6by",
//     "comment_count" => 0,
//     "like_count" => 0,
// ];

// $firestore->database()->collection("posts")->add($post);

echo "nothing here";

if (isset($_GET['clicked'])) {
    echo "here i am again bitches";
    $lastURL = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    header("Location: " . $lastURL);
}
?>

<a href="?clicked">click me</a>