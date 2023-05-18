<?php

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

require_once './vendor/autoload.php';

$keyPath = "key\infoman2-g2-2bd13-firebase-adminsdk-c7b51-c3abefd114.json";

$serviceAccJSON = file_get_contents($keyPath);

$serviceAcc = ServiceAccount::fromValue($serviceAccJSON);

$factory = (new Factory)->withServiceAccount($serviceAcc);

$auth = $factory->createAuth();

$firestore = $factory->createFirestore();



$newUser = [
    'username' => $_POST['username'],
    'email' => $_POST['email'],
    'password' => $_POST['password'],
];
try {
    $user = $auth->createUser($newUser);

    $firestore->database()->collection('user2')->document($user->uid)->set([
        'username' => $_POST['username'],
        'email' => $_POST['email'],
    ]);
} catch (Exception $e) {
    header("Location: index.php?error=" . $e->getMessage());
}
echo "succes";
