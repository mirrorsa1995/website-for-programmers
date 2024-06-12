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
                    <li class="nav-item"><a href="login.php">Login</a></li>
                    <li class="nav-item"><a href="registration.php">Registration</a></li>
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
    <div class="subforum-description subforum-column">
    <div class="container mt-5" style="text-align: center;">
        <h1><a href="#">Регистрация</h1>
        <form action= "../scripts/registerScript.php" method="post">
                       <div class="form-group">
                <input type="text" class="form-control" placeholder="email" name="email" id="email">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="login" name="login" id="login">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="pass" name="pass" id="pass">
            </div>
            <button type="submit">Зарегистрироваться</button>
        </form>
    </div>   
    </div>
    <footer>
        <span>&copy;  Форум для разработчиком | All Rights Reserved</span>
    </footer>
    <script src="main.js"></script>
</body>
</html>