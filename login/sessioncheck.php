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
$_SESSION["mt85"] = true;

echo var_export($_SESSION, true);
echo "<br>";
echo var_export(session_get_cookie_params(), true);
?>