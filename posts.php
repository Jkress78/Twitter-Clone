
<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="PostScript.js"></script>
    <link rel="stylesheet" href="Blog-Styles.css">
    <title>
        Make a Post
    </title>
    <header class="head">
        <h1>Blog Site</h1>
        <aside class="info">
            <img src="pfp.jpg" alt="profilePic" width="50" height="50" >
            <a href="http://www2.cs.uregina.ca/~jfk188/Assignment3/User-Detail-Page.html">Spicy_Cacti78</a>
        </aside>
        <a href="http://www2.cs.uregina.ca/~jfk188/Assignment3/Post-List-Page.html"><img src="home.png" alt="home" width="50" height="50"></a>
    </header>

</head>
    <body>
        
        
        <br>
        <br>
        <section class="post">
            <section class="posthead">
                <article> 
                    <h2><a href="http://www2.cs.uregina.ca/~jfk188/Assignment3/User-Detail-Page.html"><img src="pfp.jpg" alt="profilePic" width="50" height="50" ></a>Spicy_Cacti78</h2> 
                </article>
            </section>
            <section class="contents">
                <article>
                    <form id="Post" action="http://www2.cs.uregina.ca/~jfk188/Assignment3/Post-List-Page.html">
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
        </section>
    </body>
</html>