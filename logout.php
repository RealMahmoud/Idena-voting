<?php
//this just logs people out. simple! no magic here - move along
session_start();
session_destroy();
header("location:index.php");
?>