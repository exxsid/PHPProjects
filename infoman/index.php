<?php

require_once 'vendor/autoload.php';

use Google\Cloud\Firestore\FirestoreClient;

$db = new FirestoreClient([
    'keyFilePath' => 'keys\infoman2-g2-2bd13-firebase-adminsdk-c7b51-c3abefd114.json',
    'projectID' => 'infoman2-g2-2bd13',
]);

$userCollectionRef = $db->collection('users');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add-Delete Firestore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <form>
            <label for="username" class="form-label">Username: </label>
            <input type="text" name="username" required class="form-control" placeholder="username">
            <br>

            <label for="email" class="form-label">Email: </label>
            <input type="email" name="email" required class="form-control" placeholder="john@example.com">
            <br>

            <label for="password" class="form-label">Password: </label>
            <input type="password" name="password" required class="form-control" placeholder="password">
            <br>

            <label for="firstname" class="form-label">First Name: </label>
            <input type="text" name="firstname" required class="form-control" placeholder="John">
            <br>

            <label for="lastname" class="form-label">Last Name: </label>
            <input type="text" name="lastname" required class="form-control" placeholder="Doe">
            <br>

            <label for="role" class="form-label">Role: </label>
            <input type="text" name="role" required class="form-control" placeholder="Premium">
            <br>

            <label for="facebook" class="form-label">Facebook: </label>
            <input type="text" name="facebook" class="form-control">
            <br>

            <label for="instagram" class="form-label">Instagram: </label>
            <input type="text" name="instagram" class="form-control">
            <br>

            <label for="tiktok" class="form-label">Tiktok: </label>
            <input type="text" name="tiktok" class="form-control">
            <br>

            <label for="Twitter" class="form-label">Twitter: </label>
            <input type="text" name="twitter" class="form-control">
            <br>

            <button type="submit" class="btn btn-primary mb-3">Submit</button>

        </form>

        <?php

        if (isset($_GET['username'])) {
            $userCollectionRef->add(
                [
                    'username' => $_GET["username"],
                    'email' => $_GET["email"],
                    'password' => $_GET["password"],
                    'name' => [
                        'first' => $_GET["firstname"],
                        'last' => $_GET["lastname"],
                    ],
                    'role' => $_GET["role"],
                    'social' => [
                        'facebook' => $_GET["facebook"],
                        'instagram' => $_GET["instagram"],
                        'tiktok' => $_GET["tiktok"],
                        'twitter' => $_GET["twitter"]
                    ]
                ],
            );
        }

        if (isset($_GET['delete'])) {
            $id = $_GET['delete'];
            $userCollectionRef->document($id)->delete();
        }
        ?>

        <table class="table table-sm table-striped table-borded border-primary">

            <tr class="table-primary">
                <th>Last Name</th>
                <th>First Name</th>
                <th>Username</th>
                <th>Role</th>
                <th></th>
            </tr>
            <?php
            $users = $userCollectionRef->documents();

            foreach ($users as $user) {
            ?>

                <tr>
                    <td><?= $user['name']['last'] ?></td>
                    <td><?= $user['name']['first'] ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['role'] ?></td>
                    <td><a href=<?= "index.php/?delete=" . $user->id() ?>>Delete</a></td>
                </tr>

            <?php
            }

            ?>
        </table>
    </div>



</body>

</html>