<?php

require("nav.php");
require(__DIR__ . "/../lib/db.php");

$weekly = getScores($db, -1, "weekly");
$monthly = getScores($db, -1, "monthly");
$lifetime = getScores($db, -1, "life");
?>
