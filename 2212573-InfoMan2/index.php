<?php
if (!isset($_SESSION)) {
    session_start();
}



if (isset($_SESSION['userId'])) {
    header("Location: ./src/views/home.php");
}

require '.\src\views\signup.php';
