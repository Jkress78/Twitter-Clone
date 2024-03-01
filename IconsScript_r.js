var like = document.getElementsByClassName("like");
var dislike = document.getElementsByClassName("dislike");

for(var i = 0; i <like.length; i++)
{
    like[i].addEventListener("click", likeSwitch);
}

for(var i = 0; i<dislike.length; i++)
{
    dislike[i].addEventListener("click", dislikeSwitch);
}