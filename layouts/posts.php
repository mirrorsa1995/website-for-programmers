<?php
session_start();
include '../scripts/dbcon.php';
require_once('../scripts/dbcon.php');

$gp = "SELECT * FROM content";
$resultgp = $conn->query($gp);
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
            <a href="logout.php" class="logout">Выход</a>
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
    </header>
    <div class="container">
        <!--Navigation-->
        <div class="navigate">
            <span><a href="">Forum for Developers - Forums</a> >> <a href="">random subforum</a></span>
        </div>
        <!--Display posts table-->
        <div class="posts-table">
            <div class="table-head">
                <div class="status">Status</div>
                <div class="subjects">Subjects</div>

                <div class="last-reply">Date of publication</div>
            </div>
        </tr>
        <?php
        if ($resultgp->num_rows > 0) {
            while ($row = $resultgp->fetch_assoc()) {

            echo "<div class=table-row>";
                echo "<div class=status><i class=fa fa-fire></i></div>";
                echo "<div class=subjects>";
                    echo "<a href='openpost.php?id=" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['title']) . "</a>";
                    echo "<br>";
                    echo "<span>Published by <b> <a>" . htmlspecialchars($row['author_name']) . "</a></b> .</span>";
                echo "</div>";


                echo "<div class=last-reply>";
                    echo htmlspecialchars($row['date']);
                    echo "<br>By <b><a>" . htmlspecialchars($row['author_name']) . "</a></b>";
                echo "</div>";
            echo "</div>";

            }
        } else {
            echo "<tr><td colspan='4'>Нет публикаций</td></tr>";
        }
        ?>
            </div>
            <!--ends here-->
        </div>
        <!--Pagination starts-->
            <div class="pagination">
                pages: <a href="">1</a><a href="">2</a><a href="">3</a>
            </div>
        <!--pagination ends-->
    </div>

    <div class="note">
        <span><i class="fa fa-frown-o"></i>&nbsp; 0 Engagement Topic</span>&nbsp;&nbsp;&nbsp;<a href=""><i class="fa fa-share-square"></i></a><br>
        <span><i class="fa fa-book"></i>&nbsp; Low Engagement Topic</span>&nbsp;&nbsp;&nbsp;<a href=""><i class="fa fa-share-square"></i></a><br>
        <span><i class="fa fa-fire"></i>&nbsp; Popular Topic</span>&nbsp;&nbsp;&nbsp;<a href=""><i class="fa fa-share-square"></i></a><br>
        <span><i class="fa fa-rocket"></i>&nbsp; High Engagement Topic</span>&nbsp;&nbsp;&nbsp;<a href=""><i class="fa fa-share-square"></i></a><br>
        <span><i class="fa fa-lock"></i>&nbsp; Closed Topic</span>&nbsp;&nbsp;&nbsp;<a href=""><i class="fa fa-share-square"></i></a><br>
    </div>

    <footer>
        <span>&copy;  Форум для разработчиком | All Rights Reserved</span>
    </footer>
    <script src="main.js"></script>
</body>
</html>