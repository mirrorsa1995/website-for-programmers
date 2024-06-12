<?php
session_start();
include 'dbcon.php';
require_once('dbcon.php');

$login = $_POST['login'];
$pass = $_POST['pass'];


    $check_user = mysqli_query($conn, "SELECT * FROM `users` WHERE `login` = '$login' AND `pass` = '$pass'");
    if (mysqli_num_rows($check_user) > 0) {

        $user = mysqli_fetch_assoc($check_user);

        $_SESSION['user'] = [
            "id" => $user['id'],
            "login" => $user['login'],
            "email" => $user['email']
        ];

        header('Location: ../layouts/addpost.php');

    } else {
        $_SESSION['message'] = 'Не верный логин или пароль';
        header('Location: ../layouts/login.php');
    }
    ?>