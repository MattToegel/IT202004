<?php
    require(__DIR__ . "/../lib/myFunctions.php");
    if(isset($_REQUEST["email"])){
        $email = $_REQUEST["email"];
        $password = $_REQUEST["password"];
        $confirm = $_REQUEST["confirm"];
        if(is_empty_or_null($email) || is_empty_or_null($password) || is_empty_or_null($confirm)){
            echo "Something's missing here....";
            exit();
        }
        if($password !== $confirm){
            echo "Passwords don't match...";
            exit();
        }
        require(__DIR__ . "/../lib/db.php");
        $db = getDB();
        //Note: mysqli doesn't support named parameters
        //use positional prepared statements or real_escape_string
        $email = mysqli_real_escape_string($db, $email);
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $password = mysqli_real_escape_string($db, $password);
        //mysqli still wants the single quotes in the query so can't just drop in the variables post-escape
        $sql = "INSERT INTO mt_users (email, password, rawPassword) VALUES ('$email', '$hash','$password')";
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
<form method="POST">
<label>Email</label>
<input type="text" name="email"/>
<label>Password</label>
<input type="password" name="password"/>
<input type="password" name="confirm"/>
<input type="submit" value="Register"/>
</form>