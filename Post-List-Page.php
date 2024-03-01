<?php 
    session_start();

    $db = new mysqli("localhost", "jfk188", "e3Vee78!", "jfk188");

    if ($db->connect_error)
    {
        die ("Conection failed: " . $db->connect_error);
    }

    $uid = $_SESSION["user_id"];

    $query = "SELECT screen_name, img FROM Users WHERE user_id = '$uid';";
    $result = $db->query($query);

    if($row = $result->fetch_assoc())
    {
        $screen_name = $row["screen_name"];
        $img = $row["img"];
        $db->close();
    }

    if(isset($_POST["like"]))
    {
        $pid = $_POST["postID"];
        $db = new mysqli("localhost", "jfk188", "e3Vee78!", "jfk188");

        if ($db->connect_error)
        {
            die ("Conection failed: " . $db->connect_error);
        }

        $q = "SELECT dislike_id FROM Dislikes WHERE user_id = '$uid' AND post_id = '$pid';";
        $result = $db->query($q);

        if($row = $result->fetch_assoc())
        {
            $did = $row["dislike_id"];
            $q = "DELETE FROM Dislikes WHERE like_id = '$did';";
            $result = $db->query($q);

            $query = "INSERT INTO Likes (post_id, user_id) VALUES ('$pid','$uid');";
            $result2 = $db->query($query);
            $db-close();}

        else{
            $query = "INSERT INTO Likes (post_id, user_id) VALUES ('$pid','$uid');";
            $result = $db->query($query);
            $db->close();
        }
       
    }

    if(isset($_POST["dislike"]))
    {
        $pid = $_POST["postID"];
        $db = new mysqli("localhost", "jfk188", "e3Vee78!", "jfk188");

        if ($db->connect_error)
        {
            die ("Conection failed: " . $db->connect_error);
        }

        $q = "SELECT like_id FROM Likes WHERE user_id = '$uid' AND post_id = '$pid';";
        $result = $db->query($q);

        if($row = $result->fetch_assoc())
        {
            $lid = $row["like_id"];
            $q = "DELETE FROM Likes WHERE like_id = '$lid';";
            $result = $db->query($q);

            $query = "INSERT INTO Dislikes (post_id, user_id) VALUES ('$pid','$uid');";
            $result2 = $db->query($query);
            $_POST["dislike"] = "";
            $db-close();}

        else{
            $query = "INSERT INTO Dislikes (post_id, user_id) VALUES ('$pid','$uid');";
            $result = $db->query($query);
            $db->close();
        }
    }

    $db = new mysqli("localhost", "jfk188", "e3Vee78!", "jfk188");

    if ($db->connect_error)
    {
        die ("Conection failed: " . $db->connect_error);
    }

    $query = "SELECT Posts.post_id, Posts.repost_id, Posts.content, Posts.post_date, Users.screen_name, Users.img FROM Posts LEFT JOIN Users on Posts.user_id = Users.user_id ORDER BY Posts.post_date LIMIT 20;";
    $result = $db->query($query);

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="Blog-Styles.css">
    <script src="https://kit.fontawesome.com/1b8563858f.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="IconsScript.js"></script>
    <title>
        Blog Site
    </title>
    <header class="head">
        <h1>Blog Site</h1>
        <?php 
            if (isset($_SESSION["user_id"])){
        ?>
        <aside class="info">
            <img src="<?=$img?>" alt="profilePic" width="50" height="50" >
            <a href="http://www2.cs.uregina.ca/~jfk188/Assignment5/User-Detail-Page.php"><?=$screen_name?></a>
        </aside>
        <?php } ?>
    </header>

</head>
    <body>
        <aside class="side">
            <table>
                <tbody>
                    <tr>
                        <td class="rows"><a href="http://www2.cs.uregina.ca/~jfk188/Assignment5/Post-Page.php"><img src="PostIcon.png" alt="Make a Post" width="80" height="75"></a></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <?php 
                        if (isset($_SESSION["user_id"])){
                    ?>
                    <tr>
                        <td class="rows"><a href="http://www2.cs.uregina.ca/~jfk188/Assignment5/User-Detail-Page.php"><img src="<?=$img?>" alt="profilePic" width="75" height="75" ></a></td>
                    </tr>
                    <?php } ?>

                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="rows"><img src="gear.png" alt="gear" width="75" height="75"></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <?php 
                        if (isset($_SESSION["user_id"])){
                    ?>

                    <tr>
                        <td class="rows"><a href="http://www2.cs.uregina.ca/~jfk188/Assignment5/Logout.php"><button type="button" size="20" class="sideBut">Logout</button></a></td>
                    </tr>

                    <?php }?>

                    <?php 
                        if (!isset($_SESSION["user_id"])){
                    ?>

                    <tr>
                        <td class="rows"><a href="http://www2.cs.uregina.ca/~jfk188/Assignment5/Login.php"><button type="button" size="20" class="sideBut">Login</button></a></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="rows"><a href="http://www2.cs.uregina.ca/~jfk188/Assignment5/SignUp.php"><button type="button" size="20" class="sideBut">SignUp</button></a></td>
                    </tr>
                    <?php }?>
                    <tr>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </aside>

        <br>
        <?php 
            while($row = $result->fetch_assoc()){
        ?>
        <section class="post">
            <section class="posthead">
                <article> 
                    
                <h2><a href="http://www2.cs.uregina.ca/~jfk188/Assignment5/User-Detail-Page.php"><img src="<?=$row["img"]?>" alt="profilePic" width="50" height="50" ></a><?=$row["screen_name"]?></h2>
                <p class="date"><?=$row["post_date"]?></p> 
                   
                </article>

                <?php 
                        if (isset($_SESSION["user_id"])){
                            $postID = $row["post_id"];
                            $queryL = "SELECT COUNT(like_id) FROM Likes WHERE post_id = '$postID';";
                            $resultL = $db->query($queryL);
                            if($rowL = $resultL->fetch_assoc())
                            {
                                $countL = $rowL["COUNT(like_id)"];
                            }

                            $queryD = "SELECT COUNT(dislike_id) FROM Dislikes WHERE post_id = '$postID';";
                            $resultD = $db->query($queryD);
                            if($rowD = $resultD->fetch_assoc())
                            {
                                $countD = $rowD["COUNT(dislike_id)"];
                            }
                    ?>
                <article>
                    <form action="http://www2.cs.uregina.ca/~jfk188/Assignment5/Post-List-Page.php" method="post">
                    <table>
                        <tr>
                            <td> <input type="hidden" name="postID" value="<?=$row["post_id"]?>"/> </td>
                            <td><?=$countL?><input type="submit" name="like" value="Like" size="5" class="like"/></td>
                            <td><?=$countD?><input type="submit" name="dislike" value="Dislike" size="5" class="dislike"/></td>
                        </tr>
                    </table>
                    </form>
                        <br>
                    <form action="http://www2.cs.uregina.ca/~jfk188/Assignment5/Re-Post.php" method="post"> 
                        <input type="hidden" name="postID" value="<?=$row["post_id"]?>"/>
                        <input type="submit" size="5" class="repost" value="repost"/>
                    </form>
                    <br>
                    <br>
                </article>
                <?php }?>
            </section>
            <section class="contents">
                <article>
                    <p><?=$row["content"]?></p>
                </article>
            </section>
            <?php 
                if(isset($row["repost_id"]))
                { 
                    $repostID = $row["repost_id"];

                    //$db2 = new mysqli("localhost", "jfk188", "e3Vee78!", "jfk188");
                    //$q = "SELECT Posts.content, Posts.post_date, Users.screen_name, Users.img FROM Posts LEFT JOIN Users on Posts.user_id = Users.user_id WHERE post_id = '$repostID' OR Posts.user_id = Users.user_id;";
                    //$result2 = $db2->querry($q);
            ?>
            <section class="posthead">
                <article> 
                    <h2><img src="" alt="profilePic" width="50" height="50" ></h2> 
                </article>
            </section>
            <section class="contents">
                <article>
                    <p></p>
                </article>
            </section>
            <?php 
                }
            ?>
         </section>
         
         <br>
         <br>
         <?php  
            }
            $db->close();
            //$db2->close();
        ?>

         

         

                 
        
         <script type="text/javascript" src="IconsScript_r.js"></script>
        
    </body>
</html>