<?php
session_start();
unset($_SESSION['loggedin']);
$ifdes = session_destroy();
echo $ifdes;
header("Location: index.html");
exit;
?>