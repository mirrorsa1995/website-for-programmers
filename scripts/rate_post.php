<?php
session_start();
include 'dbcon.php';
require_once('dbcon.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user']['id'])) {
    $rating = intval($_POST['rating']);
    $post_id = intval($_POST['post_id']);
    $user_id = $_SESSION['user_id'];

    if ($rating >= 1 && $rating <= 10) {
        $stmt = $conn->prepare("INSERT INTO ratings (post_id, user_id, rating) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $post_id, $user_id, $rating);

        if ($stmt->execute()) {
            $stmt->close();

            // Получаем обновленную среднюю оценку
            $stmt = $conn->prepare("SELECT AVG(rating) as avg_rating FROM ratings WHERE post_id = ?");
            $stmt->bind_param("i", $post_id);
            $stmt->execute();
            $rating_result = $stmt->get_result();
            $avg_rating = $rating_result->fetch_assoc()['avg_rating'];
            echo round($avg_rating, 2);
        } else {
            echo "Ошибка: " . $stmt->error;
        }
        $stmt->close();
    }
}

$conn->close();
?>
