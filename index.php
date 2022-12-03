<?php require("connection/config.php"); ?>

<?php
    if(isset($_SESSION["userId"])) {
        header("Location: welcome.php");
    }
?>

<?php

    $login = $password = "";
    $login_err = $password_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        if(empty($_POST["login"])) {
            $login_err = "Please Enter Your Login";
        } else {
            $login = $_POST["login"];
        }

        if(empty($_POST["password"])) {
            $password_err = "Please Enter Your Password";
        } else {
            if(strlen($_POST["password"]) < 6) {
                $password_err = "Password Must Contain More Than 6 symbols";
            } else {
                $password = $_POST["password"];
            }
        }

        if(!empty($password) && !empty($login)) {
            $checkPassword = md5($password);
            $result = mysqli_query($conn, "SELECT * FROM `users` WHERE `users` . `login` IN ('$login') AND `users` . `password` IN ('$checkPassword')");

            if(mysqli_num_rows($result) > 0) {
                $record = mysqli_fetch_assoc($result);
                $_SESSION["userId"] = $record["id"];
                header("Location: welcome.php");
            } else {
                $result = mysqli_query($conn, "SELECT * FROM `users` WHERE `users` . `login` = '$login'");

                if(mysqli_num_rows($result) > 0) {
                    $password_err = "Incorrect Password";
                } else {
                    $login_err = "Undefined Account";
                }
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
    <title>Login</title>
    <style>
        h1 {
            margin-left: 20px;
            margin-bottom: 30px;
        }

        form > div {
            margin-top: 15px;
            margin-left: 20px;
        }

        form > div > label {
            margin-left: 10px;
            color: red;
        }

        div a {
            text-decoration: none;
            cursor: pointer;
            margin-left: 22px;
        }

        input[name='send'] {
            margin-bottom: 25px;
        }
    </style>
</head>
<body>
    <div>
        <h1>Login</h1>
    </div>
    <form autocomplete="off" method="POST">
        <div>
            <input type="text" name="login" placeholder="Login" value="<?=$login?>">
            <label><?=$login_err?></label>
        </div>
        <div>
            <input type="password" name="password" placeholder="Password" value="<?=$password?>">
            <label><?=$password_err?></label>
        </div>
        <div>
            <input type="submit" name="send" value="Login">
        </div>
    </form>
    <div>
        <a href="registration.php">Sign Up Here</a>
    </div>
</body>
</html>