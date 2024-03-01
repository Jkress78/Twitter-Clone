function validatePost(event)
{
    var result = true;

    var cont = document.forms.Post.text.value;

    document.getElementById("postError").innerHTML = "";

    if(cont == null || cont == "")
    {
        document.getElementById("postError").innerHTML = "Post cannot be empty.";
        result = false;
    }

    if( cont.length > 256)
    {
        document.getElementById("postError").innerHTML = "Post cannot be more than 256 characters long";
        result = false;
    }

    if(result == false)
    {
        event.preventDefault();
    }
}

function charCounter(obj)
{
    var max = 256;
    var length = obj.value.length;
    var remain = (max - length);

    if(remain < 0)
    {
        document.getElementById("charCount").innerHTML = "Post too long.";
    }
    else
    {
        document.getElementById("charCount").innerHTML = remain + " characters remaining.";
    }
}