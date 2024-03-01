<?php 
    session_start();
    if (!isset($_SESSION["user_id"]))
    {
        header("Location: Login.php");
        exit();
    }

    $db = new mysqli("localhost", "jfk188", "e3Vee78!", "jfk188");

    if ($db->connect_error)
    {
        die ("Conection failed: " . $db->connect_error);
    }

    $uid = $_SESSION["user_id"];
    $postID = $_POST["postID"];

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


    $query = "SELECT Posts.content, Users.screen_name, Users.img FROM Posts LEFT JOIN Users on Posts.user_id = Users.user_id WHERE post_id = '$postID';";
    $result2 = $db->query($query);
    if($row2 = $result2->fetch_assoc())
    {
        $old_img = $row2["img"];
        $old_content = $row2["content"];
        $old_name = $row2["screen_name"];
        $db->close();
    }

    if(isset($_POST["submitted"]) && $_POST["submitted"])
    {
        $content = $_POST["post"];
        $day = date("Y-m-d");

        $db = new mysqli("localhost", "jfk188", "e3Vee78!", "jfk188");

        if ($db->connect_error)
        {
            die ("Conection failed: " . $db->connect_error);
        }

        $query = "INSERT INTO Posts (user_id, repost_id, content, post_date) VALUES ('$uid', '$postID', '$content', '$day');";
        $result = $db->query($query);

        header("Location: Post-List-Page.php");
        $db->close();
        exit();
    }
    else{}
        
?>
<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="PostScript.js"></script>
    <link rel="stylesheet" href="Blog-Styles.css">
    <title>
        Re-Blog a Post
    </title>
    <header class="head">
        <h1>Blog Site</h1>
        <aside class="info">
            <img src="<?=$img?>" alt="profilePic" width="50" height="50" >
            <a href="http://www2.cs.uregina.ca/~jfk188/Assignment5/User-Detail-Page.php"><?=$screen_name?></a>
        </aside>
        <a href="http://www2.cs.uregina.ca/~jfk188/Assignment5/Post-List-Page.php"><img src="home.png" alt="home" width="50" height="50"></a>
    </header>

</head>
    <body>
            <br>
            <br>
            <section class="post">
                <section class="posthead">
                    <article> 
                        <h2><img src="<?=$img?>" alt="profilePic" width="50" height="50" ><?=$screen_name?></h2> 
                    </article>
                </section>
                <section class="contents">
                    <article>
                        <form id = "Post" action="http://www2.cs.uregina.ca/~jfk188/Assignment5/Re-Post.php" method="post">
                            <input type="hidden" name="submitted" value="1" />
                            <table>
                                <tr>
                                    <td><textarea id="text" name="post" rows="15" cols="70" onkeyup="charCounter(this);" placeholder="Enter text here....."></textarea></td>
                                    <td id="charCount"></td>
                                </tr>
                                <tr>
                                    <td class="error" id="postError"></td>
                                </tr>
                            </table> 
                            <input type="submit" value="Post" size="25" class="LoginSignUp"/>   
                        </form>
                    </article>

                    <script type="text/javascript" src="PostScript_r.js"></script>

                </section>
                <section class="posthead">
                    <article> 
                        <h2><img src="<?=$old_img?>" alt="profilePic" width="50" height="50" ><?=$old_name?></h2> 
                    </article>
                </section>
                <section class="contents">
                    <article>
                        <p><?=$old_content?></p>
                    </article>
                </section>
            </section>
    </body>
</html>