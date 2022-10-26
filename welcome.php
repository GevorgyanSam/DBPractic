<?php require("connection/config.php"); ?>

<?php
    if(!isset($_SESSION["userId"])) {
        header("Location: index.php");
    }

    $id = $_SESSION["userId"];

    $result = mysqli_query($conn, "SELECT * FROM `users` WHERE `users` . `id` = '$id'");
    $record = mysqli_fetch_assoc($result);
    $u_name = $record["name"];
    $u_last_name = $record["last_name"];
    $u_email = $record["email"];
    $u_login = $record["login"];
    $u_image = $record["image"];
    $u_gen = $record["gen"];
    $u_year = $record["year"];
    $u_month = $record["month"];
    $u_day = $record["day"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo("$u_name $u_last_name") ?></title>
    <style>
        body {
            display: flex;
        }

        h1 {
            text-transform: capitalize;
        }

        a {
            text-decoration: none;
            cursor: pointer;
        }

        table {
            width: 300px;
            align-items: center;
            justify-content: center;
            text-align: center;
            border-collapse: collapse;
        }

        table tr td {
            width: 70px;
        }

        table tr th, td {
            padding: 10px;
        }

        img {
            height: 100%;
            width: 100%;
            object-fit: cover;
            object-position: center;
        }

        .logoutParent {
            margin-left: 50px;
        }

        a {
            font-size: 25px;
        }
    </style>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th colspan="2">User Data</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Name: </td>
                <td><?php echo($u_name); ?></td>
            </tr>
            <tr>
                <td>Last Name: </td>
                <td><?php echo($u_last_name); ?></td>
            </tr>
            <tr>
                <td>Email: </td>
                <td><?php echo($u_email); ?></td>
            </tr>
            <tr>
                <td>Login: </td>
                <td><?php echo($u_login); ?></td>
            </tr>
            <tr>
                <td>Password: </td>
                <td></td>
            </tr>
            <tr>
                <td>Image: </td>
                <td>
                    <img src="img/<?=$u_image?>">
                </td>
            </tr>
            <tr>
                <td>Gen: </td>
                <td><?php echo($u_gen); ?></td>
            </tr>
            <tr>
                <td>Date: </td>
                <td><?php echo($u_month . " " . $u_day . " " . $u_year); ?></td>
            </tr>
        </tbody>
    </table>
    <div class="logoutParent">
        <a href="logout.php">Log Out</a>
    </div>
</body>
</html>