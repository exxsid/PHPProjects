<?php

if (!isset($_SESSION)) {
    session_start();
}

include_once $_SERVER['DOCUMENT_ROOT'] . '\src\utils\db.php';

if ($_POST['password'] === $_POST['confirmPass']) {
    $newUser = [
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
    ];

    try {
        $user = $auth->createUser($newUser);

        $firestore->database()->collection('users')->document($user->uid)->set([
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'avatar' => 'https://img.mensxp.com/media/content/2015/Jan/kindsoffacebookprofilephotoswearesickofseeing1_1420801169.jpg',
        ]);
    } catch (Exception $e) {
        header("Location: ../index.php?error=" . $e->getMessage());
    }

    header('Location: ../views/signin.php');
} else {
    header("Location: ../../index.php?error=Password is not the same");
}
