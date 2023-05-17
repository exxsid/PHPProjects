<?php

require_once './vendor/autoload.php';

use Google\Cloud\Firestore\FirestoreClient;

$db = new FirestoreClient([
	"keyFilePath" => "key\infoman2-g2-2bd13-firebase-adminsdk-c7b51-c3abefd114.json",
	"projectId" => "infoman2-g2-2bd13"
]);
