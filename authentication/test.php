<!DOCTYPE html>
<html>

<head>
    <script src="script.js"></script>
</head>

<body>
    <form method="POST" action="">
        <input type="submit" name="submitBtn" value="Click Me">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitBtn'])) {
        echo '<script>runAlert();</script>';
    }
    ?>
</body>

</html>