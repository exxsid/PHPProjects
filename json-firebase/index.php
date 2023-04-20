<?php
require_once 'vendor/autoload.php';

use Google\Cloud\Firestore\FirestoreClient;

$firestore = new FirestoreClient([
    'keyFilePath' => 'keys\infoman2-g2-2bd13-firebase-adminsdk-c7b51-c3abefd114.json',
    'projectID' => 'infoman2-g2-2bd13',
]);

$userColRef = $firestore->collection('users');

// open the file
$file = file_get_contents('res\jsonfile.json');

// create the decoded json object
$users = json_decode($file);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JSON-Firebase</title>
</head>

<body>
    <?php
    $bulk = $firestore->bulkWriter();

    foreach ($users as $user) {
        $bulk->set($userColRef->add([]), [
            'username' => $user->username,
            'email' => $user->email,
            'password' => $user->password,
            'name' => [
                'first' => $user->first_name,
                'last' => $user->last_name,
            ],
            'role' => $user->role,
            'social' => [
                'facebook' => "facebook.com/{$user->username}",
                'instagram' => "@{$user->username}",
                'tiktok' => "@{$user->username}",
                'twitter' => "@{$user->username}"
            ]
        ]);
    }
    $bulk->flush();
    ?>


</body>

</html>