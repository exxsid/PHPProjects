<?php

require_once './vendor/autoload.php';

use Google\Cloud\Firestore\FieldValue;

$posts = [
    [
        'content' => "Talo LA Lakers. TAMBAK!!!",
        'date' => FieldValue::serverTimestamp(),
        'user_id' => $db->collection('users')->add([
            'firstname' => 'Putnem',
            'lastname' => 'Addriaens',
            'email' => 'padriaens0@dropbox.com',
            'password' => password_hash('1234', PASSWORD_BCRYPT),
        ])->id(),
        'like_count' => 0,
        'comment_count' => 0
    ]
];
