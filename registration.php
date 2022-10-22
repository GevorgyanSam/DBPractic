<?php require("connection/config.php"); ?>

<?php
    if(isset($_SESSION["name"]) && isset($_SESSION["last_name"])) {
        header("Location: welcome.php");
    }
?>

<?php

    $name = $last_name = $login = $password = "";
    $name_err = $last_name_err = $login_err = $password_err = $image_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if(empty($_POST["name"])) {
            $name_err = "Please Enter Name";
        } else {
            $name_err = "";
            $name = $_POST["name"];
            $name = trim($name);
            $name = htmlspecialchars($name);
            $name = stripslashes($name);
            $name = strtolower($name);
        }

        if(empty($_POST["last_name"])) {
            $last_name_err = "Please Enter Last Name";
        } else {
            $last_name_err = "";
            $last_name = $_POST["last_name"];
            $last_name = trim($last_name);
            $last_name = htmlspecialchars($last_name);
            $last_name = stripslashes($last_name);
            $last_name = strtolower($last_name);
        }

        if(empty($_POST["login"])) {
            $login_err = "Please Enter Login";
        } else {
            $testLogin = $_POST["login"];
            $result = mysqli_query($conn, "SELECT * FROM `users` WHERE `users` . `login` = '$testLogin'");

            if(mysqli_num_rows($result) > 0) {
                $login_err = "This Login Already Exists";
            } else {
                $login_err = "";
                $login = $_POST["login"];
                $login = trim($login);
                $login = htmlspecialchars($login);
                $login = stripslashes($login);
                $login = strtolower($login);
            }
        }

        if(empty($_POST["password"])) {
            $password_err = "Please Enter Password";
        } else {
            if(strlen($_POST["password"]) < 6) {
                $password_err = "Password Must Contain More than 6 symbols";
            } else {
                $password_err = "";
                $password = $_POST["password"];
                $password = trim($password);
                $password = htmlspecialchars($password);
                $password = stripslashes($password);
            }
        }

        if(empty($_FILES["image"]["name"])) {
            $image_err = "Please Choose an Image";
        } else {
            $image_err = "";
            $image = $_FILES["image"]["name"];
            $image = trim($image);
            $image = htmlspecialchars($image);
            $image = stripslashes($image);
            $image = strtolower($image);
        }

        if(!empty($name) && !empty($last_name) && !empty($login) && !empty($password) && isset($image)) {

            $result = mysqli_query($conn, "SELECT * FROM `users` WHERE `users` . `login` = '$login'");

            if(!mysqli_num_rows($result) > 0) {
                $password = md5($password);
                $result = mysqli_query($conn, "INSERT INTO `users` (`id`, `name`, `last_name`, `login`, `password`, `image`) VALUES (NULL, '$name', '$last_name', '$login', '$password', '$image')");

                if($result) {
                    move_uploaded_file($_FILES["image"]["tmp_name"], "img/$image");
                    header("Location: index.php");
                }
            }

        }

    }

    function test($data) {
        trim($data);
        htmlspecialchars($data);
        stripslashes($data);
        strtolower($data);
        return $data;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
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
        <h1>Registration</h1>
    </div>
    <form autocomplete="off" method="POST" enctype="multipart/form-data">
        <div>
            <input type="text" placeholder="Name" name="name" value="<?=$name?>">
            <label><?=$name_err?></label>
        </div>
        <div>
            <input type="text" placeholder="Last Name" name="last_name" value="<?=$last_name?>">
            <label><?=$last_name_err?></label>
        </div>
        <div>
            <input type="text" placeholder="Login" name="login" value="<?=$login?>">
            <label><?=$login_err?></label>
        </div>
        <div>
            <input type="password" placeholder="Password" name="password" value="<?=$password?>">
            <label><?=$password_err?></label>
        </div>
        <div>
            <input type="file" name="image" value="<?=$image?>" accept=".jpg, .jpeg, .png, .webp">
            <label><?=$image_err?></label>
        </div>
        <div>
            <input type="submit" name="send" value="Sign Up">
        </div>
    </form>
    <div>
        <a href="index.php">Login Here</a>
    </div>
</body>
</html>