<?php
    session_start();

    include ('dbcon.php');
    include('server.php');

    $topic = addslashes($_POST['topic']);
    $content = nl2br(addslashes($_POST['content']));
    $cid = $_GET['cid'];
    $scid = $_GET['scid'];

    $insert = mysqli_query($db, "INSERT INTO topics (`category_id`, `subcategory_id`, `author`, `title`, `content`, `date_posted`) 
                                    VALUES ('".$cid."', '".$scid."', '".$_SESSION['username']."', '".$topic."', '".$content."', NOW());");

    if ($insert) {
        header("Location: /CSADWeb/topics.php?cid=".$cid."&scid=".$scid."");
    }