<?php
    error_reporting(0);

    session_start();
    
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['email']);
        header("location: login.php");
    }
    
    $conn = new mysqli('localhost:3308', 'root', '', 'seniors');

    if (isset($_POST['save'])) {
        $uID = $conn->real_escape_string($_POST['uID']);
        $ratedIndex = $conn->real_escape_string($_POST['ratedIndex']);
        $email = mysqli_real_escape_string($conn, $_SESSION['email']); 
        $ratedIndex++;
        
        $num = 1;
        
        $query = "SELECT class2 FROM users";
        $res = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($res)) {
            if ($row['class2'] == 0) {
                $conn->query("INSERT INTO stars_class2 (rateIndex) VALUES ('$ratedIndex')");
                $sql = $conn->query("SELECT id FROM stars_class2 ORDER BY id DESC LIMIT 1");
                $uData = $sql->fetch_assoc();
                $uID = $uData['id'];

                //var_dump($num);
                $class2 = "UPDATE users SET class2='1' WHERE email='$email'"; 
                mysqli_query($conn, $class2);
            } else {
                $conn->query("UPDATE stars_class2 SET rateIndex='$ratedIndex' WHERE id='$uID'");
            }
        }

        exit(json_encode(array('id' => $uID)));
    }
    
    $result = $conn->query("SELECT count(*) as total from stars_class2");
    $idData = $result->fetch_assoc();
    $idTotal = $idData['total'];
    
    $sql = $conn->query("SELECT id FROM stars_class2");
    $numR = $sql->num_rows;

    $sql = $conn->query("SELECT SUM(rateIndex) AS total FROM stars_class2");
    $rData = $sql->fetch_array();
    $total = $rData['total'];

    $avg = $total / $numR;
    
    require 'files_class2.php';
    $file = new files;
    $images = $file->getFiles();
    
    if(isset($_POST['submit'])) {
        $file->setName($_FILES['file']['name']);
        $file->setType($_FILES['file']['type']);
        $file->setSize($_FILES['file']['size']);
        $file->setUploadedDate(date("Y-m-d"));
        if($file->insert()) {
            if(move_uploaded_file($_FILES['file']['tmp_name'], 'images_class2/' . $_FILES['file']['name'])) {
                header('Location: class2.php');
            }
        }
    }
    
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styleclasses.css">
        <script src="https://kit.fontawesome.com/981eb9e0f8.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="jquery.bxslider.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="jquery.bxslider.js"></script>

        <script>
          $(document).ready(function(){
            $('.slider').bxSlider({
                speed: 100,
                touchEnabled: true
            });
          });
        </script>
        <title>Windows 10 Essentials</title>
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
            <div class="class-upper-container">
                <div class="shadow"></div>
                <div class="class-title">Mobile Applications</div>
                <div class="class-catchphrase">Achieve tech literacy in mere weeks</div>
                <div class="ratings-container">
                    <div class="ratings-stars">
                        <i class="fa fa-star fa-2x" style="margin-left: 11vh" data-index="0"></i>
                        <i class="fa fa-star fa-2x" data-index="1"></i>
                        <i class="fa fa-star fa-2x" data-index="2"></i>
                        <i class="fa fa-star fa-2x" data-index="3"></i>
                        <i class="fa fa-star fa-2x" data-index="4"></i>
                    </div>
                    <div class="ratings-text">
                        <?php 
                            if(is_nan($avg)) {
                                echo "0.0 / 5.0";
                            } else {
                                echo number_format(round($avg,2), 1, '.', '') . " / " . "5.0";
                            }
                        ?>
                        <p/>
                        <span class="ratings-total">
                            <?php 
                                if($idTotal == 1) {
                                    echo "(" . $idTotal . " Rating)";
                                } else {
                                    echo "(" . $idTotal . " Ratings)";
                                }
                            ?>
                        </span>
                    </div>
                </div>
            </div>
            <div id="container">
                <div class="class-lower-container">
                    <div class="class-desc-box">
                        <div class="desc-title">
                            What you will learn:
                        </div>
                        <p class="syllabus-left">
                        - Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Scelerisque felis imperdiet proin fermentum. Ridiculus mus mauris vitae ultricies. Augue eget arcu dictum varius duis at consectetur lorem. Pretium lectus quam id leo in vitae turpis.
                        </p>
                        <p class="syllabus-right">
                        - Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Scelerisque felis imperdiet proin fermentum. Ridiculus mus mauris vitae ultricies. Augue eget arcu dictum varius duis at consectetur lorem. Pretium lectus quam id leo in vitae turpis.
                        </p>
                    </div>
                </div>
                <div class="class-card">
                    <div class="slider img-gallery">
                        <?php
                            echo "<div class='image'><img src='images_class2/bottom-pic-2.jpg'></div>";
                            foreach($images as $image) {
                                echo "<div class='image'><img src='images_class2/" . $image["name"] . "'></div>";
                            }
                        ?>
                    </div>
                    <form method="POST" action="" name="uploadFrm" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="choose">Choose Image</div>
                            <input type="file" name="file" id="file" class="file">
                        </div>
                        <button id="submit" name="submit" type="Submit" class="upload">Upload Image</button>
                    </form>
                </div>
                <div class="class-card-text-container">
                    <div class="class-card-text">
                        <div class="price">$50</div>
                        <div class="includes">Includes</div>
                        <div class="class-package">
                            Weekly 2 hours lesson on available days
                            Pre-paid Learning Materials
                            Certificate of Completion
                        </div>
                        <div class="paypal-text">
                            [You can pay for the class digitally or you can pay physically by coming to out establishment location. For more info, please check out our Contact Us page]
                        </div>
                    </div>
                </div>
                <div class="button-container">
                    <form action="paypal.php">
                        <input type="submit" class="enroll-now-1" value="Enroll Now">
                    </form>
                </div>
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
        <script>
            var ratedIndex = -1, uID = 0;

            $(document).ready(function () {
                resetStarColors();

                if (localStorage.getItem('ratedIndex') != null) {
                    setStars(parseInt(localStorage.getItem('ratedIndex')));
                    uID = localStorage.getItem('uID');
                }

                $('.fa-star').on('click', function () {
                    <?php  if (isset($_SESSION['email'])) : ?>
                        ratedIndex = parseInt($(this).data('index'));
                        localStorage.setItem('ratedIndex', ratedIndex);
                        saveToTheDB();
                    <?php else: ?>
                        alert("Please login to rate this class!");
                        setStars(ratedIndex);
                    <?php endif ?>
                });

                $('.fa-star').mouseover(function () {
                    resetStarColors();
                    var currentIndex = parseInt($(this).data('index'));
                    setStars(currentIndex);
                });

                $('.fa-star').mouseleave(function () {
                    resetStarColors();
                    setStars(parseInt(localStorage.getItem('ratedIndex')));
                    uID = localStorage.getItem('uID');

                    if (ratedIndex != -1) {
                        setStars(ratedIndex);
                    }
                });
            });

            function saveToTheDB() {
                $.ajax({
                   url: "class2.php",
                   method: "POST",
                   dataType: 'json',
                   data: {
                       save: 1,
                       uID: uID,
                       ratedIndex: ratedIndex
                   }, success: function (r) {
                        uID = r.id;
                        localStorage.setItem('uID', uID);
                   }
                });
            }

            function setStars(max) {
                for (var i=0; i <= max; i++)
                    $('.fa-star:eq('+i+')').css('color', 'yellow');
            }

            function resetStarColors() {
                $('.fa-star').css('color', 'white');
            }
        </script>
    </body>
</html>