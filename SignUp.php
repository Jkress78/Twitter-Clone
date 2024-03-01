<?php 

    if (isset($_POST["submitted"]) && $_POST["submitted"])
    {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profPic"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if (move_uploaded_file($_FILES["profPic"]["tmp_name"], $target_file)) 
        {} 
        else 
        {
            echo "Sorry, there was an error uploading your file.";
        }

        $email = $_POST["email"];
        $uName = $_POST["screenname"];
        $bday = $_POST["bDay"];
        $pswd = $_POST["password"];
        $img = "http://www2.cs.uregina.ca/~jfk188/Assignment5/" . $target_file;

        $db = new mysqli("localhost", "jfk188", "e3Vee78!", "jfk188");

        if ($db->connect_error)
        {
            die ("Conection failed: " . $db->connect_error);
        }

        $query = "INSERT INTO Users (email, screen_name, bDay, img, pswd) VALUES ('$email', '$uName', '$bday', '$img', '$pswd');";
        $result = $db->query($query);

        header("Location: Post-List-Page.php");
        $db->close();
        exit();
    }
    
?>
<!DOCTYPE html>
<html>
<head>

    <script type="text/javascript" src="SignUpScript.js"></script>
    <link rel="stylesheet" href="Blog-Styles.css">
    <title>

        Blog SignUp
    </title>
    <header class="head">
        <h1>Blog Site</h1>
        <a href="http://www2.cs.uregina.ca/~jfk188/Assignment5/Post-List-Page.html"><img src="home.png" alt="home" width="50" height="50"></a>
    </header>

</head>
    <body>
        
        
        <div class="container">
            
            <section class="label"><b>SignUp</b></section>
            <form class="forms" id="SignUp" action="http://www2.cs.uregina.ca/~jfk188/Assignment5/SignUp.php" method="post" enctype="multipart/form-data"> 
                <input type="hidden" name="submitted" value="1" />
                <table>
                    <tr>
                        <td><label for="email">E-mail:</label></td>
                        <td><input type="email" id="email" name="email" size="25" placeholder="e-mail" ></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class = "error" id="emailSError"></td>
                    </tr>
                    <tr>
                        <td><label for="screenname">Screen Name:</label></td>
                        <td><input type="text" id="screenname" name="screenname" size="25" placeholder="User Name" ></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class = "error" id="unameSError"></td>
                    </tr>
                    <tr>
                        <td><label for="bDay">Date of Birth:</label></td>
                        <td><input type="date" id="bDay" name="bDay" size="25" ></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class = "error" id="bDaySError"></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password:</label></td>
                        <td><input type="password" id="password" name="password" size="25" placeholder="Password" ></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class = "error" id="pswdSError"></td>
                    </tr>
                    <tr>
                        <td><label for="retypePass">Confirm Pass:</label></td>
                        <td><input type="password" id="retypePass" name="retypePass" size="25" placeholder="re-enter Password" ></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class = "error" id="pswdrSError"></td>
                    </tr>
                    <tr>
                        <td><label for="profPic">Profile Img:</label></td>
                        <td><input type="file" id="profPic" name="profPic" size="25" accept="image/*"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class = "error" id="imgSError"></td>
                    </tr>
                </table>
                
                <input type="submit" value="Login" size="25" class="LoginSignUp"/>
            </form>

            <script type="text/javascript" src="SignUpScrip_r.js"></script>
            
        </div>
    </body>
</html>