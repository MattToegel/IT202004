<?php 
 session_set_cookie_params([
            'lifetime' => 60*60,
            'path' => '/~mt85/MC',
            'domain' => $_SERVER['HTTP_HOST'],
            'secure' => true,
            'httponly' => true,
            'samesite' => 'lax'
        ]);
session_start();
//echo var_export(session_get_cookie_params(), true); 
$sidvalue = session_id(); 
//echo "<br>Your session id: " . $sidvalue . "<br>";
require(__DIR__ . "/../lib/myFunctions.php");
?>
<ul>
<li><a href="authenticate.php">Login</a></li>
<li><a href="register.php">Register</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>