<?php 
    include('dbcon.php');
    session_start(); 
    
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['email']);
        header("location: login.php");
    }
    
    if (isset($_POST['submit'])) {
        $name = mysqli_real_escape_string($db, $_POST['name']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $message = mysqli_real_escape_string($db, $_POST['message']);
        // Attempt insert query execution
        $sql = "INSERT INTO contactus (name, email, message) VALUES ('$name', '$email', '$message')";
        if(mysqli_query($db, $sql)){
            $message = "Message sent successfully.";
            echo "<script type='text/javascript'>alert('$message');</script>";
        } else {
            alert("Error! Message sent unsuccessfully.");
        }
    }

    // Close connection
    mysqli_close($db);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Seniors Initalize</title>
        <link rel="stylesheet" href="./stylecontactus.css" />
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
                    <li><a href="index.php #classlink" class="nav-link1 nav-link2">Classes</a></li>
                    <li><a href="aboutus.php" class="nav-link1 nav-link2">About Us</a></li>
                    <li><a href="" class="nav-link1 nav-link2">Contact Us</a></li>
                    
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
            <section class="upper">
                <div class="main-content">
                    <div class="middle">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.775876175282!2d103.77536081457261!3d1.3097756990447076!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da1a602ff17c15%3A0xa9545dd23993859e!2sSingapore%20Polytechnic!5e0!3m2!1sen!2ssg!4v1596525263868!5m2!1sen!2ssg" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

                        <h1 class="contactus-text">Contact Us</h1>
                        <p class="upper-text">Physical payment or need<br>a face to face talk?</p>
                        <p class="lower-text">Office:
                            <br>
                            500 Dover Road, Singapore Polytechnic, Singapore 139651
                        </p>
                    </div>
                    <div class="transition-text">
                        Too Troublesome? Email Us.
                    </div>
                </div>
            </section>
            <section class="lower"style="height: 100%;">
                <div class="container-with-margin">
                    <div class="inputs-container">
                        <form action="contactus.php" method="POST">
                            <div class="field-title">Name</div>
                            <input type="text" class="input-field" name="name" required>
                            <div class="field-title">Email</div>
                            <input type="email" class="input-field" name="email" required>
                            <div class="field-title">Message</div>
                            <textarea name="message" id="message" cols="30" rows="10" class="message-box" required></textarea>
                            <div class="submit-container">
                                <input type="submit" value="Submit" class="submit-button" name="submit"/>
                            </div>
                        </form>
                    </div>
                    <div class="ending-text">
                        Email us with any questions or inquiries or call 91234567. We would be happy to answer your<br>questions and set up a meeting with you! Stay webbing!
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
    </body>
</html>
