<?php
session_start();

use Kreait\Firebase\Exception\Auth\InvalidPassword;
use Kreait\Firebase\Exception\Auth\UserNotFound;

include_once '../utils/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $signinResult = $auth->signInWithEmailAndPassword($email, $password);
        $_SESSION['userId'] = $signinResult->firebaseUserId();
        $_SESSION['email'] = $email;

        header("Location: ../home.php");
    } catch (UserNotFound $unf) {
        header("Location: signin.php?error=" . $unf->getMessage());
    } catch (InvalidPassword $ip) {
        header("Location: signin.php?error=" . $ip->getMessage());
    }
} else {
    header("Location: signin.php");
}
