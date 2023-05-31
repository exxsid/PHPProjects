<?php

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

putenv("FIRESTORE_EMULATOR_HOST=127.0.0.1:8080");

require_once 'vendor\autoload.php';

$keyPath = "key\infoman2-g2-2bd13-firebase-adminsdk-c7b51-c3abefd114.json";

$serviceAccJSON = file_get_contents($keyPath);

$serviceAcc = ServiceAccount::fromValue($serviceAccJSON);

$factory = (new Factory)->withServiceAccount($serviceAcc);

$auth = $factory->createAuth();

$firestore = $factory->createFirestore();
