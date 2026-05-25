<?php

session_start();

/* Remove all session data */

$_SESSION = array();

session_destroy();

/* Prevent cache */

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

/* Redirect */

header("Location: login.php");
exit();

?>