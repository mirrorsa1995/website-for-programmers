<?php
session_start();
include 'dbcon.php';
require_once('dbcon.php');
$login = $_POST['login'];
$pass = $_POST['pass'];
$email = $_POST['email'];
// Подготавливаем и выполняем SQL-запрос для вставки данных
$stmt = $conn->prepare("INSERT INTO users (login, pass, email) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $login, $pass, $email);

if ($stmt->execute()) {
    $_SESSION['message'] = 'Регистрация прошла успешно';
    header('Location: ../layouts/login.php');
} else {
    echo "Ошибка: " . $stmt->error;
}
