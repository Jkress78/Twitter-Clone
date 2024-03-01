function validateLogin(event)
{
    var result = true;

    var email = document.forms.Login.email.value;
    var pswd = document.forms.Login.password.value;

    var email_v = /^\w+@[a-zA-Z]+?\.[a-zA-Z]{2,3}$/;
    var pswd_v = /^(\S*)?\d+(\S*)?$/;

    document.getElementById("emailError").innerHTML = "";
    document.getElementById("pswdError").innerHTML = "";

    if(email == null || email == "" || email_v.test(email) == false)
    {
        document.getElementById("emailError").innerHTML = "Email must be in the correct format ex: abc@somewhere.sth";
        result = false;
    }

    if(pswd == null || pswd == "" || pswd_v.test(pswd) == false)
    {
        document.getElementById("pswdError").innerHTML = "Password must be 6 or more characters long and no spaces";
        result = false
    }

    if(result == false)
   {
       event.preventDefault();    
   }
}




