<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /layouts/registration.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
        <?php
        if ($_SESSION['user']) {
            ?>
            <h2><?= $_SESSION['user']['login'] ?></h2>
            <a href="../scripts/logout.php" class="logout">Выход</a>
            <?php
        }
        ?>
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
    <div class="subforum-description subforum-column" style="text-align: center;">
        <h1><a href="#">Опубликовать работу</h1>
        <form action="../scripts/addpostScript.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" style="width:500px; height:30px;"  placeholder="Название работы" name="title">
            </div>
            <div class="form-group">
                <textarea class="form-control" rows="5" style="width:500px; height:350px;" placeholder="Описание работы" name="description"></textarea>
                <br><input type="file" Файл><br>
            </div>
            <button type="submit" class="btn btn-primary">Опубликовать</button>
        </form>
    </div>   
    </div>
    <footer>
        <span>&copy;  Форум для разработчиком | All Rights Reserved</span>
    </footer>
    <script src="main.js"></script>
</body>
</html>