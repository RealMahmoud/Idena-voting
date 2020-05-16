<?php
session_start();

$_SESSION["token"] = null;


header("location:login.php");

?>
