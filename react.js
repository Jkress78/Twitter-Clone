var like = document.getElementById("like");
like.addEventListener("click", setLike);

var dislike = document.getElementById("dislike");
dislike.addEventListener("click", setDislike);

function setLike(){
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange=function(){
        if(xhr.readyState==4 && xhr.status==200){
            var responseObj = JSON.parse(xhr.responseText);
            var countL = document.getElementById("countL").innerHTML ="";
            for(var i = 0; i < responseObj.length; i++){

            }
        }
    }
    var pid = document.getElementById("postID").value;
    xhr.open("GET", "react.php?pid=" + encodeURIComponent(pid),true);
    xhr.send();
}