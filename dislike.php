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

    $q = "SELECT dislike_id FROM Dislikes WHERE post_id = '$pid' and user_id = '$uid';";
    $result = $db->query($q);

    //if dislike already exists get like count and leave
    if($row = $result->fetch_assoc()){
        //get like and dislike counts and add them to json array
        $q = "SELECT COUNT(like_id) FROM Likes WHERE Likes.post_id = '$pid';";
        $json = array("count" => array());
        $result = $db->query($q);

        if($row = $result->fetch_assoc()){
            $json["count"][] = $row["COUNT(like_id)"];
        }
        

        $q = "SELECT COUNT(dislike_id) FROM Dislikes WHERE Dislikes.post_id = '$pid';";
        $result = $db->query($q);
        if($row = $result->fetch_assoc()){
            $json["count"][] = $row["COUNT(dislike_id"];
        }

        print json_encode($json);
        mysqli_free_result($result);
    }

    //if no dislike exists check if a like exists if so delete then add the like and return the count.
    else{
        $q2 = "SELECT like_id FROM Likes WHERE post_id = '$pid' AND user_id = '$uid';";
        if($result = mysqli_query($db, $q2)){
            $q2 = "DELETE FROM Likes WHERE post_id = '$pid' AND user_id = '$uid';";
            $result = $db->query($q2);
        }

        $q = "INSERT INTO Dislikes (post_id, user_id) VALUES ('$pid', '$uid');";
        $result = $db->query($q);
        //get like and dislike counts and add them to json array
        $q = "SELECT COUNT(like_id) FROM Likes WHERE Likes.post_id = '$pid';";
        $json = array("count" => array());
        $result = $db->query($q);

        if($row = $result->fetch_assoc()){
            $json["count"][] = $row["COUNT(like_id)"];
        }
    
        $q = "SELECT COUNT(dislike_id) FROM Dislikes WHERE Dislikes.post_id = '$pid';";
        $result = $db->query($q);
        if($row = $result->fetch_assoc()){
            $json["count"][] = $row["COUNT(dislike_id"];
        }

        print json_encode($json);
        mysqli_free_result($result);
    }


    ?>