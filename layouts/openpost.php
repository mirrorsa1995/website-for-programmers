<?php
session_start();
include '../scripts/dbcon.php';
require_once('../scripts/dbcon.php');
$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
// Подготавливаем и выполняем SQL-запрос для получения данных публикации
$oppos = $conn->prepare("SELECT `title`, `description`, `date`, `author_name`, `id` FROM content WHERE `id` = '$post_id'");
$oppos->execute();
$result = $oppos->get_result();
// Проверяем, существует ли публикация
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $title = $row['title'];
    $description = $row['description'];
    $date = $row['date'];
    $author_name = $row['author_name'];
} else {
    echo "Публикация не найдена.";
    exit();
}
// Обработка формы комментариев

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user']['id'])) {
    if (isset($_POST['comment']) && !empty(trim($_POST['comment']))) {
        $comment = trim($_POST['comment']);
        $author_comment = $_SESSION['user']['login'];
        $user_id = $_SESSION['user']['id'];

        $stmt = $conn->prepare("INSERT INTO comments (post_id, user_id, comment, author_comment) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $post_id, $user_id, $comment, $author_comment);

        if ($stmt->execute()) {
            header("Location: openpost.php?id=" . $post_id);
            exit();
        } else {
            echo "Ошибка: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Получаем комментарии к публикации
$stmt = $conn->prepare("SELECT `comment`, `author_comment` FROM comments WHERE `post_id` = '$post_id'");
$stmt->execute();
$comments_result = $stmt->get_result();

// Получаем среднюю оценку
$rate = $conn->prepare("SELECT AVG(rating) as avg_rating FROM ratings WHERE post_id = ?");
$rate->bind_param("i", $post_id);
$rate->execute();
$rating_result = $rate->get_result();
$avg_rating = $rating_result->fetch_assoc()['avg_rating'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#rating').change(function() {
            var rating = $(this).val();
            var post_id = <?php echo $post_id; ?>;
            $.ajax({
                url: '../scripts/rate_post.php',
                type: 'POST',
                data: {rating: rating, post_id: post_id},
                success: function(response) {
                    $('#avg_rating').text(response);
                }
            });
        });
    });
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital@1&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <!--NavBar Section-->
        <div class="navbar">
            <nav class="navigation hide" id="navigation">
                <span class="close-icon" id="close-icon" onclick="showIconBar()"><i class="fa fa-close"></i></span>
                <ul class="nav-list">
                    <li class="nav-item"><a href="../forums.php">Forums</a></li>
                    <li class="nav-item"><a href="posts.php">Posts</a></li>
                    <?php
                    if ($_SESSION['user']) {
                        ?>
                    <li class="nav-item"><a href="detail.php">My Profile</a></li>
                        <?php
                    }
                    ?>
                    <li class="nav-item"><a href="addpost.php">Add post</a></li>
                    <?php
                    if (!$_SESSION['user']) {
                        ?>
                    <li class="nav-item"><a href="login.php">Login</a></li>
                    <li class="nav-item"><a href="registration.php">Registration</a></li>
                        <?php
                    }
                    ?>
                </ul>
            </nav>
            <a class="bar-icon" id="iconBar" onclick="hideIconBar()"><i class="fa fa-bars"></i></a>
            <div class="brand">Forum for Developers</div>
        </div>
        <!--SearchBox Section-->
        <div class="search-box">
            <div>
                <select name="" id="">
                    <option value="Everything">Everything</option>
                    <option value="Titles">Titles</option>
                    <option value="Descriptions">Descriptions</option>
                </select>
                <input type="text" name="q" placeholder="search ...">
                <button><i class="fa fa-search"></i></button>
            </div>
        </div>
    <div class="container">


        <!--Topic Section-->
        <div class="topic-container">
            <!--Original thread-->
            <div class="head">
                <div class="authors">Published by</div>

            </div>

            <div class="body">
                <div class="authors">
                    <div class="username"><a href=""><?php echo htmlspecialchars($row['author_name']); ?></a></div>
                    <img src="https://wallpaper-house.com/data/out/5/wallpaper2you_56790.jpg" alt="">
                </div>
                <div class="content">
                    Publication title:  <?php echo htmlspecialchars($row['title']); ?>
                    <br>Description of the publication:  <?php echo htmlspecialchars($row['description']); ?> 
                    <br><br>
                    File:                    <br>
                    <hr>
                  <button type="submit" class="btn btn-primary">Сохранить</button>  <button type="submit" class="btn btn-primary">Редактировать</button>
                    <br>

    <title>Numeric Rating System</title>

</head>
<body>
 <h3>Средняя оценка: <?php echo $avg_rating ? round($avg_rating, 2) : "Нет оценок"; ?></h3>
    <?php if (isset($_SESSION['user']['id'])): ?>
        <h3>Оценить публикацию</h3>
        <form action="openpost.php?id=<?php echo $post_id; ?>" method="post">
            <label for="rating">Ваша оценка (от 1 до 10):</label>
            <select name="rating" id="rating" required>
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
            </select><br><br>
            <input type="submit" value="Оценить">
        </form>
<?php endif; ?>
    <title>Forum Comments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .comment-box {
            margin-bottom: 20px;
        }
        .comment-box textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            font-size: 1rem;
        }
        .comment-box button {
            margin-top: 10px;
            padding: 10px 20px;
            font-size: 1rem;
            cursor: pointer;
        }
        .comments {
            margin-top: 20px;
        }
        .comment {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Commetns</h1>
    <?php
    if ($comments_result->num_rows > 0) {
        while ($comment_row = $comments_result->fetch_assoc()) {
            echo "<p><strong>" . htmlspecialchars($comment_row['author_comment']) . "</strong></p>" ;
            echo "<p>" . nl2br(htmlspecialchars($comment_row['comment'])) . "</p>";
        }
    } else {
        echo "<p>Нет комментариев.</p>";
    }
    ?>
    <?php if (isset($_SESSION['user']['id'])): ?>
        <h3>Оставить комментарий</h3>
        <form action="openpost.php?id=<?php echo $post_id; ?>" method="post">
            <textarea name="comment" required></textarea><br><br>
            <input type="submit" value="Отправить">
        </form>
    <?php else: ?>
        <p><a href="login.php">Войдите</a>, чтобы оставить комментарий.</p>
    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
    <footer>
        <span>&copy;  Форум для разработчиком | All Rights Reserved</span>
    </footer>
    <script src="main.js"></script>
</body>
</html>