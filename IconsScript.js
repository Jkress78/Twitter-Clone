function likeSwitch(event)
{
    if(event.target.style.backgroundColor != "green" && event.target.style.color != "white")
    {
        event.target.style.backgroundColor = "green";
        event.target.style.color = "white";
    }
    else
    {
        event.target.style.backgroundColor = "";
        event.target.style.color = "black";
    }
}

function dislikeSwitch(event)
{

    if(event.target.style.backgroundColor != "red" && event.target.style.color != "white")
    {
        event.target.style.backgroundColor = "red";
        event.target.style.color = "white";
    }
    else
    {
        event.target.style.backgroundColor = "";
        event.target.style.color = "black";
    }
}