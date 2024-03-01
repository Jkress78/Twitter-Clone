<?php 
    if(isset($_POST["submitted"]) && $_POST["submitted"])
    {
        $email = $_POST["email"];
        $pswd = $_POST["password"];
        if(strlen($email) > 0 && strlen($pswd) > 0)
        {
            $db = new mysqli("localhost", "jfk188", "e3Vee78!", "jfk188");

            if ($db->connect_error)
            {
                die ("Conection failed: " . $db->connect_error);
            }

            $q = "SELECT user_id, screen_name FROM Users WHERE email = '$email' AND pswd = '$pswd';";
            $result = $db->query($q);

            if($row = $result->fetch_assoc())
            {
                session_start();
                $_SESSION["user_id"] = $row["user_id"];
                $_SESSION["screen_name"] = $row["screen_name"];
                header("Location: Post-List-Page.php");
                $db->close();
                exit();
            }
            else
            {
                $error = ("The email/password combo was incorrect.");
                $db->close();
            }
        }
    }
    else
    {
        $error = "";
    }
?>

<!DOCTYPE html>
<html>
<head>

    <script type="text/javascript" src="LoginScript.js"></script>
    <link rel="stylesheet" href="Blog-Styles.css">
    <title>

        Blog Login
    </title>
    <header class="head">
        <h1>Blog Site</h1>
        <a href="http://www2.cs.uregina.ca/~jfk188/Assignment5/Post-List-Page.php"><img src="home.png" alt="home" width="50" height="50"></a>
    </header>

</head>
    <body>
        
        
        <div class="container">
            
            <section class="label">
                <b>Login</b>
                <p class="error"><?=$error?></p>
            </section>

            <form class="forms" id="Login" action="http://www2.cs.uregina.ca/~jfk188/Assignment5/Login.php" method="post"> 
                <input type="hidden" name="submitted" value="1" />
                <br>
                <table>
                    
                    <tr>
                        <td><label>Email:</label></td>
                        <td><input type="text" name="email" size="25" placeholder="email"></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td class = "error" id="emailError"></td>
                    </tr>
                    
                    <tr>
                        <td><label>Password:</label></td>
                        <td><input type="password" id="password" name="password" size="25" placeholder="Password"></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td class = "error" id="pswdError"></td>
                    </tr>
            </table>
                <br>
                <input type="submit" value="Login" size="25" class="LoginSignUp"/>
            </form>

            <script type="text/javascript" src="LoginScript_r.js"></script>
            
        </div>
    </body>
</html>