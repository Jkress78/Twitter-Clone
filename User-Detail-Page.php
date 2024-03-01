<?php
    session_start();

    $uid = $_SESSION["user_id"];

    $db = new mysqli("localhost", "jfk188", "e3Vee78!", "jfk188");

    if ($db->connect_error)
    {
        die ("Conection failed: " . $db->connect_error);
    }

    $query = "SELECT screen_name, img FROM Users WHERE user_id = '$uid';";
    $result = $db->query($query);

    if($row = $result->fetch_assoc())
    {
        $screen_name = $row["screen_name"];
        $img = $row["img"];
        $db->close();
    }

    $db = new mysqli("localhost", "jfk188", "e3Vee78!", "jfk188");

    if ($db->connect_error)
    {
        die ("Conection failed: " . $db->connect_error);
    }

    $query = "SELECT Posts.post_id, Posts.content, Posts.post_date, Users.screen_name, Users.img FROM Posts LEFT JOIN Users on Posts.user_id = Users.user_id WHERE Users.screen_name = '$screen_name';";
    $result = $db->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="Blog-Styles.css">
    <script src="https://kit.fontawesome.com/1b8563858f.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="IconsScript.js"></script>
    <title>
        User Page
    </title>
    <header class="head">
        <h1>Blog Site</h1>
        <aside class="info">
            <img src="<?=$img?>" alt="profilePic" width="50" height="50" >
            <a href="http://www2.cs.uregina.ca/~jfk188/Assignment5/User-Detail-Page.php"><?=$screen_name?></a>
        </aside>
        <a href="http://www2.cs.uregina.ca/~jfk188/Assignment5/Post-List-Page.php"><img src="home.png" alt="home" width="50" height="50"></a>
    </header>
    <section class="userHeader">
        <img src="<?=$img?>" alt="profilePic" width="75" height="75" class="PFP"><h2><b><?=$screen_name?></b></h2>
        <hr size="2" width="92%" color="black">
        <p class="bio">SAMPLE TEXT</p>
        <p class="bio">SAMPLE TEXT</p>
    </section>

</head>
    <body class = "bod">
        

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
                            <td>Likes: <?=$countL?></td>
                            <td> Dislikes: <?=$countD?></td>
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
        </section>
        <br>
        <br>
         <?php
            }
            ?>

                 
        
         <script type="text/javascript" src="IconsScript_r.js"></script>
        
    </body>
</html>