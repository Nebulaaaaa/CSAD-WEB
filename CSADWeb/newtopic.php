<?php 
include ('content_function.php');
include('server.php');

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
        <script src="//cdn.tinymce.com/4/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '#content',
                forced_root_block : 'div',
                forced_root_block_attrs: {
                    'class': 'main',
                    'style': 'font-family: PopsReg;' 
                },
                toolbar: " undo redo | removeformat | bold italic | link | alignleft aligncenter alignright alignjustify |",
                menubar: false
            });
            function validate() {
                if ((tinymce.EditorManager.get('content').getContent()) == '' || (tinymce.EditorManager.get('content').getContent()) == null) {
                    alert('Content can not be empty.');
                    return false;
                }
            }
        </script>
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
                    <input class="search" placeholder="Search Forum" >
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
            <div class="content">
                <?php 
                    if (isset($_SESSION['username'])) {
                        echo "<form action='/CSADWeb/addnewtopic.php?cid=".$_GET['cid']."&scid=".$_GET['scid']."'
                                method='POST'>
                                <p class='title-text'>Title:</p>
                                <input type='text' id='topic' name='topic' required/>
                                <p class='content-text'>Content: </p>
                                <div class='text-container'>
                                <textarea id='content' name='content' ></textarea>
                                </div>
                                <div class='comment-button-container'> 

                                <input class='add-post-button' type='submit' value='Add New Post' onclick='return validate();'/></form>";
                    } else {
                        echo "<p>Please login first or <a href='/CSADWeb/register.php'>click here</a> to register.</p>";
                    }
                ?>
            </div>
            <script>
                function validation_form() {
                    var content = $.trivalidation_formm(tinymce.get('#content').getContent({format: 'text'}));
                    if(content.length == 0) {
                        alert("Please field in your content!");
                        return false;
                    }
                    return true;
                }
            </script>
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
