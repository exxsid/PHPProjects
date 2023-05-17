<?php
putenv("FIRESTORE_EMULATOR_HOST=localhost:8030");
require_once './vendor/autoload.php';

use Google\Cloud\Firestore\FirestoreClient;

$db = new FirestoreClient([
    'prjectId' => 'infoman2-g2-2bd13'
]);

$file = file_get_contents("resources\ph.json");
$json = json_decode($file, true);

// $db->collection("cities")->newDocument();

// foreach ($json as $city) {
//     $db->collection('cities')->add($city);
// }

$cities = $db->collection("cities")->documents();

foreach ($cities as $city) {
    echo $city['city'];
    echo "<br>";
}
