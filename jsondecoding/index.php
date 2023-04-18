<?php
// open the file
$file = file_get_contents('res\sample_data.json');

// create the decoded json object
$json = json_decode($file);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JSON Decoding</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <table class="table table-sm table-striped table-borded border-primary">

            <tr class="table-primary">
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Date of Birth</th>
            </tr>

            <?php
            foreach ($json as $data) {
            ?>
                <tr>

                    <td><?= $data->id ?></td>
                    <td><?= $data->firstname ?></td>
                    <td><?= $data->lastname ?></td>
                    <td><?= $data->email ?></td>
                    <td><?= $data->gender ?></td>
                    <td><?= $data->phoneNumber ?></td>
                    <td><?= $data->address ?></td>
                    <td><?= $data->dob ?></td>

                </tr>
            <?php } ?>

        </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>