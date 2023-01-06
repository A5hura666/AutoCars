<?php
session_start();
require_once "autoload.php";
require "checkAccess.php";

checkAccess("Opérateur")


?>

<html>

<head>
    <title>AutoCars | Accueil</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="shortcut icon" href="img/favicon.ico" />
</head>

<body>
    <nav>
    <section class="nav-left"> <a class="nav-logo invert" href="home-employe.php"><img src="img/logo.png" alt="logo" /></a>
            <div> <a href="home-employe.php">Accueil</a>
            </div>
            <div>
                <a href="operations.php">Opérations</a>
            </div>
            <div>
                <a href="info-client.php">Informations client</a>
            </div>
            <div>
                <a href="liste-pieces.php">Pièces</a>
            </div>
        </section>
        <section class="nav-right">
            <a class="invert" href="logout.php">
                <img class="logout" src="img/logout.png" alt="Déconnexion" />
            </a>
        </section>
    </nav>
    <main class="menu">
        <a href="operations.php">
            <article class="btn-menu"><img src="img/operation.png" alt="Opérations" />
                <h3>Liste des opérations</h3>
            </article>
        </a>
        <a href="info-client.php">
            <article class="btn-menu client">
                <img src="img/client.png" alt="Client" />
                <h3>Informations Clients</h3>
            </article>
        </a>
        <a href="liste-pieces.php">
                <article class="btn-menu client">
                    <img src="img/pieces.png" alt="Liste Pièces" />
                    <h3>Pièces</h3>
                </article>
            </a>
    </main>

    <script src="js/accueilEmployee.js"></script>
</body>

</html>