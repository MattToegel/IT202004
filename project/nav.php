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
<link rel="stylesheet" href="styles.css">
<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
<ul class="nav">
<?php if(!is_logged_in()):?>
<li><a href="authenticate.php">Login</a></li>
<li><a href="register.php">Register</a></li>
<?php endif;?>
<?php if(is_logged_in()):?>
<li><a href="home.php">Home</a></li>
<li><a href="profile.php">Profile</a></li>
<li><a href="logout.php">Logout</a></li>
<?php endif;?>
</ul>