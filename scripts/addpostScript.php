<?php
session_start();
include 'dbcon.php';
require_once('dbcon.php');
$title = $_POST['title'];
$description = $_POST['description'];
$author_id = $_SESSION['user']['id'];
$author_name = $_SESSION['user']['login'];
$submitDate  = date('y-m-d');

$adps = $conn->prepare("INSERT INTO content (title, description, author_id, author_name, date) VALUES (?, ?, ?, ?, ?)");
$adps->bind_param("sssss", $title, $description, $author_id, $author_name, $submitDate);

if ($adps->execute()) {

    header('Location: ../layouts/posts.php');
} else {
    echo "Ошибка: " . $adps->error;
}
