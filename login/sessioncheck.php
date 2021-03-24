<?php
$lifetime = 500;
$path = "/~mt85";
session_set_cookie_params($lifetime, $path);
session_start();
$_SESSION["mt85"] = true;

echo var_export($_SESSION, true);

?>