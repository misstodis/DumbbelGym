<?php

if (isset($_POST["submit"])) {
    
    $username = $_POST["username"];
    $fname = $_POST["firstname"];
    $lname = $_POST["lastname"];
    $email = $_POST["email"];
    $pwd = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $place = $_POST["place"];
    $postcode = $_POST["postcode"];
    $adress = $_POST["adress"];

    require_once "funtion.php";
    $conn = dbconnect();

    if (emptyInputSignup($username, $fname, $lname, $email, $pwd, $confirmpassword, $place, $postcode, $adress) !== false) {
        header('Location: ../signup.php?error=emptyinput');
        exit();
    }
    if (invalidUid($username) !== false) {
        header('Location: ../signup.php?error=invaliduid');
        exit();
    }
    if (invalidEmail($email) !== false) {
        header('Location: ../signup.php?error=invalidEmail');
        exit();
    }
    if (pwdMatch($pwd, $confirmpassword) !== false) {
        header('Location: ../signup.php?error=passwordDontmatch');
        exit();
    }
    if (uidExist($conn, $username, $email) !== false) {
        header('Location: ../signup.php?error=usernametaken');
        exit();
    }

    createUser($conn, $username, $fname, $lname, $email, $pwd,  $place, $postcode, $adress);
}
else {
    header("Location: ../signup.php");
    exit();
}