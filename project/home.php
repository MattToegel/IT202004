<?php
require("nav.php");
//getDebug(true);
if(!is_logged_in()){
    die(header("Location: authenticate.php"));
}
?>
<div>
Welcome, <?php safe(get_username());?>!
</div>