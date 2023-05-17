<?php

require_once './vendor/autoload.php';
require_once './db.php';

use Google\Cloud\Firestore\FieldValue;

// $posts = [
//     [
//         'content' => "Talo LA Lakers. TAMBAK!!!",
//         'date' => FieldValue::serverTimestamp(),
//         'user_id' => $db->collection('users2')->add([
//             'firstname' => 'Putnem',
//             'lastname' => 'Addriaens',
//             'email' => 'padriaens0@dropbox.com',
//             'password' => password_hash('1234', PASSWORD_BCRYPT),
//             'avatar' => 'https://robohash.org/illumetcorporis.png'
//         ])->id(),
//         'like_count' => 0,
//         'comment_count' => 0
//     ],
//     [
//         'content' => "Go Baby Jokic. Go Denver #nuggetsforlife",
//         'date' => FieldValue::serverTimestamp(),
//         'user_id' => $db->collection('users2')->add([
//             'firstname' => 'Margarete',
//             'lastname' => 'Bestar',
//             'email' => 'mbestar1@wsj.com',
//             'password' => password_hash('erqwedf', PASSWORD_BCRYPT),
//             'avatar' => 'https://robohash.org/quiadoloribusreprehenderit.png'
//         ])->id(),
//         'like_count' => 0,
//         'comment_count' => 0
//     ],
//     [
//         'content' => "TBT. Panahong 'di pa ako mataba.",
//         'date' => FieldValue::serverTimestamp(),
//         'user_id' => $db->collection('users2')->add([
//             'firstname' => 'Mommy',
//             'lastname' => 'Romei',
//             'email' => 'mromei3@nasa.gov',
//             'password' => password_hash('4356fsf', PASSWORD_BCRYPT),
//             'avatar' => 'https://robohash.org/acupiditatedolor.png'
//         ])->id(),
//         'like_count' => 0,
//         'comment_count' => 0
//     ],
//     [
//         'content' => "Ayaw ko na sa Pilipinas ang init. Gusto ko pumuntang Baguio.",
//         'date' => FieldValue::serverTimestamp(),
//         'user_id' => $db->collection('users2')->add([
//             'firstname' => 'Karlen',
//             'lastname' => 'Willgress',
//             'email' => 'kwillgress4@bbc.co.uk',
//             'password' => password_hash('4356fsf', PASSWORD_BCRYPT),
//             'avatar' => 'https://robohash.org/verovoluptasvoluptate.png'
//         ])->id(),
//         'like_count' => 0,
//         'comment_count' => 0
//     ],
//     [
//         'content' => "LF babaeng kalding, sana may kasaman junakis na.",
//         'date' => FieldValue::serverTimestamp(),
//         'user_id' => $db->collection('users2')->add([
//             'firstname' => 'Deeanne',
//             'lastname' => 'McIvor',
//             'email' => 'dmcivor2@upenn.edu',
//             'password' => password_hash('4356fsf', PASSWORD_BCRYPT),
//             'avatar' => 'https://robohash.org/optiodoloribusharum.png'
//         ])->id(),
//         'like_count' => 0,
//         'comment_count' => 0
//     ],
// ];

// foreach ($posts as $post) {
//     $db->collection("post2")->add($post);
// }

$postLikes = [
    []
];
