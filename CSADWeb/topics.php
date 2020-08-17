<?php 
include ('content_function.php');
include('server.php');
include('dbcon.php');
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: login.php");
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Forums</title>
        <link href="Forumstyle.css" type="text/css" rel="stylesheet">
        <link href="/CSADWeb/styles/main.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <header class="header">
            <nav class="nav_bar">
                <div class="logo">
                    <a href="index.php">
                        <img
                        style="width: 6vh; height: 6vh;"
                        src="img/logo.png"
                        alt="logo"/>
                    </a>
                </div>
                <div class="container">
                    <form method="post" action="topics.php">
                        <input type="text" name="searchQuery" class="search" placeholder="Search Forum"><button name="search" style="border: none; background: none; text-align: center;"><img class="searchbutton" src="img/searchicon"/></button>
                    </form>
                </div>
                <ul class="nav-links">
                    <li><a href="index.php #classlink" class="nav-link1 nav-link2">Classes</a></li>
                    <li><a href="aboutus.php" class="nav-link1 nav-link2">About Us</a></li>
                    <li><a href="contactus.php" class="nav-link1 nav-link2">Contact Us</a></li>

                    <?php  if (!isset($_SESSION['email'])) : ?>
                        <li><a href='login.php' class='nav-link1 nav-link2'>Login</a></li>
                    <?php endif ?>

                    <?php  if (isset($_SESSION['email'])) : ?>
                        <li><a href="index.php?logout='1'" class='nav-link1 nav-link2'>Logout</a></li>
                    <?php endif ?>
                </ul>
            </nav>
        </header>  
        <main style="min-height: 100%;">
            <div>
                <?php
                    if (!isset($_SESSION['username'])) {
                        echo "<p class='login-text' style='margin-top: 2%;'>In order to add topics, please <a href='/CSADWeb/login.php'>login</a> or <a href='/CSADWeb/register.php'>click here</a> to register.</p>";
                    }
                ?>
            </div>
            <?php
                if (isset($_SESSION['username'])) {
                    echo "<div class='add-new-topic'><p style='font-family: PopsBold;'><a href='/CSADWeb/newtopic.php?cid=".$_GET['cid']."&scid=".$_GET['scid']."'>
                    Add new topic</a></p></div>";
                }
            ?>
            <div class="content">
                <?php 
                disptopics($_GET['cid'], $_GET['scid']); 
                if (isset($_POST['search'])) {
                    $query = "SELECT * FROM topics WHERE (title LIKE '%".$_POST['searchQuery']."%') ORDER BY topic_id DESC";
                    $result = mysqli_query($db, $query);
                    echo "<table class='topic-table topic-table-background'>";
                    echo "<tr>"
                        . "<th class='topics-table-title'>Title</th>"
                        . "<th class='topics-table-posted'>Posted By</th>"
                        . "<th class='topics-table-date'>Date Posted</th>"
                        . "<th class='topics-table-views'>Views</th>"
                        . "<th class='topics-table-replies'>Replies</th></tr>";
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $cid = $row['category_id'];
                        $scid = $row['subcategory_id'];
                        var_dump($scid);
                        echo "<tr class='topics-table-content'>"
                        . "<td style='text-align: left;'><a href='/CSADWeb/readtopic.php?cid=".$cid."&scid=".$scid."&tid=".$row['topic_id']."'>
                        ".$row['title']."</a></td>"
                                . "<td>".$row['author']."</td>"
                                . "<td>".date('dS F Y', strtotime($row['date_posted']))."</td>"
                                . "<td>".$row['views']."</td>"
                                . "<td>".$row['replies']."</td>"
                                . "</tr>";
                    }
                    echo "</table>";
                }
                ?>
            </div>
        </main>
        <footer>
            <section class="footer-section">
                <div class="column">
                    <h2 class="column-title">Services</h2>
                    <ul>
                        <li><a href="index.php #classlink">Classes</a></li>
                    </ul>
                </div>
                <div class="column">
                    <h2 class="column-title">Seniors Initialize</h2>
                    <ul>
                        <li><a href="aboutus.php">About Us</a></li>
                        <li><a href="contactus.php">Contact</a></li>
                    </ul>
                </div>
                <div class="column">
                    <h2 class="column-title">Community</h2>
                    <ul>
                        <li><a href="Forum.php">Forums</a></li>
                    </ul>
                </div>
                <div class="column">
                    <h2 class="column-title">Connections</h2>
                    <ul>
                        <li><a href="#"><img src="img/instagram-logo.svg" alt="instagram" class="instagram-logo"> Instagram</a></li>
                    </ul>
                </div>
            </section>
        </footer>
    </body>
</html>
