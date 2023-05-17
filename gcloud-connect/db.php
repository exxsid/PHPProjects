<?php
putenv("FIRESTORE_EMULATOR_HOST=localhost:8030");
require_once './vendor/autoload.php';

use Google\Cloud\Firestore\FirestoreClient;

$db = new FirestoreClient([
    'prjectId' => 'infoman2-g2-2bd13'
]);
