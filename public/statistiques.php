<?php
session_start();
require_once "autoload.php";
require "checkAccess.php";

checkAccess("Administrateur")



?>


<html>

<head>
    <title>AutoCars | Accueil</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="shortcut icon" href="img/favicon.ico" />
</head>

<body>
    <nav>
        <section class="nav-left"> <a class="nav-logo invert" href="home-admin.php"><img src="img/logo.png" alt="logo" /></a>
            <div> <a href="home-admin.php">Accueil</a>
                <div class="dropdown-content"></div>
            </div>
            <div><a href="creer-utilisateur.php">Créer un utilisateur</a>
                <div class="dropdown-content"></div>
            </div>
            <div><a href="statistiques.php">Statistiques</a>
                <div class="dropdown-content"></div>
            </div>
            <div><a href="#">Opérations</a>
                <div class="dropdown-content"><a href="creer-operation.php">Créer une opération</a><a href="gestion-operations.php">Gérer les opérations</a></div>
            </div>
        </section>
        <section class="nav-right">
            <a class="invert" href="logout.php">
                <img class="logout" src="img/logout.png" alt="Déconnexion" />
            </a>
        </section>
    </nav>
    <main class="menu">
        <h2 style="text-align: center;">Cettte fonctionnalité n'était pas critique au bon fonctionnement de l'application <br>ou une priorité pour le client, elle n'est pas encore implémentée.</h2>
    </main>

    <script src="js/accueilAdmin.js"></script>
</body>

</html>