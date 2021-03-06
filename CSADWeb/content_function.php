<?php
function dispcategories() {
    include ('dbcon.php');
    
    $select = mysqli_query($db, "SELECT * FROM categories");
    
    while ($row = mysqli_fetch_assoc($select)) {
        echo "<table class='category-table forum-table-background'>";
        echo "<tr><td class='main-category' colspan='1'>".$row['category_title']."</td></tr>";
        
        dispsubcategories($row['cat_id']);
        
        echo "</table>";
    }
}
function dispsubcategories($parent_id) {
    include ('dbcon.php');
    $select = mysqli_query($db, "SELECT cat_id, subcat_id, subcategory_title, subcategory_desc FROM categories, subcategories 
                                WHERE ($parent_id = categories.cat_id) AND ($parent_id = subcategories.parent_id)");
    
    echo "<tr>"
    . "<th>Categories</th>"
    . "<th class='topic-text'>Topics</th></tr>";
    while ($row = mysqli_fetch_assoc($select)) {
        echo "<tr>"
        . "<td class='category-title'>"
        . "<a href='/CSADWeb/topics.php?cid=".$row['cat_id']."&scid=".$row['subcat_id']."'>
            ".$row['subcategory_title']."<br />";
        echo $row['subcategory_desc']."</a></td>";
        echo "<td class='num-topics'>".getnumtopics($parent_id, $row['subcat_id'])."</td></tr>";
    }
}
function getnumtopics($cat_id, $subcat_id) {
    include ('dbcon.php');
    $select = mysqli_query($db, "SELECT category_id, subcategory_id FROM topics WHERE ".$cat_id." = category_id  AND ".$subcat_id." = subcategory_id");
    return mysqli_num_rows($select);
}
        
function disptopics($cid,$scid) {
    include('dbcon.php');
    $select = mysqli_query($db,"SELECT topic_id, author , title, date_posted , views , replies FROM categories, subcategories, topics WHERE ($cid = topics.category_id) AND ($scid = topics.subcategory_id) AND ($cid = categories.cat_id) AND ($scid = subcategories.subcat_id) ORDER BY topic_id DESC");
    if(mysqli_num_rows($select) != 0) {
        echo "<table class='topic-table topic-table-background'>";
        echo "<tr>"
            . "<th class='topics-table-title'>Title</th>"
            . "<th class='topics-table-posted'>Posted By</th>"
            . "<th class='topics-table-date'>Date Posted</th>"
            . "<th class='topics-table-views'>Views</th>"
            . "<th class='topics-table-replies'>Replies</th></tr>";
        while($row = mysqli_fetch_assoc($select))
        {
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
    } else {
        echo "<p class='no-topics-text' style='margin-top: 2%;'>This category has no topics yet!<a href='/CSADWeb/newtopic.php?cid=".$cid."&scid=".$scid."'>
        Why don't you add a new topic!</a></p>";
    }
 }
 function disptopic($cid, $scid, $tid) {
    include ('dbcon.php');
    $select = mysqli_query($db, "SELECT cat_id, subcat_id, topic_id, author, title, content, date_posted FROM 
                                categories, subcategories, topics WHERE ($cid = categories.cat_id) AND
                                ($scid = subcategories.subcat_id) AND ($tid = topics.topic_id)");
    $row = mysqli_fetch_assoc($select);
    echo nl2br("<div class='post-content'><h2 class='title'>".$row['title']."</h2>"
            . "<p class='post-desc'>".$row['content']."</p>"
            . "<p class='poster'>".$row['author']."\n".date('dS F Y', strtotime($row['date_posted']))."</p></div>");
    
    
}
	
function addview($cid, $scid, $tid) {
include ('dbcon.php');
    $update = mysqli_query($db, "UPDATE topics SET views = views + 1 WHERE category_id = ".$cid." AND
                                                                  subcategory_id = ".$scid." AND topic_id = ".$tid."");
}
function replylink($cid, $scid, $tid) {
    echo "<p class='reply-link'><a href='/CSADWeb/replyto.php?cid=".$cid."&scid=".$scid."&tid=".$tid."'>Reply to this post</a></p>";
}
	
function replytopost($cid, $scid, $tid) {
echo "<div class='content'><form action='/CSADWeb/addreply.php?cid=".$cid."&scid=".$scid."&tid=".$tid."' method='POST'>
    <p class='comment-text'>Comment:</p>
    <div class='text-container'>
    <textarea id='comment' name='comment'></textarea>
    </div>
    <div class='comment-button-container'> 
    <input type='submit' value='Add Comment' class='comment-button' onclick='return validate();'/>
    </div>
    </form></div>";
}
        
function dispreplies($cid, $scid, $tid) {
    include ('dbcon.php');
    $select = mysqli_query($db, "SELECT replies.author, comment, replies.date_posted FROM categories, subcategories, 
                                topics, replies WHERE ($cid = replies.category_id) AND ($scid = replies.subcategory_id)
                                AND ($tid = replies.topic_id) AND ($cid = categories.cat_id) AND 
                                ($scid = subcategories.subcat_id) AND ($tid = topics.topic_id) ORDER BY reply_id DESC");
    
    if (mysqli_num_rows($select) != 0) {
        echo "<div><table class='reply-table'>";
        while ($row = mysqli_fetch_assoc($select)) {
            echo nl2br("<div class='reply-content'><p class='reply-desc'>".$row['comment']."</p><p class='replied'>".$row['author']."\n".date('dS F Y', strtotime($row['date_posted']))."</p></div>");
        }
        echo "</table></div>";
    }
}
	
function countReplies($cid, $scid, $tid) {
    include ('dbcon.php');
    $select = mysqli_query($db, "SELECT category_id, subcategory_id, topic_id FROM replies WHERE ".$cid." = category_id AND 
                                    ".$scid." = subcategory_id AND ".$tid." = topic_id");
    return mysqli_num_rows($select);
}
