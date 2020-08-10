<?php 
    session_start(); 
    
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['email']);
        header("location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Seniors Initalize</title>
        <link rel="stylesheet" href="./stylemain.css" />
	<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
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
                <ul class="nav-links">
                    <li><a href="#classlink" class="nav-link1 nav-link2">Classes</a></li>
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
        <main class="main">
            <section class="top">
                <div class="container-header">
                    <img src="img/header-pic-1.jpg" alt="cover" class="cover" />
                    <div class="shadow"></div>
                    <img
                    src="img/seniorsinitializelogo.png"
                    alt="biglogo"
                    class="biglogo"/>
                </div>
            </section>
            <section class="middle">
                <div class="missiontitle">
                    <h1 class="mission" data-aos="fade-top">Lifelong Learning</h1>
                </div>
                <div class="desc">
                    <p data-aos="fade-right">
                      We at Seniors Initialize believe technology assist us in our daily
                      lives and that seniors shouldn't be left behind in the age of
                      technology.
                    </p>
                    <br><br>
                    <p data-aos="fade-right">
                      That's why we offer state-of-the-art technology classes for seniors
                      at a modest fee. These classes will equip seniors with various
                      everyday life skills to ease their lives.
                    </p>
                </div>
                <div class="middle-img">
                    <img src="img/middle-pic-1.jpg" alt="middle-pic-1" />
                </div>
            </section>
            <section class="bottom" id="classlink">
                <div class="classes">
                    <div class="classtitle">
                        <h1 data-aos="fade-top">Our Classes</h1>
                        <p data-aos="fade-top">Click on the images for more<br>details on the class</p>
                    </div>
                </div><div class="class1">
                    <div class="class1-img">
                        <a href="class1.php">
                            <img src="img/bottom-pic-1.jpg" alt="class1"/>
                        </a>
                    </div>
                    <div class="class1-desc">
                        <h3 data-aos="fade-left">Windows 10 Essentials</h3>
                        <p data-aos="fade-left">
                          Windows 10 Essentials is our comprehensive operating systems
                          class. Seniors will be taught basic tasks such as creating files,
                          storing files and using various applications. Topics like security
                          will also be lightly touched upon.
                        </p>
                    </div>
                </div>
                <div class="class2">
                    <div class="class2-img">
                        <a href="class2.php">
                            <img src="img/bottom-pic-2.jpg" alt="class2"/>
                        </a>
                    </div>
                    <div class="class2-desc">
                        <h3 data-aos="fade-right">Mobile Applications</h3>
                        <p data-aos="fade-right">
                          In our Mobile Applications class, seniors will learn to simplify
                          their lives with the help of their phones. Topics taught include
                          downloading apps, identifying and capturing QR codes and various
                          life-hacks.
                        </p>
                    </div>
                </div>
                <div class="class3">
                    <div class="class3-img">
                        <a href="class3.php">
                            <img src="img/bottom-pic-3.jpg" alt="class3"/>
                        </a>
                    </div>
                    <div class="class3-desc">
                        <h3 data-aos="fade-left">Internet Fundamentals</h3>
                        <p data-aos="fade-left">
                          Internet Fundamentals teaches the skill you are using right now.
                          Seniors will be taught a myraid of activities that includes but
                          not limited to surfing the web, troubleshooting, spotting scams.
                        </p>
                    </div>
                </div>
            </section>
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
          <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
    AOS.init();
    </script>
    </body>
</html>