<?php
    require("nav.php");
    //require(__DIR__ . "/../lib/myFunctions.php");
    if(isset($_REQUEST["email"])){
        $email = $_REQUEST["email"];
        $password = $_REQUEST["password"];
        if(is_empty_or_null($email) || is_empty_or_null($password)){
            echo "Something's missing here....";
            exit();
        } 
        require(__DIR__ . "/../lib/db.php");
        //$db = getDB();//invoked in db.php already
        $email = mysqli_real_escape_string($db, $email);
        $hash = password_hash($password, PASSWORD_BCRYPT);
        //mysqli still wants the single quotes in the query so can't just drop in the variables post-escape
        $sql = "SELECT id, email, password from mt_users where email = '$email' LIMIT 1";
        $retVal = mysqli_query($db, $sql);
        if($retVal){
            $result = mysqli_fetch_array($retVal, MYSQLI_ASSOC);
            var_export($result);
            if(password_verify($password, $result["password"])){
                echo "<br>";
                echo "Hey you logged in!";
                unset($result["password"]);
                //session_start();
                $_SESSION["user"] = $result;
                //uncomment below to have an example of malicious user data
                ///$_SESSION["user"]["email"] = "<script>alert('The cookie monster has your cookies!' + document.cookie);</script>";
                die(header("Location: home.php"));
                //echo "<br>";
                //var_export($_SESSION);
            }
            else{
                echo "You're not you, go away";
            }
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
<input type="submit" value="Login"/>
</form>