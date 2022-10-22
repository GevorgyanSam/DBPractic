<?php require("connection/config.php"); ?>

<?php
    if(!isset($_SESSION["name"]) && !isset($_SESSION["last_name"])) {
        header("Location: index.php");
    }

    $userName = $_SESSION["name"];
    $userLastName = $_SESSION["last_name"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        h1 {
            text-transform: capitalize;
        }

        a {
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Welcome <?php echo($userName . " " . $userLastName); ?></h1>
    <div>
        <a href="logout.php">Log Out</a>
    </div>
</body>
</html>