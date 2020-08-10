<?php 
include ('content_function.php');
include('server.php');
addview($_GET['cid'], $_GET['scid'], $_GET['tid']);
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
        <div>
        <?php
            if (!isset($_SESSION['username'])) {
		echo "<p>please login first or <a href='/CSADWeb/register.php'>click here</a> to register.</p>";
	}
		?>
		</div>
		<?php
                    if (isset($_SESSION['username'])) {
                        replytopost($_GET['cid'], $_GET['scid'], $_GET['tid']);
		}
		?>
            
        </div>
        <div class="content">
			<?php disptopic($_GET['cid'], $_GET['scid'], $_GET['tid']); ?>
		</div>
        
      
    </body>
</html>