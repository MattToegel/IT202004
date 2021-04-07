<?php
    require("nav.php");
    //require(__DIR__ . "/../lib/myFunctions.php");
    if(isset($_REQUEST["email"])){
        $email = $_REQUEST["email"];
        $password = $_REQUEST["password"];
        $confirm = $_REQUEST["confirm"];
        $username = $_REQUEST["username"];
        //make sure values are set
        if(is_empty_or_null($email) || is_empty_or_null($password) || is_empty_or_null($confirm) || is_empty_or_null($username)){
            echo "Something's missing here....";
            exit();
        }
        //remove beginning and trailing whitespace
        $email = trim($email);
        $password = trim($password);
        $confirm = trim($confirm);
        $username = trim($username);
        //verify passwords match
        if($password !== $confirm){
            echo "Passwords don't match...";
            exit();
        }
        //validate/sanitize email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "Invalid email!!!";
            die();
        }
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        //validate/sanitize username
        /*if(strlen($username) < 4){
            echo "Username must be 4 or more characters";
            exit();
        }*/
        //using regex for length and character types
        $count = preg_match('/^[a-z]{4,20}$/i', $username, $matches);
        if($count === 0){
            echo "Username must be between 4 and 20 characters and only contain alphabetical characters.";
            exit();
        }
        $username = filter_var($username, FILTER_SANITIZE_STRING);

        //valid password
        if(strlen($password) < 6){
            echo "Password must be 6 or more characters";
            exit();
        }
        
        require(__DIR__ . "/../lib/db.php");//<-- gives us $db
        //mysqli escape
        $email = mysqli_real_escape_string($db, $email);
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $password = mysqli_real_escape_string($db, $password);
        
        $sql = "INSERT INTO mt_users (email, password, rawPassword, username) VALUES ('$email', '$hash','$password', '$username')";
        $retVal = mysqli_query($db, $sql);
        if($retVal){
            echo "Welcome to the club";
        }
        else{
            echo "Something didn't work out " . mysqli_error($db);
        }
        //TODO: don't forget to close your connection, don't want resource leaks
        mysqli_close($db);
    }
?>
<script>
function validate(form){
    let isValid = true;
    //document.forms[0];var patt = new RegExp("e");
    let emailPattern = /^[a-z]{2,4}[0-9]{0,3}@[a-z]+\.[a-z]{2,4}$/i;
    let emailRegex = new RegExp(emailPattern);
    let emailInput =    form.email.value.trim();
    console.log(emailInput, "is valid ", emailRegex.test(emailInput));
    if(emailRegex.test(emailInput)){
        document.getElementById("vEmail").innerText = "";
    }
    else{
        document.getElementById("vEmail").innerText = "Invalid email address";
        isValid = false;
    }
    let usernamePattern = /^[a-z]{4,20}$/i;
    let usernameRegex = new RegExp(usernamePattern);
    let usernameInput = form.username.value.trim();
    console.log(usernameInput, " is valid ", usernameRegex.test(usernameInput));
    if(usernameRegex.test(usernameInput)){
        document.getElementById("vUsername").innerText = "";
    }
    else{
        document.getElementById("vUsername").innerText = "Invalid Username: must only contain letters and be between 4-20 characters.";
        isValid = false;
    }
    //alert(emailPattern.test(emailInput));
    let password = form.password.value.trim();
    let confirm = form.confirm.value.trim();
    if(password !== confirm){
        console.log("Passwords don't match!");
        document.getElementById("vConfirm").innerText = "Passwords don't match";
        isValid = false;
    }
    else{
        document.getElementById("vConfirm").innerText = "";
    }
    if(password.length < 6){
        console.log("Password is too short, must be 6+");
        document.getElementById("vPassword").innerText = "Password is too short, must be 6+ characters";
        isValid = false;
    }
    else{
        document.getElementById("vPassword").innerText = "";
    }
    return isValid;//<--false prevents the form from submitting
}

</script>

<form method="POST" onsubmit="return validate(this);">
<label>Email</label>
<input type="text" name="email" required/>
<span id="vEmail"></span>
<label>Username</label>
<input type="text" name="username" required/>
<span id="vUsername"></span>
<label>Password</label>
<input type="password" name="password" required/>
<span id="vPassword"></span>
<label>Confirm Password</label>
<input type="password" name="confirm" required/>
<span id="vConfirm"></span>
<input type="submit" value="Register"/>
</form>