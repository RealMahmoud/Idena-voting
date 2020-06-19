<?php
//this just logs people out. simple! no magic here - move along
session_start();
unset($_SESSION['addr']);
unset($_SESSION['token']);
unset($_SESSION['pic']);
unset($_SESSION['username']);
unset($_SESSION['credits']);
unset($_SESSION['hidden']);
unset($_SESSION['age']);
unset($_SESSION['password']);
unset($_SESSION['state']);
header("location:index.php");
?>
