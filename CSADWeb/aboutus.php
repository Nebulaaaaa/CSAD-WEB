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
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>About Us</title>
        <link rel="stylesheet" href="styleaboutus.css">
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    </head>
    <body>
        <div class="wrapper">
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
        <main>
            
            <section class="aboutus-top">
                <img src="img/group-header.jpg" alt="" class="cover"><div class="shadow"></div>
                <div class="header-text">The Team<br>Behind<br>Seniors Initialize</div>
            </section>
            <section class="profiles">
                <div data-aos="fade-top" class="intro-desc">
                    We're a bunch of<br>self-achieving individuals that wants to see<br>the world change for the better. Seniors
                    Initialize is<br>our project of taking the first step.
                </div>
                <div class="profile-left">
                    <img src="img/portrait-1.jpeg" alt="" class="profile-img-left" data-aos="fade-right">
                    <div class="left">
                        <h3 data-aos="fade-left">Iian Khor</h3>
                        <p data-aos="fade-left" class="profile-desc-right">
                            Admission Number: P1937406<br><br>
                            Hey! I'm Iian and I made the website look how it is right now! I am also a self-driven achiever and am enthusiatic in meeting people that shares my passion in technology.
                        </p>
                    </div>
                </div>
                <div class="profile-right">
                    <img src="img/portrait-2.jpeg" alt="" class="profile-img-right" data-aos="fade-left">
                    <div class="right">
                        <h3 data-aos="fade-right">Oliver Goh</h3>
                        <p data-aos="fade-right" class="profile-desc-left">
                            Admission Number: P1919488<br><br>
                            I'm Oliver and I designed and overviewed the creation of this website! Other than that, I like to constantly challenge myself and seeking discomfort.
                        </p>
                    </div>
                </div>
                <div class="profile-left">
                    <img src="img/portrait-3.jpeg" alt="" class="profile-img-left" data-aos="fade-right">
                    <div class="left">
                        <h3 data-aos="fade-left">Jerome Goh</h3>
                        <p data-aos="fade-left" class="profile-desc-right">
                            Admission Number: P1920600<br><br>
                            Hello! I’m Jerome and I made the animations for this website. I am always trying to help people. This is why my team and I made this website to help the elderly with technology.
                        </p>
                    </div>
                </div>
                <div class="profile-right">
                    <img src="img/portrait-4.jpeg" alt="" class="profile-img-right" data-aos="fade-left">
                    <div class="right">
                        <h3 data-aos="fade-right">Muhammad Rakin</h3>
                        <p data-aos="fade-right" class="profile-desc-left">
                            Admission Number: P1919855<br><br>
                            HIYA I'm Rakin and I am in charge of the backend section of the website. The forum was specially made by me with love. I'm a really outgoing guy looking for a fun time.
                        </p>
                    </div>
                </div>
            </section>
        </main>
        </div>
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
