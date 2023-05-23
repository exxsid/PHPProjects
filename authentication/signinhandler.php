<?php
session_start();

use Kreait\Firebase\Exception\Auth\InvalidPassword;
use Kreait\Firebase\Exception\Auth\UserNotFound;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

require_once './vendor/autoload.php';

$keyPath = "key\infoman2-g2-2bd13-firebase-adminsdk-c7b51-c3abefd114.json";

$serviceAccJSON = file_get_contents($keyPath);

$serviceAcc = ServiceAccount::fromValue($serviceAccJSON);

$factory = (new Factory)->withServiceAccount($serviceAcc);

$auth = $factory->createAuth();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $signinResult = $auth->signInWithEmailAndPassword($email, $password);
        $_SESSION['userId'] = $signinResult->firebaseUserId();
        $_SESSION['email'] = $email;

        header("Location: home.php");
    } catch (UserNotFound $unf) {
        header("Location: signin.php?error=" . $unf->getMessage());
    } catch (InvalidPassword $ip) {
        header("Location: signin.php?error=" . $ip->getMessage());
    }
} else {
    header("Location: signin.php");
}
