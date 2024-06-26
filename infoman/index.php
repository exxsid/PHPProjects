<?php

require_once 'vendor/autoload.php';

use Google\Cloud\Firestore\FirestoreClient;

$db = new FirestoreClient([
    'keyFilePath' => 'keys\infoman2-g2-2bd13-firebase-adminsdk-c7b51-c3abefd114.json',
    'projectID' => 'infoman2-g2-2bd13',
]);


$userCollectionRef = $db->collection('users');

// $id = $userCollectionRef->add(
//     [
//         'username' => 'MasterOgway',
//         'email' => 'MasterOgway@google.com',
//         'password' => 'Ogway',
//         'name' => [
//             'first' => 'Master',
//             'last' => 'Ogway',
//         ],
//         'role' => 'premium',
//         'social' => [
//             'facebook' => '/master_ogway',
//             'instagram' => '',
//             'tiktok' => '@master_ogway',
//             'twitter' => '@master_ogway'
//         ]
//     ],
// )->id();

// $newUser = $userCollectionRef->document($id)->snapshot();

$userCollectionRef = $db->collection('users');

$users = $userCollectionRef->documents();

echo "<pre>";
print_r($users);

echo "</pre>";

?>

<!-- <h3>Username</h3>
<p><?= $newUser['username'] ?></p>

<h3>Email</h3>
<p><?= $newUser['email'] ?></p>

<h3>Password</h3>
<p><?= $newUser['password'] ?></p>

<h3>Name</h3>
<p><?= $newUser['name']['first'] ?> <?= $newUser['name']['last'] ?></p>



<h3>Role</h3>
<p><?= $newUser['role'] ?></p>

<h3>Social</h3>
<p>facebook: <?= $newUser['social']['facebook'] ?></p>
<p>instagram: <?= $newUser['social']['instagram'] ?></p>
<p>tiktok: <?= $newUser['social']['tiktok'] ?></p>
<p>twitter: <?= $newUser['social']['twitter'] ?></p> -->