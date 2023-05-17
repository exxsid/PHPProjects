<?php
require_once './vendor/autoload.php';
require './db.php';

use Google\Cloud\Firestore\FieldValue;

$post = [
    'content' => 'I love 3 in 1 coffee',
    'date' => FieldValue::serverTimestamp(),
    'user_id' => $db->collection('users')->add([
        'firstname' => 'Xavier',
        'lastname' => 'San Juan',
        'email' => 'xavier@gmail.com',
        'password' => password_hash('1234', PASSWORD_BCRYPT),
    ])->id(),
    'like_count' => 0,
    'comment_count' => 0
];

$db->collection('posts')->add($post);
