<?php
    require(__DIR__ . "/../lib/myFunctions.php");
    if(isset($_REQUEST["email"])){
        $email = $_REQUEST["email"];
        $password = $_REQUEST["password"];
        if(is_empty_or_null($email) || is_empty_or_null($password)){
            echo "Something's missing here....";
            exit();
        }
        require(__DIR__ . "/../lib/db.php");
        $db = getDB();
    }
?>
<form method="POST">
<label>Email</label>
<input type="text" name="email"/>
<label>Password</label>
<input type="password" name="password"/>
<input type="submit" value="Login"/>
</form>