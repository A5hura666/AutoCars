<?php
session_start();
require_once "autoload.php";

session_destroy();
header("Location: login.php");
exit(0);

?>