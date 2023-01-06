<?php
//Créé une nouvelle session.
session_start();
require_once "autoload.php";

//Détruit la session précédente, et renvoie sur l'écran de connexion.
session_destroy();
header("Location: login.php");
exit(0);

?>