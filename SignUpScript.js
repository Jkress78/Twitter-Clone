function validateSignUp(event)
{
    var result = true;

    var email = document.forms.SignUp.email.value;
    var uname = document.forms.SignUp.screenname.value;
    var bDay = document.forms.SignUp.bDay.value;
    var pswd = document.forms.SignUp.password.value;
    var pswdr = document.forms.SignUp.retypePass.value;
    var profImg = document.forms.SignUp.profPic.value;
    

    var email_v = /^\w+@[a-zA-Z]+?\.[a-zA-Z]{2,3}$/;
    var uname_v = /^[a-zA-z0-9_-]+$/;
    var pswd_v = /^(\S*)?\d+(\S*)?$/;

    document.getElementById("emailSError").innerHTML = "";
    document.getElementById("unameSError").innerHTML = "";
    document.getElementById("bDaySError").innerHTML = "";
    document.getElementById("pswdSError").innerHTML = "";
    document.getElementById("pswdrSError").innerHTML = "";
    document.getElementById("imgSError").innerHTML = "";

    if(email == null || email == "" || email_v.test(email) == false)
    {
        document.getElementById("emailSError").innerHTML = "Email must be in the correct format ex: abc@somewhere.sth";
        result = false;
    }

    if(uname == null || uname == "" || uname_v.test(uname) == false)
    {
        document.getElementById("unameSError").innerHTML = "Screen name cannot contain any spaces or non-word characters.";
        result = false;
    }

    if(bDay == null || bDay == "")
    {
        document.getElementById("bDaySError").innerHTML = "You must enter a birth date.";
        result = false;
    }

    if(pswd == null || pswd == "" || pswd_v.test(pswd) == false)
    {
        document.getElementById("pswdSError").innerHTML = "Password must be 6 or more characters long <br> No sapces <br> One number <br> A capitol letter.";
        result = false
    }

    if(pswdr == null || pswdr == "" || pswdr != pswd)
    {
        document.getElementById("pswdrSError").innerHTML = "Passwords do not match.";
        result = false;
    }

    if(profImg == null || profImg == "")
    {
        document.getElementById("imgSError").innerHTML = "You must upload a picture.";
        result = false;
    }

    

    if(result == false)
   {
       event.preventDefault();
   }
}