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

<?php

    $search = $search_err = "";

    if(isset($_POST["submit"])) {

        if(empty($_POST["search"])) {
            $search_err = "Enter The User Name or Login";
        } else {
            $search = $_POST["search"];
            $search = htmlspecialchars($search);
            $search = trim($search);
            $search = stripslashes($search);
        }

        if(!empty($search)) {
            $result = mysqli_query($conn, "SELECT * FROM `users` WHERE `users` . `name` LIKE '%$search%' OR `users` . `login` = '$search' OR `users` . `last_name` LIKE '%$search%' ");

            if(mysqli_num_rows($result) > 0) {
                $arr = [];
                while($row = mysqli_fetch_assoc($result)) {
                    $search_user_id = $row["id"];
                    array_push($arr, $search_user_id);
                }
            } else {
                $search_err = "The User Not Found";
            }
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo("$u_name $u_last_name") ?></title>
    <style>
        .parent {
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

        .searchParent {
            margin-left: 40px;
        }

        .search_err {
            margin-top: 20px;
            color: red;
        }
    </style>
</head>
<body>
    <div class="parent">
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
        <div class="searchParent">
            <form method="POST" autocomplete="off">
                <input type="text" placeholder="Name, Last Name or Login" name="search" value="<?=$search?>">
                <button type="submit" name="submit">Search</button>
                <div class="search_err">
                    <?=$search_err?>
                </div>
                <?php if(isset($arr)): ?>
                    <div class="users">
                    <table border="1" style="width: 800px;">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Login</th>
                                <th>Image</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for($i = 0; $i <= count($arr) - 1; $i++) { ?>
                                <?php
                                    $find = $arr[$i];
                                    $result = mysqli_query($conn, "SELECT * FROM `users` WHERE `users` . `id` = '$find'");
                                    $row = mysqli_fetch_assoc($result);
                                ?>
                                <tr>
                                    <td><?=$row["name"]?></td>
                                    <td><?=$row["last_name"]?></td>
                                    <td><?=$row["email"]?></td>
                                    <td><?=$row["login"]?></td>
                                    <td>
                                        <img src="img/<?=$row["image"]?>">
                                    </td>
                                    <td><?=$row["month"] . " " . $row["day"] . " " . $row["year"]?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    </div>
                <?php endif ?>
            </form>
        </div>
    </div>
</body>
</html>