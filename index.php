<?php require_once("include.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing check</title>
    <style>
        body {
            background-color: #0c3a65;
        }

        .transparent1 {
            background: rgba(0, 0, 0, .5);
        }
    </style>
</head>

<body>
    <h1 class="transparent1"><?= e($HOTEL_NAME); ?></h1>
    Checking login...
    <?php
    if (isset($_SESSION["user"])) {
        header("location: home.php");
    } else {
        header("location: login.php");
    }
    ?>
</body>

</html>