<?php 
include ('content_function.php');
include('server.php');
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
                    <a href="index.html">
                        <img
                        style="width: 6vh; height: 6vh;"
                        src="img/logo.png"
                        alt="logo"/>
                    </a>
                </div>
                <div class="container">
                <input class="search" placeholder="Search Forum" >
                </div>>
                <ul class="nav-links">
                <li><a href="" class="nav-link1 nav-link2">Classes</a></li>
                <li><a href="" class="nav-link1 nav-link2">FAQs</a></li>
                <li><a href="" class="nav-link1 nav-link2">Contact Us</a></li>
                <li><a href="login.php" class="nav-link1 nav-link2">Login</a></li>
                <li><a href="Forum.php" class="nav-link1 nav-link2">Forums</a></li>
                </ul>
            </nav>
        </header>        
        <?php
        	if (isset($_SESSION['username'])) {
                    echo "<div class='content'><p><a href='/CSADWeb/newtopic.php?cid=".$_GET['cid']."&scid=".$_GET['scid']."'>
			 Add new topic</a></p></div>";
                }
		?>
        
        <div class="content">
			<?php disptopics($_GET['cid'], $_GET['scid']); ?>
		</div>
    </body>
</html>
