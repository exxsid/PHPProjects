<?php
require_once '.\vendor\autoload.php';

use Google\Cloud\Firestore\FirestoreClient;

$db = new FirestoreClient([
    'keyFilePath' => 'keys\activity-18f58-firebase-adminsdk-g0ylc-3a9aa00dd6.json',
    'projectId' => 'activity-18f58',
]);

$colRef = $db->collection("lions");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Search and Like Content</title>
    <style>
        .search-form {
            margin-bottom: 20px;
        }

        .search-results {
            margin-top: 20px;
        }

        .search-results .content {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }

        .search-results .content h2 {
            margin-top: 0;
        }

        .like-form {
            display: inline-block;
        }

        .like-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            font-size: 14px;
        }

        .like-button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h1>All About Lions</h1>

    <!-- HTML form to search content -->
    <form class="search-form" method="GET" action="">
        <input type="text" name="query" placeholder="Search content">
        <input type="submit" value="Search">
    </form>

    <!-- Display search results and like button -->
    <div class="search-results">
        <?php
        $results = $colRef->documents(); // get all the documents in collection
        if (empty($results)) { // check if the result is empty
        ?>
            <p>No results found.</p>
        <?php } else { ?>
            <?php foreach ($results as $result) { ?>
                <div class="content">
                    <h2><?php echo $result['info']; ?></h2>
                    <p><?php echo $result['info']; ?></p>
                    <form class="like-form" method="GET" action="">
                        <input type="hidden" name="like" value="<?php echo $result->id(); ?>">
                        <button class="like-button" type="submit">Like</button>
                        <span><?php echo $result['reactions'] ?></span>
                    </form>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</body>

</html>