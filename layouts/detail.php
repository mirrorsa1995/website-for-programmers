<?php
session_start();
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
                    <li class="nav-item"><a href="detail.php">My Profile</a></li>
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


        <!--Topic Section-->
        <div class="topic-container">
            <!--Original thread-->
            <div class="head">
                <div class="authors">My Profile</div>

            </div>

            <div class="body">
                <div class="authors">
                    <div class="username"><a href=""><?= $_SESSION['user']['login'] ?></a></div>
                    <img src="https://wallpaper-house.com/data/out/5/wallpaper2you_56790.jpg" alt="">
                </div>
                <div class="content">
                    Raiting:   
                    <br>Location: 
                    <br><br>
                    Bio:  
                    <br>
                    <hr>
                   <button type="submit" class="btn btn-primary">Сохранить</button>  <button type="submit" class="btn btn-primary">Редактировать</button>
                    <br>
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