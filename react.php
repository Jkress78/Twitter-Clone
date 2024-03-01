<?php 
    session_start();

    $uid = $_SESSION["user_id"];

    $db = new mysqli("localhost", "jfk188", "e3Vee78!", "jfk188");

    if ($db->connect_error)
    {
        die ("Conection failed: " . $db->connect_error);
    }

    if(!isset($_GET['pid'])){
        $pid = 0;
    }
    else{
        $pid = $_GET['pid'];
    }

    $q = "SELECT like_id FROM Likes WHERE post_id = '$pid' and user_id = '$uid';";
    $q2 = "SELECT dislike_id FROM Dislikes WHERE post_id = '$pid' AND user_id = '$uid';";

    //if like already exists get like count and leave
    if($result = mysqli_query($db, $q)){
        
    }

    //if no like exists check if a dislike exists if so delete then add the like and return the count.
    else(){

        if($result = mysqli_query($db, $q2)){
            $q2 = "DELETE FROM Dislikes WHERE post_id = '$pid' AND user_id = '$uid';";
            $result = $db->query($q2);
        }

        $q = "INSERT INTO Likes (user_id, post_id) VALUES ('$uid', '$pid');";
        $result = $db->query($q);
    }


    ?>