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
if ($_POST['password'] != $_POST['confirmPass']) {
    header("Location: index.php?error=Password is not the same");
}

try {
    $user = $auth->createUser($newUser);

    $firestore->database()->collection('users2')->document($user->uid)->set([
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname'],
        'avatar' => 'https://img.mensxp.com/media/content/2015/Jan/kindsoffacebookprofilephotoswearesickofseeing1_1420801169.jpg',
    ]);
} catch (Exception $e) {
    header("Location: index.php?error=" . $e->getMessage());
}
