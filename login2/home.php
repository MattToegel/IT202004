<?php
require("nav.php");
//getDebug(true);
?>
<div>
Welcome, <?php safe($_SESSION["user"]["email"]);?>!
</div>