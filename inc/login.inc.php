<?php
if (isset($_POST["submit"]))
{
    $username = $_POST["username"];
    $pwd = $_POST["password"];

    require_once "funtion.php";
    $conn = dbconnect();

    if (emptyInputLogin($username, $pwd) !== false) {
        header('Location: ../login.php?error=emptyinput');
        exit();
    }
    else
    {
        LoginAdmin($conn, $username, $pwd);
        loginUser($conn, $username, $pwd);
    }   
}
else {
    header('Location: ../login.php');
    exit();
}
?>