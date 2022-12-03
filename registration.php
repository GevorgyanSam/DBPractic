<?php require("connection/config.php"); ?>

<?php
    if(isset($_SESSION["userId"])) {
        header("Location: welcome.php");
    }
?>

<?php

    $name = $last_name = $email = $login = $password = $cpassword = $gen = $month = $day = $year = "";
    $name_err = $last_name_err = $email_err = $login_err = $password_err = $cpassword_err = $image_err = $gen_err = $date_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if(empty($_POST["name"])) {
            $name_err = "Please Enter Name";
        } else {
            $name_err = "";
            $name = $_POST["name"];
            $name = trim($name);
            $name = htmlspecialchars($name);
            $name = stripslashes($name);
        }

        if(empty($_POST["last_name"])) {
            $last_name_err = "Please Enter Last Name";
        } else {
            $last_name_err = "";
            $last_name = $_POST["last_name"];
            $last_name = trim($last_name);
            $last_name = htmlspecialchars($last_name);
            $last_name = stripslashes($last_name);
        }

        if(empty($_POST["email"])) {
            $email_err = "Please Enter Email";
        } else {
            if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $email = $_POST["email"];
                $email = trim($email);
                $email = htmlspecialchars($email);
                $email = stripslashes($email);
            } else {
                $email_err = "Please Enter Valide Email Address";
            }
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

        if(empty($_POST["cpassword"])) {
            $cpassword_err = "Please Confirm Password";
        } else {
            if($_POST["password"] === $_POST["cpassword"]) {
                $cpassword = $_POST["cpassword"];
                $cpassword = trim($cpassword);
                $cpassword = htmlspecialchars($cpassword);
                $cpassword = stripslashes($cpassword);
            } else {
                $cpassword_err = "The Password is Incorrect";
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
        }

        if(empty($_POST["gen"])) {
            $gen_err = "Please Select Your Gender";
        } else {
            $gen_err = "";
            $gen = $_POST["gen"];
            $gen = trim($gen);
            $gen = htmlspecialchars($gen);
            $gen = stripslashes($gen);
        }

        if($_POST["month"] == 0 || $_POST["day"] == 0 || $_POST["year"] == 0) {
            $date_err = "Please Select Your Birth Date";
        } else {
            $month = $_POST["month"];
            $month = trim($month);
            $month = htmlspecialchars($month);
            $month = stripslashes($month);
            $day = $_POST["day"];
            $day = trim($day);
            $day = htmlspecialchars($day);
            $day = stripslashes($day);
            $year = $_POST["year"];
            $year = trim($year);
            $year = htmlspecialchars($year);
            $year = stripslashes($year);
        }

        if(!empty($name) && !empty($last_name) && !empty($email) && !empty($login) && !empty($password) && !empty($cpassword) && isset($image) && !empty($gen) && !empty($month) && !empty($day) && !empty($year)) {

            $result = mysqli_query($conn, "SELECT * FROM `users` WHERE `users` . `login` = '$login'");

            if(!mysqli_num_rows($result) > 0) {
                $cpassword = md5($cpassword);
                $result = mysqli_query($conn, "INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `login`, `password`, `image`, `gen`, `year`, `month`, `day`) VALUES (NULL, '$name', '$last_name', '$email', '$login', '$cpassword', '$image', '$gen', '$year', '$month', '$day')");

                if($result) {
                    move_uploaded_file($_FILES["image"]["tmp_name"], "img/$image");
                    $result = mysqli_query($conn, "SELECT * FROM `users` WHERE `users` . `password` IN ('$cpassword')");    
                    $record = mysqli_fetch_assoc($result);
                    $_SESSION["userId"] = $record["id"];
                    header("Location: welcome.php");
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

        label[for='male'],
        label[for='female'] {
            margin: 0;
            color: black;
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
            <input type="email" placeholder="Email" name="email" value="<?=$email?>">
            <label><?=$email_err?></label>
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
            <input type="password" placeholder="Confirm Password" name="cpassword" value="<?=$cpassword?>">
            <label><?=$cpassword_err?></label>
        </div>
        <div>
            <input type="file" name="image" value="<?=$image?>" accept=".jpg, .jpeg, .png, .webp">
            <label><?=$image_err?></label>
        </div>
        <div>
            <label for="male">Male</label>
            <input type="radio" name="gen" id="male" value="Male">
            <label for="female">Female</label>
            <input type="radio" name="gen" id="female" value="Female">
            <label><?=$gen_err?></label>
        </div>
        <div>
            <select name="month">
                <option value="0">-- Month --</option>
                <option value="January">January</option>
                <option value="February">February</option>
                <option value="March">March</option>
                <option value="April">April</option>
                <option value="May">May</option>
                <option value="June">June</option>
                <option value="July">July</option>
                <option value="August">August</option>
                <option value="September">September</option>
                <option value="October">October</option>
                <option value="November">November</option>
                <option value="December">December</option>
            </select>
            <select name="day">
                <option value="0">-- Day --</option>
                <?php for($i = 1; $i <= 31; $i++) { ?>
                    <option value="<?=$i?>"><?=$i?></option>
                <?php } ?>
            </select>
            <select name="year">
                <option value="0">-- Year --</option>
                <?php for($i = 2022; $i >= 1900; $i--) { ?>
                    <option value="<?=$i?>"><?=$i?></option>
                <?php } ?>
            </select>
            <label><?=$date_err?></label>
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