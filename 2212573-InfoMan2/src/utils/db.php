<?php
putenv("FIREBASE_AUTH_EMULATOR_HOST=localhost:9099");
putenv("FIRESTORE_EMULATOR_HOST=localhost:8080");

use Kreait\Firebase\Factory;

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

// $keyPath = '..\keys\emulator-9340c-firebase-adminsdk-brpk2-a54ca132d7.json';

// $serviceAccJSON = file_get_contents($keyPath);

// $serviceAcc = ServiceAccount::fromValue($serviceAccJSON);

$filePath = $_SERVER['DOCUMENT_ROOT'] . '/keys\emulator-9340c-firebase-adminsdk-brpk2-a54ca132d7.json';

$factory = (new Factory)->withServiceAccount($filePath);

$auth = $factory->createAuth();

$firestore = $factory->createFirestore();
